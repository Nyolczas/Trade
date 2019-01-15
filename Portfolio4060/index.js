google.charts.load('current', {
    'packages': ['corechart']
});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Dátum', 'kp HUF', 'kp €', 'kp $', 'ETFBUXOTP', 'DAXEX', 'iShrUSTBond20', 'iShrUSTBond7-10', 'NDEX', 'EBRCHTL05', 'SXR8'],
        ['2018.12.31', 4570, 4317, 1118, 305350, 285850, 80747, 764758, 287680, 41376, 275440],
        ['2019.01.31', 13354, 4317, 1634, 316775, 300300, 78077, 752063, 288000, 48456, 284400]

    ]);

    var options = {
        title: 'Részletes Portfólió Összetétel',
        //hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
        //vAxis: {minValue: 0},
        isStacked: true,
        //height: 300,
        legend: {
            position: 'top',
            maxLines: 3
        }
    };

    var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}
var date = ['2018.12.31', '2019.01.31'];
var kp = {
    Huf: [],
    Eur: [],
    Usd: [],
    Sum: []
}
var portfolio = [
    {name: 'ETFBUXOTP', value: [305350, 316775]},
    {name:'', value:[]}
];

//var newName = "e";
//portfolio[newName] = [];

console.log(portfolio);

portfolio.sort(function(a,b){
    var nameA = a.name.toUpperCase();
    var nameB = b.name.toUpperCase();
    if (nameA < nameB) {
        return -1;
    }
    if (nameA > nameB) {
        return 1;
    }
    return 0;
});

console.log(portfolio);