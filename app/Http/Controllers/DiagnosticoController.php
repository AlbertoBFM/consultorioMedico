<?php

namespace App\Http\Controllers;
use App\Models\Paciente;
use App\Models\Diagnostico;
use App\Models\Medico;
use App\Models\Consulta;
use App\Models\User;
use Illuminate\Http\Request;

class DiagnosticoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuario=User::where("id",auth()->id())->get();
        $paciente=Paciente::join('consultas','consultas.paciente_id',"=","pacientes.id")
                            ->select("pacientes.id","pacientes.ci","pacientes.nombres","pacientes.apellidos")
                            ->where('consultas.medico_id',$usuario[0]['medico_id'])
                            ->where('consultas.atentido',"=","NO")
                            ->get();
        return view('diagnostico.index',compact('paciente'));
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
            'paciente_id' => $request->pacientess
        ]);


        $paciente1=Paciente::join('consultas','consultas.paciente_id',"=","pacientes.id")
                            ->select("consultas.id")
                            ->where('consultas.medico_id',$usuario[0]['medico_id'])
                            ->where('consultas.atentido',"=","NO")
                            ->get();

        $consultas=Consulta::find($paciente1[0]['id']);
        $consultas->atentido="SI";
        $consultas->save();
        return redirect(route('diagnostico.create'))->with("success",__("SE REGISTRO LA CONSULTA CORRECTAMENTE"));
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
        //
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
