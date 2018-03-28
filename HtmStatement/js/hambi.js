$(document).ready(function () {
	// navigációs menü lenyitása
	$('#nav-icon').click(function () {
		$(this).toggleClass('open');
	});
	// hamburger ikon animáció
	$("#nav-icon").click(function () {
		$("menulink1").show("slow");
		$("menulink2").show("slow");
		$("menulink3").show("slow");
		$("menulink4").show("slow");
	});
});
