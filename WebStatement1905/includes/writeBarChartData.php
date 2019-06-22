<?php
function writeBarChartData($data, $filename, $periodKey)
{
    
    $tempTxt = "'Hónap, Profit, Manuál, Robot, Átlag profit, Átlag Manuál, Átlag Robot"."\n";
    for ($i = 1; $i < count($data[$periodKey]); $i++) {
        $tempTxt = $tempTxt . $data[$periodKey][$i] . ","
            . $data['profit'][$i] . ","
            . $data['manualProfit'][$i] . ","
            . $data['robotProfit'][$i] . ","
            . $data['atlagProfit'][$i] . ","
            . $data['atlagManual'][$i] . ","
            . $data['atlagRobot'][$i] ."\n";
    }

    $handle = fopen($filename, 'w');

    fwrite($handle, $tempTxt);
    rewind($handle);
    echo fread($handle, filesize($filename));
    fclose($handle);
}