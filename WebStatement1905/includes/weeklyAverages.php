<?php
function weeklyAverages($weeks)
{
    global $weeklyData;

    // százalékok számítása
    for ($i = 1; $i < count($weeklyData['het']); $i++) {
        if($weeklyData['refBalance'][$i] > 0) {
            $weeklyData['profitPercent'][$i] = $weeklyData['profit'][$i] / ($weeklyData['refBalance'][$i] / 100);
            $weeklyData['manualPercent'][$i] = $weeklyData['manualProfit'][$i] / ($weeklyData['refBalance'][$i] / 100);
            $weeklyData['robotPercent'][$i] = $weeklyData['robotProfit'][$i] / ($weeklyData['refBalance'][$i] / 100);
        } else {
            $weeklyData['profitPercent'][$i] = 0;
            $weeklyData['manualPercent'][$i] = 0;
            $weeklyData['robotPercent'][$i] = 0;
        }
    }

    // --- átlagok számítása
    // adatok nullázása
    for ($i = 0; $i < count($weeklyData['het']); $i++) {
        $weeklyData['atlagProfit'][$i] = 0;
        $weeklyData['atlagManual'][$i] = 0;
        $weeklyData['atlagRobot'][$i] = 0;
        $weeklyData['atlagProfitPerc'][$i] = 0;
        $weeklyData['atlagManualPerc'][$i] = 0;
        $weeklyData['atlagRobotPerc'][$i] = 0;
    }

    // adatok feltöltése
    for ($i = 0; $i < count($weeklyData['het']); $i++) {
        //echo "i: " . $i . "<br>";
        $range = $i;
        if ($range > $weeks) {$range = $weeks;}
        for ($k = $i; $k > $i - $range; $k--) {
            //echo "k: " . $k . "<br>";
            $weeklyData['atlagProfit'][$i] += $weeklyData['profit'][$k];
            $weeklyData['atlagManual'][$i] += $weeklyData['manualProfit'][$k];
            $weeklyData['atlagRobot'][$i] += $weeklyData['robotProfit'][$k];
            $weeklyData['atlagProfitPerc'][$i] += $weeklyData['profitPercent'][$k];
            $weeklyData['atlagManualPerc'][$i] += $weeklyData['manualPercent'][$k];
            $weeklyData['atlagRobotPerc'][$i] += $weeklyData['robotPercent'][$k];
        }
        if ($range > 0) {$weeklyData['atlagProfit'][$i] = $weeklyData['atlagProfit'][$i] / $range;}
        if ($range > 0) {$weeklyData['atlagManual'][$i] = $weeklyData['atlagManual'][$i] / $range;}
        if ($range > 0) {$weeklyData['atlagRobot'][$i] = $weeklyData['atlagRobot'][$i] / $range;}
        if ($range > 0) {$weeklyData['atlagProfitPerc'][$i] = $weeklyData['atlagProfitPerc'][$i] / $range;}
        if ($range > 0) {$weeklyData['atlagManualPerc'][$i] = $weeklyData['atlagManualPerc'][$i] / $range;}
        if ($range > 0) {$weeklyData['atlagRobotPerc'][$i] = $weeklyData['atlagRobotPerc'][$i] / $range;}
    }
}
