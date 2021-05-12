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
                "tipo_consulta" => "Medicina General",
                "precio_consulta" => 25.0,
                "created_at" => now()
            ],
            [
                "tipo_consulta" => "Reconsulta",
                "precio_consulta" => 20.0,
                "created_at" => now()
            ],
            [
                "tipo_consulta" => "Ginecologia",
                "precio_consulta" => 50.0,
                "created_at" => now()
            ],
            [
                "tipo_consulta" => "Ecografía",
                "precio_consulta" => 120.0,
                "created_at" => now()
            ],
            [
                "tipo_consulta" => "Consulta a Domicilio",
                "precio_consulta" => 50.0,
                "created_at" => now()
            ],
            [
                "tipo_consulta" => "Emergencias",
                "precio_consulta" => 35.0,
                "created_at" => now()
            ],
        ]);
    }
}
