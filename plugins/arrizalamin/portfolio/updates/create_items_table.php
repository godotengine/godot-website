<?php namespace ArrizalAmin\Portfolio\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateItemsTable extends Migration
{

    public function up()
    {
        Schema::create('arrizalamin_portfolio_items', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('category_id')->unsigned()->index();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('arrizalamin_portfolio_items');
    }

}
