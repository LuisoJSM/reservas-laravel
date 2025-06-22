<?php

use App\Models\Business;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Business::class)->constrained();

            $table->unsignedSmallInteger('day_of_week');

            //Hora de apertura y cierre
            $table->time('open_time')->nullable();
            $table->time('close_time')->nullable();

            //Para saber si un día está cerrado
            $table->boolean('is_closed')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
