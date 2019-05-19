<?php
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