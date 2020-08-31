<?php namespace RainLab\Translate\Updates;

use Db;
use October\Rain\Database\Relations\Relation;
use October\Rain\Database\Updates\Migration;
use RainLab\Translate\Models\Attribute;

/**
 * Because attributes are loaded using a proper morphMany relation starting from version 1.6.3,
 * custom morph map aliases are now taken into account. This migration updates all existing
 * model_types to use the registered alias.
 *
 * @see https://github.com/rainlab/translate-plugin/issues/539
 */
class MigrateMorphedIndexes extends Migration
{
    protected $table = 'rainlab_translate_indexes';

    public function up()
    {
        foreach (Relation::$morphMap as $alias => $class) {
            Db::table($this->table)->where('model_type', $class)->update(['model_type' => $alias]);
        }
    }

    public function down()
    {
        foreach (Relation::$morphMap as $alias => $class) {
            Db::table($this->table)->where('model_type', $alias)->update(['model_type' => $class]);
        }
    }
}
