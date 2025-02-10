<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('products', function (Blueprint $table) {
        $table->enum('status', ['yes', 'no'])->default('yes')->after('quantity'); // Add status column
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('status'); // Remove status column
    });
}

};
