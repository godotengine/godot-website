# Translation plugin

Enables multi-lingual sites.

## Selecting a language

Different languages can be set up in the back-end area, with a single default language selected. This activates the use of the language on the front-end and in the back-end UI.

A visitor can select a language by prefixing the language code to the URL, this is then stored in the user's session as their chosen language. For example:

* `http://website/ru/` will display the site in Russian
* `http://website/fr/` will display the site in French
* `http://website/` will display the site in the default language or the user's chosen language.

## Language Picker Component

A visitor can select their chosen language using the `LocalePicker` component. This component will display a simple dropdown that changes the page language depending on the selection.

    title = "Home"
    url = "/"

    [localePicker]
    ==

    <h3>{{ 'Please select your language:'|_ }}</h3>
    {% component 'localePicker' %}

If translated, the text above will appear as whatever language is selected by the user. The dropdown is very basic and is intended to be restyled. A simpler example might be:

    [...]
    ==

    <p>
        Switch language to:
        <a href="#" data-request="onSwitchLocale" data-request-data="locale: 'en'">English</a>,
        <a href="#" data-request="onSwitchLocale" data-request-data="locale: 'ru'">Russian</a>
    </p>

## Message translation

Message or string translation is the conversion of adhoc strings used throughout the site. A message can be translated with parameters.

    {{ site.name|_ }}

    {{ 'Welcome to our website!'|_ }}

    {{ 'Hello :name!'|_({ name: 'Friend' }) }}

A message can also be translated for a choice usage.

    {{ 'There are no apples|There are :number applies!'|__(2, { number: 'two' }) }}

Or you set a locale manually by passing a second argument.

    {{ 'this is always english'|_({}, 'en') }}

Themes can provide default values for these messages by defining a `translate` key in the `theme.yaml` file, located in the theme directory.

    name: My Theme
    # [...]

    translate:
        en:
            site.name: 'My Website'
            nav.home: 'Home'
            nav.video: 'Video'
            title.home: 'Welcome Home'
            title.video: 'Screencast Video'

You may also define the translations in a separate file, where the path is relative to the theme. The following definition will source the default messages from the file **config/lang.yaml** inside the theme.

    name: My Theme
    # [...]

    translate: config/lang.yaml

This is an example of **config/lang.yaml** file with two languages:

    en:
        site.name: 'My Website'
        nav.home: 'Home'
        nav.video: 'Video'
        title.home: 'Welcome Home'
    hr:
        site.name: 'Moje web stranice'
        nav.home: 'Početna'
        nav.video: 'Video'
        title.home: 'Dobrodošli'

You may also define the translations in a separate file per locale, where the path is relative to the theme. The following definition will source the default messages from the file **config/lang-en.yaml** inside the theme for the english locale and from the file **config/lang-fr.yaml** for the french locale.

    name: My Theme
    # [...]

    translate:
	en: config/lang-en.yaml
	fr: config/lang-fr.yaml

This is an example for the **config/lang-en.yaml** file:

    site.name: 'My Website'
    nav.home: 'Home'
    nav.video: 'Video'
    title.home: 'Welcome Home'

In order to make these default values reflected to your frontend site, go to **Settings -> Translate messages** in the backend and hit **Scan for messages**. They will also be loaded automatically when the theme is activated.

The same operation can be performed with the `translate:scan` artisan command. It may be worth including it in a deployment script to automatically fetch updated messages:

    php artisan translate:scan
    
Add the `--purge` option to clear old messages first:
    
    php artisan translate:scan --purge
    
## Content translation

This plugin activates a feature in the CMS that allows content files to use language suffixes, for example:

* **welcome.htm** will contain the content in the default language.
* **welcome.ru.htm** will contain the content in Russian.
* **welcome.fr.htm** will contain the content in French.

## Model translation

Models can have their attributes translated by using the `RainLab.Translate.Behaviors.TranslatableModel` behavior and specifying which attributes to translate in the class.

    class User
    {
        public $implement = ['RainLab.Translate.Behaviors.TranslatableModel'];

        public $translatable = ['name'];
    }

The attribute will then contain the default language value and other language code values can be created by using the `translateContext()` method.

    $user = User::first();

    // Outputs the name in the default language
    echo $user->name;

    $user->translateContext('fr');

    // Outputs the name in French
    echo $user->name;

You may use the same process for setting values.

    $user = User::first();

    // Sets the name in the default language
    $user->name = 'English';

    $user->translateContext('fr');

    // Sets the name in French
    $user->name = 'Anglais';

The `lang()` method is a shorthand version of `translateContext()` and is also chainable.

    // Outputs the name in French
    echo $user->lang('fr')->name;

This can be useful inside a Twig template.

    {{ user.lang('fr').name }}

There are ways to get and set attributes without changing the context.

    // Gets a single translated attribute for a language
    $user->getAttributeTranslated('name', 'fr');

    // Sets a single translated attribute for a language
    $user->setAttributeTranslated('name', 'Jean-Claude', 'fr');

## Fallback attribute values

By default, untranslated attributes will fall back to the default locale. This behavior can be disabled by calling the `noFallbackLocale` method.

    $user = User::first();

    $user->noFallbackLocale()->lang('fr');

    // Returns NULL if there is no French translation
    $user->name;

## Indexed attributes

