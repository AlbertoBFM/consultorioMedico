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
        return \DB::table('turnos')->insert([
            [
                "turnos" => "Mañana",
                "created_at" => now()
            ],
            [
                "turnos" => "Tarde",
                "created_at" => now()
            ],
            [
                "turnos" => "Noche",
                "created_at" => now()
            ]
        ]);
    }
}
