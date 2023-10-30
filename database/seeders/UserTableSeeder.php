<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //user manager
        User::factory()->state([
            'username' => 'Manager',
            'email' => 'manager@email.com'
        ])->create()->each(function ($user) {
            $user->assignRole('manager');
        });

        //user agent
        User::factory()->state([
            'username' => 'Agent',
            'email' => 'agent@email.com'
        ])->create()->each(function ($user) {
            $user->assignRole('agent');
        });
    }
}
