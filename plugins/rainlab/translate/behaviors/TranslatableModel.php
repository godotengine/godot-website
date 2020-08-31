<?php namespace RainLab\Translate\Behaviors;

use Db;
use DbDongle;
use RainLab\Translate\Classes\Translator;
use RainLab\Translate\Classes\TranslatableBehavior;
use ApplicationException;
use Exception;

/**
 * Translatable model extension
 *
 * Usage:
 *
 * In the model class definition:
 *
 *   public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];
 *
 *   public $translatable = ['name', 'content'];
 *
 */
class TranslatableModel extends TranslatableBehavior
{
    public function __construct($model)
    {
        parent::__construct($model);

        $model->morphMany['translations'] = [
            'RainLab\Translate\Models\Attribute',
            'name' => 'model'
        ];
    }

    /**
     * Applies a translatable index to a basic query. This scope will join the index
     * table and cannot be executed more than once.
     * @param  Builder $query
     * @param  string $index
     * @param  string $value
     * @param  string $locale
     * @return Builder
     */
    public function scopeTransWhere($query, $index, $value, $locale = null, $operator = '=')
    {
        if (!$locale) {
            $locale = $this->translatableContext;
        }

        $query->select($this->model->getTable().'.*');

        $query->where(function($q) use ($index, $value, $operator) {
            $q->where($this->model->getTable().'.'.$index, $operator, $value);
            $q->orWhere(function($q) use ($index, $value, $operator) {
                $q
                    ->where('rainlab_translate_indexes.item', $index)
                    ->where('rainlab_translate_indexes.value', $operator, $value)
                ;
            });
        });

        // This join will crap out if this scope executes twice, it is a known issue.
        // It should check if the join exists before applying it, this mechanism was
        // not found in Laravel. So options are block joins entirely or allow once.
        $query->leftJoin('rainlab_translate_indexes', function($join) use ($locale) {
            $join
                ->on(Db::raw(DbDongle::cast($this->model->getQualifiedKeyName(), 'TEXT')), '=', 'rainlab_translate_indexes.model_id')
                ->where('rainlab_translate_indexes.model_type', '=', $this->getClass())
                ->where('rainlab_translate_indexes.locale', '=', $locale)
            ;
        });

        return $query;
    }

    /**
     * Saves the translation data in the join table.
     * @param  string $locale
     * @return void
     */
    protected function storeTranslatableData($locale = null)
    {
        if (!$locale) {
            $locale = $this->translatableContext;
        }

        /*
         * Model doesn't exist yet, defer this logic in memory
         */
        if (!$this->model->exists) {
            $this->model->bindEventOnce('model.afterCreate', function() use ($locale) {
                $this->storeTranslatableData($locale);
            });

            return;
        }

        /**
         * @event model.translate.resolveComputedFields
         * Resolve computed fields before saving
         *
         * Example usage:
         *
         * Override Model's __construct method
         *
         * public function __construct(array $attributes = [])
         * {
         *     parent::__construct($attributes);
         *
         *     $this->bindEvent('model.translate.resolveComputedFields', function ($locale) {
         *         return [
         *             'content_html' =>
         *                 self::formatHtml($this->asExtension('TranslatableModel')
         *                     ->getAttributeTranslated('content', $locale))
         *         ];
         *     });
         * }
         *
         */
        $computedFields = $this->model->fireEvent('model.translate.resolveComputedFields', [$locale], true);
        if (is_array($computedFields)) {
            $this->translatableAttributes[$locale] = array_merge($this->translatableAttributes[$locale], $computedFields);
        }

        $this->storeTranslatableBasicData($locale);
        $this->storeTranslatableIndexData($locale);
    }

    /**
     * Saves the basic translation data in the join table.
     * @param  string $locale
     * @return void
     */
    protected function storeTranslatableBasicData($locale = null)
    {
        $data = json_encode($this->translatableAttributes[$locale], JSON_UNESCAPED_UNICODE);

        $obj = Db::table('rainlab_translate_attributes')
            ->where('locale', $locale)
            ->where('model_id', $this->model->getKey())
            ->where('model_type', $this->getClass());

        if ($obj->count() > 0) {
            $obj->update(['attribute_data' => $data]);
        }
        else {
            Db::table('rainlab_translate_attributes')->insert([
                'locale' => $locale,
                'model_id' => $this->model->getKey(),
                'model_type' => $this->getClass(),
                'attribute_data' => $data
            ]);
        }
    }

    /**
     * Saves the indexed translation data in the join table.
     * @param  string $locale
     * @return void
     */
    protected function storeTranslatableIndexData($locale = null)
    {
        $optionedAttributes = $this->getTranslatableAttributesWithOptions();
        if (!count($optionedAttributes)) {
            return;
        }

        $data = $this->translatableAttributes[$locale];

        foreach ($optionedAttributes as $attribute => $options) {
            if (!array_get($options, 'index', false)) {
                continue;
            }

            $value = array_get($data, $attribute);

            $obj = Db::table('rainlab_translate_indexes')
                ->where('locale', $locale)
                ->where('model_id', $this->model->getKey())
                ->where('model_type', $this->getClass())
                ->where('item', $attribute);

            $recordExists = $obj->count() > 0;

            if (!strlen($value)) {
                if ($recordExists) {
                    $obj->delete();
                }
                continue;
            }

            if ($recordExists) {
                $obj->update(['value' => $value]);
            }
            else {
                Db::table('rainlab_translate_indexes')->insert([
                    'locale' => $locale,
                    'model_id' => $this->model->getKey(),
                    'model_type' => $this->getClass(),
                    'item' => $attribute,
                    'value' => $value
                ]);
            }
        }
    }

    /**
     * Loads the translation data from the join table.
     * @param  string $locale
     * @return array
     */
    protected function loadTranslatableData($locale = null)
    {
        if (!$locale) {
            $locale = $this->translatableContext;
        }

        if (!$this->model->exists) {
            return $this->translatableAttributes[$locale] = [];
        }

        $obj = $this->model->translations->first(function ($value, $key) use ($locale) {
            return $value->attributes['locale'] === $locale;
        });

        $result = $obj ? json_decode($obj->attribute_data, true) : [];

        return $this->translatableOriginals[$locale] = $this->translatableAttributes[$locale] = $result;
    }

    /**
     * Returns the class name of the model. Takes any
     * custom morphMap aliases into account.
     *
     * @return string
     */
    protected function getClass()
    {
        return $this->model->getMorphClass();
    }
}
