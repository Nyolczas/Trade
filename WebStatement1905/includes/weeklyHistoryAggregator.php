<?php
function weeklyHistoryAggregator()
{
    global $dailyHistory;
    global $weeklyData;

    $weekCount = 0;
    $prevProfit = 0;
    $prevManual = 0;
    $prevRobot = 0;
    $hetiProfit = 0;
    $hetiManual = 0;
    $hetiRobot = 0;

    // nulladik hónap beállítása
    $weeklyData['het'][$weekCount] = 0;
    $weeklyData['profit'][$weekCount] = $hetiProfit;
    $weeklyData['manualProfit'][$weekCount] = $hetiManual;
    $weeklyData['robotProfit'][$weekCount] = $hetiRobot;
    $weeklyData['refBalance'][$weekCount] = 0;
    $weeklyData['profitPercent'][$weekCount] = 0;
    $weeklyData['manualPercent'][$weekCount] = 0;
    $weeklyData['robotPercent'][$weekCount] = 0;
    $weeklyData['atlagProfitPerc'][$weekCount] = 0;
    $weeklyData['atlagManualPerc'][$weekCount] = 0;
    $weeklyData['atlagRobotPerc'][$weekCount] = 0;

    for ($i = 0; $i < count($dailyHistory['date']); $i++) {
        //$date = new DateTime(strtotime($dailyHistory['date'][$i]));

        $actualWeekNr = formatMyStringDate($dailyHistory['date'][$i], "W");

        //echo($actualWeekNr)."<br>" ;

        //echo(substr($dailyHistory['date'][$i], 6, 2)).'<br>' ;
        if ($weeklyData['het'][$weekCount] != $actualWeekNr) {
            $weekCount++;
            $weeklyData['het'][$weekCount] = $actualWeekNr;

            // refBalance számítás
            if ($weekCount == 1) {
                $weeklyData['refBalance'][$weekCount] = $dailyHistory['balance'][$i + 30];
            } else {
                $weeklyData['refBalance'][$weekCount] = $dailyHistory['balance'][$i];
            }

            $prevProfit += $hetiProfit;
            $prevManual += $hetiManual;

            $prevRobot += $hetiRobot;
            $hetiProfit = $dailyHistory['hozam'][$i] - $prevProfit;
            $hetiManual = $dailyHistory['manual'][$i] - $prevManual;
            $hetiRobot = $dailyHistory['robot'][$i] - $prevRobot;
            $weeklyData['profit'][$weekCount] = $hetiProfit;
            $weeklyData['manualProfit'][$weekCount] = $hetiManual;
            $weeklyData['robotProfit'][$weekCount] = $hetiRobot;
        } else {
            $hetiProfit = $dailyHistory['hozam'][$i] - $prevProfit;
            $hetiManual = $dailyHistory['manual'][$i] - $prevManual;
            $hetiRobot = $dailyHistory['robot'][$i] - $prevRobot;
            $weeklyData['profit'][$weekCount] = $hetiProfit;
            $weeklyData['manualProfit'][$weekCount] = $hetiManual;
            $weeklyData['robotProfit'][$weekCount] = $hetiRobot;
        }
    }
}

