<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::unprepared('
        SELECT 
            s.id, 
            s.latitud, 
            s.longitud, 
            s.tipo, 
            u.id as idUserSos, 
            s.fecha, 
            s.hora, 
            u.name
        FROM 
            sos s
        INNER JOIN 
            users u ON u.id = s.iduser
        INNER JOIN 
            (
                SELECT 
                    MAX(id) as last_sos_id
                FROM 
                    sos
                GROUP BY 
                    iduser, DATE(fecha)
            ) as latest_sos ON s.id = latest_sos.last_sos_id
        WHERE 
            s.status = 0
        ORDER BY 
            s.fecha DESC;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS GetLatestSos');
    }
};
