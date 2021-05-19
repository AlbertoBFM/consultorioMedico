<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Secretaria;
use App\Models\User;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __contruct(){
        $this->middleware("auth");
    }
    public function index()
    {
        $usuario=User::where("id",auth()->id())->get();
        $pacientes=Paciente::where("secretaria_id",$usuario[0]['secretaria_id'])->paginate(5);
        return view("paciente.index",compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $boton=__('INSERTAR');
        $ruta=route('paciente.store');
        $ci=__('INGRESA EL CARNET DE IDENTIDAD');
        $nombre=__('INGRESA LOS NOMBRES');
        $apellido=__('INGRESA LOS APELLIDOS');
        $celular=__('INGRESA EL NUMERO DE CELULAR');
        return view("paciente.form",compact('boton','ruta','ci','nombre','apellido','celular'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        echo $request->nombres;
        $this->validate($request, [
            "carnetidentidad" => "required",
            "nombres" => "required",
            "apellidos" => "required",
            "fechanacimiento" => "required",
            "sexo" => "required",
            "celular" => "required",
        ]);

        $usuario=User::where("id",auth()->id())->get();

        Paciente::insert([
            'ci' => $request->carnetidentidad,
            'apellidos' => $request->apellidos,
            'nombres' => $request->nombres,
            'f_nac' => $request->fechanacimiento,
            'sexo' => $request->sexo,
            'cel' => $request->celular,
            'secretaria_id' => $usuario[0]['secretaria_id'],
        ]);

        return \redirect(route("paciente.index"))->with("success",__("¡Paciente Creado!"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function show(Paciente $paciente)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function edit(Paciente $paciente)
    {
        $boton=__('ACTUALIZAR');
        $ruta=route('paciente.update',['paciente'=>$paciente]);
        $ci=__("$paciente->ci");
        $nombre=__("$paciente->nombres");
        $apellido=__("$paciente->apellidos");
        $celular=__("$paciente->cel");
        $actualizar=__("$paciente->sexo");
        $actualizar2=__("$paciente->f_nac");
        $update=__("yes");
        return view("paciente.form",compact('boton','ruta','ci','nombre','apellido','celular','actualizar','actualizar2','update'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paciente $paciente)
    {
        $pacientes=Paciente::find($paciente->id);
        $pacientes->ci=$request->carnetidentidad;
        $pacientes->apellidos=$request->apellidos;
        $pacientes->nombres=$request->nombres;
        $pacientes->f_nac=$request->fechanacimiento;
        $pacientes->sexo=$request->sexo;
        $pacientes->cel=$request->celular;
        $pacientes->save();
        return redirect(route('paciente.index'))->with("success",__("SE MODIFICO CORRECTAMENTE"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paciente $paciente)
    {
        $mensaje="El usuario ".$paciente->nombres." $paciente->apellidos se elimino exitosamente!!!";
        $pacientes = Paciente::find($paciente->id);
        $pacientes->delete();
        return redirect(route('paciente.index'))->with("success",$mensaje);
    }
}
