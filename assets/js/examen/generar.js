/*	
	AUTOR		Fernando Andrés Prieto
	AUTOR		Diego Martín Schwindt
	COPYRIGHT	Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

var NO_SELECTED = "";
var AJUSTE_VISUALIZACION = 20; // 20px para que se vea correctamente el item seleccionado

$('document').ready(function() {
	
	inicializar_selects();
	event_handlers_window();
	event_handlers_formulario();

	$(window).resize(); // Disparo el evento para que el contenido quede centado.

	if(es_dispositivo_movil()) {
		NO_SELECTED = -1;
		AJUSTE_VISUALIZACION = 0;
	}
});

function inicializar_selects() {

	if(es_dispositivo_movil()) {
	 	$('select').addClass('select').addClass('select-mobile');

	 	$('#select-carrera').prepend('<option value="'+NO_SELECTED+'" disabled>Seleccione una Carrera</option>');
	 	$('#select-catedra').prepend('<option value="'+NO_SELECTED+'" disabled>Seleccione un Cátedra</option>');
	 	$('#select-guia').prepend('<option value="'+NO_SELECTED+'" selected="selected" disabled>Seleccione una Guía</option>');
	 	$('#select-alumno').prepend('<option value="'+NO_SELECTED+'" selected="selected" disabled>Seleccione un Alumno</option>');
	}
	else {

		$('#select-carrera, #select-catedra').prepend('<option ></option>');
	 	$('#select-guia, #select-alumno').prepend('<option selected="selected"></option>');

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
 *	Establece el ancho de todos los selects al mismo tamaño.
 *	Verifica que el ancho sea no menor a 250px y no mayor a 600px (Condición establecida en generar.css - class .select) 
 *	y que se encuentre dentro del rango MAX(250px, 60% #div-main-content) - MIN(600px, 80% #div-main-content). 
 */
function ajustar_ancho_selects() {

	var width_select_carreras = 0;
	var width_select_catedras = 0;
	var width_select_guias = 0;
	var width_select_alumnos = 0;

	var select_mas_ancho = 0;

	width_select_carreras = parseFloat($("#select-carrera").api_get_css("width").split("px")[0]);
	width_select_catedras = parseFloat($("#select-catedra").api_get_css("width").split("px")[0]);
	width_select_guias = 	parseFloat($("#select-guia").api_get_css("width").split("px")[0]);
	width_select_alumnos = 	parseFloat($("#select-alumno").api_get_css("width").split("px")[0]);

	//calculo el width del select más ancho para ponerlos a todos del mismo tamaño
	select_mas_ancho = Math.max(width_select_carreras, width_select_catedras, width_select_guias, width_select_alumnos) + + AJUSTE_VISUALIZACION;

	var ancho_main_content = new Array();

	ancho_main_content[0] = parseFloat($("#div-main-content").css("width").split("px")[0]);
	ancho_main_content[1] = parseFloat($("#div-main-content").css("paddingLeft").split("px")[0]) + parseFloat($("#div-main-content").css("paddingRight").split("px")[0]);
	ancho_main_content[2] = parseFloat($("#div-main-content").css("border-left-width").split("px")[0]) + parseFloat($("#div-main-content").css("border-right-width").split("px")[0]);

	var ancho_main_content_real = ancho_main_content[0] - ancho_main_content[1] - ancho_main_content[2]; //ancho - padding - bordes
	var max_ancho_select = parseFloat($(".select").css("maxWidth").split("px")[0]);

	var ancho_control = ancho_main_content_real * 0.6;

	//console.log(ancho_control);

	if(select_mas_ancho < ancho_control && ancho_control < max_ancho_select) {
		select_mas_ancho = ancho_control;
	}
	else {

		ancho_control = ancho_main_content_real * 0.8;

		if(select_mas_ancho > ancho_control) {
			select_mas_ancho = ancho_control;
		}
		else {
			select_mas_ancho = max_ancho_select;
		}
	}

	width_select_carreras = select_mas_ancho;
	width_select_catedras = select_mas_ancho;
	width_select_guias = 	select_mas_ancho;
	width_select_alumnos = 	select_mas_ancho;

	$("#select-carrera").api_set_css("width", width_select_carreras);
	$("#select-catedra").api_set_css("width", width_select_catedras);
	$("#select-guia").api_set_css("width", width_select_guias);
	$("#select-alumno").api_set_css("width", width_select_alumnos);

	$('#div-form').css('maxWidth', select_mas_ancho);
}

/*	EVENT HANDLERS */

function event_handlers_window() {

	$(window).resize(function() {
		calculos_visualizacion();
		centrar_contenido('div-form');
		ajustar_ancho_selects();
		AJUSTE_VISUALIZACION = 0; // para que lo aplique solo una vez, sino siempre se suma
	});
}

function event_handlers_selects() {

	//Actualizar select catedras al seleccionar carrera
	$('#select-carrera').change(function(event) {

		event.preventDefault();

		if($(this).val() != NO_SELECTED && $(this).val() != null) {

			$('#select-catedra').api_set_val(NO_SELECTED);
		//	$('#select-catedra').api_enable(false);

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

			$.ajax({ 
					data: {catedra: $(this).val()}, // dato enviado en el post: codigo catedra
					type: "post", 
					url: $('body').data('site-url')+"/examen/get_guias_alumnos", // controlador

					error: function() {
						 alert(ERROR_AJAX);
					},

					success: function(json) { 			    
						console.log(json);
						var guias_alumnos = $.parseJSON(json);	

						if(guias_alumnos.ok) {

							var guias = guias_alumnos.data.guias;
							var alumnos = guias_alumnos.data.alumnos;

							var guia = null;
							var alumno = null;

							$('#select-guia').find('option').remove();		
							$('#select-alumno').find('option').remove();					

							if(es_dispositivo_movil()) {

							 	$('#select-guia').append('<option value="'+NO_SELECTED+'" disabled selected="selected">Seleccione una Guía</option>');
							 	$('#select-alumno').append('<option value="'+NO_SELECTED+'" disabled selected="selected">Seleccione un Alumno</option>');
							}
							else {
								$('#select-guia, #select-alumno').prepend('<option selected="selected"></option>');
							}

							for(var i = 0 ; i < guias.length; i++) {

								guia = guias[i];
								$('#select-guia').append('<option value="'+guia.id_guia+'">'+guia.nro_guia+' - '+guia.tit_guia+'</option>');
							}

							for(var i = 0 ; i < alumnos.length; i++) {

								alumno = alumnos[i];
								$('#select-alumno').append('<option value="'+alumno.lu_alu+'">'+alumno.lu_alu+' - '+alumno.apellido_alu+', '+alumno.nom_alu+'</option>');
							}

							$('#select-guia').api_set_val($('#select-guia > option :first').val());
							$('#select-alumno').api_set_val($('#select-alumno > option :first').val());
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

console.log($('#fecha').val()+"validacion "+control_expresion_regular('fecha', $('#fecha').val()));
console.log($('#select-carrera').val());
console.log($('#select-catedra').val());
console.log($('#select-guia').val());
console.log($('#select-alumno').val());

	if($('#fecha').val() == '' || !control_expresion_regular('fecha', $('#fecha').val())) {
		validacion_general = false;
		$('#error-fecha').show();
	}

	console.log(validacion_general);

	return validacion_general;

}

function ocultar_errores() {
	$('[rel="errores"]').hide();
}