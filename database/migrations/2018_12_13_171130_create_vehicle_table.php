<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle', function (Blueprint $table) {
            $table->increments('id');
            $table->string('imei');
            $table->boolean('status_vehicle')->default(true);
            $table->unsignedInteger('owner_vehicle_id');
            $table->string('device_count_id');
            $table->unsignedInteger('group_id')->nullable();
            $table->foreign('owner_vehicle_id')->references('id')->on('owner_vehicle');
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
        Schema::dropIfExists('vehicle');
    }
}
