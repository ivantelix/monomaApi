<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'agent',
                'guard_name' => 'api'
            ],
            [
                'name' => 'manager',
                'guard_name' => 'api'
            ]
        ];

        Role::insert($roles);
    }
}
