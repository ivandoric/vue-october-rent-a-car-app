<?php namespace Watchlearn\Vuerentacar\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableDeleteWatchlearnVuerentacarVehiclesLocations extends Migration
{
    public function up()
    {
        Schema::dropIfExists('watchlearn_vuerentacar_vehicles_locations');
    }
    
    public function down()
    {
        Schema::create('watchlearn_vuerentacar_vehicles_locations', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('vehicle_id');
            $table->integer('location_id');
        });
    }
}
