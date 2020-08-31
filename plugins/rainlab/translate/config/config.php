<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Prefix the default Locale
    |--------------------------------------------------------------------------
    |
    | Should the default locale be prefixed by the plugin?
    |
    */
    'prefixDefaultLocale' => true,

    /*
    |--------------------------------------------------------------------------
    | Cache timeout in minutes
    |--------------------------------------------------------------------------
    |
    | By default all translations are cached for 24 hours (1440 min).
    | This setting allows to change that period with given amount of minutes.
    |
    | ( For example 43200 for 30 days or 525600 for one year )
    |
    */
    'cacheTimeout'        => 1440,

    /*
    |--------------------------------------------------------------------------
    | Disable locale prefix routes
    |--------------------------------------------------------------------------
    |
    | Disables the automatically generated locale prefixed routes
    | (i.e. /en/original-route) when enabled.
    |
    */
    'disableLocalePrefixRoutes' => false,

];
