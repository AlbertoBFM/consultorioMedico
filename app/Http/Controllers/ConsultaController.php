<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
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
    public function index()
    {
        $success=__('Se registro la consulta Exitosamente');
        return view('consultas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paciente=Paciente::query()->select(['ci'])->get();
        $tipos=Tipo::query()->select(['id','tipo_consulta','precio_consulta'])->get();
        $medicos=Medico::query()->select(['*'])->get();
        return view('consultas.index',compact('paciente','tipos','medicos'));
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
