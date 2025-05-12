<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade'); // Patient (user with role 'patient')
            $table->foreignId('staff_id')->nullable()->constrained('users')->onDelete('set null'); // Staff who registered the appointment
            $table->date('appointment_date'); // Date of the appointment
            $table->time('appointment_time'); // Time of the appointment
            $table->enum('payment_status', ['pending', 'completed', 'failed'])->default('pending'); // Payment status
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending'); // Appointment status
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}