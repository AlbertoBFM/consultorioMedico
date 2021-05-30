<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

use App\Models\Medico;
use App\Models\Secretaria;
use App\Models\Paciente;
use App\Models\Consulta;

use App\Models\Especialidad;
use App\Models\Turno;

class PDFController extends Controller
{
    public function PDF(){
        $pdf = PDF::loadView('prueba');
        return $pdf->stream('prueba.pdf');
    }
    public function PDFMedicos(){

        $medicos = Medico::all();

        $pdf = PDF::loadView('medicos.reporte', compact("medicos"))->setPaper('legal', 'landscape');
        return $pdf->stream('medicos.pdf');
    }
    public function PDFSecretarias(){

        $secretarias = Secretaria::all();

        $pdf = PDF::loadView('secretaria.reporte', compact("secretarias"))->setPaper('legal', 'landscape');
        return $pdf->stream('secretarias.pdf');
    }
    public function PDFPacientes(){

        $pacientes = Paciente::all();

        $pdf = PDF::loadView('paciente.reporte', compact("pacientes"))->setPaper('legal', 'landscape');
        return $pdf->stream('pacientes.pdf');
    }
    public function PDFConsultas(){

        $consultas = Consulta::all();

        $pdf = PDF::loadView('consultas.reporte', compact("consultas"))->setPaper('legal', 'landscape');
        return $pdf->stream('consultas.pdf');
    }
}
