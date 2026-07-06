<?php

// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Run all seeders:      php artisan db:seed
     * Run admin only:       php artisan db:seed --class=AdminUserSeeder
     * Fresh + seed:         php artisan migrate:fresh --seed
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            CategorySeeder::class,
            NewsApiArticleSeeder::class
        ]);
    }
}
