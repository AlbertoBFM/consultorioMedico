<?php

namespace Database\Factories;

use App\Models\Medico;
use App\Models\Especialidad;
use App\Models\Salario;
use App\Models\Turno;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Medico::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "ci" => $this->faker->biasedNumberBetween($min = 11111111, $max = 99999999, $function = 'sqrt'),
            "apellidos" => $this->faker->name(),
            "nombres" => $this->faker->name(),
            "f_nac" => $this->faker->date(),
            "cel" => $this->faker->phoneNumber,
            "especialidad_id" => Especialidad::all()->random()->id,
            "salario_id" => 1,
            "turnos_id" => 6
            // "salario_id" => Salario::all()->random()->id,
            // "turnos_id" => Turno::all()->random()->id
        ];
    }
}
