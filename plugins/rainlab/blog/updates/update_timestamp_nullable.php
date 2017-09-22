<?php namespace RainLab\Blog\Updates;

use October\Rain\Database\Updates\Migration;
use DbDongle;

class UpdateTimestampsNullable extends Migration
{
    public function up()
    {
        DbDongle::disableStrictMode();

        DbDongle::convertTimestamps('rainlab_blog_posts');
        DbDongle::convertTimestamps('rainlab_blog_categories');
    }

    public function down()
    {
        // ...
    }
}
