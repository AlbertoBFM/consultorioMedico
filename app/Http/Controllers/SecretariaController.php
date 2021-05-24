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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function __contruct(){
        $this->middleware("auth");
    }*/
    public function index(Request $request)
    {
        // $secretarias = Secretaria::all();

        //Esto es para implementar la busqueda
        $ci = trim($request->get('ci'));
        $nombre = trim($request->get('nombre'));
        $apellido = trim($request->get('apellido'));
        $especialidad = trim($request->get('especialidad'));
        $turno2 = trim($request->get('turno2'));

        $secretarias = Secretaria::join('turnos', 'turnos_id', '=', 'turnos.id')
                                ->where('ci','LIKE','%'.$ci.'%')
                                ->where('nombres','LIKE','%'.$nombre.'%')
                                ->where('apellidos','LIKE','%'.$apellido.'%')
                                ->where('turnos','LIKE','%'.$turno2.'%')
                                ->paginate(8);

        return view('secretaria.index',compact("secretarias","ci","nombre","apellido","turno2"));
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

        $this->validate($request, [
            "email" => "required|unique:users",
            "ci" => "required|unique:medicos|unique:secretarias|min:8",
            "apellidos" => "required|max:100",
            "nombres" => "required|max:100",
            "f_nac" => "required",
            "cel" => "required|unique:medicos|unique:secretarias|min:8|max:30",
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
            'turnos_id' => $request->turno,
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
        return view("secretaria.edit", compact("update","title", "textButton", "route", "secretaria"));
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
        $secretaria=Secretaria::find($secretarias);//where('id',$secretarias)->get();
        $secretaria->ci=$request->ci;
        $secretaria->apellidos=$request->apellidos;
        $secretaria->nombres=$request->nombres;
        $secretaria->f_nac=$request->f_nac;
        $secretaria->cel=$request->cel;
        $secretaria->turnos_id=$request->turno;
        $secretaria->save();
        return redirect(route("secretaria.index"))->with("success", __("¡Secretaria Actualizada!"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Secretaria  $secretaria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Secretaria $secretaria)
    {
        echo $secretaria;
    }

}
