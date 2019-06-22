<?php

function singleCardRow($category, $value, $isNeutral = false)
{
    $profitClass = "text-muted";
    if (!$isNeutral) {
        if ($value > 0) {$profitClass = "text-success osszeg";}
        if ($value < 0) {$profitClass = "text-danger";}
    }
    $value = number_format($value, 0, ',', ' ');
    echo ("<div class=\"stat-row\">
            <div class=\"text-secondary\">$category:</div>
            <h4 class=\"value $profitClass\">$value<span class=\"ft $profitClass\">Ft</span></h4>
        </div>");
}

function flipCard($frontTitle,
    $frontValue, $frontPerc,
    $frontManual, $frontManualPerc,
    $frontRobot, $frontRobotPerc,
    $backTitle,
    $backValue, $backPerc,
    $backManual, $backManualPerc,
    $backRobot, $backRobotPerc) {
        echo("<div class=\"card\">
        <div class=\"card-side card-side-front\">
            <h2 class=\"card-name text-secondary text-center\">$frontTitle</h2>".
            cardRow("Össz", $frontValue, $frontPerc).
            cardRow("Manuál", $frontManual, $frontManualPerc).
            cardRow("Robot", $frontRobot, $frontRobotPerc).            
        "</div>
        <div class=\"card-side card-side-back\">
            <h2 class=\"card-name\">$backTitle</h2>".
            cardRow("Össz", $backValue, $backPerc).
            cardRow("Manuál", $backManual, $backManualPerc).
            cardRow("Robot", $backRobot, $backRobotPerc). 
        "</div>
    </div>");

}

function cardRow($category, $value, $percent)
{
    $profitClass = "text-muted";
    if ($value > 0) {$profitClass = "text-success";}
    if ($value < 0) {$profitClass = "text-danger";}

    $value = number_format($value, 0, ',', ' ');
    $percent = number_format($percent, 1, ',', ' ');

    return("<div class=\"stat-row\">
                <div class=\"text-secondary\">$category:</div>
                <div class=\"value-grp $profitClass\">
                    <h4 class=\"value\">$value<span class=\"ft\">Ft</span></h4>
                    <h1 class=\"percent\">$percent%</h1>
                </div>
            </div>");
}
