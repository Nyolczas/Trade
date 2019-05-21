<?php
function monthlyAverages($months)
{
    global $monthlyData;

    // százalékok számítása
    for ($i = 1; $i < count($monthlyData['honap']); $i++) {
        $monthlyData['profitPercent'][$i] = $monthlyData['profit'][$i] / ($monthlyData['refBalance'][$i] / 100);
        $monthlyData['manualPercent'][$i] = $monthlyData['manualProfit'][$i] / ($monthlyData['refBalance'][$i] / 100);
        $monthlyData['robotPercent'][$i] = $monthlyData['robotProfit'][$i] / ($monthlyData['refBalance'][$i] / 100);
    }

    // --- átlagok számítása
    // adatok nullázása
    for ($i = 0; $i < count($monthlyData['honap']); $i++) {
        $monthlyData['atlagProfit'][$i] = 0;
        $monthlyData['atlagManual'][$i] = 0;
        $monthlyData['atlagRobot'][$i] = 0;
        $monthlyData['atlagProfitPerc'][$i] = 0;
        $monthlyData['atlagManualPerc'][$i] = 0;
        $monthlyData['atlagRobotPerc'][$i] = 0;
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
            $monthlyData['atlagProfitPerc'][$i] += $monthlyData['profitPercent'][$k];
            $monthlyData['atlagManualPerc'][$i] += $monthlyData['manualPercent'][$k];
            $monthlyData['atlagRobotPerc'][$i] += $monthlyData['robotPercent'][$k];
        }
        if ($range > 0) {$monthlyData['atlagProfit'][$i] = $monthlyData['atlagProfit'][$i] / $range;}
        if ($range > 0) {$monthlyData['atlagManual'][$i] = $monthlyData['atlagManual'][$i] / $range;}
        if ($range > 0) {$monthlyData['atlagRobot'][$i] = $monthlyData['atlagRobot'][$i] / $range;}
        if ($range > 0) {$monthlyData['atlagProfitPerc'][$i] = $monthlyData['atlagProfitPerc'][$i] / $range;}
    }
}
