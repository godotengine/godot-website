<?php namespace RainLab\Blog\FormWidgets;

use RainLab\Blog\Models\Post;
use RainLab\Translate\Models\Locale;

/**
 * A multi-lingual version of the blog markdown editor.
 * This class should never be invoked without the RainLab.Translate plugin.
 *
 * @package rainlab\blog
 * @author Alexey Bobkov, Samuel Georges
 */
class MLBlogMarkdown extends BlogMarkdown
{
    use \RainLab\Translate\Traits\MLControl;

    /**
     * {@inheritDoc}
     */
    protected $defaultAlias = 'mlmarkdowneditor';

    public $originalAssetPath;
    public $originalViewPath;

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
        $this->actAsParent();
        $parentContent = parent::render();
        $this->actAsParent(false);

        if (!$this->isAvailable) {
            return $parentContent;
        }

        $this->vars['markdowneditor'] = $parentContent;

        $this->actAsControl(true);

        return $this->makePartial('mlmarkdowneditor');
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
        $localeData = $this->getLocaleSaveData();

        /*
         * Set the translated values to the model
         */
        if ($this->model->methodExists('setAttributeTranslated')) {
            foreach ($localeData as $locale => $value) {
                $this->model->setAttributeTranslated('content', $value, $locale);

                $this->model->setAttributeTranslated(
                    'content_html',
                    Post::formatHtml($value),
                    $locale
                );
            }
        }

        return array_get($localeData, $this->defaultLocale->code, $value);
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

            $this->actAsControl(true);
            $this->addJs('js/mlmarkdowneditor.js');
            $this->actAsControl(false);
        }
    }

    protected function actAsParent($switch = true)
    {
        if ($switch) {
            $this->originalAssetPath = $this->assetPath;
            $this->originalViewPath = $this->viewPath;
            $this->assetPath = '/modules/backend/formwidgets/markdowneditor/assets';
            $this->viewPath = base_path('/modules/backend/formwidgets/markdowneditor/partials');
        }
        else {
            $this->assetPath = $this->originalAssetPath;
            $this->viewPath = $this->originalViewPath;
        }
    }

    protected function actAsControl($switch = true)
    {
        if ($switch) {
            $this->originalAssetPath = $this->assetPath;
            $this->originalViewPath = $this->viewPath;
            $this->assetPath = '/plugins/rainlab/translate/formwidgets/mlmarkdowneditor/assets';
            $this->viewPath = base_path('/plugins/rainlab/translate/formwidgets/mlmarkdowneditor/partials');
        }
        else {
            $this->assetPath = $this->originalAssetPath;
            $this->viewPath = $this->originalViewPath;
        }
    }
}
