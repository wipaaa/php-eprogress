<?php

return [
	'driver' => env('DB_DRVR', 'mysql'),
	'name' => env('DB_NAME', 'ukk'),
	'host' => env('DB_HOST', 'localhost'),
	'port' => env('DB_PORT', 3306),
	'user' => env('DB_USER', 'root'),
	'pass' => env('DB_PASS', '')
];
