<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $data=[
            'tipo'=>'A+',
        ];
        DB::table('rhs')->insert($data);

        $data=[
            'tipo'=>'A-',
        ];
        DB::table('rhs')->insert($data);

        $data=[
            'tipo'=>'B+',
        ];
        DB::table('rhs')->insert($data);

        $data=[
            'tipo'=>'B-',
        ];
        DB::table('rhs')->insert($data);

        $data=[
            'tipo'=>'AB+',
        ];
        DB::table('rhs')->insert($data);

        $data=[
            'tipo'=>'AB-',
        ];
        DB::table('rhs')->insert($data);

        $data=[
            'tipo'=>'O+',
        ];
        DB::table('rhs')->insert($data);

        $data=[
            'tipo'=>'O-',
        ];
        DB::table('rhs')->insert($data);

    }
}
