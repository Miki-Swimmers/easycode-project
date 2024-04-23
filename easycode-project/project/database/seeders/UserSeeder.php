<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(10)->create()->each(function (User $user) {
            foreach (['notifications:orders', 'notifications:payments'] as $notification) {
                $user->settings()->create([
                    'key' => $notification,
                    'value' => false
                ]);
            }
        });
    }
}
