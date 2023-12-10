<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Estadistica extends Model
{
    use HasFactory;

    public static function obtenerDatosPorAno($year)
    {
        return DB::select("call getMeses($year)");
    }

    public static function totales()
    {
        $years = DB::table('sos')
                ->select(DB::raw('DISTINCT YEAR(fecha) as year'))
                ->orderby('year')
                ->get();
        $totalUsers=User::count();
        $activedUsers=User::where('status',1)->count();
        $totalSos=Sos::count();
        return  [
            'years'=>$years, 
            'total_users'=>$totalUsers, 
            'activos_users'=>$activedUsers,
            'total_sos'=>$totalSos
        ];
    }
}
