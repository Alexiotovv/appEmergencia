<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class sos extends Model
{
    use HasFactory;

    public static function listActiveSos()
    {
        try {
            $results = DB::select('CALL GetLatestSos()');
            return $results;
        } catch(\Exception $e){
            throw new \Exception ('Ocurrio un error de tipo: ' . $e->getMessage());
        }
    }

    public static function isUserSosSpam($id, $fecha, $hora)
    {
        $resultado = DB::select("
            SELECT *
            FROM sos
            WHERE iduser = ?
            AND fecha = ?
            AND TIME_TO_SEC(TIMEDIFF(?, hora)) / 3600  < 1
            ORDER BY hora DESC
            LIMIT 1", 
            [$id, $fecha, $hora]);
        if(!$resultado){
            return false;
        }
        return true;
    }
}
