<?php namespace RainLab\Translate\FormWidgets;

use Backend\FormWidgets\Repeater;
use RainLab\Translate\Models\Locale;
use October\Rain\Html\Helper as HtmlHelper;
use ApplicationException;
use Request;

/**
 * ML Repeater
 * Renders a multi-lingual repeater field.
 *
 * @package rainlab\translate
 * @author Alexey Bobkov, Samuel Georges
 */
class MLRepeater extends Repeater
{
    use \RainLab\Translate\Traits\MLControl;

    /**
     * {@inheritDoc}
     */
    protected $defaultAlias = 'mlrepeater';

    /**
     * {@inheritDoc}
     */
    public function init()
    {
        parent::init();
        $this->initLocale();
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        $this->isAvailable = Locale::isAvailable();

        $this->actAsParent();
        $parentContent = parent::render();
        $this->actAsParent(false);

        if (!$this->isAvailable) {
            return $parentContent;
        }

        $this->vars['repeater'] = $parentContent;
        return $this->makePartial('mlrepeater');
    }

    public function prepareVars()
    {
        parent::prepareVars();
        $this->prepareLocaleVars();
    }

    /**
     * Returns an array of translated values for this field
     * @return array
     */
    public function getSaveValue($value)
    {
        $this->rewritePostValues();

        return $this->getLocaleSaveValue(is_array($value) ? array_values($value) : $value);
    }

    /**
     * {@inheritDoc}
     */
    protected function loadAssets()
    {
        $this->actAsParent();
        parent::loadAssets();
        $this->actAsParent(false);

        if (Locale::isAvailable()) {
            $this->loadLocaleAssets();
            $this->addJs('js/mlrepeater.js');
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function getParentViewPath()
    {
        return base_path().'/modules/backend/formwidgets/repeater/partials';
    }

    /**
     * {@inheritDoc}
     */
    protected function getParentAssetPath()
    {
        return '/modules/backend/formwidgets/repeater/assets';
    }

    public function onAddItem()
    {
        $this->actAsParent();
        return parent::onAddItem();
    }

    public function onSwitchItemLocale()
    {
        if (!$locale = post('_repeater_locale')) {
            throw new ApplicationException('Unable to find a repeater locale for: '.$locale);
        }

        // Store previous value
        $previousLocale = post('_repeater_previous_locale');
        $previousValue = $this->getPrimarySaveDataAsArray();

        // Update widget to show form for switched locale
        $lockerData = $this->getLocaleSaveDataAsArray($locale) ?: [];
        $this->reprocessLocaleItems($lockerData);

        foreach ($this->formWidgets as $key => $widget) {
            $value = array_shift($lockerData);
            if (!$value) {
                unset($this->formWidgets[$key]);
            }
            else {
                $widget->setFormValues($value);
            }
        }

        $this->actAsParent();
        $parentContent = parent::render();
        $this->actAsParent(false);

        return [
            '#'.$this->getId('mlRepeater') => $parentContent,
            'updateValue' => json_encode($previousValue),
            'updateLocale' => $previousLocale,
        ];
    }

    /**
     * Ensure that the current locale data is processed by the repeater instead of the original non-translated data
     * @return void
     */
    protected function reprocessLocaleItems($data)
    {
        $this->formWidgets = [];
        $this->formField->value = $data;

        $key = implode('.', HtmlHelper::nameToArray($this->formField->getName()));
        $requestData = Request::all();
        array_set($requestData, $key, $data);
        Request::merge($requestData);

        $this->processItems();
    }

    /**
     * Gets the active values from the selected locale.
     * @return array
     */
    protected function getPrimarySaveDataAsArray()
    {
        $data = post($this->formField->getName()) ?: [];

        return $this->processSaveValue($data);
    }

    /**
     * Returns the stored locale data as an array.
     * @return array
     */
    protected function getLocaleSaveDataAsArray($locale)
    {
        $saveData = array_get($this->getLocaleSaveData(), $locale, []);

        if (!is_array($saveData)) {
            $saveData = json_decode($saveData, true);
        }

        return $saveData;
    }

    /**
     * Since the locker does always contain the latest values, this method
     * will take the save data from the repeater and merge it in to the
     * locker based on which ever locale is selected using an item map
     * @return void
     */
    protected function rewritePostValues()
    {
        /*
         * Get the selected locale at postback
         */
        $data = post('RLTranslateRepeaterLocale');
        $fieldName = implode('.', HtmlHelper::nameToArray($this->fieldName));
        $locale = array_get($data, $fieldName);

        if (!$locale) {
            return;
        }

        /*
         * Splice the save data in to the locker data for selected locale
         */
        $data = $this->getPrimarySaveDataAsArray();
        $fieldName = 'RLTranslate.'.$locale.'.'.implode('.', HtmlHelper::nameToArray($this->fieldName));

        $requestData = Request::all();
        array_set($requestData, $fieldName, json_encode($data));
        Request::merge($requestData);
    }
}
