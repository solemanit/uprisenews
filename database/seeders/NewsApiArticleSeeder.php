<?php

// database/seeders/NewsApiArticleSeeder.php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsApiArticleSeeder extends Seeder
{
    // ── Config ────────────────────────────────────────────────────────────────

    private const API_URL   = 'https://newsapi.org/v2/top-headlines';
    private const API_KEY   = 'b2ff761f8c354ea8b4c3f34b08328612';
    private const LIMIT     = 20;

    // ── Entry point ───────────────────────────────────────────────────────────

    public function run(): void
    {
        $this->command->info('📡 Fetching articles from NewsAPI...');

        $articles = $this->fetchArticles();

        if (empty($articles)) {
            $this->command->error('No articles returned from NewsAPI. Aborting.');
            return;
        }

        // Ensure we have at least one author & default category
        $author   = $this->resolveAuthor();
        $category = $this->resolveCategory('Business');

        $inserted = 0;

        foreach ($articles as $item) {
            if ($inserted >= self::LIMIT) break;

            // Skip articles with removed / placeholder content
            if (
                empty($item['title']) ||
                $item['title'] === '[Removed]' ||
                empty($item['description'])
            ) {
                continue;
            }

            $imagePath = $this->downloadImage($item['urlToImage'] ?? null, $inserted + 1);

            // Resolve per-article category from the source name, fallback to Business
            $articleCategory = $this->resolveCategory(
                $item['source']['name'] ?? 'Business'
            );

            $title   = $this->cleanText($item['title']);
            $excerpt = $this->cleanText($item['description'] ?? '');
            $body    = $this->buildBody($item);

            Article::create([
                // Core
                'title'          => $title,
                'slug'           => Article::generateUniqueSlug($title),
                'excerpt'        => Str::limit($excerpt, 300),
                'body'           => $body,
                'featured_image' => $imagePath,
                'category_id'   => $articleCategory->id,
                'author_id'     => $author->id,

                // Status
                'status'         => 'published',
                'is_featured'    => $inserted < 3,        // first 3 are featured
                'is_breaking'    => $inserted === 0,      // very first is breaking
                'published_at'   => $item['publishedAt'] ?? now(),

                // SEO — auto-derived
                'seo_title'       => Str::limit($title, 60),
                'seo_description' => Str::limit($excerpt, 160),
                'seo_keywords'    => $this->extractKeywords($title),
                'canonical_url'   => $item['url'] ?? null,
            ]);

            $inserted++;
            $this->command->info("  ✅ [{$inserted}] {$title}");
        }

        $this->command->info("\n🎉 Done! {$inserted} articles seeded successfully.");
    }

    // ── NewsAPI fetch ─────────────────────────────────────────────────────────

    private function fetchArticles(): array
    {
        $response = Http::timeout(15)->get(self::API_URL, [
            'country'  => 'us',
            'category' => 'business',
            'pageSize' => self::LIMIT + 5, // fetch a few extra to account for skipped items
            'apiKey'   => self::API_KEY,
        ]);

        if (! $response->successful()) {
            $this->command->error('API request failed: ' . $response->status());
            return [];
        }

        return $response->json('articles', []);
    }

    // ── Image download ────────────────────────────────────────────────────────

    private function downloadImage(?string $url, int $index): ?string
    {
        if (empty($url)) return null;

        try {
            $response = Http::timeout(10)->get($url);

            if (! $response->successful()) return null;

            $contentType = $response->header('Content-Type');

            // Only accept image content types
            if (! str_contains($contentType, 'image/')) return null;

            $ext  = $this->extensionFromContentType($contentType);
            $name = 'articles/news_' . $index . '_' . Str::random(6) . '.' . $ext;

            Storage::disk('public')->put($name, $response->body());

            return $name;
        } catch (\Throwable $e) {
            $this->command->warn("  ⚠️  Could not download image #{$index}: " . $e->getMessage());
            return null;
        }
    }

    private function extensionFromContentType(string $type): string
    {
        return match (true) {
            str_contains($type, 'png')  => 'png',
            str_contains($type, 'gif')  => 'gif',
            str_contains($type, 'webp') => 'webp',
            default                     => 'jpg',
        };
    }

    // ── Helpers ───────────────────────────────────────────────────────────────

    /**
     * Use the first existing user as author, or create a dedicated seed user.
     */
    private function resolveAuthor(): User
    {
        return User::first() ?? User::factory()->create([
            'name'  => 'News Desk',
            'email' => 'newsdesk@example.com',
        ]);
    }

    /**
     * Find or create a category by name.
     */
    private function resolveCategory(string $name): Category
    {
        return Category::firstOrCreate(
            ['slug' => Str::slug($name)],
            ['name' => $name]
        );
    }

    /**
     * Build a full body from available NewsAPI fields.
     * NewsAPI truncates `content` at 200 chars; we pad with description.
     */
    private function buildBody(array $item): string
    {
        $content = $this->cleanText($item['content'] ?? '');
        $desc    = $this->cleanText($item['description'] ?? '');
        $source  = $item['source']['name'] ?? '';
        $origUrl = $item['url'] ?? '';

        // Remove the "[+XXXX chars]" suffix NewsAPI appends
        $content = preg_replace('/\s*\[\+\d+ chars\]$/', '', $content);

        $body = '';

        if ($content) {
            $body .= "<p>{$content}</p>\n";
        }

        if ($desc && $desc !== $content) {
            $body .= "<p>{$desc}</p>\n";
        }

        if ($source && $origUrl) {
            $body .= "\n<p><em>Source: <a href=\"{$origUrl}\" target=\"_blank\" rel=\"noopener\">{$source}</a></em></p>";
        }

        return $body ?: '<p>Full article available at the source link.</p>';
    }

    /**
     * Strip non-UTF-8 junk that sometimes comes back from NewsAPI.
     */
    private function cleanText(?string $text): string
    {
        if (empty($text)) return '';

        // Remove HTML tags, normalize whitespace
        $text = strip_tags($text);
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = preg_replace('/\s+/', ' ', $text);

        return trim($text);
    }

    /**
     * Pull the first 5 significant words from the title as comma-separated keywords.
     */
    private function extractKeywords(string $title): string
    {
        $stopWords = ['the', 'a', 'an', 'in', 'on', 'at', 'to', 'for', 'of', 'and', 'or', 'is', 'are', 'was', 'were'];

        $words = array_filter(
            explode(' ', strtolower($title)),
            fn ($w) => strlen($w) > 3 && ! in_array($w, $stopWords)
        );

        return implode(', ', array_slice(array_values($words), 0, 5));
    }
}
