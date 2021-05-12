<?php

namespace App\Http\Controllers;

use App\Models\Medico;

use App\Models\User;
use App\Models\Especialidad;
use App\Models\Salario;
use App\Models\Turno;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MedicoController extends Controller
{
    public function __construct(){
        // $this->middleware("auth");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicos = Medico::paginate(8);
        return view("medicos.index", compact("medicos"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $medico = new Medico();
        $title = __("Registrar Médico");
        $textButton = __("Registrar");
        $route = route("medico.store");
        $especialidades = Especialidad::all();
        $turnos = Turno::all();
        $salarios = Salario::all();
        return view("medicos.create", compact("title", "textButton", "route", "medico","especialidades","turnos","salarios"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            "email" => "required|unique:users",
            "ci" => "required|unique:medicos|min:8",
            "apellidos" => "required|max:100",
            "nombres" => "required|max:100",
            "f_nac" => "required",
            "cel" => "required|unique:medicos|min:8|max:30",
        ]);
        $ciAux = $request->ci;
        Medico::create([
            'ci' => $request->ci,
            'apellidos' => $request->apellidos,
            'nombres' => $request->nombres,
            'f_nac' => $request->f_nac,
            'cel' => $request->cel,
            'especialidad_id' => $request->especialidad,
            'salario_id' => $request->salario,
            'turnos_id' => $request->turno,
        ]);
        //buscamos el medico
        $medicoRecup = Medico::where("ci",$ciAux)->get();

        User::create([
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($request->ci),
            'medico_id' => $medicoRecup[0]["id"]
        ]);
        return redirect(route("medico.index"))->with("success", __("¡Médico Creado!"));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function show(Medico $medico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function edit(Medico $medico)
    {

        $update = true;
        $title = __("Modificar Médico");
        $textButton = __("Actualizar");
        $route = route("medico.update", ["medico" => $medico]);
        $especialidades = Especialidad::all();
        $turnos = Turno::all();
        $salarios = Salario::all();
        return view("medicos.edit", compact("update","title", "textButton", "route", "medico","especialidades","turnos","salarios"));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medico $medico)
    {

        $this->validate($request, [
            "ci" => "required|unique:medicos,ci,".$medico->id."|min:8",
            "apellidos" => "required|max:100",
            "nombres" => "required|max:100",
            "f_nac" => "required",
            "cel" => "required|unique:medicos,cel,".$medico->id."|min:8|max:30",
        ]);
        //ACTUALIZANDO
        $medico->fill([
            'ci' => $request->ci,
            'apellidos' => $request->apellidos,
            'nombres' => $request->nombres,
            'f_nac' => $request->f_nac,
            'cel' => $request->cel,
            'especialidad_id' => $request->especialidad,
            'salario_id' => $request->salario,
            'turnos_id' => $request->turno,
        ])->save();
        // return back()->with("success", __("Médico Modificado"));
        return redirect(route("medico.index"))->with("success", __("¡Médico Modificado!"));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medico $medico)
    {
        $medico->delete();
        return back()->with("success", __("Medico Eliminado"));
    }
}
