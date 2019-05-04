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

    global $dayArr;
    global $historyArray;

    foreach ($dayArr as $day) {
        $histCnt = 0;
        // if($day == substr($historyArray[cnt][8], 0, 10)){

        // }
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

    var_dump($historyArray);
}

dayRange("2019-03-05");
processHistory('mt4data/FullHistory_27019217.csv');
