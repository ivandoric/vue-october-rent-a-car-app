<?php namespace Watchlearn\Vuerentacar\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateWatchlearnVuerentacarVehicles3 extends Migration
{
    public function up()
    {
        Schema::table('watchlearn_vuerentacar_vehicles', function($table)
        {
            $table->dropColumn('avilable');
        });
    }
    
    public function down()
    {
        Schema::table('watchlearn_vuerentacar_vehicles', function($table)
        {
            $table->boolean('avilable');
        });
    }
}
