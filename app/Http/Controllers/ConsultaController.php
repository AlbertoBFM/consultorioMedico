<?php

namespace App\Http\Controllers;

date_default_timezone_set("America/La_Paz");

use App\Models\Consulta;
use App\Models\Especialidad;
use App\Models\Paciente;
use App\Models\Medico;
use App\Models\Tipo;
use App\Models\User;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        // $this->middleware("secretaria");
    }

    public function index(Request $request)
    {
        $usuario = User::where("id",auth()->id())->get();
        $tipos = Especialidad::all();

        $mot = trim($request->get('mot'));
        $cimedico = trim($request->get('cimedico'));
        $cipaciente = trim($request->get('cipaciente'));
        $tipo2 = trim($request->get('tipo2'));
        $resp = trim($request->get('resp'));
        $fechaInicio = trim($request->get('f_ini'));
        $fechaFinal = trim($request->get('f_fin'));

        if ($fechaInicio == "" && $fechaFinal == "") {
            $fechaInicio = date('Y-m-d');
            $fechaFinal = date('Y-m-d');
        }
        elseif ($fechaInicio > $fechaFinal)//SI LA FECHA INICIAL ES MAYOR A LA FINAL NO REALIZARA LA BUSQUEDA
            return back()->with("success", __("La fecha de INICIO no puede ser mayor a la FINAL"));

        if ($tipo2 == ""){
            $consultas = Consulta::join('medicos', 'medico_id', '=', 'medicos.id')
                                        ->join('pacientes', 'paciente_id', '=', 'pacientes.id')
                                        ->join('tipos', 'tipo_id', '=', 'tipos.id')
                                        ->where('consultas.secretaria_id',$usuario[0]['secretaria_id'])
                                        ->where('motivo_consulta','LIKE','%'.$mot.'%')
                                        ->where('medicos.ci','LIKE','%'.$cimedico.'%')
                                        ->where('pacientes.ci','LIKE','%'.$cipaciente.'%')
                                        ->where('atentido','LIKE','%'.$resp.'%')
                                        ->where('fecha', '>=', $fechaInicio)
                                        ->where('fecha', '<=', $fechaFinal)
                                        ->orderByDesc('consultas.id')
                                        ->simplePaginate(20);
                                        // foreach ($consultas as $consulta) {
                                        //     echo $consulta;
                                        //     echo "<br><br>";
                                        // }
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
                                    ->where('fecha', '>=', $fechaInicio)
                                    ->where('fecha', '<=', $fechaFinal)
                                    ->orderByDesc('consultas.id')
                                    ->simplePaginate(20);
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
                                    ->where('fecha', '>=', $fechaInicio)
                                    ->where('fecha', '<=', $fechaFinal)
                                    ->orderByDesc('consultas.id')
                                    ->simplePaginate(20);
        }
        return view('consultas.index', compact("consultas","mot","cimedico","cipaciente","tipo2","resp","tipos","fechaInicio","fechaFinal"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paciente = Paciente::query()->select(['ci'])->get();
        // $tipos=Tipo::query()->select(['id','tipo_consulta','precio_consulta'])->get();
        $tipos = Tipo::join('especialidades', 'especialidad_id', '=', 'especialidades.id')
                    ->select('tipos.*', 'especialidades.*')
                    ->get();
        //SELECCIONAR AL MÉDICO DE TURNO
        if (date('Hi') >= '0830' && date('Hi') < '1230') {
            $medicoTurno = Medico::query()->select(['*'])->where("turnos_id",'3')->get();
        }
        elseif(date('Hi') >= '1230' && date('Hi') < '1630'){
            $medicoTurno = Medico::query()->select(['*'])->where("turnos_id",'4')->get();
        }
        else{
            $medicoTurno = Medico::query()->select(['*'])->where("turnos_id",'5')->get();
        }
        //PARA EL CONTROL DEL CALENDARIO
        $fechaMinima = date('Y-m-d');
        $dias = date("j");
        $fechaMaxima = date("Y-m-d",strtotime($fechaMinima."+ 1 month"));
        $fechaMaxima = date("Y-m-d",strtotime($fechaMaxima."- ".$dias." days"));
        //LISTAS DE MÉDICOS
        $medicosGenerales = Medico::whereNull('especialidad_id')->get();
        $medicosEspecialistas = Medico::join('especialidades', 'especialidad_id', '=', 'especialidades.id')
                                        ->select('medicos.*','especialidades.nombre_especialidad')
                                        ->get();
        return view('consultas.form',compact('paciente','tipos','medicoTurno','medicosGenerales','medicosEspecialistas','fechaMinima','fechaMaxima'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario=User::where("id",auth()->id())->get();
        $paciente=Paciente::query()->select(['id'])->where("ci",$request->pacientess)->get();

        //SI CONSULTA SIN ESPECIALIDAD
        if ($request->tipo == 1 || $request->tipo == 21 || $request->tipo == 22 || $request->tipo == 3 || $request->tipo == 4) {
            if($request->tipo == 21){//SI ES RECONSULTA ESPECIALIDAD
                $medico_id = $request->medico_esp;
                $id_tipo = 2;
                $fechaConsulta = now();
            }
            elseif ($request->tipo == 22){//SI ES RECONSULTA GENERAL
                $medico_id = $request->medico_gen;
                $id_tipo = 2;
                $fechaConsulta = $request->f_nac;
            }
            elseif ($request->tipo == 3) {//CONSULTA DOMICILIO
                $medico_id = $request->medico_gen;
                $id_tipo = 3;
                $fechaConsulta = $request->f_nac;
            }
            elseif ($request->tipo == 1) {//CONSULTA GENERAL
                $medico_id = $request->medico_turno;
                $id_tipo = 1;
                $fechaConsulta = $request->f_nac;
                $cantidadConsultas = Consulta::where('medico_id','=',$medico_id)
                                                ->where('fecha', '=', $fechaConsulta)
                                                ->count();
                if($cantidadConsultas >= 8)
                    return redirect(route("consulta.create"))->with("success",__("Limite de consultas alcanzadas"));
            }
            else{//CONSULTA  EMERGENCIA
                $medico_id = $request->medico_turno;
                $id_tipo = 4;
                $fechaConsulta = now();
            }
            Consulta::insert([
                'motivo_consulta' => $request->motivoconsulta,
                'fecha' => $fechaConsulta,
                'paciente_id' => $paciente[0]['id'],
                'tipo_id' => $id_tipo,
                'medico_id' => $medico_id,
                'secretaria_id' => $usuario[0]['secretaria_id'],
                'atentido' => "NO"
            ]);
        }
        else {
            $recupMedic = $request->medico_esp;
            //PARA SELECCIONAR EL TIPO RELACIONADO A LA ESPECIALIDAD DEL MÉDICO
            $nombre_esp = Medico::join('especialidades', 'especialidad_id', '=', 'especialidades.id')
                                        ->select('especialidades.nombre_especialidad')
                                        ->where ('medicos.id','=',$recupMedic)
                                        ->get();
            $tipo_id = Tipo::join('especialidades', 'especialidad_id', '=', 'especialidades.id')
                            ->select('tipos.id')
                            ->where('especialidades.nombre_especialidad','=',$nombre_esp[0]["nombre_especialidad"])
                            ->get();
            //INSERSIÓN
            Consulta::insert([
                'motivo_consulta' => $request->motivoconsulta,
                'fecha' => now(),
                'paciente_id' => $paciente[0]['id'],
                'tipo_id' => $tipo_id[0]["id"],
                'medico_id' => $request->medico_esp,
                'secretaria_id' => $usuario[0]['secretaria_id'],
                'atentido' => "NO"
            ]);
        }

        return redirect(route("consulta.index"))->with("success",__("Se registro la consulta Exitosamente'"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function show(Consulta $consulta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function edit(Consulta $consulta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consulta $consulta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consulta $consulta)
    {
        //
    }
}
