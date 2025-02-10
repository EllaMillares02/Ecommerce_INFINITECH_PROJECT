<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['quantity', 'delivery_qty', 'expiry_date']);
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('quantity')->default(0);
            $table->integer('delivery_quantity')->default(0);
            $table->date('expiry_date')->nullable();
        });
    }
};
