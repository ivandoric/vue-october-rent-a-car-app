<?php namespace Watchlearn\Vuerentacar\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateWatchlearnVuerentacarLocations2 extends Migration
{
    public function up()
    {
        Schema::create('watchlearn_vuerentacar_locations', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('watchlearn_vuerentacar_locations');
    }
}
