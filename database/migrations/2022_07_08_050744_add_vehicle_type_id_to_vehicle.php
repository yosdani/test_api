<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVehicleTypeIdToVehicle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicle', function (Blueprint $table) {
            $table->unsignedBigInteger('vehicle_type_id');
            $table->foreign('vehicle_type_id')->references('id')->on('vehicle_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicle', function (Blueprint $table) {
            //
        });
    }
}
