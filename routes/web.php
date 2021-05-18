<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsultaController;    
use App\Http\Controllers\DiagnosticoController; 
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\JefeMedicoController;  
use App\Http\Controllers\MedicoController;      
use App\Http\Controllers\PacienteController;    
use App\Http\Controllers\SalarioController;     
use App\Http\Controllers\SecretariaController;  
use App\Http\Controllers\TipoController;         
use App\Http\Controllers\TurnoController;        

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/secretariaprincipal', function () {
    return view('secretaria.opciones.index');
});

Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('consulta',ConsultaController::class);
Route::resource('diagnostico',DiagnosticoController::class);
Route::resource('especialidad',EspecialidadController::class);
Route::resource('jefemedico',JefeMedicoController::class);
Route::resource('medico',MedicoController::class);
Route::resource('paciente',PacienteController::class);
Route::resource('salario',SalarioController::class);
Route::resource('secretaria',SecretariaController::class);
Route::resource('tipo',TipoController::class);
Route::resource('turno',TurnoController::class);