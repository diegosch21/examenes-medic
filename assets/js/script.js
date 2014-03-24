/*
	AUTOR		Fernando Andrés Prieto
	AUTOR		Diego Martín Schwindt
	COPYRIGHT	Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

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

	var navbar = 0;

	if($('#navbar')[0]) { //si existe el elemento
		navbar = $('#navbar').css('height').split("px");
		navbar = navbar[0];
	}

	var footer = $('footer').css('height').split("px");
	footer = footer[0];

	var margin_top = wrapper - header - navbar - footer;

	if(margin_top > 0) {
		$('#div-main-content').css('min-height', wrapper - header - navbar - footer);
	}
}

function centrar_contenido(contenido) {

	var contenedor = $('#div-main-content').css('height').split("px");
	contenedor = contenedor[0];

	var contenedor_padding_top =  $('#div-main-content').css('padding-top').split("px");
	contenedor_padding_top = contenedor_padding_top[0];

	var contenedor_padding_bottom =  $('#div-main-content').css('padding-bottom').split("px");
	contenedor_padding_bottom = contenedor_padding_bottom[0];

	var altura_contenido = $('#'+contenido).css('height').split("px");
	altura_contenido = altura_contenido[0];

	$('#'+contenido).css('margin-top', (contenedor - contenedor_padding_top - contenedor_padding_bottom - altura_contenido) / 2);
}

function es_integer(valor) {
    return (valor == parseInt(valor));
}