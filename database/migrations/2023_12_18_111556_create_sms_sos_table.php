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
        Schema::create('sms_sos', function (Blueprint $table) {
            $table->id();
            $table->text('message');
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->foreignId('id_event_file')->constrained('sos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sms_sos');
    }
};
