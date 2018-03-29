$( "#lt1" )
  .mouseover(function() {
    $("#ltbt1").stop().fadeOut('20');   
  })
  .mouseout(function() {
    $("#ltbt1").stop().fadeIn('20');  
  });