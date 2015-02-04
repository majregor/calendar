<?php

//--------------------------------------------------------------------------------------------------
// Utilities for our event-fetching scripts.
//
// Requires PHP 5.2.0 or higher.
//--------------------------------------------------------------------------------------------------

// PHP will fatal error if we attempt to use the DateTime class without this being set.
date_default_timezone_set('America/New_York');


// Date Utilities
//----------------------------------------------------------------------------------------------


// Parses a string into a DateTime object, optionally forced into the given timezone.
function parseDateTime($string, $timezone=null) {
	$date = new DateTime(
		$string,
		$timezone ? $timezone : new DateTimeZone('UTC')
			// Used only when the string is ambiguous.
			// Ignored if string has a timezone offset in it.
	);
	if ($timezone) {
		// If our timezone was ignored above, force it.
		$date->setTimezone($timezone);
	}
	return $date;
}


// Takes the year/month/date values of the given DateTime and converts them to a new DateTime,
// but in UTC.
function stripTime($datetime) {
	return new DateTime($datetime->format('Y-m-d'));
}
/**
 * Returns current date in either ISO8601 or Y-m-d formats
 * Default is ISO8601 
 * @param unknown $format
 * @return string
 */
function currentDate($format='c'){
	if($format!='c'){
		if($format != 'Y-m-d'){
			return date($format);
		}
		else{
			return date('Y-m-d');
		}
	}
	else{
		return date('c');
	}
}
