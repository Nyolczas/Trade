<?php
require 'readMt4Data.php';
require 'formatMyStringDate.php';
require 'dayRange.php';
require 'filterHistoryForDay.php';
require 'dailyHistoryAggregator.php';
require 'monthlyHistoryAggregator.php';
require 'monthlyAverages.php';
require 'weeklyHistoryAggregator.php';
require 'weeklyAverages.php';
require 'writeBalanceChartData.php';
require 'monthNames.php';
require 'weekdayNames.php';

$dayArr = [];
$monthArr = [];
$historyArray = [];
$monthlyData = ["honap" => [], 
"profit" => [], "manualProfit" => [], "robotProfit" => [], 
"atlagProfit" => [], "atlagManual" => [], "atlagRobot" => [],
"refBalance" => [], // viszonyítási alap a százalékos profitok számításához
"profitPercent" => [], "manualPercent" => [], "robotPercent" => [],
"atlagProfitPerc" => [], "atlagManualPerc" => [], "atlagRobotPerc" =>[]];

$weeklyData = ["het" => [], 
"profit" => [], "manualProfit" => [], "robotProfit" => [], 
"atlagProfit" => [], "atlagManual" => [], "atlagRobot" => [],
"refBalance" => [], // viszonyítási alap a százalékos profitok számításához
"profitPercent" => [], "manualPercent" => [], "robotPercent" => [],
"atlagProfitPerc" => [], "atlagManualPerc" => [], "atlagRobotPerc" =>[]];

//napi adatok a balance charthoz
$dayFilteredHistory = []; //egy bejegyzés a nap végi értékekkel, ha van (lyukacsos)
$dailyHistory = []; //szétterítve a teljes időszakra

// csv adat beolvasása a $historyArray tömbbe
readMt4Data('mt4data/FullHistory_27019217.csv');

// napi vizsgálat idő intervallumának betöltése a dayArr tömbbe
dayRange(substr($historyArray[1][1], 0, 10));

// adatok napi szűrése a balance charthoz
filterHistoryForDay();

// napra szűrt adatok kiegészítése a teljes range-ben szereplő napokra és tömbösítése
dailyHistoryAggregator();

// havi adatok számolása ($monthlyData) a napi adatokból ($dailyHistory) csak a havi profitok
monthlyHistoryAggregator();

// havi átlagok számítása (? havi átlagot)
monthlyAverages(12);

// heti adatok számolása ($weeklyData) a napi adatokból ($dailyHistory) csak a heti profitok
weeklyHistoryAggregator();

// heti átlagok számítása (? heti átlagot)
weeklyAverages(12);

// BalanceChart adatainak csv-be írása
writeBalanceChartData();

print_r($dailyHistory);
