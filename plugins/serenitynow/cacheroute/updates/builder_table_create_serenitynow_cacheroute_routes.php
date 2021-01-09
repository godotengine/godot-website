<?php namespace SerenityNow\Cacheroute\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateSerenitynowCacherouteRoutes extends Migration
{
    public function up()
    {
        Schema::create('serenitynow_cacheroute_routes', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('route_pattern', 255);
            $table->integer('cache_ttl');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('serenitynow_cacheroute_routes');
    }
}
