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
            $table->integer('pulseless_count')->default(0);
            $table->integer('out_of_location_count')->default(0);
            $table->integer('battery_empty_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alerts', function (Blueprint $table) {
            $table->dropColumn('pulseless_count');
            $table->dropColumn('out_of_location_count');
            $table->dropColumn('battery_empty_count');
        });
    }
};
