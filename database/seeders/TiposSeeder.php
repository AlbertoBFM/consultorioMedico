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
                "precio_consulta" => 25.0,
                "especialidad_id" => 1,
                "created_at" => now()
            ],
            [
                "precio_consulta" => 20.0,
                "especialidad_id" => 2,
                "created_at" => now()
            ],
            [
                "precio_consulta" => 50.0,
                "especialidad_id" => 3,
                "created_at" => now()
            ],
            [
                "precio_consulta" => 120.0,
                "especialidad_id" => 4,
                "created_at" => now()
            ]
        ]);
    }
}
