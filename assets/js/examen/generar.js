/*	
	AUTOR		Fernando Andrés Prieto
	AUTOR		Diego Martín Schwindt
	COPYRIGHT	Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

var NO_SELECTED = "";

$('document').ready(function() {

	if(es_dispositivo_movil()) {
		NO_SELECTED = -1;
	}
	
	inicializar_selects();
	event_handlers_window();
	event_handlers_formulario();

	$(window).resize(); // Disparo el evento para que el contenido quede centado.

	
});

function inicializar_selects() {

	if(es_dispositivo_movil()) {
	 	$('select').addClass('select-mobile');

	 	$('#select-carrera').prepend('<option value="'+NO_SELECTED+'" disabled>Seleccione una Carrera</option>');
	 	$('#select-catedra').prepend('<option value="'+NO_SELECTED+'" disabled>Seleccione un Cátedra</option>');
	 	$('#select-guia').prepend('<option value="'+NO_SELECTED+'" selected="selected" disabled>Seleccione una Guía</option>');
	 	$('#select-alumno').prepend('<option value="'+NO_SELECTED+'" selected="selected" disabled>Seleccione un Alumno</option>');
	}
	else {

		$('#select-carrera, #select-catedra').prepend('<option></option>');
		console.log($('#select-guia option:selected'));

		if($('#select-guia option:selected').length == 0) {
			$('#select-guia').prepend('<option selected="selected"></option>');
		}
		else {
			$('#select-guia').prepend('<option></option>');
		}
		
		console.log($('#select-alumno').attr('selected'));
		if($('#select-alumno option:selected').length == 0) {
			$('#select-alumno').prepend('<option selected="selected"></option>');
		}
		else {
			$('#select-alumno').prepend('<option></option>');
		}

		//Inicialización gráfica de los selects personalizados
		inicializar_select('select-carrera', 'Seleccione una Carrera');
		inicializar_select('select-catedra', 'Seleccione una Cátedra');
		inicializar_select('select-guia', 'Seleccione una Guía');
		inicializar_select('select-alumno', 'Seleccione un Alumno');
	}

	ajustar_ancho_selects();
	event_handlers_selects();	
}

function inicializar_select(id_select, placeholder) {
	$('#'+id_select).select2({
		placeholder: placeholder,
		containerCssClass: 'select',
		width: 'element'
	});
}

/*
 *	Establece el ancho de todos los selects en el rango MAX(250px, MIN(600px, 80% #div-main-content))
 */
function ajustar_ancho_selects() {

	var ancho_main_content = new Array();

	ancho_main_content[0] = parseFloat($("#div-main-content").css("width").split("px")[0]);
	ancho_main_content[1] = parseFloat($("#div-main-content").css("paddingLeft").split("px")[0]) + parseFloat($("#div-main-content").css("paddingRight").split("px")[0]);
	ancho_main_content[2] = parseFloat($("#div-main-content").css("border-left-width").split("px")[0]) + parseFloat($("#div-main-content").css("border-right-width").split("px")[0]);

	var ancho_control = (ancho_main_content[0] - ancho_main_content[1] - ancho_main_content[2]) * 0.8; // 80% del #div-main-content (ancho interior = ancho total - paddings - bordes)

	$("#select-carrera").api_set_css("width", ancho_control);
	$("#select-catedra").api_set_css("width", ancho_control);
	$("#select-guia").api_set_css("width", ancho_control);
	$("#select-alumno").api_set_css("width", ancho_control);

	$('#div-form').css('maxWidth', $("#select-carrera").api_get_css("width"));
}

/*	EVENT HANDLERS */

function event_handlers_window() {

	$(window).resize(function() {
		calculos_visualizacion();
		centrar_contenido('div-form');
		ajustar_ancho_selects();
	});
}

