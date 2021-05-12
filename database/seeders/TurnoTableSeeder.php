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
                "turnos" => "00:00 - 04:00",
                "created_at" => now()
            ],
            [
                "turnos" => "04:00 - 08:00",
                "created_at" => now()
            ],
            [
                "turnos" => "08:00 - 12:00",
                "created_at" => now()
            ],
            [
                "turnos" => "12:00 - 16:00",
                "created_at" => now()
            ],
            [
                "turnos" => "16:00 - 20:00",
                "created_at" => now()
            ],
            [
                "turnos" => "20:00 - 00:00",
                "created_at" => now()
            ]
        ]);
    }
}
