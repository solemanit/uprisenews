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

        $tree = [
            [
                'name'        => 'Politics',
                'description' => 'National and international political news, government affairs, and policy.',
                'sort_order'  => 1,
                'children'    => [
                    ['name' => 'National',      'description' => 'Domestic political affairs and governance.',         'sort_order' => 1],
                    ['name' => 'International', 'description' => 'Foreign policy and global political developments.',   'sort_order' => 2],
                    ['name' => 'Elections',     'description' => 'Election coverage, results, and analysis.',          'sort_order' => 3],
                    ['name' => 'Parliament',    'description' => 'Legislative proceedings and parliamentary news.',    'sort_order' => 4],
                ],
            ],
            [
                'name'        => 'Business',
                'description' => 'Economy, markets, corporate news, and financial analysis.',
                'sort_order'  => 2,
                'children'    => [
                    ['name' => 'Economy',       'description' => 'Macroeconomic indicators, policy, and trends.',      'sort_order' => 1],
                    ['name' => 'Markets',       'description' => 'Stock markets, commodities, and trading updates.',   'sort_order' => 2],
                    ['name' => 'Companies',     'description' => 'Corporate earnings, mergers, and business strategy.','sort_order' => 3],
                    ['name' => 'Startups',      'description' => 'Emerging companies, funding rounds, and founders.',  'sort_order' => 4],
                    ['name' => 'Real Estate',   'description' => 'Property markets, housing, and infrastructure.',     'sort_order' => 5],
                ],
            ],
            [
                'name'        => 'Technology',
                'description' => 'Latest in tech, gadgets, software, AI, and digital culture.',
                'sort_order'  => 3,
                'children'    => [
                    ['name' => 'Artificial Intelligence', 'description' => 'AI research, tools, ethics, and applications.',      'sort_order' => 1],
                    ['name' => 'Gadgets',                 'description' => 'Consumer electronics, reviews, and launches.',        'sort_order' => 2],
                    ['name' => 'Cybersecurity',           'description' => 'Data breaches, privacy, and digital security.',       'sort_order' => 3],
                    ['name' => 'Social Media',            'description' => 'Platforms, trends, and the creator economy.',         'sort_order' => 4],
                    ['name' => 'Science & Research',      'description' => 'Breakthroughs in science and academic research.',     'sort_order' => 5],
                ],
            ],
            [
                'name'        => 'Sports',
                'description' => 'Live scores, match reports, transfers, and sporting events.',
                'sort_order'  => 4,
                'children'    => [
                    ['name' => 'Cricket',    'description' => 'Test, ODI, T20 matches and cricket news.',              'sort_order' => 1],
                    ['name' => 'Football',   'description' => 'Club football, international, and transfers.',           'sort_order' => 2],
                    ['name' => 'Tennis',     'description' => 'Grand slams, ATP/WTA tour news and results.',            'sort_order' => 3],
                    ['name' => 'Olympics',   'description' => 'Olympic Games coverage and athlete stories.',            'sort_order' => 4],
                    ['name' => 'Other Sports','description' => 'Hockey, basketball, motorsport, and more.',             'sort_order' => 5],
                ],
            ],
            [
                'name'        => 'Entertainment',
                'description' => 'Movies, music, celebrity news, and pop culture.',
                'sort_order'  => 5,
                'children'    => [
                    ['name' => 'Movies',     'description' => 'Film reviews, box office, and industry news.',           'sort_order' => 1],
                    ['name' => 'Music',      'description' => 'Albums, concerts, artist interviews, and charts.',       'sort_order' => 2],
                    ['name' => 'Television', 'description' => 'Series, streaming shows, and TV reviews.',               'sort_order' => 3],
                    ['name' => 'Celebrity',  'description' => 'Celebrity news, awards, and red-carpet coverage.',       'sort_order' => 4],
                ],
            ],
            [
                'name'        => 'Health',
                'description' => 'Medical news, wellness, mental health, and healthcare policy.',
                'sort_order'  => 6,
                'children'    => [
                    ['name' => 'Wellness',       'description' => 'Fitness, nutrition, and healthy living tips.',       'sort_order' => 1],
                    ['name' => 'Mental Health',  'description' => 'Psychology, therapy, and emotional wellbeing.',      'sort_order' => 2],
                    ['name' => 'Medical Research','description' => 'Clinical trials, drug approvals, and discoveries.',  'sort_order' => 3],
                    ['name' => 'Healthcare Policy','description' => 'Insurance, hospital systems, and public health.',  'sort_order' => 4],
                ],
            ],
            [
                'name'        => 'World',
                'description' => 'International news from every region of the globe.',
                'sort_order'  => 7,
                'children'    => [
                    ['name' => 'Asia',          'description' => 'News from South Asia, East Asia, and Southeast Asia.','sort_order' => 1],
                    ['name' => 'Europe',        'description' => 'European Union, UK, and continental affairs.',        'sort_order' => 2],
                    ['name' => 'Middle East',   'description' => 'Regional conflicts, diplomacy, and economies.',       'sort_order' => 3],
                    ['name' => 'Americas',      'description' => 'US, Canada, Latin America, and the Caribbean.',       'sort_order' => 4],
                    ['name' => 'Africa',        'description' => 'Political and economic developments across Africa.',  'sort_order' => 5],
                ],
            ],
            [
                'name'        => 'Opinion',
                'description' => 'Editorials, columns, op-eds, and reader perspectives.',
                'sort_order'  => 8,
                'children'    => [
                    ['name' => 'Editorials', 'description' => 'Official editorial board positions and commentary.',     'sort_order' => 1],
                    ['name' => 'Columns',    'description' => 'Regular opinion columns from staff writers.',            'sort_order' => 2],
                    ['name' => 'Op-Ed',      'description' => 'Opinion pieces from external contributors.',             'sort_order' => 3],
                    ['name' => 'Letters',    'description' => 'Letters to the editor from readers.',                    'sort_order' => 4],
                ],
            ],
            [
                'name'        => 'Lifestyle',
                'description' => 'Travel, food, fashion, and everyday living.',
                'sort_order'  => 9,
                'children'    => [
                    ['name' => 'Travel',     'description' => 'Destinations, guides, and travel industry news.',        'sort_order' => 1],
                    ['name' => 'Food',       'description' => 'Recipes, restaurant reviews, and food culture.',         'sort_order' => 2],
                    ['name' => 'Fashion',    'description' => 'Trends, designers, and style guides.',                   'sort_order' => 3],
                    ['name' => 'Home & Garden','description' => 'Interior design, DIY, and home improvement.',          'sort_order' => 4],
                ],
            ],
            [
                'name'        => 'Environment',
                'description' => 'Climate change, nature, conservation, and sustainability.',
                'sort_order'  => 10,
                'children'    => [
                    ['name' => 'Climate',        'description' => 'Climate science, policy, and global warming news.',  'sort_order' => 1],
                    ['name' => 'Conservation',   'description' => 'Wildlife, biodiversity, and protected habitats.',    'sort_order' => 2],
                    ['name' => 'Sustainability', 'description' => 'Green energy, recycling, and eco-friendly living.',  'sort_order' => 3],
                    ['name' => 'Natural Disasters','description' => 'Earthquakes, floods, storms, and disaster relief.','sort_order' => 4],
                ],
            ],
        ];

        foreach ($tree as $parentData) {
            $children = $parentData['children'] ?? [];
            unset($parentData['children']);

            $parent = Category::create(array_merge($parentData, ['status' => true]));

            foreach ($children as $childData) {
                Category::create(array_merge($childData, [
                    'parent_id' => $parent->id,
                    'status'    => true,
                ]));
            }
        }

        $this->command->info('✓ Categories seeded: 10 parent + 44 children');
    }
}
