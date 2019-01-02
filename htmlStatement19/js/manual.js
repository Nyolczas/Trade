//---------------------- oldal betöltése
init();

setTableData(0, manuTrades.length);


function init() {
  document.getElementById("datefrom").value = "2018-10-20";
  document.getElementById("dateto").value = formatDate(new Date());
}

//--- dátum formátum
function formatDate(date) {
  var d = new Date(date),
    month = '' + (d.getMonth() + 1),
    day = '' + d.getDate(),
    year = d.getFullYear();

  if (month.length < 2) month = '0' + month;
  if (day.length < 2) day = '0' + day;

  return [year, month, day].join('-');
}

//---------------------- táblázat szűrése

document.querySelector('.filter').addEventListener('click',function filter() {

  //--- kezdő dátum megkeresése
  var dateFrom = new Date(document.getElementById("datefrom").value);
  var dateTo = new Date(document.getElementById("dateto").value);

  var start = searchCounter(dateFrom);
  var end = searchCounter(dateTo);

  //alert("start: "+ start + ", end: " + end);
  setTableData(start, end);

});

searchCounter = function (date) {
  for (var i = 0; i < manuTrades.length; i++) {
    if (manuTrades[i].CloseTime.getTime() >= date) {

      break;
    }
  }
  console.log(i);
  return i;
}

//---------------------- táblázat összeállítása
function setTableData(start, end) {
  var tabbleData = {
    top: '<div style="overflow-x:auto;"></div>\
  <table class="table table-sm">',
    head: '<tr>\
  <th>Ticket</th>\
  <th>Open Time</th>\
  <th>Type</th>\
  <th>Size</th>\
  <th>Item</th>\
  <th>Open Price</th>\
  <th>SL</th>\
  <th>TP</th>\
  <th>Close Time</th>\
  <th>Close Price</th>\
  <th>Comission</th>\
  <th>Swap</th>\
  <th>Profit</th>\
  <th>Net Profit</th>\
  <th>%</th>\
  <th>Comment</th>\
  </tr>',
    rows: rowFill(start, end),
    butt: '</table>\
  </div>'
  }

  //---------------------- kiírás
  document.getElementById("table").innerHTML = tabbleData.top +
    tabbleData.head + tabbleData.rows + tabbleData.butt;

  document.getElementById("datefrom").value = formatDate(manuTrades[start].CloseTime);
  document.getElementById("dateto").value = formatDate(manuTrades[end-1].CloseTime);
  
}

function rowFill(start, end) {
  var res = "";
  for (var i = start; i < end; i++) {
    var opt = dateConvertBjuti(manuTrades[i].OpenTime);
    var clt = dateConvertBjuti(manuTrades[i].CloseTime);
    res += '<tr>\
    <td>' + manuTrades[i].Ticket + '</td>\
    <td>' + opt + '</td>\
    <td>' + manuTrades[i].Type + '</td>\
    <td>' + manuTrades[i].Size + '</td>\
    <td>' + manuTrades[i].Item + '</td>\
    <td>' + manuTrades[i].OpenPrice + '</td>\
    <td>' + manuTrades[i].SL + '</td>\
    <td>' + manuTrades[i].TP + '</td>\
    <td>' + clt + '</td>\
    <td>' + manuTrades[i].ClosePrice + '</td>\
    <td>' + manuTrades[i].Comission + '</td>\
    <td>' + manuTrades[i].Swap + '</td>\
    <td>' + manuTrades[i].Profit + '</td>\
    <td>' + manuTrades[i].NetProfit + '</td>\
    <td>' + manuTrades[i].PercProfit + '%</td>\
    <td>' + manuTrades[i].Comment + '</td>\
  </tr>';
  }
  return (res);
}

function dateConvertBjuti(date) {
  var d = new Date(date);
  var res = d.toISOString();
  res = res.replace("T", " ");
  res = res.replace(".000Z", " ");
  return res;
}