<?php namespace ArrizalAmin\Portfolio\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateCategoriesTable extends Migration
{

    public function up()
    {
        Schema::create('arrizalamin_portfolio_categories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('arrizalamin_portfolio_categories');
    }

}
