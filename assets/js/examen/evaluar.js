/*	
	AUTOR		Fernando Andrés Prieto
	AUTOR		Diego Martín Schwindt
	COPYRIGHT	Abril, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

$('document').ready(function() {

	event_handlers_window();
//	event_handlers_tabs();	//poniendo los data-toggle en los tabs no es necesario llamar a esto!
	event_handlers_buttons();

	$(window).resize(); // Disparo el evento para que el contenido quede centado
});


/*	EVENT HANDLERS */

function event_handlers_window() {

	$(window).resize(function() {
		calculos_visualizacion();
		centrar_contenido('div-evaluar');
	});
}

function event_handlers_tabs() {

	$('#tab a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show');
	})
}

function event_handlers_buttons() {
	$('.boton-si').click(function(e){
		if($(this).is('.active')) {
			desactivar_boton($(this),'SI');
		}
		else {
			activar_boton($(this),'SI');
		}
	});

	$('.boton-no').click(function(e){
		if($(this).is('.active')) {
			desactivar_boton($(this),'NO');
		}
		else {
			activar_boton($(this),'NO');
		}
	});

	$('.boton-obs').click(function(e){
		var text = $(this).next();
		if(text.css('display')=='none') {
			//text.show('fast');
			text.show();
		}
		else {
			//text.hide('fast');
			text.hide();
		}
	});

	$('#btn-cancelar').click(function(event) {
		event.preventDefault();

		$('#form-evaluar').submit();

	});


}

function activar_boton(boton,valor) {
	if(valor=='SI') {
		boton.addClass('btn-success').removeClass('btn-default');
		boton.siblings('.boton-no').removeClass('btn-danger active').addClass('btn-default');
		var parent = boton.parent();
		parent.siblings('input').val('1');	
		parent.siblings('span').html('sí').removeClass('item-value-no').addClass('item-value-si');;	
	}
	else {
		boton.addClass('btn-danger').removeClass('btn-default');
		boton.siblings('.boton-si').removeClass('btn-success active').addClass('btn-default');
		var parent = boton.parent();
		parent.siblings('input').val('0');
		parent.siblings('span').html('no').removeClass('item-value-si').addClass('item-value-no');
	}
}

function desactivar_boton(boton,valor) {
	if(valor=='SI') {
		boton.removeClass('btn-success').addClass('btn-default');
	}
	else {
		boton.removeClass('btn-danger').addClass('btn-default');	
	}
	var parent = boton.parent();
	parent.siblings('input').val('-1');
	parent.siblings('span').html('');
	
}