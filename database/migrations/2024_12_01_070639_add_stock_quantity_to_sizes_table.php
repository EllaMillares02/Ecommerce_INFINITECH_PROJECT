<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('sizes', function (Blueprint $table) {
        $table->integer('stock_quantity')->default(0); // Add stock_quantity column
    });
}

public function down()
{
    Schema::table('sizes', function (Blueprint $table) {
        $table->dropColumn('stock_quantity');
    });
}

};
