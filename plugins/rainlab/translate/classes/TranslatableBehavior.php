<?php namespace RainLab\Translate\Classes;

use Str;
use RainLab\Translate\Classes\Translator;
use October\Rain\Extension\ExtensionBase;
use October\Rain\Html\Helper as HtmlHelper;

/**
 * Base class for model behaviors.
 *
 * @package october\translate
 * @author Alexey Bobkov, Samuel Georges
 */
abstract class TranslatableBehavior extends ExtensionBase
{

    /**
     * @var \October\Rain\Database\Model Reference to the extended model.
     */
    protected $model;

    /**
     * @var string Active language for translations.
     */
    protected $translatableContext;

    /**
     * @var string Default system language.
     */
    protected $translatableDefault;

    /**
     * @var bool Determines if empty translations should be replaced by default values.
     */
    protected $translatableUseFallback = true;

    /**
     * @var array Data store for translated attributes.
     */
    protected $translatableAttributes = [];

    /**
     * @var array Data store for original translated attributes.
     */
    protected $translatableOriginals = [];

    /**
     * {@inheritDoc}
     */
    protected $requiredProperties = ['translatable'];

    /**
     * Constructor
     * @param \October\Rain\Database\Model $model The extended model.
     */
    public function __construct($model)
    {
        $this->model = $model;

        $this->initTranslatableContext();

        $this->model->bindEvent('model.beforeGetAttribute', function ($key) use ($model) {
            if ($this->isTranslatable($key)) {
                $value = $this->getAttributeTranslated($key);
                if ($model->hasGetMutator($key)) {
                    $method = 'get' . Str::studly($key) . 'Attribute';
                    $value = $model->{$method}($value);
                }
                return $value;
            }
        });

        $this->model->bindEvent('model.beforeSetAttribute', function ($key, $value) use ($model) {
            if ($this->isTranslatable($key)) {
                $value = $this->setAttributeTranslated($key, $value);
                if ($model->hasSetMutator($key)) {
                    $method = 'set' . Str::studly($key) . 'Attribute';
                    $value = $model->{$method}($value);
                }
                return $value;
            }
        });

        $this->model->bindEvent('model.saveInternal', function() {
            $this->syncTranslatableAttributes();
        });
    }

    /**
     * Initializes this class, sets the default language code to use.
     * @return void
     */
    public function initTranslatableContext()
    {
        $translate = Translator::instance();
        $this->translatableContext = $translate->getLocale();
        $this->translatableDefault = $translate->getDefaultLocale();
    }

    /**
     * Checks if an attribute should be translated or not.
     * @param  string  $key
     * @return boolean
     */
    public function isTranslatable($key)
    {
        if ($key === 'translatable' || $this->translatableDefault == $this->translatableContext) {
            return false;
        }

        return in_array($key, $this->model->getTranslatableAttributes());
    }

    /**
     * Disables translation fallback locale.
     * @return self
     */
    public function noFallbackLocale()
    {
        $this->translatableUseFallback = false;

        return $this->model;
    }

    /**
     * Returns a translated attribute value.
     *
     * The base value must come from 'attributes' on the model otherwise the process
     * can possibly loop back to this event, then method triggered by __get() magic.
     *
     * @param  string $key
     * @param  string $locale
     * @return string
     */
    public function getAttributeTranslated($key, $locale = null)
    {
        if ($locale == null) {
            $locale = $this->translatableContext;
        }

        /*
         * Result should not return NULL to successfully hook beforeGetAttribute event
         */
        $result = '';

        /*
         * Default locale
         */
        if ($locale == $this->translatableDefault) {
            $result = $this->getAttributeFromData($this->model->attributes, $key);
        }
        /*
         * Other locale
         */
        else {
            if (!array_key_exists($locale, $this->translatableAttributes)) {
                $this->loadTranslatableData($locale);
            }

            if ($this->hasTranslation($key, $locale)) {
                $result = $this->getAttributeFromData($this->translatableAttributes[$locale], $key);
            }
            elseif ($this->translatableUseFallback) {
                $result = $this->getAttributeFromData($this->model->attributes, $key);
            }
        }

        /*
         * Handle jsonable attributes, default locale may return the value as a string
         */
        if (
            is_string($result) &&
            method_exists($this->model, 'isJsonable') &&
            $this->model->isJsonable($key)
        ) {
            $result = json_decode($result, true);
        }

        return $result;
    }

