<?php
function writeBalanceChartData()
{
    global $dailyHistory;
    //print_r(count($dailyHistory));
    
    $tempTxt = "'Dátum, Balance, hozam, full depó, manuál, robot, költség, osztalék"."\n";
    for ($i = 0; $i < count($dailyHistory['balance']); $i++) {
        $tempTxt = $tempTxt . $dailyHistory['date'][$i] . ","
            . $dailyHistory['balance'][$i] . ","
            . $dailyHistory['hozam'][$i] . ","
            . $dailyHistory['fullDepo'][$i] . ","
            . $dailyHistory['manual'][$i] . ","
            . $dailyHistory['robot'][$i] . ","
            . $dailyHistory['fee'][$i] . ","
            . $dailyHistory['dividend'][$i] . "\n";
    }

    $handle = fopen('csv/balanceChartData.csv', 'w');

    fwrite($handle, $tempTxt);
    rewind($handle);
    echo fread($handle, filesize('csv/balanceChartData.csv'));
    fclose($handle);
}