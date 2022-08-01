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
            'nombre'=>'Mensualidad',
            'valor'=>0,
            

        ]);

    }
}
