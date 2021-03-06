<?php

// --- robot stratégiák kiszedése
$a = ['classic', 'tsq', 'zoom', 'classic', 'tsq', 'tsq', 'zoom', 'msr', 'msr'];

$res = array_unique($a);
sort($res);

//print_r($res);

// --- hónapok listázása
$startDate = date_create('2019-03-25');

$month = intval(date_format($startDate, "m"));

//var_dump($month);

// --- hónapok multidimenziós tömbbé alakítása

$months = [1, 2, 3, 4, 5, 6, 7, 8];
$newArr = [];

foreach($months as $m) {
    $dummyArr = ["honap" => monthNames($m), "profit" => 0, "manualProfit" => 0, "robotProfit" => 0];
    array_push($newArr, $dummyArr);
}

print_r($newArr);

function monthNames($mn){
    switch($mn){
        case 1:
        return "jan";
        break;
    }
    switch($mn){
        case 2:
        return "febr";
        break;
    }
    switch($mn){
        case 3:
        return "márc";
        break;
    }
    switch($mn){
        case 4:
        return "ápr";
        break;
    }
    switch($mn){
        case 5:
        return "máj";
        break;
    }
    switch($mn){
        case 6:
        return "júni";
        break;
    }
    switch($mn){
        case 7:
        return "júli";
        break;
    }
    switch($mn){
        case 8:
        return "aug";
        break;
    }
    switch($mn){
        case 9:
        return "szept";
        break;
    }
    switch($mn){
        case 10:
        return "okt";
        break;
    }
    switch($mn){
        case 11:
        return "nov";
        break;
    }
    switch($mn){
        case 12:
        return "dec";
        break;
    }
}