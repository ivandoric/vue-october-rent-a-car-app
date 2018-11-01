<?php namespace Watchlearn\Vuerentacar\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableDeleteWatchlearnVuerentacar extends Migration
{
    public function up()
    {
        Schema::dropIfExists('watchlearn_vuerentacar_');
    }
    
    public function down()
    {
        Schema::create('watchlearn_vuerentacar_', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title', 191);
            $table->string('slug', 191);
        });
    }
}
