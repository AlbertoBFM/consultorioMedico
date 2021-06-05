<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $fillable = [
        'motivo_consulta',
        'medico_id',
        'paciente_id',
        'secretaria_id',
        'tipo_id',
        'atendido'
    ];

    public function tipos(){
        return $this->belongsTo(Tipo::class, 'tipo_id');
    }

    public function medico(){
        return $this->belongsTo(Medico::class, 'medico_id');
    }
    public function paciente(){
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
    public function diagnostico(){
        return $this->belongsTo(Diagnostico::class, 'id');
    }

}
