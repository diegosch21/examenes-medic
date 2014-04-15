/*	
	AUTOR		Fernando Andrés Prieto
	AUTOR		Diego Martín Schwindt
	COPYRIGHT	Abril, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

var mostrando_modal = false;

var ITEM_NO = 0;
var ITEM_SI = 1;
var ITEM_VACIO = -1;

var submit_on_cancel = true;

$('document').ready(function() {

	inicializar_modal();
	event_handlers_window();
//	event_handlers_tabs();	//poniendo los data-toggle en los tabs no es necesario llamar a esto!
	event_handlers_buttons();
	handler_formulario();	

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
			desactivar_boton($(this), ITEM_SI);
		}
		else {
			activar_boton($(this), ITEM_SI);
		}
	});

	$('.boton-no').click(function(e){
		if($(this).is('.active')) {
			desactivar_boton($(this), ITEM_NO);
		}
		else {
			activar_boton($(this), ITEM_NO);
		}
	});

	$('.boton-obs').click(function(e){

		$(this).parent().nextAll('.item-obs-container:first').toggle();
	});

	$('#btn-calificar, #btn-atras').click(function(event) {

		$(window).scrollTop(0);

		$('.calificacion').toggle();
		$('.evaluacion').toggle();

		if($('.calificacion').is(':visible')) {

			$('.item-texto').addClass('item-texto-padding');
			$('.borde-item').addClass('borde-grupoitem');
			$('.item-botonera').addClass('item-value-botonera-calificar');
			 
			var rta_correctas = 0;
			var rta_respondidas = 0;

			$('.item-estado').each(function() {

				if($(this).val() == ITEM_SI) {
					rta_correctas ++;
					rta_respondidas ++;
					$(this).parent().parent().addClass('bg-success');
				}
				else {
					if($(this).val() == ITEM_NO) {
						rta_respondidas ++;
						$(this).parent().parent().addClass('bg-danger');	
					}
					else {
						$(this).parent().parent().addClass('bg-no-resp');
					}
				}					
			});

			var porcentaje_correcto = 0;

			if(rta_respondidas > 0) {
				porcentaje_correcto = (rta_correctas * 100) / rta_respondidas;
				porcentaje_correcto = porcentaje_correcto.toFixed(2);
			}

			$('#porcentaje-realizado').html(porcentaje_correcto + "%  - ("+rta_correctas+" / "+rta_respondidas+")");

		}
		else {
			$('.item-texto').removeClass('item-texto-padding');
			$('.borde-item').removeClass('borde-grupoitem');
			$('.item-botonera').removeClass('item-value-botonera-calificar');

			$('.item-estado').each(function() {
				$(this).parent().parent().removeClass('bg-success').removeClass('bg-danger').removeClass('bg-no-resp');					
			});
		}
	});

	$('#btn-cancelar, #navbar-brand, #navbar-mis-examenes, #navbar-mis-datos, #navbar-cerrar-cesion').click(function(event) {

		event.preventDefault();

		console.log('paso por aca');

		if(($(this).attr('id') == 'navbar-mis-examenes') 
			|| ($(this).attr('id') == 'navbar-mis-datos') 
			|| ($(this).attr('id') == 'navbar-cerrar-cesion')
			|| ($(this).attr('id') == 'navbar-brand'))
		{
			console.log("entre aca");
			$('#btn-modal-abortar').attr('href', $(this).attr('href'));
			submit_on_cancel = false;
		}
		else {
			submit_on_cancel = true;
		}

		mostrar_modal('warning-exit');		
	});

	$('#btn-confirmar').click(function(event) {
		mostrar_modal('warning-save');		
	});
}	

function handler_formulario() {

	$('#btn-modal-save').click(function(event) {
		event.preventDefault();

		mostrar_modal('loading-bar');

		$.ajax({ 
				data: $('#form-evaluar').serialize(), // dato enviado en el post: codigo carrera
				type: "post",

				url: $('body').data('site-url')+"/examen/evaluar", // controlador

				error: function() {
					 alert(ERROR_AJAX);
				},

				success: function(json) { 

					mostrar_modal('success');				
				}
		});
	});	
}

function inicializar_modal() {

	$('#modal').modal({
		backdrop: 'static',
		keyboard: 'false',
		show: false
	});

	$('#modal').on('hidden.bs.modal', function (event) {
	  mostrando_modal = false;
	});

	event_handlers_modal_buttons();
}

function event_handlers_modal_buttons() {

	$('#btn-modal-abortar').click(function(event) {

		event.preventDefault();

		if(submit_on_cancel)
		{
			$('#form-evaluar').submit();
		}
	});
}

function activar_boton(boton, valor) {

	if(valor == ITEM_SI) {

		boton.addClass('btn-success').removeClass('btn-default');
		boton.siblings('.boton-no').removeClass('btn-danger active').addClass('btn-default');
		var parent = boton.parent();
		parent.siblings('input').val(ITEM_SI);	
		parent.siblings('span.item-value').html('sí').removeClass('item-value-no').addClass('item-value-si');;	
	}
	else {

		boton.addClass('btn-danger').removeClass('btn-default');
		boton.siblings('.boton-si').removeClass('btn-success active').addClass('btn-default');
		var parent = boton.parent();
		parent.siblings('input').val(ITEM_NO);
		parent.siblings('span.item-value').html('no').removeClass('item-value-si').addClass('item-value-no');
	}
}

function desactivar_boton(boton,valor) {

	if(valor == ITEM_SI) {
		boton.removeClass('btn-success').addClass('btn-default');
	}
	else {
		boton.removeClass('btn-danger').addClass('btn-default');	
	}
	var parent = boton.parent();
	parent.siblings('input').val(ITEM_VACIO);
	parent.siblings('span.item-value').html('-').removeClass('item-value-si').removeClass('item-value-no');
}

function mostrar_modal(mensaje) {

	switch(mensaje)
	{
		case 'warning-exit': 
							$('#modal-titulo').html("Abortar Examen");
							$('#alert-warning-save').hide();
							$('#alert-success').hide();
							$('[rel="btn-modal-success"]').hide();

							$('#progressbar').hide();

							$('#btn-modal-save').hide();

							$('#alert-warning-exit').show();
							$('[rel="btn-modal-warning"]').show();
							break;

		case 'warning-save': 
							$('#modal-titulo').html("Guardar Examen");
							$('#alert-warning-exit').hide();
							$('#alert-success').hide();
							$('[rel="btn-modal-success"]').hide();

							$('#progressbar').hide();

							$('[rel="btn-modal-warning"]').hide();

							$('#btn-modal-cancelar').show();
							$('#btn-modal-save').show();
							$('#alert-warning-save').show();
							
							break;

		case 'success':
						$('#modal-titulo').html("Guardar Examen");

						$('#alert-warning-exit').hide();
						$('#alert-warning-save').hide();
						$('[rel="btn-modal-warning"]').hide();

						$('#progressbar').hide();

						$('#btn-modal-save').hide();

						$('#alert-success').show();
						$('[rel="btn-modal-success"]').show();					
						break;
		
		default:
						$('#modal-titulo').html("Guardar Examen");
						$('#alert-warning-exit').hide();
						$('#alert-warning-save').hide();
						$('[rel="btn-modal-warning"]').hide();

						$('#alert-success').hide();
						$('[rel="btn-modal-success"]').hide();

						$('#btn-modal-save').hide();

						$('#progressbar').show();
	}

	// permite llamar a esta funcion dos veces evitando que existan multiples backdrops
	if(!mostrando_modal) {  
		$('#modal').modal('show');
		mostrando_modal = true;
	}
}