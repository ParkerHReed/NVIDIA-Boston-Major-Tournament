<?php

/* Functions
======================================== */

function url( $path = '' )
{
	global $app;
	return $app->config('base_url').$path;
}

function assets_url( $path = '' )
{
	global $app;
	return $app->config('assets_url').$path;
}


function svg( $icon_path )
{
	$file = PUBLIC_PATH.'/'.$icon_path;
	$file_content = @file_get_contents( $file );
	if( $file_content ) echo $file_content;
}

function trace( $string, $simple = false )
{
	if( is_ajax() || $simple )
	{
		echo '<pre>';
		var_dump( $string );
		echo '</pre>';
	}
	else
	{
		echo '<pre style="background-color: #000; color: #fff; padding: 20px; text-align: left; z-index: 9999; position: relative;">';
		var_dump( $string );
		echo '</pre>';
	}
}

function input( $name, $default = '' )
{
	if( isset($_REQUEST[$name]) ) return $_REQUEST[$name];
	return $default;
}

function get_ip()
{
	if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
	{
	  $ip=$_SERVER['HTTP_CLIENT_IP'];
	}
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
	{
	  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else
	{
	  $ip=$_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}


/* Redirect
======================================== */

function redirect( $url, $code = 302 )
{
	if( !headers_sent() )
	{
		header( 'Location: '.$url, true, $code );
		exit();
	}
}

function redirect_to( $path = '' )
{
	redirect( url($path) );
}


/* Checks
======================================== */

function is_ajax()
{
	if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' )
	{
		return true;
	}

	return false;
}