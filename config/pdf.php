<?php

return [
    'mode'                     => '',
    'format'                   => 'A4',
    'default_font_size'        => '14',
    'default_font'             => 'vazir',
    'margin_left'              => 10,
    'margin_right'             => 10,
    'margin_top'               => 10,
    'margin_bottom'            => 10,
    'margin_header'            => 0,
    'margin_footer'            => 0,
    'orientation'              => 'P',
    'title'                    => 'Laravel mPDF',
    'subject'                  => '',
    'author'                   => '',
    'watermark'                => '',
    'show_watermark'           => false,
    'show_watermark_image'     => false,
    'watermark_font'           => 'sans-serif',
    'display_mode'             => 'fullpage',
    'watermark_text_alpha'     => 0.1,
    'watermark_image_path'     => '',
    'watermark_image_alpha'    => 0.2,
    'watermark_image_size'     => 'D',
    'watermark_image_position' => 'P',
    'custom_font_dir'  => base_path('public/fonts'), // don't forget the trailing slash!
    'custom_font_data' => [
        'vazir' => [ // must be lowercase and snake_case
            'R'  => 'Vazir-Bold-FD-WOL.ttf',    // regular font
            'B'  => 'Vazir-Bold-FD-WOL.ttf',       // optional: bold font
            'I'  => 'Vazir-Bold-FD-WOL.ttf',     // optional: italic font
            'BI' => 'Vazir-Bold-FD-WOL.ttf' ,// optional: bold-italic font
        ]
        // ...add as many as you want.
    ],
    'auto_language_detection'  => false,
    'temp_dir'                 => storage_path('app'),
    'pdfa'                     => false,
    'pdfaauto'                 => false,
    'use_active_forms'         => false,
];
