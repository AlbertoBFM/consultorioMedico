<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EspecialidadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return \DB::table('especialidades')->insert([
            [
                "nombre_especialidad" => "Ginecología",
                "created_at" => now()
            ],
            [
                "nombre_especialidad" => "Ecografía",
                "created_at" => now()
            ],
            // [
            //     "nombre_especialidad" => "Cirugía General",
            //     "created_at" => now()
            // ],
            // [
            //     "nombre_especialidad" => "Medicina Interna",
            //     "created_at" => now()
            // ]
        ]);
    }
}
