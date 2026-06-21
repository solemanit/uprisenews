<?php

// database/seeders/AdminUserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Admin accounts to seed.
     * Change credentials before running in production.
     *
     * Run with:  php artisan db:seed --class=AdminUserSeeder
     */
    public function run(): void
    {
        $admins = [
            [
                'name'              => 'Super Admin',
                'email'             => 'admin@alex.com',
                'password'          => 'admin@alex.com',       // ← change before deploy
                'email_verified_at' => now(),
            ],
            // Add more admins here if needed:
            // [
            //     'name'              => 'Second Admin',
            //     'email'             => 'admin2@admin.com',
            //     'password'          => 'secret456',
            //     'email_verified_at' => now(),
            // ],
        ];

        foreach ($admins as $admin) {
            $exists = User::where('email', $admin['email'])->exists();

            if ($exists) {
                $this->command->warn("  Skipped — already exists: {$admin['email']}");
                continue;
            }

            User::create([
                'name'              => $admin['name'],
                'email'             => $admin['email'],
                'password'          => Hash::make($admin['password']),
                'email_verified_at' => $admin['email_verified_at'],
            ]);

            $this->command->info("  Created admin: {$admin['email']}");
        }
    }
}
