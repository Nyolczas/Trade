<?php
$dayArr = [];
$historyArray = [];

//napi adatok a balance charthoz
$dayFilteredHistory = [];
$dailyHistory = [];
//-------------------------------------------------------------------------------------
// napra szűrt adatok kiegészítése a teljes range-ben szereplő napokra
function dailyHistoryAggregator()
{
    global $dayArr;
    global $dayFilteredHistory;
    global $dailyHistory;
    global $startDay;

    $filterCnt = 0;
    $dCnt = 0;
    for ($i = 0; $i < count($dayArr); $i++) {
        
        if ($dayFilteredHistory[$filterCnt + 1]['date'] == $dayArr[$i]) {
            if($filterCnt >= count($dayFilteredHistory)){
                // vége az adatnak.
            } else {
                $filterCnt++;
            }
        }
        if(date_create($dayArr[$i]) >= date_create($startDay)) {
            $dailyHistory['date'][$dCnt] = '"'.str_replace("-",".",$dayArr[$i]).'"';
            $dailyHistory['fullDepo'][$dCnt] = $dayFilteredHistory[$filterCnt]['fullDepo'];
            $dailyHistory['fee'][$dCnt] = $dayFilteredHistory[$filterCnt]['fee'];
            $dailyHistory['dividend'][$dCnt] = $dayFilteredHistory[$filterCnt]['dividend'];
            $dailyHistory['balance'][$dCnt] = $dayFilteredHistory[$filterCnt]['balance'];
            $dailyHistory['manual'][$dCnt] = $dayFilteredHistory[$filterCnt]['manual'];
            $dailyHistory['robot'][$dCnt] = $dayFilteredHistory[$filterCnt]['robot'];
            $dailyHistory['hozam'][$dCnt] = $dayFilteredHistory[$filterCnt]['hozam'];
            $dCnt++;
        }
    }
}
//-------------------------------------------------------------------------------------
// adatok napi szűrése a balance charthoz
function filterHistoryForDay()
{
    global $historyArray;
    global $dayFilteredHistory; //0:dátum, 1:fullDepo, 2:fee, 3:dividend, 4:balance, 5:manual, 6:robot
    $tempRow = [];
    $tempRow['date'] = substr($historyArray[0][8], 0, 10);
    $tempRow['fullDepo'] = $historyArray[0][12];
    $tempRow['fee'] = 0;
    $tempRow['dividend'] = 0;
    $tempRow['balance'] = $historyArray[0][12];
    $tempRow['manual'] = 0;
    $tempRow['robot'] = 0;
    $tempRow['hozam'] = 0;

    for ($i = 1; $i < count($historyArray); $i++) {
        $tempDate = date_create(substr($tempRow['date'], 0, 10));
        $histDate = date_create(substr($historyArray[$i][8], 0, 10));

        if ($histDate > $tempDate) {
            array_push($dayFilteredHistory, $tempRow);
            // tempRow frissítés
            $tempRow['date'] = substr($historyArray[$i][8], 0, 10);
            $profit = $historyArray[$i][10] + $historyArray[$i][11] + $historyArray[$i][12];
            $tempRow['balance'] += $profit;
            if ($historyArray[$i][0] == "Depo") {
                $tempRow['fullDepo'] += $profit;
            } elseif ($historyArray[$i][0] == "Fee") {
                $tempRow['fee'] += $profit;
            } elseif ($historyArray[$i][0] == "Adj") {
                $tempRow["dividend"] += $profit;
            } elseif ($historyArray[$i][0] == "manual") {
                $tempRow['manual'] += $profit;
            } else {
                $tempRow['robot'] += $profit;
            }
            $tempRow['hozam'] = $tempRow['fee'] + $tempRow["dividend"] + $tempRow['manual'] + $tempRow['robot'];
        } else {
            // tempRow frissítés
            $profit = $historyArray[$i][10] + $historyArray[$i][11] + $historyArray[$i][12];
            $tempRow['balance'] += $profit;
            if ($historyArray[$i][0] == "Depo") {
                $tempRow['fullDepo'] += $profit;
            } elseif ($historyArray[$i][0] == "Fee") {
                $tempRow['fee'] += $profit;
            } elseif ($historyArray[$i][0] == "Adj") {
                $tempRow["dividend"] += $profit;
            } elseif ($historyArray[$i][0] == "manual") {
                $tempRow['manual'] += $profit;
            } else {
                $tempRow['robot'] += $profit;
            }
            $tempRow['hozam'] = $tempRow['fee'] + $tempRow["dividend"] + $tempRow['manual'] + $tempRow['robot'];
        }

    }
    array_push($dayFilteredHistory, $tempRow);
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
filterHistoryForDay();
dailyHistoryAggregator();
// print_r($dayArr[0]);
//print_r($dailyHistory);
