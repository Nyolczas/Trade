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
        $lastData = count($monthlyData['atlagProfit'])-1;
        flipCard("Havi átlag",
        $monthlyData['atlagProfit'][$lastData], $monthlyData['atlagProfitPerc'][$lastData],
        $monthlyData['atlagManual'][$lastData], $monthlyData['atlagManualPerc'][$lastData],
        $monthlyData['atlagRobot'][$lastData], $monthlyData['atlagRobotPerc'][$lastData],
        monthNames(substr($dayFilteredHistory[$lastFilterData]['date'], 5, 2),false),
        $monthlyData['profit'][$lastData], $monthlyData['profitPercent'][$lastData],
        $monthlyData['manualProfit'][$lastData], $monthlyData['manualPercent'][$lastData],
        $monthlyData['robotProfit'][$lastData], $monthlyData['robotPercent'][$lastData]);
        ?>
</body>

</html>