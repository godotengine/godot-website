<?php namespace ArrizalAmin\Portfolio\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class UpdateTablesWithSlugs extends Migration
{

    public function up()
    {
        if (! Schema::hasColumn('arrizalamin_portfolio_items', 'slug')) {
            Schema::table('arrizalamin_portfolio_items', function($table)
            {
                $table->string('slug')->index();
            });
        }

        if (! Schema::hasColumn('arrizalamin_portfolio_categories', 'slug')) {
            Schema::table('arrizalamin_portfolio_categories', function($table)
            {
                $table->string('slug')->index();
            });
        }
    }

    public function down()
    {
        Schema::table('arrizalamin_portfolio_items', function($table)
        {
            $table->dropColumn('slug');
        });

        Schema::table('arrizalamin_portfolio_categories', function($table)
        {
            $table->dropColumn('slug');
        });
    }

}
