<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    protected $fillable = [
        'Anamnesis',
        'Enfermedad_Actual',
        'Examen_Fisico_General',
        'Examenes_complementarios',
        'Diagnostico',
        'Tratamiento',
        'medico_id',
        'paciente_id',
    ];
    use HasFactory;
    public function medicos(){
        return $this->belongsTo(Medico::class,'medico_id');
    }
    public function pacientes(){
        return $this->belongsTo(Paciente::class,'paciente_id');
    }
    public function consultas(){
        return $this->belongsTo(Consulta::class,'consulta_id');
    }
}
