<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class mediosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            'medio'=>'Efectivo',
        ];
        DB::table('medios')->insert($data);

        $data=[
            'medio'=>'Transferencia',
        ];
        DB::table('medios')->insert($data);
    }
    
}
