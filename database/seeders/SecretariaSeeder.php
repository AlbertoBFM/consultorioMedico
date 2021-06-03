<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SecretariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         return \DB::table('secretarias')->insert([
            [
                "ci" => "12345687",
                "apellidos" => "Mamani",
                "nombres" => "Juana",
                "f_nac" => "2021-05-11",
                "cel" => "213254656",
                "salario_id" => 2,
                "turnos_id" => 1,
                "created_at" => now()
            ]
        ]);
    }
}
