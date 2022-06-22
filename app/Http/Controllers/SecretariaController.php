<?php

namespace App\Http\Controllers;

use App\Models\Secretaria;

use App\Models\User;
use App\Models\Turno;
use App\Models\Salario;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class SecretariaController extends Controller
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
        //Esto es para implementar la busqueda
        $ci = trim($request->get('ci'));
        $nombre = trim($request->get('nombre'));
        $apellido = trim($request->get('apellido'));
        $turno3 = trim($request->get('turno3'));

        $secretarias = Secretaria::join('turnos', 'turnos_id', '=', 'turnos.id')
                                ->select('secretarias.*')
                                ->where('ci','LIKE','%'.$ci.'%')
                                ->where('nombres','LIKE','%'.$nombre.'%')
                                ->where('apellidos','LIKE','%'.$apellido.'%')
                                ->where('turnos','LIKE','%'.$turno3.'%')
                                ->paginate(8);

        return view('secretaria.index',compact("secretarias","ci","nombre","apellido","turno3"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $secretaria = new Secretaria();
        $title = __("Registrar Secretaria");
        $textButton = __("Registrar");
        $route = route("secretaria.store");
        $turnos = Turno::all();
        $salarios = Salario::all();
        return view("secretaria.create", compact("title", "textButton", "route", "secretaria","turnos","salarios"));
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
            "ci" => "required|unique:secretarias|unique:medicos|numeric|min:10000000|max:9999999999",
            "apellidos" => "required|max:100|regex:/(^([a-zA-z])[a-zA-z ]*([a-zA-Z]*)$)/u",
            "nombres" => "required|max:100|regex:/(^([a-zA-z])[a-zA-z ]*([a-zA-Z]*)$)/u",
            "f_nac" => "required|before:".$fecha_mayoria_edad,
            "cel" => "required|unique:secretarias|unique:medicos|numeric|min:10000000|max:99999999"
        ]);

        Salario::create([
            'Salario' => 2200,
            'Bono' => 0
        ]);
        //recup id SALARIO


        $salarioRecup = Salario::orderByDesc('created_at')->limit(1)->get();


        Secretaria::create([
            'ci' => $request->ci,
            'apellidos' => $request->apellidos,
            'nombres' => $request->nombres,
            'f_nac' => $request->f_nac,
            'cel' => $request->cel,
            'salario_id' => $salarioRecup[0]["id"],
            'turnos_id' => 6,
        ]);

        $secretariaRecup = Secretaria::where("ci",$request->ci)->get();

        User::create([
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($request->ci),
            'secretaria_id' => $secretariaRecup[0]["id"]
        ]);
        return redirect(route("secretaria.index"))->with("success", __("¡Secretaria Creada!"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Secretaria  $secretaria
     * @return \Illuminate\Http\Response
     */
    public function show(Secretaria $secretaria)
    {
        $secretaria1=Secretaria::where('id',$secretaria)->get();
        return $secretaria1;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Secretaria  $secretaria
     * @return \Illuminate\Http\Response
     */
    public function edit($secretarias)
    {
        $secretaria1=Secretaria::where('id',$secretarias)->get();
        $secretaria=$secretaria1[0];
        $update = true;
        $title = __("Modificar Secretaria");
        $textButton = __("Actualizar");
        $route = route("secretaria.update", $secretarias);
        $turnos = Turno::all();
        $turnosOcupados = Turno::join('secretarias', 'turnos.id', '=', 'turnos_id')
        ->select('turnos.id')
        ->where('turnos.id', '!=', '6')
        ->get();
        return view("secretaria.edit", compact("update","title", "textButton", "route", "secretaria","turnosOcupados","turnos"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Secretaria  $secretaria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $secretarias)
    {
        //fecha actual
        $fecha_Actual = date("Y-m-d");
        $fecha_mayoria_edad = date("Y-m-d", strtotime($fecha_Actual."- 18 year"));

        $this->validate($request, [
            "ci" => "required|unique:secretarias,ci,".$secretarias."|unique:medicos,ci,".$secretarias."|numeric|min:10000000|max:9999999999",
            "apellidos" => "required|max:100|regex:/(^([a-zA-z])[a-zA-z ]*([a-zA-Z]*)$)/u",
            "nombres" => "required|max:100|regex:/(^([a-zA-z])[a-zA-z ]*([a-zA-Z]*)$)/u",
            "f_nac" => "required|before:".$fecha_mayoria_edad,
            "cel" => "required|unique:secretarias,cel,".$secretarias."|unique:medicos,cel,".$secretarias."|numeric|min:10000000|max:99999999"
        ]);

        $secretaria = Secretaria::find($secretarias);//where('id',$secretarias)->get();
        $secretaria->ci = $request->ci;
        $secretaria->apellidos = $request->apellidos;
        $secretaria->nombres = $request->nombres;
        $secretaria->f_nac = $request->f_nac;
        $secretaria->cel = $request->cel;
        $secretaria->turnos_id = $request->turno;
        $secretaria->save();
        echo "asdsad";
        return redirect(route("secretaria.index"))->with("success", __("¡Secretaria Actualizada!"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Secretaria  $secretaria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Secretaria $secretaria, $secretaria2)
    {
        try {
            $delete_secretaria = Secretaria::find($secretaria2);
            $delete_secretaria->delete();
            return back()->with("success", __("Secretaria Eliminada"));
        } catch (\Throwable $th) {
            return back()->with("danger", __("No puedes eliminar esta secretaria"));
        }


    }

}
