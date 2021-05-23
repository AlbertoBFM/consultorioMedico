<?php

namespace App\Http\Controllers;

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
    public function index(Request $request)
    {
        $usuario = User::where("id",auth()->id())->get();
        $tipos = Especialidad::all();

        $mot = trim($request->get('mot'));
        $cimedico = trim($request->get('cimedico'));
        $cipaciente = trim($request->get('cipaciente'));
        $tipo2 = trim($request->get('tipo2'));
        $resp = trim($request->get('resp'));


        $consultas = Consulta::join('medicos', 'medico_id', '=', 'medicos.id')
                                    ->join('pacientes', 'paciente_id', '=', 'pacientes.id')
                                    ->join('tipos', 'tipo_id', '=', 'tipos.id')
                                    ->where('consultas.secretaria_id',$usuario[0]['secretaria_id'])
                                    ->where('motivo_consulta','LIKE','%'.$mot.'%')
                                    ->where('medicos.ci','LIKE','%'.$cimedico.'%')
                                    ->where('pacientes.ci','LIKE','%'.$cipaciente.'%')
                                    ->where(function ($query) {
                                        $query->select('nombre_especialidad')
                                                ->from('especialidades')
                                                ->whereColumn('tipos.especialidad_id', 'especialidades.id');
                                    },'LIKE','%'.$tipo2.'%')
                                    ->where('atentido','LIKE','%'.$resp.'%')
                                    ->paginate(8);

        return view('consultas.index', compact("consultas","mot","cimedico","cipaciente","tipo2","resp","tipos"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paciente=Paciente::query()->select(['ci'])->get();
        // $tipos=Tipo::query()->select(['id','tipo_consulta','precio_consulta'])->get();
        $tipos=Tipo::join('especialidades', 'especialidad_id', '=', 'especialidades.id')
                    ->select('tipos.*', 'especialidades.*')
                    ->get();
        if (date('Hi') - 400 >= '0830' && date('Hi') - 400 < '1230') {
            $medicos=Medico::query()->select(['*'])->where("turnos_id",'3')->get();
        }
        elseif(date('Hi') - 400 >= '1230' && date('Hi') - 400 < '1630'){
            $medicos=Medico::query()->select(['*'])->where("turnos_id",'4')->get();
        }
        else{
            $medicos=Medico::query()->select(['*'])->where("turnos_id",'5')->get();
        }
        return view('consultas.form',compact('paciente','tipos','medicos'));
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
        Consulta::insert([
            'motivo_consulta' => $request->motivoconsulta,
            'medico_id' => $request->medicos,
            'paciente_id' => $paciente[0]['id'],
            'secretaria_id' => $usuario[0]['secretaria_id'],
            'tipo_id' => $request->tipos,
            'atentido' => "NO"
        ]);
        return \redirect(route("consulta.create"))->with("success",__("Se registro la consulta Exitosamente'"));
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
