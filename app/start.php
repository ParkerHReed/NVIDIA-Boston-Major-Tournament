<?php

date_default_timezone_set('UTC');

require VENDOR_PATH.'/autoload.php';

use SlimFacades\Facade;
use Illuminate\Database\Capsule\Manager as Capsule;
use Carbon\Carbon;

require APP_PATH.'/config.php';
require APP_PATH.'/libs/functions.php';
require APP_PATH.'/libs/time/Time.php';

require APP_PATH.'/data/lang.php';


/* Errors
---------------------------- */

if( $settings['show_errors'] == true )
{
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
}
else
{
	error_reporting( 0 );
	ini_set('display_errors', '0');
}


/* Start
------------------------------------------- */

$app = new \Slim\Slim( $settings );

$app->error(function (\Exception $e) use ( $app )
{
	if( Config::get('env') == 'dev' )
	{
		echo json_encode(
		[
			'success' => false,
			'code' => $e->getCode(),
			'message' => $e->getMessage(),
			'line' => $e->getLine(),
			'file' => $e->getFile()
		]);
	}
	else
	{
		echo 'Sorry there was an error. Please come back and try again later.';
	}
});


/* Database Services
------------------------------------------- */

$capsule = new Capsule;
$capsule->addConnection( $databases['main'], 'default' );
$capsule->setFetchMode(PDO::FETCH_OBJ);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$connection = $capsule->connection();
if( $settings['env'] != 'live' ) $connection->enableQueryLog();



/* Facade
------------------------------------------- */

Facade::setFacadeApplication($app);
Facade::registerAliases();

Facade::registerAliases(
[
	'DB'   => 'Illuminate\Database\Capsule\Manager',
	'v'    => 'Respect\Validation\Validator',
	'Time' => 'Time\Time',
	'util' => '\utilphp\util',
	'Carbon' => 'Carbon\Carbon'
]);



/* Global Data
------------------------------------------- */

View::setData($settings);


/* Routes include
------------------------------------------- */

require APP_PATH.'/routes.php';


/* Run Slim
------------------------------------------- */

$app->run();