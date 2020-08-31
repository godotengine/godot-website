<?php namespace RainLab\Translate\FormWidgets;

use Backend\FormWidgets\MediaFinder;
use RainLab\Translate\Models\Locale;
use System\Classes\MediaLibrary;

/**
 * ML MediaFinder Form Widget
 * Renders a multilingual media finder.
 *
 * @package rainlab\translate
 * @author Sascha Aeppli
 */
class MLMediaFinder extends MediaFinder
{
    use \RainLab\Translate\Traits\MLControl;

    /**
     * @inheritDoc
     */
    protected $defaultAlias = 'mlmediafinder';

    /**
     * needed to preview images, because we only get a relative path
     * @var string path to media library
     */
    private $mediaPath;

    /**
     * @inheritDoc
     */
    public function init()
    {
        parent::init();
        $this->initLocale();
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        $this->actAsParent();
        $parentContent = parent::render();
        $this->actAsParent(false);

        if (!$this->isAvailable) {
            return $parentContent;
        }

        $this->vars['mediafinder'] = $parentContent;
        return $this->makePartial('mlmediafinder');
    }

    /**
     * Prepares the form widget view data
     */
    public function prepareVars()
    {
        parent::prepareVars();
        $this->prepareLocaleVars();
        // make root path of media files accessible
        $this->vars['mediaPath'] = $this->mediaPath = MediaLibrary::url('/');
    }

    /**
     * @inheritDoc
     */
    public function getSaveValue($value)
    {
        return $this->getLocaleSaveValue($value);
    }

    /**
     * @inheritDoc
     */
    public function loadAssets()
    {
        $this->actAsParent();
        parent::loadAssets();
        $this->actAsParent(false);

        if (Locale::isAvailable()) {
            $this->loadLocaleAssets();
            $this->addJs('js/mlmediafinder.js');
            $this->addCss('css/mlmediafinder.css');
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function getParentViewPath()
    {
        return base_path().'/modules/backend/formwidgets/mediafinder/partials';
    }

    /**
     * {@inheritDoc}
     */
    protected function getParentAssetPath()
    {
        return '/modules/backend/formwidgets/mediafinder/assets';
    }
}
