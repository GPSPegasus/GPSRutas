<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeofenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geofence', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('latitude');
            $table->string('longitude');
            $table->unsignedInteger('radio');
            $table->unsignedInteger('group_id');
            $table->foreign('group_id')->references('id')->on('group_vehicle');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('geofence');
    }
}
