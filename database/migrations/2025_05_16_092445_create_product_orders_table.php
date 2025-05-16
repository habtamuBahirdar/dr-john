<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('product_orders', function (Blueprint $table) {
            $table->id();
            $table->string('buyer_name');
            $table->string('buyer_phone');
            $table->string('buyer_email')->nullable();
            $table->json('products'); // Store product IDs and quantities as JSON
            $table->decimal('total_amount', 12, 2);
            $table->string('currency', 10)->default('ETB');
            $table->string('payment_reference')->nullable();
            $table->string('payment_status')->default('completed');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_orders');
    }
}