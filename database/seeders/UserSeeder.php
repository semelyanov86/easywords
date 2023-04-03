<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        /** @var User $admin */
        $admin = \App\Models\User::factory()
            ->createOne([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('password'),
            ]);
        $admin->settings()->setMultiple(config('model_settings.defaultSettings.users'));
        /** @var User $user */
        $user = \App\Models\User::factory()
            ->createOne([
                'email' => 'user@user.com',
                'password' => \Hash::make('password'),
            ]);
        $user->settings()->setMultiple(config('model_settings.defaultSettings.users'));
    }
}
