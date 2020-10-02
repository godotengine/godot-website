<?php

namespace PaulVonZimmerman\Patreon\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class AddPatronCount extends Migration
{
    public function up()
    {
        Schema::table('paulvonzimmerman_patreon_system_settings', function ($table) {
            $table->integer('patron_count')->nullable();
        });
    }

    public function down()
    {
        Schema::table('paulvonzimmerman_patreon_system_settings', function ($table) {
            $table->dropColumn('patron_count');
        });
    }
}
