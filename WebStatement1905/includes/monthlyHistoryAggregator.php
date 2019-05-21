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
    $monthlyData['refBalance'][$monthCount] = 0;
    $monthlyData['profitPercent'][$monthCount] = 0;
    $monthlyData['manualPercent'][$monthCount] = 0;
    $monthlyData['robotPercent'][$monthCount] = 0;
    $monthlyData['atlagProfitPerc'][$monthCount] = 0;
    $monthlyData['atlagManualPerc'][$monthCount] = 0;
    $monthlyData['atlagRobotPerc'][$monthCount] = 0;

    for ($i = 0; $i < count($dailyHistory['date']); $i++) {
        $actualDate = substr($dailyHistory['date'][$i], 3, 2) . " " . monthNames(substr($dailyHistory['date'][$i], 6, 2));
        //echo(substr($dailyHistory['date'][$i], 6, 2)).'<br>' ;
        if ($monthlyData['honap'][$monthCount] != $actualDate) {
            $monthCount++;
            $monthlyData['honap'][$monthCount] = $actualDate;

            // refBalance számítás
            if($monthCount == 1){
                $monthlyData['refBalance'][$monthCount] = $dailyHistory['balance'][$i+30];
            } else {
                $monthlyData['refBalance'][$monthCount] = $dailyHistory['balance'][$i];
            }

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
