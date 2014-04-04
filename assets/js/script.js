/*
	AUTOR		Fernando Andrés Prieto
	AUTOR		Diego Martín Schwindt
	COPYRIGHT	Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

$(document).ready(function(){	 				
	calculos_visualizacion();

	$(window).resize(function() {
		calculos_visualizacion();
	});

});

function calculos_visualizacion() {
	centrar_contenido_header_footer();
	calcular_altura_main_content();
}


function centrar_contenido_header_footer() {

	$('#header-texto').css('margin-top', 0);

	var header_texto = $('#header-texto').css('height').split("px");
		header_texto = header_texto[0];

	var header_image = $('#header-image').css('height').split("px");
		header_image = header_image[0];

	var header_image_padding_top = $('#header-image').css('padding-top').split("px");
		header_image_padding_top = header_image_padding_top[0];

	var header_image_padding_bottom = $('#header-image').css('padding-bottom').split("px");
		header_image_padding_bottom = header_image_padding_bottom[0];

	var margin_top = (header_image - header_image_padding_top - header_image_padding_bottom - header_texto) / 2;

	if(margin_top < 0) {
		margin_top = 0;
	}

	$('#header-texto').css('margin-top', margin_top);

	if($('#header-sombra').length > 0) { //si se esta mostrando la sombra del header

		var header_principal = $('#header-principal').css('height').split("px");
		header_principal = header_principal[0];

		$('#header-sombra').css('top', header_principal+'px');
	}
}

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

	if(margin_top < 0) {
		margin_top = 0;		
	}

	$('#div-main-content').css('min-height', margin_top);
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


function es_dispositivo_movil() {

	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		return true;
	}
	else {
		return false;
	}
}

/*
 *	Retorna la fecha actual en formato yyyy-mm-dd
 */
function fecha_actual() {
	var d = new Date();

	var month = d.getMonth()+1;
	var day = d.getDate();

	var output = d.getFullYear() + '-' +
	    ((''+month).length<2 ? '0' : '') + month + '-' +
	    ((''+day).length<2 ? '0' : '') + day;

	return output;
}

function sete6ar_value_select(id_select, valor) {
	
	if(es_dispositivo_movil()) {
		$("#"+id_select).val(valor);
	}
	else {
		$("#"+id_select).select2('val', valor);
	}
}



/*
 *	Estas funciones son solo aplicables a SELECTS. 
 *	Deben ser llamadas de la forma $(selector).nombre_function(parametros)
 */

(function( $ ){
   $.fn.setear_value_select = function(valor) {
	
		if(es_dispositivo_movil()) {
			this.val(valor);
		}
		else {
			this.select2('val', valor);
		}
	}; 

	$.fn.habilitar_select = function(habilitar) {

		if(es_dispositivo_movil()) {
			this.attr('disabled', !habilitar);
		}
		else {
			this.select2('enable', habilitar);
		}
	}; 

})( jQuery );