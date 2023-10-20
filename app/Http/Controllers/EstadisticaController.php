<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sos;
use DB;

class EstadisticaController extends Controller
{
    function datos ($year) {
        $cuadro_meses = DB::select("call getMeses('$year')");
        return response()->json($cuadro_meses);

    }
}
