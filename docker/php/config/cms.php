<?php

// See https://github.com/octobercms/october/blob/v1.0.474/config/cms.php

return [

    // Overridden.
    'activeTheme' => 'godotengine',

    'edgeUpdates' => false,

    'backendUri' => 'backend',
    'backendForceSecure' => false,
    'backendForceRemember' => true,
    'backendTimezone' => 'UTC',
    'backendSkin' => 'Backend\Skins\Standard',

    'runMigrationsOnLogin' => null,

    'loadModules' => ['System', 'Backend', 'Cms'],

    // Overridden, use composer for updates.
    'disableCoreUpdates' => true,

    'disablePlugins' => [],

    'enableRoutesCache' => false,
    'urlCacheTtl' => 10,
    'parsedPageCacheTTL' => 10,

    'enableAssetCache' => false,
    'enableAssetMinify' => null,
    'enableAssetDeepHashing' => null,

    'databaseTemplates' => false,

    'pluginsPath' => '/plugins',
    'themesPath' => '/themes',

    'storage' => [

        'uploads' => [
            'disk'            => 'local',
            'folder'          => 'uploads',
            'path'            => '/storage/app/uploads',
            'temporaryUrlTTL' => 3600,
        ],

        'media' => [
            'disk'   => 'local',
            'folder' => 'media',
            'path'   => '/storage/app/media',
        ],

    ],

    'convertLineEndings' => false,
    'linkPolicy' => 'detect',
    'defaultMask' => ['file' => null, 'folder' => null],

    'enableSafeMode' => null,
    'enableCsrfProtection' => true,

    'forceBytecodeInvalidation' => true,

    'enableTwigStrictVariables' => false,

    'restrictBaseDir' => true,

    'enableBackendServiceWorkers' => false,

];
