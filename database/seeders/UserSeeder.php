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
            'name'=>'empleado',
            'email'=>'ingreso@ingreso.com',
            'password'=>bcrypt('ingreso@ingreso.com')

        ])->assignRole('empleado');

        User::create([
            'name'=>'root',
            'email'=>'root@root.com',
            'password'=>bcrypt('root027a')

        ])->assignRole('root');
    }
}
