<?php namespace ShahiemSeymor\Forum\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateEmoticonsTable extends Migration
{

    public function up()
    {
        Schema::create('shahiemseymor_bbcode_emoticons', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('notation')->nullable();
            $table->string('name')->nullable();
            $table->integer('in_editor');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('shahiemseymor_bbcode_emoticons');
    }

}
