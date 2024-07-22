<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('suspects', function (Blueprint $table) {
            $table->integer('state_id');
            $table->integer('city_id');
        });
    }

    public function down()
    {
        Schema::table('suspects', function (Blueprint $table) {
            $table->dropColumn('state_id');
            $table->dropColumn('city_id');
        });
    }
};
