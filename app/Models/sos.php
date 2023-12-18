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

    public static function findSoS($id)
    {
        $sos = DB::select(" 
            SELECT 
                s.id as id, 
                s.latitud as latitud, 
                s.longitud as longitud, 
                s.tipo as tipo, 
                u.id as idUserSos, 
                s.fecha as fecha, 
                s.hora as hora, 
                u.name as name,
                u.celular as celular,
                u.dni as dni
            FROM 
                sos s
            INNER JOIN 
                users u ON u.id = s.iduser
            WHERE 
                s.id = ?" , [$id]);
        return $sos[0];
    }

    public static function saveSmS($id, $message, $fecha, $hora)
    {
        DB::insert('sms', [
            'id_sos' => $id,
            'message' => $message,
            'fecha' => $fecha,
            'hora' => $hora
        ]);
    }

    public static function isUserSmSSpam($id, $fecha, $hora)
    {   
        $resultado = DB::select("
            SELECT sos.id
            FROM sos as sos
            INNER JOIN sms_sos as sms ON sms.id_sos = sos.id
            WHERE sos.id = ?
            AND sms.fecha = ?
            AND TIME_TO_SEC(TIMEDIFF(?, sms.hora)) / 3600  < 1
            ORDER BY hora DESC
            LIMIT 1", 
        [$id, $fecha, $hora]);
        if(!$resultado){
            return false;
        }
        return true;
    }

    public static function updateSendHelp($id, $idUser)
    {
        DB::table('sos')
            ->where('id', '=', $id)
            ->update(['status' => 1]);

        DB::table('sos')
            ->where('iduser', $idUser)
            ->where('status', 0)
            ->where('fecha', '=', Carbon::today()->toDateString())
            ->where('hora', '<', Carbon::now()->toTimeString())
            ->update(['status' => 3]);
        
    }

    public static function updateCloseIncidencia($id)
    {
        DB::table('sos')
        ->where('id', '=', $id)
        ->update(['status' => 2]);
    }
}
