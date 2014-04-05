/*	
	AUTOR		Fernando Andrés Prieto
	AUTOR		Diego Martín Schwindt
	COPYRIGHT	Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

$('document').ready(function() {

	event_handlers_form();
	event_handlers_window();

	$(window).resize(); // Disparo el evento para que el contenido quede centado.
	$('#input-legajo').focus();
});

/*	EVENT HANDLERS */

function event_handlers_window() {

	$(window).resize(function() {
		calculos_visualizacion();
		centrar_contenido('div-form');
	});
}

function event_handlers_form() {
	
	$('#form').submit(function(event) {

		if(!validar()) {

			event.preventDefault();
			alert("PERSONALIZAR MSJ - HAY ERRORES");
		}
	});
}

function validar() {

	if( $('#input-legajo').val() == "" || !es_integer($('#input-legajo').val()) || $('#input-password').val() == "") {
		return false;
	}
	
	return true;
}