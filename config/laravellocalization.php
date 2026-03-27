<?php

return [

    'supportedLocales' => [
        'en' => ['name' => 'English', 'script' => 'Latn', 'native' => 'English',   'regional' => 'en_GB'],
        'ar' => ['name' => 'Arabic',  'script' => 'Arab', 'native' => 'العربية', 'regional' => 'ar_AE'],
    ],

    'useAcceptLanguageHeader' => true,

    // TRUE = English (default) has no prefix: / = English, /ar = Arabic
    // This eliminates the / → /en redirect that was causing 404
    'hideDefaultLocaleInURL' => true,

    'localesOrder'   => [],
    'localesMapping' => [],

    'utf8suffix' => env('LARAVELLOCALIZATION_UTF8SUFFIX', '.UTF-8'),

    'urlsIgnored' => ['/skipped'],

    'httpMethodsIgnored' => ['POST', 'PUT', 'PATCH', 'DELETE'],
];
