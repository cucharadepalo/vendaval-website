<?php
    /**
     * Converts minutes to hh:mm format to store the value in a 'time' type column.
     *
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
     *
     */
    function convertToMinutes(string $time)
    {
        $time = explode(':', $time);

        return ($time[0] * 60) + ($time[1]) + ($time[2] / 60);
    }
