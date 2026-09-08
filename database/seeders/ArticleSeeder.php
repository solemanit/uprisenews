<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * How many articles to seed per category.
     */
    protected int $perCategory = 8;

    /**
     * Base endpoint for the dummy/free news source.
     * Docs: https://api.spaceflightnewsapi.net/v4/docs/
     */
    protected string $apiBase = 'https://api.spaceflightnewsapi.net/v4/articles';

    public function run(): void
    {
        // Truncate cleanly (respects soft deletes column if present)
        Article::withTrashed()->forceDelete();

        // Make sure we have at least one author to attach articles to
        $author = User::first() ?? User::factory()->create([
            'name'  => 'Demo Editor',
            'email' => 'editor@example.com',
        ]);

        // Make sure the public disk is linked and the target folder exists
        Storage::disk('public')->makeDirectory('articles');

        $categories = Category::orderBy('sort_order')->get();

        if ($categories->isEmpty()) {
            $this->command->warn('No categories found — run CategorySeeder first.');
            return;
        }

        $totalCreated = 0;

        foreach ($categories as $catIndex => $category) {
            // Fetch a fresh, non-overlapping batch of "dummy" news items for this category
            $items = $this->fetchDummyNews($catIndex, $this->perCategory);

            foreach ($items as $i => $item) {
                $globalIndex = ($catIndex * $this->perCategory) + $i;

                Article::create([
                    'title'          => $item['title'],
                    'excerpt'        => $item['excerpt'],
                    'body'           => $item['body'],
                    'featured_image' => $this->downloadImage($item['image_url'], $item['title'], $globalIndex),
                    'category_id'    => $category->id,
                    'author_id'      => $author->id,
                    'status'         => 'published',
                    // First article of each category is featured, one random one is breaking
                    'is_featured'    => $i === 0,
                    'is_breaking'    => $i === random_int(1, $this->perCategory - 1),
                    'published_at'   => $item['published_at'] ?? Carbon::now()->subHours($globalIndex * 3),
                ]);

                $totalCreated++;
            }

            $this->command->info("✓ {$category->name}: " . count($items) . ' articles seeded');
        }

        $this->command->info("✓ Demo articles seeded: {$totalCreated}");
    }

    /**
     * Pull `$count` dummy news items from the public Spaceflight News API,
     * offset per category so categories don't repeat the same items.
     * Falls back to locally generated Faker content if the API is
     * unreachable or returns insufficient data.
     *
     * @return array<int, array{title:string, excerpt:string, body:string, image_url:?string, published_at:?Carbon}>
     */
    protected function fetchDummyNews(int $catIndex, int $count): array
    {
        $offset = $catIndex * $count;

        try {
            $response = Http::timeout(10)->get($this->apiBase, [
                'limit'  => $count,
                'offset' => $offset,
            ]);

            if ($response->successful()) {
                $results = $response->json('results') ?? [];

                if (count($results) >= $count) {
                    return collect($results)
                        ->take($count)
                        ->map(function (array $item) {
                            $summary = trim($item['summary'] ?? '');

                            return [
                                'title'        => $item['title'] ?? 'Untitled News',
                                'excerpt'      => Str::limit($summary, 200),
                                'body'         => $this->expandBody($summary),
                                'image_url'    => $item['image_url'] ?? null,
                                'published_at' => isset($item['published_at'])
                                    ? Carbon::parse($item['published_at'])
                                    : null,
                            ];
                        })
                        ->all();
                }

                $this->command->warn("API returned fewer than {$count} items for offset {$offset} — filling the rest with fallback content.");

                // Pad out whatever we got with generated fallback items
                $have = collect($results)->map(fn (array $item) => [
                    'title'        => $item['title'] ?? 'Untitled News',
                    'excerpt'      => Str::limit(trim($item['summary'] ?? ''), 200),
                    'body'         => $this->expandBody(trim($item['summary'] ?? '')),
                    'image_url'    => $item['image_url'] ?? null,
                    'published_at' => isset($item['published_at']) ? Carbon::parse($item['published_at']) : null,
                ])->all();

                $missing = $count - count($have);

                return array_merge($have, $this->fallbackNews($missing));
            }
        } catch (\Throwable $e) {
            $this->command->warn("Dummy news API unreachable ({$e->getMessage()}) — using fallback content.");
        }

        return $this->fallbackNews($count);
    }

    /**
     * Turn a short summary into a multi-paragraph body so seeded articles
     * don't look too thin on the article detail page.
     */
    protected function expandBody(string $summary): string
    {
        if ($summary === '') {
            $summary = fake()->paragraphs(3, true);
        }

        $extra = fake()->paragraphs(2, true);

        return $summary . "\n\n" . $extra;
    }

    /**
     * Locally generated placeholder news items, used when the external
     * dummy news API is unreachable or doesn't return enough data.
     *
     * @return array<int, array{title:string, excerpt:string, body:string, image_url:?string, published_at:?Carbon}>
     */
    protected function fallbackNews(int $count): array
    {
        return collect(range(1, $count))->map(function () {
            $title = Str::ucfirst(fake()->sentence(8));

            return [
                'title'        => rtrim($title, '.'),
                'excerpt'      => fake()->sentence(20),
                'body'         => fake()->paragraphs(4, true),
                'image_url'    => null,
                'published_at' => null,
            ];
        })->all();
    }

    /**
     * Download a featured image from a given URL (or a picsum placeholder
     * if no URL is available) and store it on the public disk, returning
     * the relative path to save in `featured_image`.
     */
    protected function downloadImage(?string $url, string $title, int $seed): ?string
    {
        $filename = 'articles/' . Str::slug($title) . '-' . $seed . '.jpg';

        // Skip re-downloading if it already exists (re-running the seeder)
        if (Storage::disk('public')->exists($filename)) {
            return $filename;
        }

        // Fall back to a deterministic placeholder image if the API gave no image
        $url = $url ?: "https://picsum.photos/seed/{$seed}/1200/630";

        try {
            $response = Http::timeout(10)->get($url);

            if ($response->successful()) {
                Storage::disk('public')->put($filename, $response->body());

                return $filename;
            }
        } catch (\Throwable $e) {
            $this->command->warn("Could not download image for \"{$title}\": {$e->getMessage()}");
        }

        return null;
    }
}
