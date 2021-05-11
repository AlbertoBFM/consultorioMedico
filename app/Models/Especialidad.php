<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
<<<<<<< HEAD
    use HasFactory;
=======
    public $table = "especialidades";

    use HasFactory;

    protected $fillable = [
        'nombre_especialidad'
    ];

    public function medicos(){
        return $this->hasMany(Medico::class, 'id');
    }
>>>>>>> 0a99fa1116c721f9afc5ea8f5a8f925b90a9fa81
}
