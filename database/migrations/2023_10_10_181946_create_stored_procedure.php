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
    public function up(): void
    {
        
        DB::unprepared('
            CREATE PROCEDURE getMeses(IN ANO CHAR(4))
            
            BEGIN
                SELECT  nombre,
                cant_policia,
                cant_bombero FROM meses 
                LEFT JOIN
                ( SELECT MONTH(fecha) AS mes, COUNT(*) AS cant_policia
                FROM sos where tipo="policia" AND YEAR(fecha)=ANO
                GROUP BY mes) T1 ON T1.mes = meses.mes  
                LEFT JOIN
                ( SELECT MONTH(fecha) AS mes, COUNT(*) AS cant_bombero
                FROM sos where tipo="bombero" AND YEAR(fecha)=ANO
                GROUP BY mes) T2 ON T2.mes = meses.mes 
                LEFT JOIN
                ( SELECT MONTH(fecha) AS mes, COUNT(*) AS cant_ambulancia
                FROM sos where tipo="ambulancia" AND YEAR(fecha)=ANO
                GROUP BY mes) T3 ON T3.mes = meses.mes;
            END
        ');
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS getMeses');

    }
};
