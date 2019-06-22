google.charts.setOnLoadCallback(drawWeeklyChart);
    
        function drawWeeklyChart() {
            // grab the CSV
            $.get("csv/weeklyChartData.csv", function (csvString) {
                // transform the CSV string into a 2-dimensional array
                var arrayData = $.csv.toArrays(csvString, {
                    onParseValue: $.csv.hooks.castToScalar
                });

                var data = new google.visualization.arrayToDataTable(arrayData);

                // this view can select a subset of the data at a time
                var view = new google.visualization.DataView(data);
                view.setColumns([0, 1]);

                var options = {
                    seriesType: 'bars',
                    series: {
                        3: {
                            type: 'line'
                        },
                        4: {
                            type: 'line'
                        },
                        5: {
                            type: 'line'
                        },
                    },
                    
                    colors: ['#a5c9a5', '#d8bac0', '#b0b9d4','forestGreen', 'crimson', 'royalBlue']
                };

                var chart = new google.visualization.ComboChart(document.getElementById('weekly-chart'));
                chart.draw(data, options);
            });
        }