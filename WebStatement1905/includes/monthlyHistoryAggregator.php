<?php
function monthlyHistoryAggregator()
{
    global $dailyHistory;
    global $monthlyData;

    $monthCount = 0;
    $prevProfit = 0;
    $prevManual = 0;
    $prevRobot = 0;
    $haviProfit = 0;
    $haviManual = 0;
    $haviRobot = 0;

    // nulladik hónap beállítása
    $monthlyData['honap'][$monthCount] = '75  ' . monthNames(07);
    $monthlyData['profit'][$monthCount] = $haviProfit;
    $monthlyData['manualProfit'][$monthCount] = $haviManual;
    $monthlyData['robotProfit'][$monthCount] = $haviRobot;

    for ($i = 0; $i < count($dailyHistory['date']); $i++) {
        $actualDate = substr($dailyHistory['date'][$i], 3, 2) . " " . monthNames(substr($dailyHistory['date'][$i], 6, 2));
        //echo(substr($dailyHistory['date'][$i], 6, 2)).'<br>' ;
        if ($monthlyData['honap'][$monthCount] != $actualDate) {
            $monthCount++;
            $monthlyData['honap'][$monthCount] = $actualDate;

            $prevProfit += $haviProfit;
            $prevManual += $haviManual;
            $prevRobot += $haviRobot;
            $haviProfit = $dailyHistory['hozam'][$i] - $prevProfit;
            $haviManual = $dailyHistory['manual'][$i] - $prevManual;
            $haviRobot = $dailyHistory['robot'][$i] - $prevRobot;
            $monthlyData['profit'][$monthCount] = $haviProfit;
            $monthlyData['manualProfit'][$monthCount] = $haviManual;
            $monthlyData['robotProfit'][$monthCount] = $haviRobot;
        } else {
            $haviProfit = $dailyHistory['hozam'][$i] - $prevProfit;
            $haviManual = $dailyHistory['manual'][$i] - $prevManual;
            $haviRobot = $dailyHistory['robot'][$i] - $prevRobot;
            $monthlyData['profit'][$monthCount] = $haviProfit;
            $monthlyData['manualProfit'][$monthCount] = $haviManual;
            $monthlyData['robotProfit'][$monthCount] = $haviRobot;
        }
    }
}
