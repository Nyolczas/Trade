<?php
function monthlyAverages($months)
{
    global $monthlyData;
    // adatok nullázása
    for ($i = 0; $i < count($monthlyData['honap']); $i++) {
        $monthlyData['atlagProfit'][$i] = 0;
        $monthlyData['atlagManual'][$i] = 0;
        $monthlyData['atlagRobot'][$i] = 0;
    }

    // adatok feltöltése
    for ($i = 0; $i < count($monthlyData['honap']); $i++) {
        //echo "i: " . $i . "<br>";
        $range = $i;
        if ($range > $months) {$range = $months;}
        for ($k = $i; $k > $i - $range; $k--) {
            //echo "k: " . $k . "<br>";
            $monthlyData['atlagProfit'][$i] += $monthlyData['profit'][$k];
            $monthlyData['atlagManual'][$i] += $monthlyData['manualProfit'][$k];
            $monthlyData['atlagRobot'][$i] += $monthlyData['robotProfit'][$k];
        }
        if ($range > 0) {$monthlyData['atlagProfit'][$i] = $monthlyData['atlagProfit'][$i] / $range;}
        if ($range > 0) {$monthlyData['atlagManual'][$i] = $monthlyData['atlagManual'][$i] / $range;}
        if ($range > 0) {$monthlyData['atlagRobot'][$i] = $monthlyData['atlagRobot'][$i] / $range;}
    }

}
