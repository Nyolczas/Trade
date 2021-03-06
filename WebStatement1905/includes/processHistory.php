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

require 'monthNames.php';
require 'weekdayNames.php';

require 'writeBalanceChartData.php';
require 'writeBarChartData.php';

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
$startDay='2019-03-25';
//readMt4Data("mt4data/FullHistory_23129454.csv"); // admiral demo
readMt4Data("mt4data/FullHistory_27019217.csv"); // admiral live
//readMt4Data("mt4data/FullHistory_9107935.csv"); // xm demo
//readMt4Data("mt4data/FullHistory_19061180.csv"); // xm live

// napi vizsgálat idő intervallumának betöltése a dayArr tömbbe
dayRange(substr($historyArray[1][1], 0, 10));

// adatok napi szűrése a balance charthoz
filterHistoryForDay();

// napra szűrt adatok kiegészítése a teljes range-ben szereplő napokra és tömbösítése
dailyHistoryAggregator();

// havi adatok számolása ($monthlyData) a napi adatokból ($dailyHistory) csak a havi profitok
monthlyHistoryAggregator();

// havi átlagok számítása (? havi átlagot) // és százalékok számítása
monthlyAverages(12);

// heti adatok számolása ($weeklyData) a napi adatokból ($dailyHistory) csak a heti profitok
weeklyHistoryAggregator();

// heti átlagok számítása (? heti átlagot)
weeklyAverages(12);

// Chartok adatainak csv-be írása
writeBalanceChartData();
writeBarChartData($monthlyData, 'csv/monthlyChartData.csv', 'honap', 12);
writeBarChartData($weeklyData, 'csv/weeklyChartData.csv', 'het', 12);

//print_r($monthlyData);
