<?php namespace Watchlearn\Vuerentacar\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateWatchlearnVuerentacarDates extends Migration
{
    public function up()
    {
        Schema::create('watchlearn_vuerentacar_dates', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->dateTime('pickup');
            $table->dateTime('drop_off');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('watchlearn_vuerentacar_dates');
    }
}
