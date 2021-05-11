<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    public $table = "especialidades";

    use HasFactory;

    protected $fillable = [
        'nombre_especialidad'
    ];

    public function medicos(){
        return $this->hasMany(Medico::class, 'id');
    }
}
