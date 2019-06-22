google.charts.setOnLoadCallback(drawChart);

//balance chart colors
var balanceChartColors = [];

$.getJSON('data/balanceChartColors.json', function(data) {
    $.each(data.colors, function(i, c) {
        balanceChartColors.push(c.color);
    });
});

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
            colors: balanceChartColors
        };

        var chart = new google.visualization.ComboChart(document.getElementById('balance-chart'));
        chart.draw(data, options);
    });
}