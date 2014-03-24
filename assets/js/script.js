$(document).ready(function(){	 				
	calcular_altura_main_content();

	$(window).resize(function() {
		calcular_altura_main_content();
	});

});

function calcular_altura_main_content() {

	var wrapper = $('.wrapper').css('height').split("px");
		wrapper = wrapper[0];

	var header = $('#header-image').css('height').split("px");
		header = header[0];

	var navbar = $('#navbar').css('height').split("px");
	navbar = navbar[0];

	var footer = $('footer').css('height').split("px");
	footer = footer[0];

	$('#div-main-content').css('min-height', wrapper - header - navbar - footer);
}