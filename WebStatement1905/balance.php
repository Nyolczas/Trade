<?php
    if (isset($_GET['sday'])) {
        $startDay = $_GET['sday'];
    }else {
        $startDay='2019-03-25';
    }
    
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
    <link rel="stylesheet" href="css/style.css">

    <!-- balance chart -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/1.0.3/jquery.csv.min.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
             // grab the CSV
             $.get("csv/balanceChartData.csv", function (csvString) {
                // transform the CSV string into a 2-dimensional array
                var arrayData = $.csv.toArrays(csvString, {
                    onParseValue: $.csv.hooks.castToScalar
                });

            var data = new google.visualization.arrayToDataTable(arrayData);

            // this view can select a subset of the data at a time
            var view = new google.visualization.DataView(data);
                view.setColumns([0, 1]);

            var options = {
                seriesType: 'line',
                series: {
                    0: {
                        type: 'area'
                    },
                    1: {
                        type: 'area'
                    },
                },
                colors: ['grey', 'forestGreen', 'black', 'crimson', 'royalBlue', 'rgb(80,40,0)', 'purple']
            };

            var chart = new google.visualization.ComboChart(document.getElementById('balance-chart'));
            chart.draw(data, options);
        });
        }
    </script>
</head>

<body>
    <div class="chart-wrapper">
        <div id="balance-chart"></div>
    </div>
    <div class="stat-cards">
        <div class="single-card">
            <h2 class="card-name">Mindeddig</h2>
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
        $lastData = count($weeklyData['atlagProfit'])-1;

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
        $lastData = $days-1;
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
</body>

</html>