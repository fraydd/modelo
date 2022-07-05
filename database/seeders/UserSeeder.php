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
    public function run()
    {
        User::create([
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'password'=>bcrypt('admin@admin.com')

        ])->assignRole('admin');

        User::create([
            'name'=>'empleado',
            'email'=>'empleado@empleado.com',
            'password'=>bcrypt('empleado@empleado.com')

        ])->assignRole('empleado');
    }
}
