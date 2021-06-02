<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

use App\Models\Medico;
use App\Models\Secretaria;
use App\Models\Paciente;
use App\Models\Consulta;

use App\Models\User;

use App\Models\Tipo;
use App\Models\Especialidad;
use App\Models\Turno;

class PDFController extends Controller
{
    public function PDF(){
        $pdf = PDF::loadView('prueba');
        return $pdf->stream('prueba.pdf');
    }
    public function PDFMedicos(Request $request){
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
    public function PDFSecretarias(Request $request){
        $ci = trim($request->get('ci2'));
        $nombre = trim($request->get('nombre2'));
        $apellido = trim($request->get('apellido2'));
        $turno3 = trim($request->get('turno32'));

        $secretarias = Secretaria::join('turnos', 'turnos_id', '=', 'turnos.id')
                                ->where('ci','LIKE','%'.$ci.'%')
                                ->where('nombres','LIKE','%'.$nombre.'%')
                                ->where('apellidos','LIKE','%'.$apellido.'%')
                                ->where('turnos','LIKE','%'.$turno3.'%')
                                ->paginate(8);

        $pdf = PDF::loadView('secretaria.reporte', compact("secretarias"))->setPaper('legal', 'landscape');
        return $pdf->stream('secretarias.pdf');
    }
    public function PDFPacientes(Request $request){

        $ci = trim($request->get('ci2'));
        $nombre = trim($request->get('nombre2'));
        $apellido = trim($request->get('apellido2'));
        $sexo2 = trim($request->get('sexo22'));

        $usuario=User::where("id",auth()->id())->get();

        $pacientes=Paciente::where("secretaria_id",$usuario[0]['secretaria_id'])
                                ->where('ci','LIKE','%'.$ci.'%')
                                ->where('nombres','LIKE','%'.$nombre.'%')
                                ->where('apellidos','LIKE','%'.$apellido.'%')
                                ->where('sexo','LIKE','%'.$sexo2.'%')
                                ->paginate(8);

        $pdf = PDF::loadView('paciente.reporte', compact("pacientes"))->setPaper('legal', 'landscape');
        return $pdf->stream('pacientes.pdf');
    }
    public function PDFConsultas(Request $request){

        $usuario = User::where("id",auth()->id())->get();

        $mot = trim($request->get('mot2'));
        $cimedico = trim($request->get('cimedico2'));
        $cipaciente = trim($request->get('cipaciente2'));
        $tipo2 = trim($request->get('tipo22'));
        $resp = trim($request->get('resp2'));

        if ($tipo2 == ""){
            $consultas = Consulta::join('medicos', 'medico_id', '=', 'medicos.id')
                                        ->join('pacientes', 'paciente_id', '=', 'pacientes.id')
                                        ->join('tipos', 'tipo_id', '=', 'tipos.id')
                                        ->where('consultas.secretaria_id',$usuario[0]['secretaria_id'])
                                        ->where('motivo_consulta','LIKE','%'.$mot.'%')
                                        ->where('medicos.ci','LIKE','%'.$cimedico.'%')
                                        ->where('pacientes.ci','LIKE','%'.$cipaciente.'%')
                                        ->where('atentido','LIKE','%'.$resp.'%')
                                        ->orderByDesc('fecha')
                                        ->paginate(8);
        }
        else if ($tipo2 == 'General' || $tipo2 == 'Reconsulta' || $tipo2 == 'Domicilio' || $tipo2 == 'Emergencia') {
            if($tipo2 == 'General')
                $aux_tipo = 1;
            elseif ($tipo2 == 'Reconsulta')
                $aux_tipo = 2;
            elseif ($tipo2 == 'Domicilio')
                $aux_tipo = 3;
            else
                $aux_tipo = 4;

            $consultas = Consulta::join('medicos', 'medico_id', '=', 'medicos.id')
                                    ->join('pacientes', 'paciente_id', '=', 'pacientes.id')
                                    ->join('tipos', 'tipo_id', '=', 'tipos.id')
                                    ->where('consultas.secretaria_id',$usuario[0]['secretaria_id'])
                                    ->where('motivo_consulta','LIKE','%'.$mot.'%')
                                    ->where('medicos.ci','LIKE','%'.$cimedico.'%')
                                    ->where('pacientes.ci','LIKE','%'.$cipaciente.'%')
                                    ->where('consultas.tipo_id','LIKE','%'.$aux_tipo.'%')
                                    ->where('atentido','LIKE','%'.$resp.'%')
                                    ->orderByDesc('fecha')
                                    ->paginate(8);
        }
        else {
            // recuperamos el id de tipo dependiendo de la especialidad escogida
            $aux_tipo = Tipo::join('especialidades', 'especialidad_id', '=', 'especialidades.id')
                                ->select('tipos.id')
                                ->where("nombre_especialidad",$tipo2)->get();

            $consultas = Consulta::join('medicos', 'medico_id', '=', 'medicos.id')
                                    ->join('pacientes', 'paciente_id', '=', 'pacientes.id')
                                    ->join('tipos', 'tipo_id', '=', 'tipos.id')
                                    ->where('consultas.secretaria_id',$usuario[0]['secretaria_id'])
                                    ->where('motivo_consulta','LIKE','%'.$mot.'%')
                                    ->where('medicos.ci','LIKE','%'.$cimedico.'%')
                                    ->where('pacientes.ci','LIKE','%'.$cipaciente.'%')
                                    ->where('consultas.tipo_id','LIKE','%'.$aux_tipo[0]['id'].'%')
                                    ->where('atentido','LIKE','%'.$resp.'%')
                                    ->orderByDesc('fecha')
                                    ->paginate(8);
        }

        $pdf = PDF::loadView('consultas.reporte', compact("consultas"))->setPaper('legal', 'landscape');
        return $pdf->stream('consultas.pdf');
    }
}
