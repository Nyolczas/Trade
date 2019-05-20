<?php
require 'readMt4Data.php';
require 'dayRange.php';
require 'filterHistoryForDay.php';
require 'dailyHistoryAggregator.php';
require 'monthlyHistoryAggregator.php';
require 'writeBalanceChartData.php';
require 'monthNames.php';

$dayArr = [];
$monthArr = [];
$historyArray = [];
$monthlyData = ["honap" => [], "profit" => [], "manualProfit" => [], "robotProfit" => [], "atlagProfit" => [], "atlagManual" => [], "atlagRobot" => []];

//napi adatok a balance charthoz
$dayFilteredHistory = []; //egy bejegyzés a nap végi értékekkel, ha van (lyukacsos)
$dailyHistory = []; //szétterítve a teljes időszakra

// csv adat beolvasása a $historyArray tömbbe
readMt4Data('mt4data/FullHistory_27019217.csv');

// napi vizsgálat idő intervallumának betöltése a dayArr és a monthlyData tömbbe
dayRange(substr($historyArray[1][1], 0, 10));

// adatok napi szűrése a balance charthoz
filterHistoryForDay();

// napra szűrt adatok kiegészítése a teljes range-ben szereplő napokra és tömbösítése hónapokra
dailyHistoryAggregator();

// havi adatok számolása ($monthlyData) a napi adatokból ($dailyHistory)
monthlyHistoryAggregator();

// BalanceChart adatainak csv-be írása
writeBalanceChartData();

print_r($monthlyData);

