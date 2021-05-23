<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secretaria extends Model
{
    use HasFactory;
    protected $fillable = [
        'ci',
        'apellidos',
        'nombres',
        'f_nac',
        'cel',
        'salario_id',
        'turnos_id'
    ];
    public function turnos(){
        return $this->belongsTo(Turno::class,'turnos_id');
    }

    public function salarios(){
        return $this->belongsTo(Salario::class,'salario_id');
    }
}
