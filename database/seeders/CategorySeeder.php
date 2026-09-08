<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Truncate cleanly (respects soft deletes column if present)
        Category::withTrashed()->forceDelete();

        $categories = [
            ['name' => 'National',              'description' => 'Domestic news and affairs from across the country.',              'sort_order' => 1],
            ['name' => 'Politics',               'description' => 'National and international political news, government affairs, and policy.', 'sort_order' => 2],
            ['name' => 'Countrywide',            'description' => 'News and events from every district and region of the country.',  'sort_order' => 3],
            ['name' => 'International',          'description' => 'Foreign policy and global political developments.',               'sort_order' => 4],
            ['name' => 'Sports',                 'description' => 'Live scores, match reports, transfers, and sporting events.',      'sort_order' => 5],
            ['name' => 'Entertainment',          'description' => 'Movies, music, celebrity news, and pop culture.',                  'sort_order' => 6],
            ['name' => 'Opinion',                'description' => 'Editorials, columns, op-eds, and reader perspectives.',            'sort_order' => 7],
            ['name' => 'Crime',                  'description' => 'Crime reports, investigations, and law enforcement news.',         'sort_order' => 8],
            ['name' => 'Law & Justice',          'description' => 'Court proceedings, verdicts, and the justice system.',             'sort_order' => 9],
            ['name' => 'Capital',                'description' => 'News and updates from the capital city.',                          'sort_order' => 10],
            ['name' => 'Environment',            'description' => 'Climate change, nature, conservation, and sustainability.',        'sort_order' => 11],
            ['name' => 'Weather',                'description' => 'Weather forecasts, warnings, and seasonal updates.',               'sort_order' => 12],
            ['name' => 'Economy',                'description' => 'Macroeconomic indicators, policy, and trends.',                    'sort_order' => 13],
            ['name' => 'Industry & Commerce',    'description' => 'Trade, industry, and business developments.',                      'sort_order' => 14],
            ['name' => 'Art & Literature',       'description' => 'Literary works, art news, and cultural commentary.',               'sort_order' => 15],
            ['name' => 'Health',                 'description' => 'Medical news, wellness, mental health, and healthcare policy.',    'sort_order' => 16],
            ['name' => 'Lifestyle',              'description' => 'Travel, food, fashion, and everyday living.',                      'sort_order' => 17],
            ['name' => 'Campus',                 'description' => 'Education, student life, and campus news.',                        'sort_order' => 18],
            ['name' => 'Travel',                 'description' => 'Destinations, guides, and travel industry news.',                  'sort_order' => 19],
            ['name' => 'Jobs',                   'description' => 'Job listings, career news, and recruitment updates.',              'sort_order' => 20],
            ['name' => 'Fact Check',             'description' => 'Fact-checking reports and verification of viral claims.',          'sort_order' => 21],
        ];

        foreach ($categories as $categoryData) {
            Category::create(array_merge($categoryData, ['status' => true]));
        }

        $this->command->info('✓ Categories seeded: ' . count($categories) . ' (flat, no sub-categories)');
    }
}
