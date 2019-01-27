<?php namespace Watchlearn\Vuerentacar\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateWatchlearnVuerentacarReservations extends Migration
{
    public function up()
    {
        Schema::create('watchlearn_vuerentacar_reservations', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->dateTime('pickup');
            $table->dateTime('dropoff');
            $table->integer('user_id');
            $table->integer('vehicle_id');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('watchlearn_vuerentacar_reservations');
    }
}
