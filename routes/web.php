<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SosController;
use App\Http\Controllers\EstadisticaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', function () {
    return view('usuarios.login');
});


Route::get('/login',function(){
    return view('usuarios.login');
})->name('login')->middleware('guest');

Route::get('/home',[LoginController::class,'index'])->middleware('auth')->name('home');

//estadistica
Route::get('/sos/datos/{ano}', [EstadisticaController::class,'datos'])->middleware(['auth'])->name('sos.datos');


//SOS
Route::get('/sos/index', [SosController::class,'index'])->middleware(['auth'])->name('sos.index');
Route::get('/sos/create', [SosController::class,'create'])->name('sos.create');
Route::post('/sos/store', [SosController::class,'store'])->name('sos.store');
Route::get('/sos/show', [SosController::class,'show'])->middleware(['auth'])->name('sos.show');
Route::get('/sos/update/{id}/{estado}', [SosController::class,'update'])->middleware(['auth'])->name('sos.update');

//SOS JSON
Route::get('/sos/listarsos', [SosController::class,'listarsos'])->middleware(['auth'])->name('sos.listarsos');

//Usuarios
Route::get('/usuarios/index', [UserController::class,'index'])->middleware(['auth'])->name('usuarios.index');
Route::get('/usuarios/edit/{id}', [UserController::class,'edit'])->middleware(['auth'])->name('usuarios.edit');
Route::post('/usuarios/update', [UserController::class,'update'])->middleware(['auth'])->name('usuarios.update');
Route::get('/usuarios/create', [UserController::class,'create'])->middleware(['auth'])->name('usuarios.create');
Route::post('/usuarios/store', [UserController::class,'store'])->middleware(['auth'])->name('usuarios.store');

Route::get("/verificanombre/{name}",[UserController::class,'verificanombre'])->middleware(['auth'])->name('verificanombre');
Route::get("/verificaemail/{email}",[UserController::class,'verificaemail'])->middleware(['auth'])->name('verificaemail');
Route::post("/ActualizaContrasena",[UserController::class, "ActualizaContrasena"])->middleware(['auth'])->name('Actualiza.Contrasena');

Route::post("/login",[LoginController::class, 'login']);
Route::put('/login', [LoginController::class, 'logout']);