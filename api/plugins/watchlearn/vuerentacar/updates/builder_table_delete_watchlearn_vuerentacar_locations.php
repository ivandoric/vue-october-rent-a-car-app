<?php namespace Watchlearn\Vuerentacar\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableDeleteWatchlearnVuerentacarLocations extends Migration
{
    public function up()
    {
        Schema::dropIfExists('watchlearn_vuerentacar_locations');
    }
    
    public function down()
    {
        Schema::create('watchlearn_vuerentacar_locations', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title', 191);
            $table->string('slug', 191);
        });
    }
}
