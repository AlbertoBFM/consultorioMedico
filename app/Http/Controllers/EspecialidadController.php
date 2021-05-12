<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use App\Models\Tipo;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $especialidades = Especialidad::paginate(8);
        return view("especialidad.index", compact("especialidades"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $especialidad = new Especialidad();
        $title = __("Registrar Especialidad");
        $textButton = __("Registrar");
        $route = route("especialidad.store");
        return view("especialidad.create", compact("title", "textButton", "route", "especialidad"));

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
            "nombre_especialidad" => "required|max:100|unique:especialidades",
            "precio_consulta" => "required|max:100"
        ]);


        Especialidad::create([
            'nombre_especialidad' => $request->nombre_especialidad
        ]);

        $especialidadRecup = Especialidad::where("nombre_especialidad",$request->nombre_especialidad)->get();

        Tipo::create([
            'precio_consulta' => $request->precio_consulta,
            'especialidad_id' => $especialidadRecup[0]["id"]
        ]);

        return redirect(route("especialidad.index"))->with("success", __("¡Especialidad Creada!"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Especialidad  $especialidad
     * @return \Illuminate\Http\Response
     */
    public function show(Especialidad $especialidad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Especialidad  $especialidad
     * @return \Illuminate\Http\Response
     */
    public function edit(Especialidad $especialidad)
    {
        $update = true;
        $title = __("Modificar Especialidad");
        $textButton = __("Actualizar");
        $route = route("especialidad.update", ["especialidad" => $especialidad]);

        return view("especialidad.edit", compact("update","title", "textButton", "route", "especialidad"));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Especialidad  $especialidad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Especialidad $especialidad)
    {
        $this->validate($request, [
            "nombre_especialidad" => "required|unique:especialidades,nombre_especialidad,".$especialidad->id."|max:100"
        ]);
        //ACTUALIZANDO
        $especialidad->fill([
            'nombre_especialidad' => $request->nombre_especialidad
        ])->save();
        // return back()->with("success", __("Médico Modificado"));
        return redirect(route("especialidad.index"))->with("success", __("¡Especialidad Modificada!"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Especialidad  $especialidad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Especialidad $especialidad)
    {
        $especialidad->delete();
        return back()->with("success", __("Especialidad Eliminada"));
    }
}