Translatable model attributes can also be declared as an index by passing the `$transatable` attribute value as an array. The first value is the attribute name, the other values represent options, in this case setting the option `index` to `true`.

    public $translatable = [
        'name',
        ['slug', 'index' => true]
    ];

Once an attribute is indexed, you may use the `transWhere` method to apply a basic query to the model.

    Post::transWhere('slug', 'hello-world')->first();

The `transWhere` method accepts a third argument to explicitly pass a locale value, otherwise it will be detected from the environment.

    Post::transWhere('slug', 'hello-world', 'en')->first();

## URL translation

Pages in the CMS support translating the URL property. Assuming you have 3 languages set up:

- en: English
- fr: French
- ru: Russian

There is a page with the following content:

    url = "/contact"

    [viewBag]
    localeUrl[ru] = "/контакт"
    ==
    <p>Page content</p>

The word "Contact" in French is the same so a translated URL is not given, or needed. If the page has no URL override specified, then the default URL will be used. Pages will not be duplicated for a given language.

- /fr/contact - Page in French
- /en/contact - Page in English
- /ru/контакт - Page in Russian
- /ru/contact - 404

## URL parameter translation

It's possible to translate URL parameters by listening to the `translate.localePicker.translateParams` event, which is fired when switching languages.

    Event::listen('translate.localePicker.translateParams', function($page, $params, $oldLocale, $newLocale) {
        if ($page->baseFileName == 'your-page-filename') {
            return YourModel::translateParams($params, $oldLocale, $newLocale);
        }
    });

In YourModel, one possible implementation might look like this:

    public static function translateParams($params, $oldLocale, $newLocale) {
        $newParams = $params;
        foreach ($params as $paramName => $paramValue) {
            $records = self::transWhere($paramName, $paramValue, $oldLocale)->first();
            if ($records) {
                $records->translateContext($newLocale);
                $newParams[$paramName] = $records->$paramName;
            }
        }
        return $newParams;
    }

## Query string translation

It's possible to translate query string parameters by listening to the `translate.localePicker.translateQuery` event, which is fired when switching languages.

    Event::listen('translate.localePicker.translateQuery', function($page, $params, $oldLocale, $newLocale) {
        if ($page->baseFileName == 'your-page-filename') {
            return YourModel::translateParams($params, $oldLocale, $newLocale);
        }
    });

For a possible implementation of the `YourModel::translateParams` method look at the example under `URL parameter translation` from above.

## Settings model translation

It's possible to translate your settings model like any other model. To retrieve translated values use:

    Settings::instance()->getAttributeTranslated('your_attribute_name');

## Conditionally extending plugins

#### Models

It is possible to conditionally extend a plugin's models to support translation by placing an `@` symbol before the behavior definition. This is a soft implement will only use `TranslatableModel` if the Translate plugin is installed, otherwise it will not cause any errors.

    /**
     * Blog Post Model
     */
    class Post extends Model
    {

        [...]

        /**
         * Softly implement the TranslatableModel behavior.
         */
        public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

        /**
         * @var array Attributes that support translation, if available.
         */
        public $translatable = ['title'];

        [...]

    }

The back-end forms will automatically detect the presence of translatable fields and replace their controls for multilingual equivalents.

#### Messages

Since the Twig filter will not be available all the time, we can pipe them to the native Laravel translation methods instead. This ensures translated messages will always work on the front end.

    /**
     * Register new Twig variables
     * @return array
     */
    public function registerMarkupTags()
    {
        // Check the translate plugin is installed
        if (!class_exists('RainLab\Translate\Behaviors\TranslatableModel'))
            return;

        return [
            'filters' => [
                '_' => ['Lang', 'get'],
                '__' => ['Lang', 'choice'],
            ]
        ];
    }

# User Interface

#### Switching locales

Users can switch between locales by clicking on the locale indicator on the right hand side of the Multi-language input. By holding the CMD / CTRL key all Multi-language Input fields will switch to the selected locale.

## Integration without jQuery and October Framework files

It is possible to use the front-end language switcher without using jQuery or the OctoberCMS AJAX Framework by making the AJAX API request yourself manually. The following is an example of how to do that.

    document.querySelector('#languageSelect').addEventListener('change', function () {
        const details = {
            _session_key: document.querySelector('input[name="_session_key"]').value,
            _token: document.querySelector('input[name="_token"]').value,
            locale: this.value
        }

        let formBody = []

        for (var property in details) {
            let encodedKey = encodeURIComponent(property)
            let encodedValue = encodeURIComponent(details[property])
            formBody.push(encodedKey + '=' + encodedValue)
        }

        formBody = formBody.join('&')

        fetch(location.href + '/', {
            method: 'POST',
            body: formBody,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                'X-OCTOBER-REQUEST-HANDLER': 'onSwitchLocale',
                'X-OCTOBER-REQUEST-PARTIALS': '',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.json())
        .then(res => window.location.replace(res.X_OCTOBER_REDIRECT))
        .catch(err => console.log(err))
    })

The HTML:

    {{ form_open() }}
        <select id="languageSelect">
            <option value="none" hidden></option>
            {% for code, name in locales %}
                {% if code != activeLocale %}
                    <option value="{{code}}" name="locale">{{code | upper }}</option>
                {% endif %}
            {% endfor %}
        </select>
    {{ form_close() }}
