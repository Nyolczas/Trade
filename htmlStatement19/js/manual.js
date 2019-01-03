//---------------------- oldal betöltése
init();

setTableData(0, manuTrades.length);



function init() {
  document.getElementById("datefrom").value = "2018-10-20";
  document.getElementById("dateto").value = formatDate(new Date());
  document.getElementById("instrumentSelector").value = "összes";
}

//---------------------- táblázat szűrése
document.querySelector('.filter').addEventListener('click', function filter() {

  //--- szűrési feltételek beolvasása
  var dateFrom = new Date(document.getElementById("datefrom").value);
  var dateTo = new Date(document.getElementById("dateto").value);
  var sym = document.getElementById("instrumentSelector").value;

  var start = searchCounter(dateFrom);
  var end = searchCounter(dateTo);

  //alert("start: "+ start + ", end: " + end);
  setTableData(start, end, sym);

});

searchCounter = function (date) {
  for (var i = 0; i < manuTrades.length; i++) {
    if (manuTrades[i].CloseTime.getTime() >= date) {

      break;
    }
  }
  return i;
}

//---------------------- táblázat összeállítása
function setTableData(start, end, sym) {
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
  <th>Hozam</th>\
  <th>%Hozam</th>\
  </tr>',
    rows: rowFill(start, end, sym),
    butt: '</table>\
  </div>'
  }

  //---------------------- táblázat fejlécének kiírása
  document.getElementById("table").innerHTML = tabbleData.top +
    tabbleData.head + tabbleData.rows + tabbleData.butt;
}

function rowFill(start, end, sym = "összes") {

  var res = "";
  var symbols = [];
  var tempHozam = 0;
  var tempPercHozam = 0;
  var x = document.getElementById("instrumentSelector");
  for (var i = x.length; i > 0; i--) {
    x.remove(i);
  }
  if (sym != "összes") {
    var option = document.createElement("option");
    option.text = sym;
    x.add(option);
  }
  for (var i = start; i < end; i++) {
    //--- select option hozzáadása a szimbólum szűréshez
    if (!symbols.includes(manuTrades[i].Item) && sym == "összes") {
      symbols.push(manuTrades[i].Item);
      var option = document.createElement("option");
      option.text = manuTrades[i].Item;
      x.add(option);
    }
    //--- táblázat sorok feltöltése
    if (sym == "összes" || manuTrades[i].Item == sym) {
      var opt = dateConvertBjuti(manuTrades[i].OpenTime);
      var clt = dateConvertBjuti(manuTrades[i].CloseTime);
      tempHozam += manuTrades[i].NetProfit;
      tempPercHozam += manuTrades[i].PercProfit;
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
      <td>' + Math.round(tempHozam * 100)/100 + '</td>\
      <td>' + Math.round(tempPercHozam * 10)/10 + '%</td>\
    </tr>';
    }
  }

  x.value = sym;
  //--- táblázat sorok visszaküldése
  return (res);
}

//====================== Helpers ======================
//--- date bjuti
function dateConvertBjuti(date) {
  var d = new Date(date);
  var res = d.toISOString();
  res = res.replace("T", " ");
  res = res.replace(".000Z", " ");
  return res;
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