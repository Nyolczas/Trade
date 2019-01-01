d3.select(".chart")
  .selectAll("div")
  .data(balance)
    .enter()
    .append("div")
    .style("width", function(d) { return d + "px"; })
    .text(function(d) { return d; });