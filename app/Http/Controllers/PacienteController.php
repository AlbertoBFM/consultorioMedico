<?php

namespace App\Http\Controllers;

date_default_timezone_set("America/La_Paz");

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
    public function __construct(){
        // $this->middleware("secretaria");
    }

    public function index(Request $request)
    {
        $ci = trim($request->get('ci'));
        $nombre = trim($request->get('nombre'));
        $apellido = trim($request->get('apellido'));
        $sexo2 = trim($request->get('sexo2'));

        $pacientes=Paciente::where('ci','LIKE','%'.$ci.'%')
                                ->where('nombres','LIKE','%'.$nombre.'%')
                                ->where('apellidos','LIKE','%'.$apellido.'%')
                                ->where('sexo','LIKE','%'.$sexo2.'%')
                                ->paginate(8);

        return view("paciente.index",compact('pacientes','ci','nombre','apellido','sexo2'));
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
        $ci=__('');
        $nombre=__('');
        $apellido=__('');
        $celular=__('');
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
        //fecha actual
        $fecha_Actual = date("Y-m-d");
        $this->validate($request, [
            "ci" => "required|unique:pacientes|unique:medicos|unique:secretarias|numeric|min:10000000|max:9999999999",
            "nombres" => "required|max:100|regex:/(^([a-zA-z])[a-zA-z ]*([a-zA-Z]*)$)/u",
            "apellidos" => "required|max:100|regex:/(^([a-zA-z])[a-zA-z ]*([a-zA-Z]*)$)/u",
            "f_nac" => "required|before:".$fecha_Actual,
            "cel" => "required|unique:pacientes|unique:medicos|unique:secretarias|numeric|min:10000000|max:99999999",
        ]);

        $usuario=User::where("id",auth()->id())->get();

        Paciente::insert([
            'ci' => $request->ci,
            'apellidos' => $request->apellidos,
            'nombres' => $request->nombres,
            'f_nac' => $request->f_nac,
            'sexo' => $request->sexo,
            'cel' => $request->cel,
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
        $fecha_Actual = date("Y-m-d");
        $this->validate($request, [
            "ci" => "required|unique:pacientes,ci,".$paciente->id."|unique:medicos,ci,".$paciente->id."|unique:secretarias,ci,".$paciente->id."|numeric|min:10000000|max:9999999999",
            "nombres" => "required|max:100|regex:/(^([a-zA-z])[a-zA-z ]*([a-zA-Z]*)$)/u",
            "apellidos" => "required|max:100|regex:/(^([a-zA-z])[a-zA-z ]*([a-zA-Z]*)$)/u",
            "f_nac" => "required|before:".$fecha_Actual,
            "cel" => "required|unique:pacientes,cel,".$paciente->id."|unique:medicos,cel,".$paciente->id."|unique:secretarias,cel,".$paciente->id."|numeric|min:10000000|max:99999999",
        ]);

        $pacientes=Paciente::find($paciente->id);
        $pacientes->ci = $request->ci;
        $pacientes->apellidos = $request->apellidos;
        $pacientes->nombres = $request->nombres;
        $pacientes->f_nac = $request->f_nac;
        $pacientes->sexo = $request->sexo;
        $pacientes->cel = $request->cel;
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
        try {
            $mensaje="El paciente ".$paciente->nombres." $paciente->apellidos se elimino exitosamente!!!";
            $pacientes = Paciente::find($paciente->id);
            $pacientes->delete();
            return redirect(route('paciente.index'))->with("success",$mensaje);
        } catch (\Throwable $th) {
            $mensaje = "No puede borrar este paciente";
            return redirect(route('paciente.index'))->with("danger",$mensaje);
        }
    }
}
