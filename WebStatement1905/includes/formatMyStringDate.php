<?php

function formatMyStringDate($stringdate, $format)
{
    $actualYear = substr($stringdate, 1, 4);
    $actualDay = substr($stringdate, -3, 2);
    $actualMonth = substr($stringdate, -6, 2);
    return date($format, mktime(0, 0, 0, $actualMonth, $actualDay, $actualYear));

}

/*
$actualYear = substr($stringdate, 1, 4);
    $actualDay = substr($stringdate, -3, 2);
    $actualMonth = substr($stringdate, -6, 2);
    $actualDate = date_create(date("Y-m-d", mktime(0, 0, 0, $actualMonth, $actualDay, $actualYear)));
    return $actualDate->format($format);
*/