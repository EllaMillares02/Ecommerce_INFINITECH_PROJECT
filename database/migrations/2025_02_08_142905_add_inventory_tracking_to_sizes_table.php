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
        Schema::table('sizes', function (Blueprint $table) {
            $table->integer('initial_quantity')->default(0)->after('stock_quantity'); 
            $table->integer('sold_quantity')->default(0)->after('initial_quantity'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('sizes', function (Blueprint $table) {
        $table->dropColumn(['initial_quantity', 'sold_quantity']);
    });
}

};
