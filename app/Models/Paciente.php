<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    protected $fillable = [
        'ci',
        'apellidos',
        'nombres',
        'f_nac',
        'sexo',
        'cel',
        'secretaria_id',
    ];

    public function diagnosticos(){
        return $this->hasMany(Diagnostico::class, 'id');
    }
} 
