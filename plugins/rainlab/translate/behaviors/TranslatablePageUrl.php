<?php namespace RainLab\Translate\Behaviors;

use App;
use RainLab\Translate\Classes\Translator;
use October\Rain\Extension\ExtensionBase;
use ApplicationException;
use Exception;

/**
 * Translatable page URL model extension
 *
 * Usage:
 *
 * In the model class definition:
 *
 *   public $implement = ['@RainLab.Translate.Behaviors.TranslatablePageUrl'];
 *
 */
class TranslatablePageUrl extends ExtensionBase
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
     * @var string Default page URL.
     */
    protected $translatableDefaultUrl;

    /**
     * Constructor
     * @param \October\Rain\Database\Model $model The extended model.
     */
    public function __construct($model)
    {
        $this->model = $model;

        $this->initTranslatableContext();

        $this->model->bindEvent('model.afterFetch', function() {
            $this->translatableDefaultUrl = $this->getModelUrl();

            if (!App::runningInBackend()) {
                $this->rewriteTranslatablePageUrl();
            }
        });
    }

    protected function setModelUrl($value)
    {
        if ($this->model instanceof \RainLab\Pages\Classes\Page) {
            array_set($this->model->attributes, 'viewBag.url', $value);
        }
        else {
            $this->model->url = $value;
        }
    }

    protected function getModelUrl()
    {
        if ($this->model instanceof \RainLab\Pages\Classes\Page) {
            return array_get($this->model->attributes, 'viewBag.url');
        }
        else {
            return $this->model->url;
        }
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
     * Checks if a translated URL exists and rewrites it, this method
     * should only be called from the context of front-end.
     * @return void
     */
    public function rewriteTranslatablePageUrl($locale = null)
    {
        $locale = $locale ?: $this->translatableContext;
        $localeUrl = $this->translatableDefaultUrl;

        if ($locale != $this->translatableDefault) {
            $localeUrl = $this->getSettingsUrlAttributeTranslated($locale) ?: $localeUrl;
        }

        $this->setModelUrl($localeUrl);
    }

    /**
     * Determines if a locale has a translated URL.
     * @return bool
     */
    public function hasTranslatablePageUrl($locale = null)
    {
        $locale = $locale ?: $this->translatableContext;

        return strlen($this->getSettingsUrlAttributeTranslated($locale)) > 0;
    }

    /**
     * Mutator detected by MLControl
     * @return string
     */
    public function getSettingsUrlAttributeTranslated($locale)
    {
        $defaults = ($locale == $this->translatableDefault) ? $this->translatableDefaultUrl : null;

        return array_get($this->model->attributes, 'viewBag.localeUrl.'.$locale, $defaults);
    }

    /**
     * Mutator detected by MLControl
     * @return void
     */
    public function setSettingsUrlAttributeTranslated($value, $locale)
    {
        if ($locale == $this->translatableDefault) {
            return;
        }

        if ($value == $this->translatableDefaultUrl) {
            return;
        }

        /*
         * The CMS controller will purge attributes just before saving, this
         * will ensure the attributes are injected after this logic.
         */
        $this->model->bindEventOnce('model.beforeSave', function() use ($value, $locale) {
            if (!$value) {
                array_forget($this->model->attributes, 'viewBag.localeUrl.'.$locale);
            }
            else {
                array_set($this->model->attributes, 'viewBag.localeUrl.'.$locale, $value);
            }
        });
    }

    /**
     * Mutator detected by MLControl, proxy for Static Pages plugin.
     * @return string
     */
    public function getViewBagUrlAttributeTranslated($locale)
    {
        return $this->getSettingsUrlAttributeTranslated($locale);
    }

    /**
     * Mutator detected by MLControl, proxy for Static Pages plugin.
     * @return void
     */
    public function setViewBagUrlAttributeTranslated($value, $locale)
    {
        $this->setSettingsUrlAttributeTranslated($value, $locale);
    }
}