    /**
     * Returns all translated attribute values.
     * @param  string $locale
     * @return array
     */
    public function getTranslateAttributes($locale)
    {
        return array_get($this->translatableAttributes, $locale, []);
    }

    /**
     * Returns whether the attribute is translatable (has a translation) for the given locale.
     * @param  string $key
     * @param  string $locale
     * @return bool
     */
    public function hasTranslation($key, $locale)
    {
        /*
         * If the default locale is passed, the attributes are retreived from the model,
         * otherwise fetch the attributes from the $translatableAttributes property
         */
        if ($locale == $this->translatableDefault) {
            $translatableAttributes = $this->model->attributes;
        }
        else {          
            /*
             * Ensure that the translatableData has been loaded
             * @see https://github.com/rainlab/translate-plugin/issues/302
             */
            if (!isset($this->translatableAttributes[$locale])) {
                $this->loadTranslatableData($locale);
            }

            $translatableAttributes = $this->translatableAttributes[$locale];
        }

        return !!$this->getAttributeFromData($translatableAttributes, $key);
    }

    /**
     * Sets a translated attribute value.
     * @param  string $key   Attribute
     * @param  string $value Value to translate
     * @return string        Translated value
     */
    public function setAttributeTranslated($key, $value, $locale = null)
    {
        if ($locale == null) {
            $locale = $this->translatableContext;
        }

        if ($locale == $this->translatableDefault) {
            return $this->setAttributeFromData($this->model->attributes, $key, $value);
        }

        if (!array_key_exists($locale, $this->translatableAttributes)) {
            $this->loadTranslatableData($locale);
        }

        return $this->setAttributeFromData($this->translatableAttributes[$locale], $key, $value);
    }

    /**
     * Restores the default language values on the model and 
     * stores the translated values in the attributes table.
     * @return void
     */
    public function syncTranslatableAttributes()
    {
        /*
         * Spin through the known locales, store the translations if necessary
         */
        $knownLocales = array_keys($this->translatableAttributes);
        foreach ($knownLocales as $locale) {
            if (!$this->isTranslateDirty(null, $locale)) {
                continue;
            }

            $this->storeTranslatableData($locale);
        }

        /*
         * Saving the default locale, no need to restore anything
         */
        if ($this->translatableContext == $this->translatableDefault) {
            return;
        }

        /*
         * Restore translatable values to models originals
         */
        $original = $this->model->getOriginal();
        $attributes = $this->model->getAttributes();
        $translatable = $this->model->getTranslatableAttributes();
        $originalValues = array_intersect_key($original, array_flip($translatable));
        $this->model->attributes = array_merge($attributes, $originalValues);
    }

    /**
     * Changes the active language for this model
     * @param  string $context
     * @return void
     */
    public function translateContext($context = null)
    {
        if ($context === null) {
            return $this->translatableContext;
        }

        $this->translatableContext = $context;
    }

    /**
     * Shorthand for translateContext method, and chainable.
     * @param  string $context
     * @return self
     */
    public function lang($context = null)
    {
        $this->translateContext($context);

        return $this->model;
    }

    /**
     * Checks if this model has transatable attributes.
     * @return true
     */
    public function hasTranslatableAttributes()
    {
        return is_array($this->model->translatable) &&
            count($this->model->translatable) > 0;
    }

    /**
     * Returns a collection of fields that will be hashed.
     * @return array
     */
    public function getTranslatableAttributes()
    {
        $translatable = [];

        foreach ($this->model->translatable as $attribute) {
            $translatable[] = is_array($attribute) ? array_shift($attribute) : $attribute;
        }

        return $translatable;
    }

