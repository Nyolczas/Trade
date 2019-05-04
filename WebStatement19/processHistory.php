<?php
$dayArr = [];
$historyArray = [];

//napi adatok a balance charthoz
$fullDepo = [];
$balance = [];
$manual = [];
$robot = [];
$fee = [];
$dividend = [];
//-------------------------------------------------------------------------------------
// adatok feltöltése a balance charthoz
function processBalanceChart()
{
    global $fullDepo;
    global $balance;
    global $manual;
    global $robot;
    global $fee;
    global $dividend;

    $tempDepo = 0;
    $tempBalance = 0;
    $tempManual = 0;
    $tempRobot = 0;
    $tempFee = 0;
    $tempDiv = 0;

    global $dayArr;
    global $historyArray;

    $histCnt = 0;
    $histDay = substr($historyArray[1][8], 0, 10);
    $first = true;

    for ($day = 0; $day < count($dayArr); $day++) {
        global $tempDepo;
        global $tempBalance;
        global $tempManual;
        global $tempRobot;
        global $tempFee;
        global $tempDiv;

        if (substr($historyArray[$histCnt][8], 0, 10) > $dayArr[$day]) {
            if ($first) {
                array_push($fullDepo, 0);
                array_push($balance, 0);
                array_push($manual, 0);
                array_push($robot, 0);
                array_push($fee, 0);
                array_push($dividend, 0);

                $first = false;
            } else {
                while (substr($historyArray[$histCnt][8], 0, 10) != $dayArr[$day]) {
                    array_push($fullDepo, $tempDepo);
                    array_push($balance, $tempBalance);
                    array_push($manual, $tempManual);
                    array_push($robot, $tempRobot);
                    array_push($fee, $tempFee);
                    array_push($dividend, $tempDiv);
                    $histCnt++;
                }
                $profit = $historyArray[$histCnt][10] + $historyArray[$histCnt][11] + $historyArray[$histCnt][12];
                $tempBalance += $profit;
                if ($historyArray[$histCnt][0] == "Depo") {
                    $tempDepo += $profit;
                } elseif ($historyArray[$histCnt][0] == "Fee") {
                    $tempFee += $profit;
                } elseif ($historyArray[$histCnt][0] == "Adj") {
                    $tempDiv += $profit;
                } elseif ($historyArray[$histCnt][0] == "manual") {
                    $tempManual += $profit;
                } else {
                    $tempRobot += $profit;
                }
                $histCnt++;
            }
        } else {
            while (substr($historyArray[$histCnt][8], 0, 10) < $dayArr[$day + 1]) {
                $profit = $historyArray[$histCnt][10] + $historyArray[$histCnt][11] + $historyArray[$histCnt][12];
                $balance[$histCnt] = $balance[$histCnt - 1] + $profit;
                if ($historyArray[$histCnt][0] == "Depo") {
                    $fullDepo[$histCnt] = $fullDepo[$histCnt - 1] + $profit;
                } elseif ($historyArray[$histCnt][0] == "Fee") {
                    $fee[$histCnt] = $fee[$histCnt - 1] + $profit;
                } elseif ($historyArray[$histCnt][0] == "Adj") {
                    $dividend[$histCnt] = $dividend[$histCnt - 1] + $profit;
                } elseif ($historyArray[$histCnt][0] == "manual") {
                    $manual[$histCnt] = $manual[$histCnt - 1] + $profit;
                } else {
                    $robot[$histCnt] = $robot[$histCnt - 1] + $profit;
                }
                $histCnt++;
            }
        }
    }
}
//-------------------------------------------------------------------------------------
// napi vizsgálat idő intervallumának betöltése a dayArr tömbbe
function dayRange($startDateString)
{
    global $dayArr;
    // kezdő dátum
    $startDate = date_create($startDateString);
    date_add($startDate, date_interval_create_from_date_string("-1 days"));
    // befejező dátum
    $now = date_create(date("Y-m-d", time()));
    date_add($now, date_interval_create_from_date_string("5 days"));
    // tömb feltöltése
    while ($startDate != $now) {
        array_push($dayArr, date_format($startDate, "Y-m-d"));
        date_add($startDate, date_interval_create_from_date_string("1 days"));
    }
    //var_dump($dayArr);
}
//-------------------------------------------------------------------------------------
// mt4 jelentés betöltése a historyArray tömbbe
function processHistory($file)
{
    global $historyArray;
    $first = true;
    if (($handle = fopen($file, 'r')) !== false) { // Check the resource is valid

        while (($data = fgetcsv($handle, 1000, ";")) !== false) { // Check opening the file is OK!

            if ($first) {
                $first = false;
            } else {
                $row = [];
                foreach ($data as $value) {
                    array_push($row, $value);
                }
                array_push($historyArray, $row);
            }
        }
        fclose($handle);
    }

    //var_dump($historyArray);
}

processHistory('mt4data/FullHistory_27019217.csv');
//echo substr($historyArray[1][1],0,10);
dayRange(substr($historyArray[1][1], 0, 10));
processBalanceChart();
