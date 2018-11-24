<?php namespace Watchlearn\Vuerentacar\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateWatchlearnVuerentacarVehicles4 extends Migration
{
    public function up()
    {
        Schema::table('watchlearn_vuerentacar_vehicles', function($table)
        {
            $table->boolean('available');
        });
    }
    
    public function down()
    {
        Schema::table('watchlearn_vuerentacar_vehicles', function($table)
        {
            $table->dropColumn('available');
        });
    }
}
