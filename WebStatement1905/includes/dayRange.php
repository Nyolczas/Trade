<?php
// napi vizsgálat idő intervallumának betöltése a dayArr tömbbe
function dayRange($startDateString)
{
    global $dayArr;
    global $monthArr;
    global $monthlyData;

    // kezdő dátum
    $startDate = date_create($startDateString);
    date_add($startDate, date_interval_create_from_date_string("-1 days"));
    // //első hónap
    // array_push($monthArr, intval(date_format($startDate, "m")));
    // array_push($monthlyData['honap'], substr(intval(date_format($startDate, "Y")), -2) . " "
    //     . monthNames(intval(date_format($startDate, "m"))));
    // $monthCnt = 0;
    // befejező dátum
    $now = date_create(date("Y-m-d", time()));
    date_add($now, date_interval_create_from_date_string("5 days"));
    // tömb feltöltése
    while ($startDate != $now) {
        array_push($dayArr, date_format($startDate, "Y-m-d"));
        //$tempMonth = intval(date_format($startDate, "m"));

        // if ($tempMonth != $monthArr[$monthCnt]) {
        //     array_push($monthArr, $tempMonth);
        //     array_push($monthlyData['honap'], substr(intval(date_format($startDate, "Y")), -2) . " "
        //         . monthNames(intval(date_format($startDate, "m"))));
        //     $monthCnt++;
        // }
        date_add($startDate, date_interval_create_from_date_string("1 days"));
    }
}
