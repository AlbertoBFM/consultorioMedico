<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return \DB::table('tipos')->insert([
            [
                "precio_consulta" => 25.0,//GENERAL
                "especialidad_id" => null,
                "created_at" => now()
            ],
            [
                "precio_consulta" => 20.0,//RECONSULTA
                "especialidad_id" => null,
                "created_at" => now()
            ],
            [
                "precio_consulta" => 50.0,//DOMICILIO
                "especialidad_id" => null,
                "created_at" => now()
            ],
            [
                "precio_consulta" => 35.0,//EMERGENCIA
                "especialidad_id" => null,
                "created_at" => now()
            ],
            [
                "precio_consulta" => 50.0,//GINECOLOGIA
                "especialidad_id" => 1,
                "created_at" => now()
            ],
            [
                "precio_consulta" => 120.0,//ECOGRAFIA
                "especialidad_id" => 2,
                "created_at" => now()
            ]
        ]);
    }
}
