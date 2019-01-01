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
  rows: rowFill(),
  butt: '</table>\
</div>'
}


function rowFill() {
  var res = "";
  for (var i = 0; i < manuTrades.length; i++) {
    res += '<tr>\
    <td>'+ manuTrades[i].Ticket + '</td>\
    <td>'+manuTrades[i].OpenTime+ '</td>\
    <td>'+manuTrades[i].Type+ '</td>\
    <td>'+manuTrades[i].Size+ '</td>\
    <td>'+manuTrades[i].Item+ '</td>\
    <td>'+manuTrades[i].OpenPrice+ '</td>\
    <td>'+manuTrades[i].SL+ '</td>\
    <td>'+manuTrades[i].TP+ '</td>\
    <td>'+manuTrades[i].CloseTime+ '</td>\
    <td>'+manuTrades[i].ClosePrice+ '</td>\
    <td>'+manuTrades[i].Comission+ '</td>\
    <td>'+manuTrades[i].Swap+ '</td>\
    <td>'+manuTrades[i].Profit+ '</td>\
    <td>'+manuTrades[i].NetProfit+ '</td>\
    <td>'+manuTrades[i].PercProfit+ '%</td>\
    <td>'+manuTrades[i].Comment + '</td>\
  </tr>';
  }
  return (res);
}




//--- kiírás
document.getElementById("table").innerHTML = tabbleData.top +
  tabbleData.head + tabbleData.rows + tabbleData.butt;