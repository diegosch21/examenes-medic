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

	



$('#select-carrera').change(function(event) {
console.log("aca");
	event.preventDefault();

	if($(this).val() != NO_SELECTED) {

		$.ajax({ 
					data: {carrera: $(this).val()}, // get the form data
					type: "post", // GET or POST
					url: $('body').data('site-url')+"/examen/get_catedras", // the file to call

					success: function(json) { 			    
console.log(json);
						var catedras = $.parseJSON(json);	

						if(catedras.ok == false) {
							alert("Invalid select value en carreras");
						}
						else {
							console.log(catedras);

						}
					}
		});
	}
});});