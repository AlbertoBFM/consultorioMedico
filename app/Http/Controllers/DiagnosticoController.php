<?php

namespace App\Http\Controllers;

date_default_timezone_set("America/La_Paz");

use App\Models\Paciente;
use App\Models\Diagnostico;
use App\Models\Medico;
use App\Models\Consulta;
use App\Models\User;
use Illuminate\Http\Request;

class DiagnosticoController extends Controller
{
    // public function __construct(){
    //     $this->middleware("medico");
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $usuario = User::where("id",auth()->id())->get();

        $mot = trim($request->get('mot'));
        $cipaciente = trim($request->get('cipaciente'));
        $resp = trim($request->get('resp'));
        $fechaInicio = trim($request->get('f_ini'));
        $fechaFinal = trim($request->get('f_fin'));

        if ($fechaInicio == "" && $fechaFinal == "") {
            $fechaInicio = date('Y-m-d');
            $fechaFinal = date('Y-m-d');
        }
        elseif ($fechaInicio > $fechaFinal)//SI LA FECHA INICIAL ES MAYOR A LA FINAL NO REALIZARA LA BUSQUEDA
            return back()->with("success", __("La fecha de INICIO no puede ser mayor a la FINAL"));

        $consultas = Consulta::join('medicos', 'medico_id', '=', 'medicos.id')
                                ->join('pacientes', 'paciente_id', '=', 'pacientes.id')
                                ->join('tipos', 'tipo_id', '=', 'tipos.id')
                                ->select('consultas.*')
                                ->where('motivo_consulta','LIKE','%'.$mot.'%')
                                ->where('consultas.medico_id','=',$usuario[0]['medico_id'])
                                ->where('pacientes.ci','LIKE','%'.$cipaciente.'%')
                                ->where('atentido','LIKE','%'.$resp.'%')
                                ->where('fecha', '>=', $fechaInicio)
                                ->where('fecha', '<=', $fechaFinal)
                                ->orderByDesc('consultas.id')
                                ->simplePaginate(20);

        return view('diagnostico.index', compact("consultas","mot","cipaciente","resp","fechaInicio","fechaFinal"));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexTurno()
    {
        $usuario = User::where("id",auth()->id())->get();

        $consultas = Consulta::join('medicos', 'medico_id', '=', 'medicos.id')
                                ->join('pacientes', 'paciente_id', '=', 'pacientes.id')
                                ->join('tipos', 'tipo_id', '=', 'tipos.id')
                                ->select('consultas.*')
                                ->where('consultas.medico_id','=',$usuario[0]['medico_id'])
                                ->where('fecha', '=', date('Y-m-d'))
                                ->where('consultas.atentido',"=","NO")
                                ->orderByDesc('consultas.id')
                                ->simplePaginate(20);

                                // echo $consultas;
        return view('diagnostico.show', compact("consultas"));
    }
    public function verDiagnostico(Request $request)
    {
        $diagnostico = Diagnostico::join('consultas', 'consulta_id', '=', 'consultas.id')
                                    ->select('diagnosticos.*')
                                    ->where('consulta_id','=',$request->consulta)->get();
        $aux_diagnostico = Diagnostico::where('consulta_id','=',$request->consulta)->get();
        $update = true;
        $route = route("diagnostico.update", ["diagnostico" => $aux_diagnostico[0]]);
        $button = __("Modificar");
        return view('diagnostico.form',compact('diagnostico','update','route','button'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $consulta = Consulta::join('medicos', 'medico_id', '=', 'medicos.id')
                                ->join('pacientes', 'paciente_id', '=', 'pacientes.id')
                                ->join('tipos', 'tipo_id', '=', 'tipos.id')
                                ->select('consultas.*','pacientes.nombres','pacientes.apellidos')
                                ->where('consultas.id','=',$request->consulta)
                                ->get();
        $route = route("diagnostico.store");
        $button = __("Registrar");
        return view('diagnostico.form',compact('consulta','route','button'));
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

        Diagnostico::insert([
            'Anamnesis' => $request->anamnesis,
            'Enfermedad_Actual' => $request->enfermedadactual,
            'Examen_Fisico_General' => $request->examenfisicogeneral,
            'Examenes_complementarios' => $request->examenescomplementarios,
            'Diagnostico' => $request->diagnostico,
            'Tratamiento' => $request->tratamiento,
            'medico_id' => $usuario[0]['medico_id'],
            'paciente_id' => $request->pacientess,
            'consulta_id' => $request->consulta
        ]);

        $consultas=Consulta::find($request->consulta);
        $consultas->atentido="SI";
        $consultas->save();
        return redirect(route('indexTurno'))->with("success",__("SE REGISTRO LA CONSULTA CORRECTAMENTE"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Diagnostico  $diagnostico
     * @return \Illuminate\Http\Response
     */
    public function show(Diagnostico $diagnostico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Diagnostico  $diagnostico
     * @return \Illuminate\Http\Response
     */
    public function edit(Diagnostico $diagnostico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Diagnostico  $diagnostico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diagnostico $diagnostico)
    {
        $diagnostico->fill([
            'Anamnesis' => $request->anamnesis,
            'Enfermedad_Actual' => $request->enfermedadactual,
            'Examen_Fisico_General' => $request->examenfisicogeneral,
            'Examenes_complementarios' => $request->examenescomplementarios,
            'Diagnostico' => $request->diagnostico,
            'Tratamiento' => $request->tratamiento,
        ])->save();
        return back()->with("success", __("Médico Modificado"));
        // return redirect(route("medico.index"))->with("success", __("¡Médico Modificado!"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Diagnostico  $diagnostico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diagnostico $diagnostico)
    {
        //
    }
}
