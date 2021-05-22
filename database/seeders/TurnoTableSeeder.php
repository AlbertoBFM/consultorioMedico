<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TurnoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return \DB::table('turnos')->insert([//6 FILAS
            [
                "turnos" => "08:30 - 14:30",
                "created_at" => now()
            ],
            [
                "turnos" => "14:30 - 20:30",
                "created_at" => now()
            ],
            [
                "turnos" => "08:30 - 12:30",
                "created_at" => now()
            ],
            [
                "turnos" => "12:30 - 16:30",
                "created_at" => now()
            ],
            [
                "turnos" => "16:30 - 20:30",
                "created_at" => now()
            ]
        ]);
    }
}
