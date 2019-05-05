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
            include 'includes/processHistory.php';
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
                    label: 'hozam',
                    data: [ <?php echo implode(", ", $hozam); ?> ],
                    backgroundColor: 'rgba(30,90,0,0.3)',
                    borderColor: 'rgb(30,90,0)',
                    borderWidth: '2' 
                }, {
                    label: 'költség',
                    data: [ <?php echo implode(", ", $fee); ?> ],
                    backgroundColor: 'rgba(128,128,128,0)',
                    borderColor: 'rgb(80,40,0)',
                    borderWidth: '2'
                }, {
                    label: 'fulldepó',
                    data: [ <?php echo implode(", ", $fullDepo); ?> ],
                    backgroundColor: 'rgba(128,128,128,0)',
                    borderColor: 'rgb(0,0,0)',
                    borderWidth: '1'
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
                    },
                    point:{
                        radius: 2
                    }
                },
                title: {
                    display: true,
                    text: 'Admiral 27019217 Egyenleg',
                    fontSize: 18
                },
                legend: {
                    position: 'right',
                    display: false
                },
                tooltips: {
                    
                    callbacks: {
                label: function(tooltipItem, data) {
                    var label = data.datasets[tooltipItem.datasetIndex].label || '';

                    if (label) {
                        label += ': ';
                    }
                    label += thousands_separators(Math.round(tooltipItem.yLabel));
                    return label;
                }
            }
                   
                },
                scales: {
                        yAxes: [{
                            ticks: {
                                // thousand Separator
                                callback: function(value, index, values) {
                                    return  thousands_separators(value);
                                }
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                fontSize: 8
                            }
                        }]
                    }
                }
           
        })

        let monthlyChart = document.getElementById('monthly').getContext('2d');

        let barChart = new Chart(monthlyChart, {
            type: 'bar',
            data: {
                labels: ['március', 'április', 'május' ],
                datasets: [
                    {
                        label: 'profit',
                        backgroundColor: 'rgba(30,90,0,0.3)',
                        data: [-25000, 46800, 262000]
                    },
                    {
                        label: 'manuál profit',
                        backgroundColor: 'rgba(237,28,36,0.3)',
                        data: [-25000, 48000, 250000]
                    },
                    {
                        label: 'robot profit',
                        backgroundColor: 'rgba(0,139,206,0.3)',
                        data: [0, -1200, 12000]
                    }
                ]
            },
            options: {

            }
        })

        function thousands_separators(num)
            {
                var num_parts = num.toString().split(".");
                num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, " ");
                return num_parts.join(".");
            }
    </script>
</body>

</html>