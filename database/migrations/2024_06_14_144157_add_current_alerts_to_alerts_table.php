<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('alerts', function (Blueprint $table) {
            $table->boolean('currently_out_of_location')->default(false);
            $table->boolean('currently_battery_empty')->default(false);
            $table->boolean('currently_pulseless')->default(false);
            // Puedes agregar otros estados temporales aquí si es necesario
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alerts', function (Blueprint $table) {
            $table->dropColumn('currently_out_of_location');
            $table->dropColumn('currently_battery_empty');
            $table->dropColumn('currently_pulseless');
        });
    }
};
