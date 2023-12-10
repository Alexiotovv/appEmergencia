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
                SELECT 
                    meses.nombre,
                    COALESCE(T1.cant_policia, 0) AS cant_policia,
                    COALESCE(T2.cant_bombero, 0) AS cant_bombero,
                    COALESCE(T3.cant_ambulancia, 0) AS cant_ambulancia
                FROM meses
                LEFT JOIN
                    (SELECT MONTH(fecha) AS mes, COUNT(*) AS cant_policia
                    FROM sos 
                    WHERE tipo = "policia" AND YEAR(fecha) = ANO
                    GROUP BY mes) T1 ON T1.mes = meses.mes
                LEFT JOIN
                    (SELECT MONTH(fecha) AS mes, COUNT(*) AS cant_bombero
                    FROM sos 
                    WHERE tipo = "bomberos" AND YEAR(fecha) = ANO
                    GROUP BY mes) T2 ON T2.mes = meses.mes
                LEFT JOIN
                    (SELECT MONTH(fecha) AS mes, COUNT(*) AS cant_ambulancia
                    FROM sos 
                    WHERE tipo = "hospital" AND YEAR(fecha) = ANO
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
