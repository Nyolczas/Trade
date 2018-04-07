
$(document).ready(function(){
  
  $('.buttonsh-hover').fadeOut(0.1);
  
	$('ul.tabs li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.tabs li').removeClass('current');
    $('.tab-content').removeClass('current');

		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	})

})
// ---------------- aside buttons ----------------
$( "#gc1" )
  .mouseover(function() {
    $("#os1").stop().fadeOut(20); 
    $("#hw1").stop().fadeIn(20);  
  })
  .mouseout(function() {
    $("#hw1").stop().fadeOut(20); 
    $("#os1").stop().fadeIn(20);  
  });
  
$( "#gc2" )
  .mouseover(function() {
    $("#os2").stop().fadeOut(20); 
    $("#hw2").stop().fadeIn(20);  
  })
  .mouseout(function() {
    $("#hw2").stop().fadeOut(20); 
    $("#os2").stop().fadeIn(20);  
  });
  
$( "#gc3" )
  .mouseover(function() {
    $("#os3").stop().fadeOut(20); 
    $("#hw3").stop().fadeIn(20);  
  })
  .mouseout(function() {
    $("#hw3").stop().fadeOut(20); 
    $("#os3").stop().fadeIn(20);  
  });

$( "#gc4" )
  .mouseover(function() {
    $("#os4").stop().fadeOut(20); 
    $("#hw4").stop().fadeIn(20);  
  })
  .mouseout(function() {
    $("#hw4").stop().fadeOut(20); 
    $("#os4").stop().fadeIn(20);  
  });

$( "#gc5" )
  .mouseover(function() {
    $("#os5").stop().fadeOut(20); 
    $("#hw5").stop().fadeIn(20);  
  })
  .mouseout(function() {
    $("#hw5").stop().fadeOut(20); 
    $("#os5").stop().fadeIn(20);  
  });
  
$( "#gc6" )
  .mouseover(function() {
    $("#os6").stop().fadeOut(20); 
    $("#hw6").stop().fadeIn(20);  
  })
  .mouseout(function() {
    $("#hw6").stop().fadeOut(20); 
    $("#os6").stop().fadeIn(20);  
  });

$( "#gc7" )
  .mouseover(function() {
    $("#os7").stop().fadeOut(20); 
    $("#hw7").stop().fadeIn(20);  
  })
  .mouseout(function() {
    $("#hw7").stop().fadeOut(20); 
    $("#os7").stop().fadeIn(20);  
  });

$( "#gc8" )
  .mouseover(function() {
    $("#os8").stop().fadeOut(20); 
    $("#hw8").stop().fadeIn(20);  
  })
  .mouseout(function() {
    $("#hw8").stop().fadeOut(20); 
    $("#os8").stop().fadeIn(20);  
  });

// ---------------- last trades ----------------
$( "#lt1" )
  .mouseover(function() {
    $("#ltbt1").stop().fadeOut(20); 
    $("#lthw1").stop().fadeIn(20);  
  })
  .mouseout(function() {
    $("#lthw1").stop().fadeOut(20); 
    $("#ltbt1").stop().fadeIn(20);  
  });
  
$( "#lt2" )
  .mouseover(function() {
    $("#ltbt2").stop().fadeOut(20); 
    $("#lthw2").stop().fadeIn(20);  
  })
  .mouseout(function() {
    $("#lthw2").stop().fadeOut(20); 
    $("#ltbt2").stop().fadeIn(20);  
  });

$( "#lt3" )
  .mouseover(function() {
    $("#ltbt3").stop().fadeOut(20); 
    $("#lthw3").stop().fadeIn(20);  
  })
  .mouseout(function() {
    $("#lthw3").stop().fadeOut(20); 
    $("#ltbt3").stop().fadeIn(20);  
  });

$( "#lt4" )
  .mouseover(function() {
    $("#ltbt4").stop().fadeOut(20); 
    $("#lthw4").stop().fadeIn(20);  
  })
  .mouseout(function() {
    $("#lthw4").stop().fadeOut(20); 
    $("#ltbt4").stop().fadeIn(20);  
  });

$( "#lt5" )
  .mouseover(function() {
    $("#ltbt5").stop().fadeOut(20); 
    $("#lthw5").stop().fadeIn(20);  
  })
  .mouseout(function() {
    $("#lthw5").stop().fadeOut(20); 
    $("#ltbt5").stop().fadeIn(20);  
  });
  
$( "#lt6" )
  .mouseover(function() {
    $("#ltbt6").stop().fadeOut(20); 
    $("#lthw6").stop().fadeIn(20);  
  })
  .mouseout(function() {
    $("#lthw6").stop().fadeOut(20); 
    $("#ltbt6").stop().fadeIn(20);  
  });

$( "#lt7" )
  .mouseover(function() {
    $("#ltbt7").stop().fadeOut(20); 
    $("#lthw7").stop().fadeIn(20);  
  })
  .mouseout(function() {
    $("#lthw7").stop().fadeOut(20); 
    $("#ltbt7").stop().fadeIn(20);  
  });

$( "#lt8" )
  .mouseover(function() {
    $("#ltbt8").stop().fadeOut(20); 
    $("#lthw8").stop().fadeIn(20);  
  })
  .mouseout(function() {
    $("#lthw8").stop().fadeOut(20); 
    $("#ltbt8").stop().fadeIn(20);  
  });