function event_handlers_selects() {

	//Actualizar select catedras al seleccionar carrera
	$('#select-carrera').change(function(event) {

		event.preventDefault();

		if($(this).val() != NO_SELECTED && $(this).val() != null) {

			$('#select-catedra').api_set_val(NO_SELECTED);
			$('#select-catedra').api_enable(false);
			$('#select-guia').api_enable(false);
			$('#select-alumno').api_enable(false);

			$.ajax({ 
					data: {carrera: $(this).val()}, // dato enviado en el post: codigo carrera
					type: "post",
					url: $('body').data('site-url')+"/examen/get_catedras", // controlador

					error: function() {
						 alert(ERROR_AJAX);
					},

					success: function(json) { 		

						var catedras = $.parseJSON(json);	

						if(catedras.ok) {

							var catedra = null;

							$('#select-catedra').find('option').remove();

							if(es_dispositivo_movil()) {

							 	$('#select-catedra').append('<option value="'+NO_SELECTED+'" disabled>Seleccione una Cátedra</option>');
							}
							else {

								$('#select-catedra').append('<option></option>');
							}					
							

							for(var i = 0 ; i < catedras.data.length; i++) {
								catedra = catedras.data[i];
								$('#select-catedra').append('<option value="'+catedra.cod_cat+'">'+catedra.cod_cat+' - '+catedra.nom_cat+'</option>');
							}

							$('#select-catedra').api_enable(true);				

							$('#select-catedra').api_set_val(catedras.data[0].cod_cat);
							$('#select-catedra').change();
						}
						else {
							alert("Invalid selected value en carreras");
						}
					}
			});
		}
		else {
			alert("No seleccionó una carrera");
		}
	});
	
	//Actualizar select guias y alumnos al seleccionar catedra
	$('#select-catedra').change(function(event) {
		event.preventDefault();

		if($(this).val() != NO_SELECTED && $(this).val() != null) {

			$('#select-guia').api_enable(false);
			$('#select-alumno').api_enable(false);

			$.ajax({ 
					data: {catedra: $(this).val()}, // dato enviado en el post: codigo catedra
					type: "post", 
					url: $('body').data('site-url')+"/examen/get_guias_alumnos", // controlador

					error: function() {
						 alert(ERROR_AJAX);
					},

					success: function(json) { 

						var guias_alumnos = $.parseJSON(json);	

						if(guias_alumnos.ok) {

							var guias = guias_alumnos.data.guias;
							var alumnos = guias_alumnos.data.alumnos;

							var guia = null;
							var alumno = null;

							$('#select-guia').find('option').remove();		
							$('#select-alumno').find('option').remove();					

							if(es_dispositivo_movil()) {

							 	$('#select-guia').append('<option value="'+NO_SELECTED+'" disabled>Seleccione una Guía</option>');
							 	$('#select-alumno').append('<option value="'+NO_SELECTED+'" disabled>Seleccione un Alumno</option>');
							}
							else {
								$('#select-guia, #select-alumno').prepend('<option></option>');
							}

							for(var i = 0 ; i < guias.length; i++) {

								guia = guias[i];
								$('#select-guia').append('<option value="'+guia.id_guia+'">'+guia.nro_guia+' - '+guia.tit_guia+'</option>');
							}

							for(var i = 0 ; i < alumnos.length; i++) {

								alumno = alumnos[i];
								$('#select-alumno').append('<option value="'+alumno.lu_alu+'">'+alumno.lu_alu+' - '+alumno.apellido_alu+', '+alumno.nom_alu+'</option>');
							}

							$('#select-guia').api_set_val($('#select-guia > option:first').val());
							$('#select-alumno').api_set_val($('#select-alumno > option:first').val());

							$('#select-guia').api_enable(true);
							$('#select-alumno').api_enable(true);
						}
						else {
							alert("Invalid select value en catedras");
						}
					}
			});
		}
	});
}

function event_handlers_formulario() {

	ocultar_errores();

	$('#form-generar').submit(function(event) {	

		ocultar_errores();	

		if(!validar()) { 
			event.preventDefault();
		}
	});
}

function validar() {

	var validacion_general = true;

	if($('#select-carrera').val() == NO_SELECTED || $('#select-carrera').val() == null) {
		validacion_general = false;
		$('#error-carrera').show();
	}

	if($('#select-catedra').val() == NO_SELECTED || $('#select-catedra').val() == null) {
		validacion_general = false;
		$('#error-catedra').show();
	}

	if($('#select-guia').val() == NO_SELECTED || $('#select-guia').val() == null) {
		validacion_general = false;
		$('#error-guia').show();
	}

	if($('#select-alumno').val() == NO_SELECTED || $('#select-alumno').val() == null) {
		validacion_general = false;
		$('#error-alumno').show();
	}

	if($('#fecha').val() == '' || !control_expresion_regular('fecha', $('#fecha').val())) {
		validacion_general = false;
		$('#error-fecha').show();
	}

	return validacion_general;

}

function ocultar_errores() {
	$('[rel="errores"]').hide();
}