    /**
     * Returns the defined options for a translatable attribute.
     * @return array
     */
    public function getTranslatableAttributesWithOptions()
    {
        $attributes = [];

        foreach ($this->model->translatable as $options) {
            if (!is_array($options)) {
                continue;
            }

            $attributeName = array_shift($options);

            $attributes[$attributeName] = $options;
        }

        return $attributes;
    }

    /**
     * Determine if the model or a given translated attribute has been modified.
     * @param  string|null  $attribute
     * @return bool
     */
    public function isTranslateDirty($attribute = null, $locale = null)
    {
        $dirty = $this->getTranslateDirty($locale);

        if (is_null($attribute)) {
            return count($dirty) > 0;
        }
        else {
            return array_key_exists($attribute, $dirty);
        }
    }

    /**
     * Get the original values of the translated attributes.
     * @param  string|null $locale If `null`, the method will get the original data for all locales.
     * @return array|null Returns locale data as an array, or `null` if an invalid locale is specified.
     */
    public function getTranslatableOriginals($locale = null)
    {
        if (!$locale) {
            return $this->translatableOriginals;
        } else {
            return $this->translatableOriginals[$locale] ?? null;
        }
    }

    /**
     * Get the translated attributes that have been changed since last sync.
     * @return array
     */
    public function getTranslateDirty($locale = null)
    {
        if (!$locale) {
            $locale = $this->translatableContext;
        }

        if (!array_key_exists($locale, $this->translatableAttributes)) {
            return [];
        }

        if (!array_key_exists($locale, $this->translatableOriginals)) {
            return $this->translatableAttributes[$locale]; // All dirty
        }

        $dirty = [];

        foreach ($this->translatableAttributes[$locale] as $key => $value) {

            if (!array_key_exists($key, $this->translatableOriginals[$locale])) {
                $dirty[$key] = $value;
            }
            elseif ($value != $this->translatableOriginals[$locale][$key]) {
                $dirty[$key] = $value;
            }
        }

        return $dirty;
    }

    /**
     * Extracts a attribute from a model/array with nesting support.
     * @param  mixed  $data
     * @param  string $attribute
     * @return mixed
     */
    protected function getAttributeFromData($data, $attribute)
    {
        $keyArray = HtmlHelper::nameToArray($attribute);

        return array_get($data, implode('.', $keyArray));
    }

    /**
     * Sets an attribute from a model/array with nesting support.
     * @param  mixed  $data
     * @param  string $attribute
     * @return mixed
     */
    protected function setAttributeFromData(&$data, $attribute, $value)
    {
        $keyArray = HtmlHelper::nameToArray($attribute);

        array_set($data, implode('.', $keyArray), $value);

        return $value;
    }

    /**
     * Saves the translation data for the model.
     * @param  string $locale
     * @return void
     */
    abstract protected function storeTranslatableData($locale = null);

    /**
     * Loads the translation data from the model.
     * @param  string $locale
     * @return array
     */
    abstract protected function loadTranslatableData($locale = null);

    /**
     * @deprecated setTranslateAttribute is deprecated, use setAttributeTranslated instead.
     * @todo Remove method if year >= 2017
     */
    public function setTranslateAttribute($key, $value, $locale = null)
    {
        traceLog(static::class . '::setTranslateAttribute is deprecated, use setAttributeTranslated instead.');
        return $this->setAttributeTranslated($key, $value, $locale);
    }

    /**
     * @deprecated getTranslateAttribute is deprecated, use getAttributeTranslated instead.
     * @todo Remove method if year >= 2017
     */
    public function getTranslateAttribute($key, $locale = null)
    {
        traceLog(static::class . '::getTranslateAttribute is deprecated, use getAttributeTranslated instead.');
        return $this->getAttributeTranslated($key, $locale);
    }
}
