//===================================================================================================================
//--- PORTFOLIO CONTROLLER
var portfolioController = (function() {

})();

//===================================================================================================================
//--- UI CONTROLLER
var UIController = (function() {

})();

//===================================================================================================================
//--- GLOBAL APP CONTROLLER
var portfolioController = (function(portfCtrl, UICtrl) {

})(portfolioController, UIController);

var date = ['2018.12.31', '2019.01.31'];
var kp = {
    Huf: [4570, 13354],
    Eur: [4317, 4317],
    Usd: [1118, 1634],
    Sum: [10005, 19306]
}
var portfolio = [
    {name: 'ETFBUXOTP', type: 'stock', value: [305350, 316775]},
    {name:'DAXEX', type: 'stock', value:[285850, 300300]},
    {name:'iShrUSTBond20', type: 'bond', value:[80747, 78077]},
    {name:'iShrUSTBond7-10', type: 'bond', value:[764758, 752063]},
    {name:'NDEX', type: 'stock', value:[287680, 288000]},
    {name:'EBRCHTL05', type: 'stock', value:[41376, 48456]},
    {name:'SXR8', type: 'stock', value:[275440, 284400]}
];


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

var portfHead=[];
portfHead.push('Dátum');
for(i=0; i<portfolio.length; i++) {
    portfHead.push(portfolio[i].name);
}

var portfBody=[];
for (i=0 ; i<date.length; i++) {
    var portfRow = [];
    portfRow.push(date[i]);
    for (j=0; j<portfolio.length; j++) {
        portfRow.push(portfolio[j].value[i]);
    }
    portfBody.push(portfRow);
}

console.log(portfBody);


// --- area chart ---
google.charts.load('current', {
    'packages': ['corechart']
});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable([
        portfHead,
        portfBody[0],
        portfBody[1]
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