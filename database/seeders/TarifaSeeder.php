<?php

namespace Database\Seeders;

use App\Models\Tarifa;
use Illuminate\Database\Seeder;

class TarifaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tarifa::create([
            'tipo'=>'Mensualidad',
            'valor'=>0,
            

        ]);

        Tarifa::create([
            'tipo'=>'Pasarela',
            'valor'=>0,

        ]);
    }
}
