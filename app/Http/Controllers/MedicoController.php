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
        // $this->middleware("jefeMedico");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $medicos22 = Medico::paginate(8);
        $especialidades = Especialidad::all();
        $turnos = Turno::all();
        //Esto es para implementar la busqueda
        $ci = trim($request->get('ci'));
        $nombre = trim($request->get('nombre'));
        $apellido = trim($request->get('apellido'));
        $especialidad = trim($request->get('especialidad'));
        $especialidad2 = trim($request->get('especialidad'));
        $turno = trim($request->get('turno'));
        $turno2 = trim($request->get('turno'));

        if ($especialidad == "") {
            $medicos = Medico::join('turnos', 'turnos_id', '=', 'turnos.id')
                            ->select('medicos.*','turnos.turnos')
                            ->where('ci','LIKE','%'.$ci.'%')
                            ->where('nombres','LIKE','%'.$nombre.'%')
                            ->where('apellidos','LIKE','%'.$apellido.'%')
                            ->where('turnos','LIKE','%'.$turno.'%')
                            ->orderByDesc('medicos.id')
                            ->paginate(8);
        }
        elseif ($especialidad == "Sin Especialidad") {
            $medicos = Medico::join('turnos', 'turnos_id', '=', 'turnos.id')
                            ->select('medicos.*','turnos.turnos')
                            ->where('ci','LIKE','%'.$ci.'%')
                            ->where('nombres','LIKE','%'.$nombre.'%')
                            ->where('apellidos','LIKE','%'.$apellido.'%')
                            ->where('turnos','LIKE','%'.$turno.'%')
                            ->whereNull('especialidad_id')
                            ->paginate(8);
        }
        else
            $medicos = Medico::join('especialidades', 'especialidad_id', '=', 'especialidades.id')
                            ->join('turnos', 'turnos_id', '=', 'turnos.id')
                            ->select('medicos.*','turnos.turnos','especialidades.nombre_especialidad')
                            ->where('ci','LIKE','%'.$ci.'%')
                            ->where('nombres','LIKE','%'.$nombre.'%')
                            ->where('apellidos','LIKE','%'.$apellido.'%')
                            ->where('nombre_especialidad','LIKE','%'.$especialidad.'%')
                            ->where('turnos','LIKE','%'.$turno.'%')
                            ->paginate(8);
        return view("medicos.index", compact("medicos","ci","nombre","apellido","especialidad","especialidad2","turno","turno2","especialidades","turnos"));
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
        //fecha actual
        $fecha_Actual = date("Y-m-d");
        $fecha_mayoria_edad = date("Y-m-d", strtotime($fecha_Actual."- 18 year"));

        $this->validate($request, [
            "email" => "required|unique:users|email",
            "ci" => "required|unique:medicos|unique:secretarias|numeric|min:10000000|max:9999999999",
            "apellidos" => "required|max:100|regex:/(^([a-zA-z])[a-zA-z ]*([a-zA-Z]*)$)/u",
            "nombres" => "required|max:100|regex:/(^([a-zA-z])[a-zA-z ]*([a-zA-Z]*)$)/u",
            "f_nac" => "required|before:".$fecha_mayoria_edad,
            "cel" => "required|unique:medicos|unique:secretarias|numeric|min:10000000|max:99999999"
        ]);
        if($request->especialidad == "0"){
            Salario::create([
                'Salario' => 2200,
                'Bono' => 0
            ]);
            //recup id SALARIO
            $salarioRecup = Salario::orderByDesc('created_at')->limit(1)->get();
            Medico::create([
                'ci' => $request->ci,
                'apellidos' => $request->apellidos,
                'nombres' => $request->nombres,
                'f_nac' => $request->f_nac,
                'cel' => $request->cel,
                'salario_id' => $salarioRecup[0]["id"],
                'turnos_id' => 6,
            ]);
        }
        else{
            Salario::create([
                'Salario' => 0,
                'Bono' => 0
            ]);
            //recup id SALARIO
            $salarioRecup = Salario::orderByDesc('created_at')->limit(1)->get();
            Medico::create([
                'ci' => $request->ci,
                'apellidos' => $request->apellidos,
                'nombres' => $request->nombres,
                'f_nac' => $request->f_nac,
                'cel' => $request->cel,
                'especialidad_id' => $request->especialidad,
                'salario_id' => $salarioRecup[0]["id"],
                'turnos_id' => 6,
            ]);
        }
        //buscamos el medico
        $medicoRecup = Medico::where("ci",$request->ci)->get();

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
        $turnos = Turno::all();
        // echo $medico["especialidad_id"]." hola";
        $turnosOcupados = Turno::join('medicos', 'turnos.id', '=', 'turnos_id')
                        ->select('turnos.id')
                        ->where('turnos.id', '!=', '6')
                        ->get();
        return view("medicos.edit", compact("medico","update","title", "textButton", "route", "medico","turnos","turnosOcupados"));

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

        //fecha actual
        $fecha_Actual = date("Y-m-d");
        $fecha_mayoria_edad = date("Y-m-d", strtotime($fecha_Actual."- 18 year"));

        $this->validate($request, [
            "ci" => "required|unique:medicos,ci,".$medico->id."|unique:secretarias,ci,".$medico->id."|numeric|min:10000000|max:9999999999",
            "apellidos" => "required|max:100|regex:/(^([a-zA-z])[a-zA-z ]*([a-zA-Z]*)$)/u",
            "nombres" => "required|max:100|regex:/(^([a-zA-z])[a-zA-z ]*([a-zA-Z]*)$)/u",
            "f_nac" => "required|before:".$fecha_mayoria_edad,
            "cel" => "required|unique:medicos,cel,".$medico->id."|unique:secretarias,cel,".$medico->id."|numeric|min:10000000|max:99999999"
        ]);
        //ACTUALIZANDO
        if($request->turno == null)
            $turno = 6;
        else
            $turno = $request->turno;
        $medico->fill([
            'ci' => $request->ci,
            'apellidos' => $request->apellidos,
            'nombres' => $request->nombres,
            'f_nac' => $request->f_nac,
            'cel' => $request->cel,
            'turnos_id' => $turno,
        ])->save();
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
        try {
            $medico->delete();
            $salario = Salario::where('id',$medico->salario_id)->get();
            $salario[0]->delete();
            return back()->with("success", __("Medico Eliminado"));
        } catch (\Throwable $th) {
            return back()->with("danger", __("No puede Eliminar este Médico"));
        }

    }
}
