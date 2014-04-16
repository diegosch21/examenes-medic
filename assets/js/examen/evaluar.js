/*	
	AUTOR		Fernando Andrés Prieto
	AUTOR		Diego Martín Schwindt
	COPYRIGHT	Abril, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

var mostrando_modal = false;

var ITEM_NO = 0;
var ITEM_SI = 1;
var ITEM_VACIO = -1;

var CALIF_COMPETENCIA_NO_ADQUIRIDA = 0;
var CALIF_COMPETENCIA_MED_ADQUIRIDA = 1;
var CALIF_COMPETENCIA_ADQUIRIDA = 2;

var submit_on_cancel = true;

$('document').ready(function() {

	inicializar_modal();
	event_handlers_window();
//	event_handlers_tabs();	//poniendo los data-toggle en los tabs no es necesario llamar a esto!
	event_handlers_buttons();
	event_handlers_radio_buttons();
	handler_formulario();

	ocultar_errores();	

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
					$(this).parent().addClass('bg-success');
					
					manage_observacion(true, $(this).nextAll('.item-obs-container'));
				}
				else {
					if($(this).val() == ITEM_NO) {

						rta_respondidas ++;
						$(this).parent().addClass('bg-danger');	

						manage_observacion(true, $(this).nextAll('.item-obs-container'));
					}
					else {

						$(this).parent().addClass('bg-no-resp');

						manage_observacion(true, $(this).nextAll('.item-obs-container'));
					}
				}					
			});

			$('.solotexto').each(function() {
				manage_observacion(true, $(this));	
			});

			var porcentaje_correcto = 0;

			if(rta_respondidas > 0) {
				porcentaje_correcto = (rta_correctas * 100) / rta_respondidas;
				porcentaje_correcto = porcentaje_correcto.toFixed(2);
			}

			$('#porcentaje-realizado').html(porcentaje_correcto + "%  - ("+rta_correctas+" / "+rta_respondidas+")");

			$('#examen-obs').attr('disabled', true);

		}
		else {
			$('.item-texto').removeClass('item-texto-padding');
			$('.borde-item').removeClass('borde-grupoitem');
			$('.item-botonera').removeClass('item-value-botonera-calificar');

			$('.item-estado').each(function() {

				$(this).parent().removeClass('bg-success').removeClass('bg-danger').removeClass('bg-no-resp');	
				manage_observacion(false, $(this).nextAll('.item-obs-container'));			
			});

			$('.solotexto').each(function() {				
				manage_observacion(false, $(this));
			});

			$('#examen-obs').attr('disabled', false);
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

		if(validar()) {
			mostrar_modal('warning-save');
		}

	});
}	

function manage_observacion(calificando, container) {

	var observacion = container.find('.observaciones');

	if(calificando) {
		
		if(observacion.val() != '') {
			container.show();
		}
		else {
			container.hide();
		}
		
		observacion.attr("disabled", true); 
	}
	else {
		observacion.attr('disabled', false);
	}	
}

function event_handlers_radio_buttons() {
	$('.radio-texto').click(function() {
		$(this).prev().click();
	});
}

function validar() {

	ocultar_errores();

	if( !$('#calificacion0').is(':checked') && 
		!$('#calificacion1').is(':checked') &&
		!$('#calificacion2').is(':checked'))
	{
		$('#error-radio').text('Debe seleccionar una opción');
		$('#error-radio').show();
		return false;
	}
	else {
		
		if( ($('#calificacion0').is(':checked') && ($('#calificacion0').val() != CALIF_COMPETENCIA_NO_ADQUIRIDA)) ||
		    ($('#calificacion1').is(':checked') && ($('#calificacion1').val() != CALIF_COMPETENCIA_MED_ADQUIRIDA)) ||
		    ($('#calificacion2').is(':checked') && ($('#calificacion2').val() != CALIF_COMPETENCIA_ADQUIRIDA)))
		{
			$('#error-radio').text('El valor de la opción seleccionada es inválido');
			$('#error-radio').show();
			return false;
		}
	}

	return true;
}

function ocultar_errores() {
	$('.errores').hide();
}

function handler_formulario() {

	$('#btn-modal-save').click(function(event) {
		event.preventDefault();
		//rehabilito las observaciones para que se manden en el form
		$('textarea').attr('disabled', false);


		mostrar_modal('loading-bar');

		//DEBUG////////////////////////////////////////////////////////////////////////
		//$('#form-evaluar').attr('action', $('body').data('site-url')+"/examen/archivar");
		//$('#form-evaluar').submit();
		///////////////////////////////////////////////////////////////////////////////////
		
		$.ajax({ 
				data: $('#form-evaluar').serialize(), // dato enviado en el post: codigo carrera
				type: "post",

				url: $('body').data('site-url')+"/examen/archivar", // controlador

				error: function() {
					 alert(ERROR_AJAX);    //TODO
				},

				success: function(json) { 
					var response = $.parseJSON(json);
					if(response.ok) 
					{
						mostrar_modal('success');	
						$("#response-success").html("<strong>EXAMEN GUARDADO CORRECTAMENTE!</strong> "+JSON.stringify(response.data));
					}
					else
					{
						//mostrar_modal('error','ERROR',response.data);
						mostrar_modal('success');	
						$("#response-success").html('ERROR '+response.status+": "+response.data);
					}
								
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
		parent.parent().siblings('.item-estado').val(ITEM_SI);	
		parent.siblings('span.item-value').html('sí').removeClass('item-value-no').addClass('item-value-si');;	
	}
	else {

		boton.addClass('btn-danger').removeClass('btn-default');
		boton.siblings('.boton-si').removeClass('btn-success active').addClass('btn-default');
		var parent = boton.parent();
		parent.parent().siblings('.item-estado').val(ITEM_NO);
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
	parent.parent().siblings('.item-estado').val(ITEM_VACIO);
	parent.siblings('span.item-value').html('-').removeClass('item-value-si').removeClass('item-value-no');
}

function mostrar_modal(mensaje) {

	switch(mensaje)
	{
		case 'warning-exit': 
							$('#modal-titulo').html("Abortar Examen");
							$('#alert-warning-save').hide();
							$('#alert-success').hide();
							$('.btn-modal-success').hide();

							$('#progressbar').hide();

							$('#btn-modal-save').hide();

							$('#alert-warning-exit').show();
							$('.btn-modal-warning').show();
							break;

		case 'warning-save': 
							$('#modal-titulo').html("Guardar Examen");
							$('#alert-warning-exit').hide();
							$('#alert-success').hide();
							$('.btn-modal-success').hide();

							$('#progressbar').hide();

							$('.btn-modal-warning').hide();

							$('#btn-modal-cancelar').show();
							$('#btn-modal-save').show();
							$('#alert-warning-save').show();
							
							break;

		case 'success':
						$('#modal-titulo').html("Guardar Examen");

						$('#alert-warning-exit').hide();
						$('#alert-warning-save').hide();
						$('.btn-modal-warning').hide();

						$('#progressbar').hide();

						$('#btn-modal-save').hide();

						$('#alert-success').show();
						$('.btn-modal-success').show();					
						break;
		
		default:
						$('#modal-titulo').html("Guardar Examen");
						$('#alert-warning-exit').hide();
						$('#alert-warning-save').hide();
						$('.btn-modal-warning').hide();

						$('#alert-success').hide();
						$('.btn-modal-success').hide();

						$('#btn-modal-save').hide();

						$('#progressbar').show();
	}

	// permite llamar a esta funcion dos veces evitando que existan multiples backdrops
	if(!mostrando_modal) {  
		$('#modal').modal('show');
		mostrando_modal = true;
	}
}