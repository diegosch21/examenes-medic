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

var STATUS_OK = 100;
var STATUS_EMPTY_POST = 101;
var STATUS_INVALID_PARAM = 102;
var STATUS_INVALID_POST = 103;
var STATUS_REPEATED_POST = 104;
var STATUS_NO_INSERT = 105;
var STATUS_UNKNOWN_ERROR = 106;

var submit_on_cancel = true;

$('document').ready(function() {

	inicializar_modal();
	event_handlers_window();
//	event_handlers_tabs();	//poniendo los data-toggle en los tabs no es necesario llamar a esto!
	event_handlers_buttons();
	event_handlers_radio_buttons();
	event_handlers_nav_tabs();
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

function event_handlers_nav_tabs() {

	$('.nav-tab-link').click(function (event) {

		if($(this).parent().hasClass('disabled'))
		{
			return false; //cancelo el evento para que la pestaña no se muestre
		}
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

		$(this).parent().nextAll('.item-obs-container:first').toggle().find('.item-obs').focus();
		$(this).toggleClass('active');
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

			manage_observacion_gral_examen(true);

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

			manage_observacion_gral_examen(false);
		}
	});

	$('#btn-cancelar, #navbar-brand, #navbar-mis-examenes, #navbar-mis-datos, #navbar-cerrar-sesion').click(function(event) {

		event.preventDefault();

//		console.log('paso por aca');

		if(($(this).attr('id') == 'navbar-mis-examenes') 
			|| ($(this).attr('id') == 'navbar-mis-datos') 
			|| ($(this).attr('id') == 'navbar-cerrar-sesion')
			|| ($(this).attr('id') == 'navbar-brand'))
		{
//			console.log("entre aca");
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

function manage_observacion_gral_examen(calificando) {

	if(calificando) {
		
		$('.examen-obs').hide();

		if($('.examen-obs').val() != '') {
			
			$('.span-examen-obs-container > span').html($('.examen-obs').val());
		}
		else {

			$('.span-examen-obs-container > span').html("&nbsp;");			
		}

		$('.span-examen-obs-container').show();
	}
	else {	

		$('.span-examen-obs-container').hide();
		$('.examen-obs').show();
	}	
}

function manage_observacion(calificando, container) {

	var observacion = container.find('.observaciones');
	var container_label_observacion = container.find('.span-item-obs-container');

	if(calificando) {
		
		if(observacion.val() != '') {
			
			container_label_observacion.find('.span-item-obs').html(observacion.val());
			container_label_observacion.show();
			observacion.hide();
			container.show();
		}
		else {
			
			container.siblings('.item-botonera').find('.boton-obs').removeClass('active'); //quito el estado activo para los botones de obs que no poseen comentarios
			container.hide();
		}
	}
	else {	
		container_label_observacion.hide();
		observacion.show();	
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

	$('#btn-modal-save, #btn-modal-reintentar').click(function(event) {
		event.preventDefault();

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
					mostrar_modal('error');	
					$("#response-error").html('Error de comunicación con el servidor. Intente de nuevo.');
				},

				success: function(json) { 
					var response = $.parseJSON(json);
					
					if(response.ok) 
					{
						var msj = "El examen fue archivado exitosamente en la base de datos, con ID: "+response.data.id_exam+". ";
						//DEBUG//////////////////////////////
						//msj += "<br/>"+JSON.stringify(response.data);
						///////////////////////////////////
						$("#response-success").html(msj);

						$('#btn-modal-ver').attr('href', $('#btn-modal-ver').data('link')+'/'+response.data.id_exam);

						mostrar_modal('success');	
					}
					else
					{
						var status;
						switch(response.status)
						{
							case STATUS_EMPTY_POST:
								status = "<strong>ACCESO INVÁLIDO</strong>";
								break;
							case STATUS_INVALID_POST:
								status = "<strong>DATOS INVÁLIDOS</strong>";
								break;
							case STATUS_REPEATED_POST:
								status = "<strong>ACCESO REPETIDO</strong>";
								break;
							case STATUS_INVALID_PARAM:
								status = "<strong>DATOS INVÁLIDOS</strong>";
								break;
							case STATUS_NO_INSERT:
								status = "<strong>ERROR EN EL SERVIDOR</strong>";
								break;
							default:
								status = "<strong>ERROR DESCONOCIDO</strong>";
								break;
						}

						var msj = response.data.error_msj;
						//DEBUG/////////////////////////////
						//msj += "<br/>"+JSON.stringify(response.data);
						///////////////////////////////////
						$("#response-error").html(status+"<br/>"+msj);
						mostrar_modal('error');	
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
	$('#btn-modal-nuevo').click(function(event) {

		event.preventDefault();

		$('#input-alumno').val('');
		$('#form-evaluar').submit();
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
						$('#alert-error').hide();
						$('.btn-modal-error').hide();

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
						$('#alert-error').hide();
						$('.btn-modal-error').hide();

						$('#progressbar').hide();

						$('.btn-modal-warning').hide();

						$('#btn-modal-cancelar').show();
						$('#btn-modal-save').show();
						$('#alert-warning-save').show();
						
						break;

		case 'success':
						$('#modal-titulo').html("Examen guardado correctamente");

						$('#alert-warning-exit').hide();
						$('#alert-warning-save').hide();
						$('.btn-modal-warning').hide();

						$('#progressbar').hide();

						$('#btn-modal-save').hide();
						$('#alert-error').hide();
						$('.btn-modal-error').hide();
						$('#alert-success').show();
						$('.btn-modal-success').show();	

						break;
		case 'error':
						$('#modal-titulo').html("ERROR");

						$('#alert-warning-exit').hide();
						$('#alert-warning-save').hide();
						$('.btn-modal-warning').hide();

						$('#progressbar').hide();

						$('#btn-modal-save').hide();

						$('#alert-success').hide();
						$('.btn-modal-success').hide();
						$('#alert-error').show();
						$('.btn-modal-error').show();					
						break;
		
		case 'loading-bar':
						$('#modal-titulo').html("Guardar Examen");
						$('#alert-warning-exit').hide();
						$('#alert-warning-save').hide();
						$('.btn-modal-warning').hide();

						$('#alert-success').hide();
						$('.btn-modal-success').hide();
						$('#alert-error').hide();
						$('.btn-modal-error').hide();
						
						$('#btn-modal-save').hide();

						$('#progressbar').show();
						break;
		default:
						$('#modal-titulo').html("");
						$('#alert-warning-exit').hide();
						$('#alert-warning-save').hide();
						$('.btn-modal-warning').hide();

						$('#alert-success').hide();
						$('#alert-error').hide();
						$('.btn-modal-success').hide();
						$('.btn-modal-error').hide();

						$('#btn-modal-save').hide();
							
						$('#progressbar').hide();
						break;

	}

	// permite llamar a esta funcion dos veces evitando que existan multiples backdrops
	if(!mostrando_modal) {  
		$('#modal').modal('show');
		mostrando_modal = true;
	}
}