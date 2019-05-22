<?php
function weekdayNames($weekday)
{
    switch ($weekday) {
        case "Monday":
            return "hétfő";
            break;
        case "Tuesday":
            return "kedd";
            break;
        case "Wednesday":
            return "szerda";
            break;
        case "Thursday":
            return "csütörtök";
            break;
        case "Friday":
            return "péntek";
            break;
        case "Saturday":
            return "szombat";
            break;
        case "Sunday":
            return "vasárnap";
            break;
    }
}
