<?php
function writeMonthlyChartData()
{
    global $monthlyData;
    
    $tempTxt = "'Hónap, Profit, Manuál, Robot, Átlag profit, Átlag Manuál, Átlag Robot"."\n";
    for ($i = 1; $i < count($monthlyData['honap']); $i++) {
        $tempTxt = $tempTxt . $monthlyData['honap'][$i] . ","
            . $monthlyData['profit'][$i] . ","
            . $monthlyData['manualProfit'][$i] . ","
            . $monthlyData['robotProfit'][$i] . ","
            . $monthlyData['atlagProfit'][$i] . ","
            . $monthlyData['atlagManual'][$i] . ","
            . $monthlyData['atlagRobot'][$i] ."\n";
    }

    $handle = fopen('csv/monthlyChartData.csv', 'w');

    fwrite($handle, $tempTxt);
    rewind($handle);
    echo fread($handle, filesize('csv/monthlyChartData.csv'));
    fclose($handle);
}