<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPaymentsTable extends Migration
{
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            // Add missing columns
            $table->string('tx_ref')->unique()->after('id'); // Transaction reference
            $table->string('currency')->default('ETB')->after('amount'); // Currency
        });
    }

    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            // Drop the added columns
            $table->dropColumn(['tx_ref', 'currency']);
        });
    }
}