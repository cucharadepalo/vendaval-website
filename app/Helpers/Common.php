<?php

use Carbon\Carbon;

/**
 * Converts minutes to hh:mm format to store the value in a 'time' type column.
 */
function convertToHoursMins(int $minutes, $format = '%02d:%02d')
{
	if ($minutes < 1) {
		return;
	}

	$hours = floor($minutes / 60);
	$mins = $minutes % 60;

	return sprintf($format, $hours, $mins);
}

/**
 * Converts time in hh:mm format to minutes.
 */
function convertToMinutes(string $time)
{
	$time = explode(':', $time);

	return ($time[0] * 60) + ($time[1]) + ($time[2] / 60);
}

/**
 * Print CSS Root variables from an array containing variable and color.
 */
function printCssVariables(array $vars = []): string
{
	$output = "";

	if (count($vars)) {
		$output .= "<style>\n\t\t:root{";

		foreach ($vars as $var) {
			$output .= "\n\t\t\t{$var['variable']}: {$var['color']};";
		}

		$output .= "\n\t\t}\n\t</style>";
	}

	return $output;
}

/**
 * Devuelve el día de la semana en string de tres letras en galego
 * a partir de una fecha en formato Y-m-d
 */
function printDDay(string $date): string
{
	$days = ['dom', 'lun', 'mar', 'mér', 'xov', 'ven', 'sáb'];

	return $days[Carbon::createFromFormat('Y-m-d', $date)->dayOfWeek()];
}

/**
 * Devuelve el mes en string de tres letras en galego
 * a partir de una fecha en format Y-m-d
 */
function printMMonth(string $date): string
{
	return substr(Carbon::createFromFormat('Y-m-d', $date)->translatedFormat('M'), 0, 3);
}
