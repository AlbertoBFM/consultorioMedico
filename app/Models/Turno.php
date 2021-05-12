<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    use HasFactory;

    protected $fillable = [
        'turnos'
    ];

    public function medicos(){
        return $this->hasMany(Medico::class, 'id');
    }

    public function secretaria(){
        return $this->hasMany(Secretaria::class);
    }
}
