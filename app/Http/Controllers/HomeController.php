<?php

namespace App\Http\Controllers;

date_default_timezone_set("America/La_Paz");

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Consulta;
use App\Models\Tipo;
use App\Models\Especialidad;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $mes = date("m");
        $año = date("Y");
        $mesActual = $año."-".$mes."-01";
        $mesSiguiente = date("Y-m-d",strtotime($mesActual."+ 1 month"));

        $consultas1 = Consulta::join('tipos','consultas.tipo_id','=','tipos.id')
                                ->join('especialidades','tipos.especialidad_id','=','especialidades.id')
                                ->select('tipos.id','especialidades.nombre_especialidad',DB::raw('count(especialidades.nombre_especialidad) as cantidad'))
                                ->where('consultas.fecha', '>=', $mesActual)
                                ->where('consultas.fecha', '<', $mesSiguiente)
                                ->groupBy('especialidades.nombre_especialidad','tipos.id')
                                ->orderBy('tipos.id')
                                ->get();
        $consultas2 = Consulta::join('tipos','consultas.tipo_id','=','tipos.id')
                                ->select('tipos.id',DB::raw('count(tipos.id) as cantidad'))
                                ->where('consultas.fecha', '>=', $mesActual)
                                ->where('consultas.fecha', '<', $mesSiguiente)
                                ->whereNull('tipos.especialidad_id')
                                ->groupBy('tipos.id')
                                ->get();
        $totalTipos = Tipo::count();

        $consultasPorFecha = Consulta::select('fecha',DB::raw('count(fecha) as cantidad'))
                                        ->where('fecha', '>=', $mesActual)
                                        ->where('fecha', '<', $mesSiguiente)
                                        ->groupBy('fecha')
                                        ->orderBy('fecha')
                                        ->get();

        foreach ($consultasPorFecha as $consulta) {//PARA AGARRAR SOLO LOS DÍAS DEL MES Y NO TODA LA FECHA
            $consulta->fecha = intval(date("d", strtotime($consulta->fecha)));
        }

        $diasDelMes = date('t');
        $nombreMes = date('F');


        return view('home',compact('consultas1','consultas2','totalTipos','diasDelMes','nombreMes','consultasPorFecha'));
    }
}
