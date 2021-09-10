<?php

return [
	'mode'                  => 'utf-8',
	'format'                => 'A4',
	'author'                => '',
	'subject'               => '',
	'keywords'              => '',
	'creator'               => 'Laravel Pdf',
	'display_mode'          => 'fullpage',
	'tempDir'               => base_path('../temp/'),
	'font_path' => base_path('storage/fonts/'),
	'font_data' => [
		'nikosh' => [
			'R'  => 'Nikosh.ttf',    // regular font
			'B'  => 'Nikosh.ttf',       // optional: bold font
			'I'  => 'Nikosh.ttf',     // optional: italic font
			'BI' => 'Nikosh.ttf', // optional: bold-italic font
			'useOTL' => 0xFF,    // required for complicated langs like Persian, Arabic and Chinese
			'useKashida' => 75,  // required for complicated langs like Persian, Arabic and Chinese
		],
		'nikoshban' => [
			'R'  => 'NikoshBAN.ttf',    // regular font
			'B'  => 'NikoshBAN.ttf',       // optional: bold font
			'I'  => 'NikoshBAN.ttf',     // optional: italic font
			'BI' => 'NikoshBAN.ttf', // optional: bold-italic font
			'useOTL' => 0xFF,    // required for complicated langs like Persian, Arabic and Chinese
			'useKashida' => 75,  // required for complicated langs like Persian, Arabic and Chinese
		],
		'kalpurush' => [
			'R'  => 'Kalpurush.ttf',    // regular font
			'B'  => 'Kalpurush.ttf',       // optional: bold font
			'I'  => 'Kalpurush.ttf',     // optional: italic font
			'BI' => 'Kalpurush.ttf', // optional: bold-italic font
			'useOTL' => 0xFF,    // required for complicated langs like Persian, Arabic and Chinese
			'useKashida' => 75,  // required for complicated langs like Persian, Arabic and Chinese
		],
		'SolaimanLipi' => [
			'R'  => 'SolaimanLipi.ttf',    // regular font
			'B'  => 'SolaimanLipi.ttf',       // optional: bold font
			'I'  => 'SolaimanLipi.ttf',     // optional: italic font
			'BI' => 'SolaimanLipi.ttf', // optional: bold-italic font
			'useOTL' => 0xFF,    // required for complicated langs like Persian, Arabic and Chinese
			'useKashida' => 75,  // required for complicated langs like Persian, Arabic and Chinese
		]
		// ...add as many as you want.
	]
];
