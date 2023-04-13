<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UserSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();

        User::factory()->count(1)
            ->create([
                'image' => 'https://ps.w.org/user-avatar-reloaded/assets/icon-256x256.png?rev=2540745',
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'password' => Hash::make('ayoub123'),
            ])
            ->each(
                function ($user) {
                    $user->assignRole('simple-user');
                }
            );
        User::factory()->count(1)
            ->create([
                'image' => 'https://ps.w.org/user-avatar-reloaded/assets/icon-256x256.png?rev=2540745',
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'password' => Hash::make('ayoub123'),
            ])
            ->each(
                function ($user) {
                    $user->assignRole('moderator');
                }
            );

        User::factory()->count(1)
            ->create([
                'image' => 'https://ps.w.org/user-avatar-reloaded/assets/icon-256x256.png?rev=2540745',
                'name' => 'ayoub Ouabi',
                'email' => 'ayoub@gmail.com',
                'password' => Hash::make('ayoub123'),
            ])
            ->each(
                function ($user) {
                    $user->assignRole('super-admin');
                }
            );
    }
}
