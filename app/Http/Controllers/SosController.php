<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sos;
use DB;

class SosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activos=sos::where('status','=',0)->count();
        $enrescate=sos::where('status','=',1)->count();
        $cerrados=sos::where('status','=',2)->count();
        
        return view('sos.index',['activos'=>$activos,'enrescate'=>$enrescate,'cerrados'=>$cerrados]);
    }

    function listarsos(){
        $sos = DB::table('sos')->orderBy('status')->orderByDesc('id')
        ->take(50)->get();
        return response()->json($sos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    //para hacer pruebas desde la web site
    public function store(Request $request)
    {   
        $obj= new sos();
        $obj->iduser=auth()->user()->id;
        $obj->latitud=request('latitud');
        $obj->longitud=request('longitud');
        $obj->celular=request('celular');
        $obj->tipo=request('tipo');
        $obj->fecha=request('fecha');
        $obj->hora=request('hora');

        //status se guarda por defecto 0 y 
        //atendido por vacío hasta que un poli envie el rescate
        $obj->save();
        $data =['msje'=>'ok'];
        
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(sos $sos)
    {
        $sos=sos::all()->take(100);
        return response()->json($sos);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sos $sos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id,$estado)
    {
        $obj= sos::findOrFail($id);
        $obj->status=$estado;
        $obj->atendidopor=auth()->user()->name;
        $obj->save();
        $data =['msje'=>'ok'];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(sos $sos)
    {
        //
    }
}
