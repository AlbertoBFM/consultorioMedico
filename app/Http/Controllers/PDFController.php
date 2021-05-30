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
    public function PDFMedicos(Request $request){
        // $medicos = Medico::all();
        $ci = trim($request->get('ci2'));
        $nombre = trim($request->get('nombre2'));
        $apellido = trim($request->get('apellido2'));
        $especialidad = trim($request->get('especialidad2'));
        $turno = trim($request->get('turno2'));

        if($especialidad == ""){
            $medicos = Medico::join('turnos', 'turnos_id', '=', 'turnos.id')
                            ->where('ci','LIKE','%'.$ci.'%')
                            ->where('nombres','LIKE','%'.$nombre.'%')
                            ->where('apellidos','LIKE','%'.$apellido.'%')
                            ->where('turnos','LIKE','%'.$turno.'%')
                            ->get();
        }
        elseif ($especialidad == "Sin Especialidad") {
            $medicos = Medico::join('turnos', 'turnos_id', '=', 'turnos.id')
                            ->where('ci','LIKE','%'.$ci.'%')
                            ->where('nombres','LIKE','%'.$nombre.'%')
                            ->where('apellidos','LIKE','%'.$apellido.'%')
                            ->where('turnos','LIKE','%'.$turno.'%')
                            ->whereNull('especialidad_id')
                            ->get();
        }
        else{
            $medicos = Medico::join('especialidades', 'especialidad_id', '=', 'especialidades.id')
                            ->join('turnos', 'turnos_id', '=', 'turnos.id')
                            ->where('ci','LIKE','%'.$ci.'%')
                            ->where('nombres','LIKE','%'.$nombre.'%')
                            ->where('apellidos','LIKE','%'.$apellido.'%')
                            ->where('nombre_especialidad','LIKE','%'.$especialidad.'%')
                            ->where('turnos','LIKE','%'.$turno.'%')
                            ->get();
        }
        // echo $medicos;
        $pdf = PDF::loadView('medicos.reporte', compact("medicos","ci","nombre","apellido","especialidad","turno"))->setPaper('legal', 'landscape');
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
