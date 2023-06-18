<?php

return [
	'mode'                  => 'utf-8',
	'format'                => 'A4',
	'author'                => '',
	'subject'               => '',
	'keywords'              => '',
	'creator'               => 'Faracoach',
	'display_mode'          => 'fullpage',
	'tempDir'               => base_path('../temp/'),
	'pdf_a'                 => false,
	'pdf_a_auto'            => false,
	'icc_profile_path'      => '',
    'font_path' => base_path('resources/fonts/'),
    'font_data' => [
        'IRANSans' => [
            'R'  => 'IRANSansWebFaNum.ttf',
            'B'  => 'IRANSansWebFaNum_Bold.ttf',
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ]
    ]
];
