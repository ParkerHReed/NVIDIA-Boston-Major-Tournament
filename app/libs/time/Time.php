<?php

namespace Time;

use Carbon\Carbon;
use Auth;

class Time
{
	private static $timezone = 'US/Eastern';

	public static function set_timezone( $timezone )
	{
		self::$timezone = $timezone;
	}

	public static function get_timezone()
	{
		return self::$timezone;
	}

	public static function now()
	{
		return Carbon::now()->toDateTimeString();
	}

	public static function to_timestamp( $string )
	{
		if( is_object($string) ) $string = $string->toDateTimeString();
		if( is_string($string) ) $string = strtotime($string);
		return $string;
	}

	public static function minutes( $string )
	{
		$timestamp = Time::to_timestamp( $string );
		return Carbon::createFromTimeStamp( $timestamp, Time::get_timezone() )->diffInMinutes();
	}

	public static function human( $string )
	{
		$timestamp = Time::to_timestamp( $string );

		$time = Carbon::createFromTimeStamp( $timestamp, Time::get_timezone() )->format('g:ia');

		return FormatTime( $timestamp );
	}

	public static function days( $string )
	{
		$timestamp = Time::to_timestamp( $string );

		$date = Carbon::createFromTimeStamp( $timestamp, Time::get_timezone() )->format('l, F jS Y');

		$from = strtotime($date);
		$today = strtotime( Carbon::createFromTimeStamp( time(), Time::get_timezone() )->format('l, F jS Y') );
		$difference = $today - $from;

		$days = floor($difference / (60 * 60 * 24));

		if( $days == 0 )
		{
			return 'Today';
		}
		else if( $days == 1 )
		{
			return 'Yesturday';
		}
		else if( $days >= 7 )
		{
			return Time::just_date( $date );
		}

		return $days.' days ago';
	}


	public static function full_date( $string )
	{
		$timestamp = Time::to_timestamp( $string );
		return Carbon::createFromTimeStamp( $timestamp, Time::get_timezone() )->format('l, F jS Y @ g:ia');
	}

	public static function full_date_condensed( $string )
	{
		$timestamp = Time::to_timestamp( $string );
		return Carbon::createFromTimeStamp( $timestamp, Time::get_timezone() )->format('m/d/Y ( g:ia )');
	}

	public static function date( $string )
	{
		$timestamp = Time::to_timestamp( $string );
		return Carbon::createFromTimeStamp( $timestamp, Time::get_timezone() )->format('l, F jS Y @ g:ia');
	}

	public static function just_date( $string )
	{
		$timestamp = Time::to_timestamp( $string );
		return Carbon::createFromTimeStamp( $timestamp, Time::get_timezone() )->format('F jS');
	}

	public static function date_small( $string )
	{
		$timestamp = Time::to_timestamp( $string );
		return Carbon::createFromTimeStamp( $timestamp, Time::get_timezone() )->format('M d Y');
	}

	public static function mysql( $string, $timezone = true )
	{
		$timestamp = Time::to_timestamp( $string );

		if( !$timezone )
		{
			return Carbon::createFromTimeStamp( $timestamp )->format('Y-m-d H:i:s');
		}
		else
		{
			return Carbon::createFromTimeStamp( $timestamp, Time::get_timezone() )->format('Y-m-d H:i:s');
		}
	}

	public static function get_offset()
	{
		$timezone = self::get_timezone();
		$time = new \DateTime('now', new \DateTimeZone($timezone));
		return $time->format('P');
	}

}
