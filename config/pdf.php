<?php

return [
	'mode'                  => 'utf-8',
	'format'                => 'A4',
	'author'                => '',
	'subject'               => '',
	'keywords'              => '',
	'creator'               => 'Faracoach',
	'display_mode'          => 'fullpage',
	'tempDir'               => base_path('storage/temp'),
	'pdf_a'                 => false,
	'pdf_a_auto'            => false,
	'icc_profile_path'      => '',
    'font_path' => base_path('storage/fonts/'),
    'font_data' => [
        'vazir' => [
            'R' => 'Vazir.ttf', // regular font
            'B' => 'Vazir.ttf', // optional: bold font
            'I' => 'Vazir.ttf', // optional: italic font
            'useOTL' => 0xFF,    // required for complicated langs like Persian, Arabic and Chinese
            'useKashida' => 75,  // required for complicated langs like Persian, Arabic and Chinese
        ]
        // ...add as many as you want.
    ]

];
