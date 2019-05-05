<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <title>Balance</title>
</head>

<body>
    <div class="container">
        <canvas id="balance"></canvas>
        <form action="balance.php" method="get">
            Start Day: <input type="date" name="sday">
            <input type="submit">
        </form>
        <canvas id="monthly"></canvas>
        
        <?php
        
        if (isset($_GET['sday'])) {
            $startDay = $_GET['sday'];
        }else {
            $startDay='2019-03-25';
        }

        //echo ($startDay);
            include 'processHistory.php';
            extract($dailyHistory);
            //echo implode( ", ", $date );
        ?>
    </div>

    <script>
        let balanceChart = document.getElementById('balance').getContext('2d');
        
        let chart = new Chart(balanceChart, {
            type: 'line',
            data: {
                labels: [ <?php echo implode(", ", $date); ?> ],
                datasets: [{
                    label: 'balance',
                    data: [ <?php echo implode(", ", $balance); ?> ],
                    backgroundColor: 'rgba(128,128,128,0.3)'
                }, {
                    label: 'fulldepó',
                    data: [ <?php echo implode(", ", $fullDepo); ?> ],
                    backgroundColor: 'rgba(128,128,128,0)',
                    borderColor: 'rgb(0,10,40)',
                    borderWidth: '2',
                    bezierCurve : false
                }, {
                    label: 'manual',
                    data: [ <?php echo implode(", ", $manual); ?> ],
                    backgroundColor: 'rgba(128,128,128,0)',
                    borderColor: 'rgb(237,28,36)',
                    borderWidth: '2'
                }, {
                    label: 'robot',
                    data: [ <?php echo implode(", ", $robot); ?> ],
                    backgroundColor: 'rgba(128,128,128,0)',
                    borderColor: 'rgb(0,139,206)',
                    borderWidth: '2'
                }, {
                    label: 'osztalék',
                    data: [ <?php echo implode(", ", $dividend); ?> ],
                    backgroundColor: 'rgba(128,128,128,0)',
                    borderColor: 'rgb(208,105,169)',
                    borderWidth: '2'
                }]
            },
            options: {
                elements: {
                    line: {
                        tension: 0 // disables bezier curves
                    }
                },
                title: {
                    display: true,
                    text: 'Admiral 27019217 Egyenleg',
                    fontSize: 18
                },
                legend: {
                    position: 'right'
                },
                
            }
        })
    </script>
</body>

</html>