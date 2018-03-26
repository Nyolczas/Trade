$(document).ready(function(){
	
	$('ul.tabs li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.tabs li').removeClass('current');
		$('.tab-content').removeClass('current');

		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	})

})

$( "#gc1" )
  .mouseover(function() {
    $("#os1").show();
  })
  .mouseout(function() {
    $("#os1").hide();
  });

$( "#gc2" )
  .mouseover(function() {
    $("#os2").show();
  })
  .mouseout(function() {
    $("#os2").hide();
  });

$( "#gc3" )
  .mouseover(function() {
    $("#os3").show();
  })
  .mouseout(function() {
    $("#os3").hide();
  });

$( "#gc4" )
  .mouseover(function() {
    $("#os4").show();
  })
  .mouseout(function() {
    $("#os4").hide();
  });

$( "#gc5" )
  .mouseover(function() {
    $("#os5").show();
  })
  .mouseout(function() {
    $("#os5").hide();
  });

$( "#gc6" )
  .mouseover(function() {
    $("#os6").show();
  })
  .mouseout(function() {
    $("#os6").hide();
  });

$( "#gc7" )
  .mouseover(function() {
    $("#os7").show();
  })
  .mouseout(function() {
    $("#os7").hide();
  });
  
$( "#gc8" )
  .mouseover(function() {
    $("#os8").show();
  })
  .mouseout(function() {
    $("#os8").hide();
  });