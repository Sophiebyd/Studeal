<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * @return void
     */
    public function run()
    {
        Role::create([
            'role' => 'admin',
            'id' => '1'
        ]);

        Role::create([
            'role' => 'student',
            'id' => '2'
        ]);

        Role::create([
            'role' => 'user',
            'id' => '3'
        ]);
    }
}
