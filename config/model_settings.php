<?php

return [
    // start other config options

    // end other config options

    // defaultConfigs
    'defaultSettings' => [
        'users' => [
            'paginate' => 20,
            'default_language' => 'DE',
            'starred_enabled' => false,
            'known_enabled' => false,
            'fresh_first' => false,
            'show_shared' => true,
            'show_imported' => true,
            'languages_list' => config('app.supported_languages'),
            'main_language' => config('app.main_language'),
            'latest_first' => false,
        ],
    ],
];
