<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sos', function (Blueprint $table) {
            $table->id();
            $table->string('latitud', 200)->default('');
            $table->string('longitud', 200)->default('');
            $table->string('celular', 200)->default('');
            $table->string('tipo', 100)->default('');
            $table->tinyInteger('status')->default(0);
            $table->string('atendidopor', 100)->default('');
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->boolean('is_sms')->default(0);
            $table->bigInteger('iduser')->unsigned();
            $table->foreign('iduser')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('sos');
    }
};
