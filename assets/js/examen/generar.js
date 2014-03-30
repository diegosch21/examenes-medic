/*	
	AUTOR		Fernando Andrés Prieto
	AUTOR		Diego Martín Schwindt
	COPYRIGHT	Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/
var NO_SELECTED = -1;

$('document').ready(function() {

	centrar_contenido('div-content');

	$(window).resize(function() {
		centrar_contenido('div-content');
	});

	
	//Actualizar select catedras al seleccionar carrera
	$('#select-carrera').change(function(event) {

		event.preventDefault();
		if($(this).val() != NO_SELECTED) {

			$.ajax({ 
					data: {carrera: $(this).val()}, // dato enviado en el post: codigo carrera
					type: "post", // 
					url: $('body').data('site-url')+"/examen/get_catedras", // controlador

					success: function(json) { 			    
						console.log(json);
						var catedras = $.parseJSON(json);	

						if(catedras.ok) {
							console.log(catedras);
							//TODO actualizar select catedras
						}
						else {
							alert("Invalid select value en carreras");
						}
					}
			});
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
});