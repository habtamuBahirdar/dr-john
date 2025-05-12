<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->date('date'); // The date of the schedule
            $table->enum('session', ['morning', 'afternoon']); // Morning or Afternoon session
            $table->time('start_time'); // Start time of the session
            $table->time('end_time'); // End time of the session
            $table->integer('max_patients'); // Maximum number of patients for the session
            $table->integer('current_patients')->default(0); // Number of patients currently assigned
            $table->enum('status', ['open', 'closed'])->default('open'); // Status of the schedule
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}