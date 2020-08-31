<?php namespace RainLab\Translate\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateLocalesTable extends Migration
{

    public function up()
    {
        Schema::create('rainlab_translate_locales', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('code')->index();
            $table->string('name')->index()->nullable();
            $table->boolean('is_default')->default(0);
            $table->boolean('is_enabled')->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('rainlab_translate_locales');
    }

}
