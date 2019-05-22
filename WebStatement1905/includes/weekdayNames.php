<?php
function weekdayNames($weekday)
{
    switch ($weekday) {
        case "Monday":
            return "Hétfő";
            break;
        case "Tuesday":
            return "Kedd";
            break;
        case "Wednesday":
            return "Szerda";
            break;
        case "Thursday":
            return "Csütörtök";
            break;
        case "Friday":
            return "Péntek";
            break;
        case "Saturday":
            return "Szombat";
            break;
        case "Sunday":
            return "Vasárnap";
            break;
    }
}
