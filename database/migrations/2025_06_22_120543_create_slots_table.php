<?php

use App\Models\Business;
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
        Schema::create('slots', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Business::class)->constrained();

            $table->date('slot_date');//para los días de la reserva

            $table->time('start_time')->comment('The start time of the slot H:i'); // Hora de inicio
            $table->time('end_time')->comment('The end time of the slot H:i'); // Hora fiinalización

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slots');
    }
};
