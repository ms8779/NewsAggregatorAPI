<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Category;
use App\Models\Preferences;
use App\Models\Source;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = User::updateOrCreate(
            ['email' => 'admin@newsaggregator.com'],
            [
                'name' => 'Administrator',
                'email' => 'admin@newsaggregator.com',
                'password' => Hash::make('admin@321'),
            ]
        );
    }
}
