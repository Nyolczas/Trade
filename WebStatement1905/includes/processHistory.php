<?php
require 'readMt4Data.php';
require 'dayRange.php';
require 'filterHistoryForDay.php';
require 'dailyHistoryAggregator.php';
require 'writeBalanceChartData.php';
require 'monthNames.php';

$dayArr = [];
$monthArr = [];
$historyArray = [];
$monthlyData = ["honap" => [], "profit" => [], "manualProfit" => [], "robotProfit" => []];

//napi adatok a balance charthoz
$dayFilteredHistory = [];
$dailyHistory = [];

// csv adat beolvasása a $historyArray tömbbe
readMt4Data('mt4data/FullHistory_27019217.csv');
// napi vizsgálat idő intervallumának betöltése a dayArr tömbbe
dayRange(substr($historyArray[1][1], 0, 10));
// adatok napi szűrése a balance charthoz
filterHistoryForDay();
// napra szűrt adatok kiegészítése a teljes range-ben szereplő napokra
dailyHistoryAggregator();

// BalanceChart adatainak csv-be írása
writeBalanceChartData();
//print_r($dayFilteredHistory);

