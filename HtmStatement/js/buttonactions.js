$( "#lt1" )
  .mouseover(function() {
    $("#ltbt1").stop().fadeOut('20'); 
    $("#lthw1").stop().fadeIn('20');  
  })
  .mouseout(function() {
    $("#lthw1").stop().fadeOut('20'); 
    $("#ltbt1").stop().fadeIn('20');  
  });