<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained('appointments')->onDelete('cascade'); // Link to the appointment
            $table->decimal('amount', 10, 2); // Payment amount
            $table->enum('payment_method', ['chapa', 'santimpay', 'cash']); // Payment method
            $table->enum('status', ['pending', 'paid', 'failed'])->default('pending'); // Payment status
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
}