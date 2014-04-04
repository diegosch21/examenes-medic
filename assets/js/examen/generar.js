/*	
	AUTOR		Fernando Andrés Prieto
	AUTOR		Diego Martín Schwindt
	COPYRIGHT	Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

var NO_SELECTED = -1;
var AJUSTE_VISUALIZACION = 20; // 20px para que se vea correctamente el item seleccionado

$('document').ready(function() {
	
	inicializar_selects();
	event_handlers_window();

	$(window).resize(); // Disparo el evento para que el contenido quede centado.

	$('#fecha').val(fecha_actual());

	if(es_dispositivo_movil()) {
		NO_SELECTED = "";
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

		$('#select-carrera, #select-catedra').prepend('<option></option>');
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

	var ajuste_visualizacion_select2 = AJUSTE_VISUALIZACION;

	if(es_dispositivo_movil()) {

		width_select_carreras = parseFloat($("#select-carrera").css("width").split("px")[0]);
		width_select_catedras = parseFloat($("#select-catedra").css("width").split("px")[0]);
		width_select_guias = 	parseFloat($("#select-guia").css("width").split("px")[0]);
		width_select_alumnos = 	parseFloat($("#select-alumno").css("width").split("px")[0]);

		ajuste_visualizacion_select2 = 0;
	}
	else {

		width_select_carreras = parseFloat($("#select-carrera").select2("container").css("width").split("px")[0]);
		width_select_catedras = parseFloat($("#select-catedra").select2("container").css("width").split("px")[0]);
		width_select_guias = 	parseFloat($("#select-guia").select2("container").css("width").split("px")[0]);
		width_select_alumnos = 	parseFloat($("#select-alumno").select2("container").css("width").split("px")[0]);
	}

	//calculo el width del select más ancho para ponerlos a todos del mismo tamaño
	select_mas_ancho = Math.max(width_select_carreras, width_select_catedras, width_select_guias, width_select_alumnos);

	var ancho_main_content = new Array();

	ancho_main_content[0] = parseFloat($("#div-main-content").css("width").split("px")[0]);
	ancho_main_content[1] = parseFloat($("#div-main-content").css("paddingLeft").split("px")[0]) + parseFloat($("#div-main-content").css("paddingRight").split("px")[0]);
	ancho_main_content[2] = parseFloat($("#div-main-content").css("border-left-width").split("px")[0]) + parseFloat($("#div-main-content").css("border-right-width").split("px")[0]);

	var ancho_main_content_real = ancho_main_content[0] - ancho_main_content[1] - ancho_main_content[2]; //ancho - padding - bordes
	var max_ancho_select = parseFloat($(".select").css("maxWidth").split("px")[0]);

	if(select_mas_ancho + ajuste_visualizacion_select2 <= max_ancho_select) {
		select_mas_ancho = select_mas_ancho + ajuste_visualizacion_select2;
	}

	var ancho_control = ancho_main_content_real * 0.6;

	if(select_mas_ancho < ancho_control && ancho_control < max_ancho_select) {
		select_mas_ancho = ancho_control;
	}
	else {

		ancho_control = ancho_main_content_real * 0.8;

		if(select_mas_ancho > ancho_control) {
			select_mas_ancho = ancho_control;
		}
	}

	width_select_carreras = select_mas_ancho;
	width_select_catedras = select_mas_ancho;
	width_select_guias = 	select_mas_ancho;
	width_select_alumnos = 	select_mas_ancho;

	if(es_dispositivo_movil()) {

		$("#select-carrera").css("width", width_select_carreras);
		$("#select-catedra").css("width", width_select_catedras);
		$("#select-guia").css("width", width_select_guias);
		$("#select-alumno").css("width", width_select_alumnos);
	}
	else {

		$("#select-carrera").select2("container").css("width", width_select_carreras);
		$("#select-catedra").select2("container").css("width", width_select_catedras);
		$("#select-guia").select2("container").css("width", width_select_guias);
		$("#select-alumno").select2("container").css("width", width_select_alumnos);
	}

	$('#div-form').css('maxWidth', select_mas_ancho);
}

/*	EVENT HANDLERS */

function event_handlers_window() {

	$(window).resize(function() {
		centrar_contenido('div-form');
		ajustar_ancho_selects();
	});
}

function event_handlers_selects() {

	//Actualizar select catedras al seleccionar carrera
	$('#select-carrera').change(function(event) {

		event.preventDefault();

		if($(this).val() != NO_SELECTED && $(this).val() != null) {

			$('#select-catedra').setear_value_select(NO_SELECTED);
			$('#select-catedra').habilitar_select(false);

			$.ajax({ 
					data: {carrera: $(this).val()}, // dato enviado en el post: codigo carrera
					type: "post",
					url: $('body').data('site-url')+"/examen/get_catedras", // controlador

					success: function(json) { 			    
						console.log(json);
						var catedras = $.parseJSON(json);	

						if(catedras.ok) {
							console.log(catedras);

							var catedra = null;

							for(var i = 0 ; i < catedras.data.length; i++) {

								catedra = catedras.data[i];

								catedra.cod_cat
								catedra.nom_cat
							}
							//TODO actualizar select catedras
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
		if($(this).val() != NO_SELECTED) {

			$.ajax({ 
					data: {catedra: $(this).val()}, // dato enviado en el post: codigo catedra
					type: "post", 
					url: $('body').data('site-url')+"/examen/get_guias_alumnos", // controlador

					success: function(json) { 			    
						console.log(json);
						var guias_alumnos = $.parseJSON(json);	

						if(guias_alumnos.ok) {
							var guias = guias_alumnos.data.guias;
							console.log(guias);
							//TODO actualizar select guias
							var alumnos = guias_alumnos.data.alumnos;
							console.log(alumnos);
							//TODO actualizar select alumnos

						}
						else {
							alert("Invalid select value en catedras");
						}
					}
			});
		}
	});
}