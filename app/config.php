<?php

/* PEPPER
---------------------------------------------- */

if( $_SERVER["SERVER_NAME"] == 'dota2.dev'  )
{
	$settings =
	[
		'version' => 1,
		'env' => 'dev',
		'debug' => false,
		'show_errors' => true,
		'templates.path' => 'app/views/',

		'base_url' => 'http://dota2.dev:8888',
		'assets_url'  => 'http://dota2.dev:8888/assets'
	];

	$services =
	[
		'twitter' =>
		[
			'name' => 'Twitter',
			'key' => '37515099-dgFNnBdkRSW8tPNI2v1PFziBeTjyTkgCmmRdRU5r0',
			'secret' => '0Y6lstEL0YTMVvaJrL8QkuybmviaK0BqZRQKfuNxQHwej'
		]
	];

	$databases =
	[
		'main' =>
		[
			'driver'    => 'mysql',
			'host'      => 'localhost',
			'database'  => 'inventory',
			'username'  => 'root',
			'password'  => 'root',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => ''
		]
	];
}

/* LIVE!
---------------------------------------------- */

else
{
	$settings =
	[
		'version' => 1,
		'env' => 'live',
		'debug' => false,
		'show_errors' => true,
		'templates.path' => 'app/views/',

		'base_url' => 'http://localhost:8888/bostondota',
		'assets_url'  => 'http://localhost:8888/bostondota/assets'
	];

	$services =
	[
		'twitter' =>
		[
			'name' => 'Twitter',
			'key' => '37515099-dgFNnBdkRSW8tPNI2v1PFziBeTjyTkgCmmRdRU5r0',
			'secret' => '0Y6lstEL0YTMVvaJrL8QkuybmviaK0BqZRQKfuNxQHwej'
		]
	];

	$databases =
	[
		'main' =>
		[
			'driver'    => 'mysql',
			'host'      => 'localhost',
			'database'  => 'inventory',
			'username'  => 'root',
			'password'  => 'root',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => ''
		]
	];
}
