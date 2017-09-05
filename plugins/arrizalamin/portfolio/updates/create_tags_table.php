<?php namespace ArrizalAmin\Portfolio\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateTagsTable extends Migration
{

    public function up()
    {
        Schema::create('arrizalamin_portfolio_tags', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->unique()->nullable();
            $table->timestamps();
        });

        Schema::create('arrizalamin_portfolio_item_tag', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('item_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->index(['tag_id', 'item_id']);
            $table->foreign('item_id')->references('id')->on('arrizalamin_portfolio_items')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('arrizalamin_portfolio_tags')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('arrizalamin_portfolio_item_tag');
        Schema::dropIfExists('arrizalamin_portfolio_tags');
    }

}
