<?php namespace SerenityNow\Cacheroute\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSerenitynowCacherouteRoutes extends Migration
{
    public function up()
    {
        Schema::table('serenitynow_cacheroute_routes', function($table)
        {
            $table->integer('sort_order')->nullable()->unsigned();
        });
    }
    
    public function down()
    {
        Schema::table('serenitynow_cacheroute_routes', function($table)
        {
            $table->dropColumn('sort_order');
        });
    }
}
