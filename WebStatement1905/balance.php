<?php

    
    include 'includes/processHistory.php';
    include 'includes/cardCreator.php';
    
    ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Balance</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- balance chart -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/1.0.3/jquery.csv.min.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
    </script>
    <script src="js/drawBalanceChart.js"></script>
    <script src="js/drawMonthlyChart.js"></script>
    <script src="js/drawWeeklyChart.js"></script>
</head>

<body>
    <div class="chart-wrapper">
        <div id="balance-chart" class="chart"></div>
    </div>
    
        <div class="single-card">
            <h2 class="card-name text-secondary text-center">Mindeddig</h2>
            <?php 
            $lastFilterData = count($dayFilteredHistory)-1;
            singleCardRow("Full Depó", $dayFilteredHistory[$lastFilterData]['fullDepo'],true); 
            singleCardRow("Tőke", $dayFilteredHistory[$lastFilterData]['balance'],true); 
            singleCardRow("Össz Költség", $dayFilteredHistory[$lastFilterData]['fee']); 
            singleCardRow("Össz Hozam", $dayFilteredHistory[$lastFilterData]['hozam']); 
            singleCardRow("Manuál Hozam", $dayFilteredHistory[$lastFilterData]['manual']); 
            singleCardRow("Robot Hozam", $dayFilteredHistory[$lastFilterData]['robot']); 
            singleCardRow("Osztalék Hozam", $dayFilteredHistory[$lastFilterData]['dividend']); 
            ?>
        </div>
        <div class="stat-cards">
        <?php 
        //<!-- Havi card -->
        $lastMonthlyData = count($monthlyData['atlagProfit'])-1;

        flipCard("Havi átlag",
        $monthlyData['atlagProfit'][$lastMonthlyData], $monthlyData['atlagProfitPerc'][$lastMonthlyData],
        $monthlyData['atlagManual'][$lastMonthlyData], $monthlyData['atlagManualPerc'][$lastMonthlyData],
        $monthlyData['atlagRobot'][$lastMonthlyData], $monthlyData['atlagRobotPerc'][$lastMonthlyData],
        monthNames(substr($dayFilteredHistory[$lastFilterData]['date'], 5, 2),false),
        $monthlyData['profit'][$lastMonthlyData], $monthlyData['profitPercent'][$lastMonthlyData],
        $monthlyData['manualProfit'][$lastMonthlyData], $monthlyData['manualPercent'][$lastMonthlyData],
        $monthlyData['robotProfit'][$lastMonthlyData], $monthlyData['robotPercent'][$lastMonthlyData]);

        //<!-- Heti card -->
        $lastData = date('W') - 12;

        flipCard("Heti átlag",
        $weeklyData['atlagProfit'][$lastData], $weeklyData['atlagProfitPerc'][$lastData],
        $weeklyData['atlagManual'][$lastData], $weeklyData['atlagManualPerc'][$lastData],
        $weeklyData['atlagRobot'][$lastData], $weeklyData['atlagRobotPerc'][$lastData],
        $weeklyData['het'][$lastData].". hét",
        $weeklyData['profit'][$lastData], $weeklyData['profitPercent'][$lastData],
        $weeklyData['manualProfit'][$lastData], $weeklyData['manualPercent'][$lastData],
        $weeklyData['robotProfit'][$lastData], $weeklyData['robotPercent'][$lastData]);
        
        //<!-- Napi card -->
        $days = count($dailyHistory['date'])-5;
        $lastData = $days;
        $lastDay = str_replace(".","-",$dailyHistory['date'][$lastData]);
        $maiProfit = $dailyHistory['hozam'][$lastData] - $dailyHistory['hozam'][$lastData-1];
        $maiManualProfit = $dailyHistory['manual'][$lastData] - $dailyHistory['manual'][$lastData-1];
        $maiRobotProfit = $dailyHistory['robot'][$lastData] - $dailyHistory['robot'][$lastData-1];

        flipCard("Napi átlag",
        $monthlyData['atlagProfit'][$lastMonthlyData] / $days, $monthlyData['atlagProfitPerc'][$lastMonthlyData] / $days,
        $monthlyData['atlagManual'][$lastMonthlyData] / $days, $monthlyData['atlagManualPerc'][$lastMonthlyData] / $days,
        $monthlyData['atlagRobot'][$lastMonthlyData] / $days, $monthlyData['atlagRobotPerc'][$lastMonthlyData] / $days,
        weekdayNames(formatMyStringDate($lastDay, "l")),//$lastDay, //date("l"),
        $maiProfit, $maiProfit / ($dailyHistory['balance'][$lastData - 1] / 100),
        $maiManualProfit, $maiManualProfit / ($dailyHistory['balance'][$lastData - 1] / 100),
        $maiRobotProfit, $maiRobotProfit / ($dailyHistory['balance'][$lastData - 1] / 100)) ;
        ?>
        </div>
        <div class="chart-wrapper">
            <div class="jumbotron">
                <div class="container text-center">
                    <h2 >Havi eredmények</h2>
                </div>
            </div>
            <div id="monthly-chart" class="chart"></div>
        </div>

        <div class="chart-wrapper">
            <div class="jumbotron">
                <div class="container text-center">
                    <h2 >Heti eredmények</h2>
                </div>
            </div>
            <div id="weekly-chart" class="chart"></div>
        </div>
</body>

</html>