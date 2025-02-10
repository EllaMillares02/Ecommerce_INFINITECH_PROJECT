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
        Schema::table('customers', function (Blueprint $table) {
            // Drop the old columns
            $table->dropColumn(['municipality', 'city_province', 'zipcode']);

            // Add the new columns
            $table->string('barangay')->nullable();
            $table->string('city_municipality')->nullable();
            $table->string('province')->nullable();
            $table->string('postal_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            // Revert the changes by dropping the newly added columns
            $table->dropColumn(['barangay', 'city_municipality', 'province', 'postal_code']);

            // Restore the old columns
            $table->string('municipality');
            $table->string('city_province');
            $table->string('zipcode');
        });
    }
};
