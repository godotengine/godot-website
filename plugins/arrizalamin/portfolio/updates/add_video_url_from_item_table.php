<?php namespace ArrizalAmin\Portfolio\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class AppVideoUrlFromItemTable extends Migration
{

    public function up()
    {
        if(! Schema::hasColumn('arrizalamin_portfolio_items', 'video_url')){
            Schema::table('arrizalamin_portfolio_items', function($table){
                $table->string('video_url')->nullable();
            });
        }
    }

    public function down()
    {
        Schema::table('arrizalamin_portfolio_items', function($table)
        {
            $table->dropColumn('video_url');
        });
    }

}
