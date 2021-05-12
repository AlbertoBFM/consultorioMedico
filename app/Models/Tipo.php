<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;

    public function consultas(){
        return $this->hasMany(Consulta::class, 'id');
    }
    protected $fillable = [
        'precio_consulta',
        'especialidad_id'
    ];

    public function consultas(){
        return $this->hasMany(Consulta::class, 'id');
    }

    public function especialidades(){
        return $this->belongsTo(Especialidad::class, 'id');
    }
}
