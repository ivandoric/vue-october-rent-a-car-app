<?php namespace Watchlearn\Vuerentacar\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateWatchlearnVuerentacarVehicles extends Migration
{
    public function up()
    {
        Schema::table('watchlearn_vuerentacar_vehicles', function($table)
        {
            $table->integer('price')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('watchlearn_vuerentacar_vehicles', function($table)
        {
            $table->dropColumn('price');
        });
    }
}
