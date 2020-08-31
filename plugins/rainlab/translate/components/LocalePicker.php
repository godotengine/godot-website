<?php namespace RainLab\Translate\Components;

use Event;
use Config;
use Request;
use Redirect;
use RainLab\Translate\Models\Locale as LocaleModel;
use RainLab\Translate\Classes\Translator;
use October\Rain\Router\Router as RainRouter;
use Cms\Classes\ComponentBase;

class LocalePicker extends ComponentBase
{
    /**
     * @var RainLab\Translate\Classes\Translator Translator object.
     */
    protected $translator;

    /**
     * @var array Collection of enabled locales.
     */
    public $locales;

    /**
     * @var string The active locale code.
     */
    public $activeLocale;

    /**
     * @var string The active locale name.
     */
    public $activeLocaleName;
    
    /**
     * @var The active locale code before switching.
     */
    public $oldLocale;

    public function componentDetails()
    {
        return [
            'name'        => 'rainlab.translate::lang.locale_picker.component_name',
            'description' => 'rainlab.translate::lang.locale_picker.component_description',
        ];
    }

    public function defineProperties()
    {
        return [
            'forceUrl' => [
                'title'       => 'Force URL schema',
                'description' => 'Always prefix the URL with a language code.',
                'default'     => 0,
                'type'        => 'checkbox'
            ],
        ];
    }

    public function init()
    {
        $this->translator = Translator::instance();
    }

    public function onRun()
    {
        if ($redirect = $this->redirectForceUrl()) {
            return $redirect;
        }

        $this->page['locales'] = $this->locales = LocaleModel::listEnabled();
        $this->page['activeLocale'] = $this->activeLocale = $this->translator->getLocale();
        $this->page['activeLocaleName'] = $this->activeLocaleName = array_get($this->locales, $this->activeLocale);
    }

    public function onSwitchLocale()
    {
        if (!$locale = post('locale')) {
            return;
        }

        // Remember the current locale before switching to the requested one
        $this->oldLocale = $this->translator->getLocale();
        
        $this->translator->setLocale($locale);

        $pageUrl = $this->withPreservedQueryString($this->makeLocaleUrlFromPage($locale), $locale);
        if ($this->property('forceUrl')) {
            return Redirect::to($this->translator->getPathInLocale($pageUrl, $locale));
        }

        return Redirect::to($pageUrl);
    }

    protected function redirectForceUrl()
    {
        if (
            Request::ajax() ||
            !$this->property('forceUrl') ||
            $this->translator->loadLocaleFromRequest()
        ) {
            return;
        }

        $prefixDefaultLocale = Config::get('rainlab.translate::prefixDefaultLocale');
        $locale = $this->translator->getLocale(false)
            ?: $this->translator->getDefaultLocale();

        if ($prefixDefaultLocale) {
            return Redirect::to(
                $this->withPreservedQueryString(
                    $this->translator->getCurrentPathInLocale($locale),
                    $locale
                )
            );
        } elseif ( $locale == $this->translator->getDefaultLocale()) {
            return;
        } else {
            $this->translator->setLocale($this->translator->getDefaultLocale());
            return;
        }

    }

    /**
     * Returns the URL from a page object, including current parameter values.
     * @return string
     */
    protected function makeLocaleUrlFromPage($locale)
    {
        $page = $this->getPage();

        /*
         * Static Page
         */
        if (isset($page->apiBag['staticPage'])) {

            $staticPage = $page->apiBag['staticPage'];

            $staticPage->rewriteTranslatablePageUrl($locale);

            $localeUrl = array_get($staticPage->attributes, 'viewBag.url');
        }
        /*
         * CMS Page
         */
        else {
            $page->rewriteTranslatablePageUrl($locale);

            $router = new RainRouter;

            $params = $this->getRouter()->getParameters();
                        
            /**
             * @event translate.localePicker.translateParams
             * Enables manipulating the URL parameters
             *
             * You will have access to the page object, the old and new locale and the URL parameters.
             *
             * Example usage:
             *
             *     Event::listen('translate.localePicker.translateParams', function($page, $params, $oldLocale, $newLocale) {
             *        if ($page->baseFileName == 'your-page-filename') {
             *             return YourModel::translateParams($params, $oldLocale, $newLocale);
             *         }
             *     });
             *
             */            
            $translatedParams = Event::fire('translate.localePicker.translateParams', 
                                            [$page, $params, $this->oldLocale, $locale], true);
            
            if ($translatedParams) {
                $params = $translatedParams;
            }
            
            $localeUrl = $router->urlFromPattern($page->url, $params);
        }

        return $localeUrl;
    }

    /**
     * Makes sure to add any existing query string to the redirect url.
     *
     * @param $pageUrl
     * @param $locale
     *
     * @return string
     */
    protected function withPreservedQueryString($pageUrl, $locale)
    {       
        $page = $this->getPage();
        $query = request()->query();

        /**
         * @event translate.localePicker.translateQuery
         * Enables manipulating the URL query parameters
         *
         * You will have access to the page object, the old and new locale and the URL query parameters.
         *
         * Example usage:
         *
         *     Event::listen('translate.localePicker.translateQuery', function($page, $params, $oldLocale, $newLocale) {
         *        if ($page->baseFileName == 'your-page-filename') {
         *             return YourModel::translateParams($params, $oldLocale, $newLocale);
         *         }
         *     });
         *
         */
        $translatedQuery = Event::fire('translate.localePicker.translateQuery', 
                                        [$page, $query, $this->oldLocale, $locale], true);
        
        $query = http_build_query($translatedQuery ?: $query);

        return $query ? $pageUrl . '?' . $query : $pageUrl;
    }
}
