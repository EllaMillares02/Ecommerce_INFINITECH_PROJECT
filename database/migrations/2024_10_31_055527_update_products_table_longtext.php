<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Change the column type to LONGTEXT
            $table->longText('information')->change();
            $table->longText('description')->change();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Revert back to TEXT if needed
            $table->text('information')->change();
            $table->text('description')->change();
        });
    }
};
