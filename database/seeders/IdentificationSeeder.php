<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IdentificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $data1=[
            'tipo'=>'PAP',
            'desc'=>'Pasaporte'

        ];
        DB::table('identifications')->insert($data1); $data2=[
            'tipo'=>'CC',
            'desc'=>'Cédula de ciudadania'
        ];
        DB::table('identifications')->insert($data2);  $data3=[
            'tipo'=>'TI',
            'desc'=>'Tarjeta de identidad'

        ];
        DB::table('identifications')->insert($data3); 

        $data4=[
            'tipo'=>'CE',
            'desc'=>'Cédula extranjera'

        ];
        DB::table('identifications')->insert($data4); 

        $data5=[
            'tipo'=>'NIP',
            'desc'=>'Número de identificación personal'

        ];
        DB::table('identifications')->insert($data5); 

        $data5=[
            'tipo'=>'NIT',
            'desc'=>'Número de identificación tributaria'

        ];
        DB::table('identifications')->insert($data5); 

        $data5=[
            'tipo'=>'NA',
            'desc'=>'Indocumentado'

        ];
        DB::table('identifications')->insert($data5); 
        
    }
}
