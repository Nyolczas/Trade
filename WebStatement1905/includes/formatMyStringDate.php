<?php

function formatMyStringDate($stringdate, $format)
{
    $actualYear = substr($stringdate, 1, 4);
    $actualDay = substr($stringdate, -3, 2);
    $actualMonth = substr($stringdate, -6, 2);
    return date($format, mktime(0, 0, 0, $actualMonth, $actualDay, $actualYear));

}
