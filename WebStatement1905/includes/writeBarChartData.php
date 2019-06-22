<?php
function writeBarChartData($data, $filename, $periodKey, $maxBar)
{
    $dataLength = count($data[$periodKey]);
    if ($dataLength > $maxBar) {
        $startBar = $dataLength - $maxBar;
    } else {
        $startBar = 1;
    }

    $tempTxt = "'Hónap, Profit, Manuál, Robot, Átlag profit, Átlag Manuál, Átlag Robot" . "\n";

    for ($i = $startBar; $i < $dataLength; $i++) {
        $tempTxt = $tempTxt . $data[$periodKey][$i] . ","
            . $data['profit'][$i] . ","
            . $data['manualProfit'][$i] . ","
            . $data['robotProfit'][$i] . ","
            . $data['atlagProfit'][$i] . ","
            . $data['atlagManual'][$i] . ","
            . $data['atlagRobot'][$i] . "\n";
    }

    $handle = fopen($filename, 'w');

    fwrite($handle, $tempTxt);
    rewind($handle);
    echo fread($handle, filesize($filename));
    fclose($handle);
}
