<?php
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
}
