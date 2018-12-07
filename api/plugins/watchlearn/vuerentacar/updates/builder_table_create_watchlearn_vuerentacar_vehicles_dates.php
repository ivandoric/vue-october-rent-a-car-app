<?php namespace Watchlearn\Vuerentacar\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateWatchlearnVuerentacarVehiclesDates extends Migration
{
    public function up()
    {
        Schema::create('watchlearn_vuerentacar_vehicles_dates', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('vehicle_id');
            $table->integer('date_id');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('watchlearn_vuerentacar_vehicles_dates');
    }
}
