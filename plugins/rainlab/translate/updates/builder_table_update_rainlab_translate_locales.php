<?php namespace RainLab\Translate\Updates;

use RainLab\Translate\Models\Locale;
use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateRainlabTranslateLocales extends Migration
{
    public function up()
    {
        Schema::table('rainlab_translate_locales', function($table)
        {
            $table->integer('sort_order')->default(0);
        });

        $locales = Locale::all();
        foreach($locales as $locale) {
            $locale->sort_order = $locale->id;
            $locale->save();
        }
    }
    
    public function down()
    {
        Schema::table('rainlab_translate_locales', function($table)
        {
            $table->dropColumn('sort_order');
        });
    }
}