/*	
	AUTOR		Fernando Andrés Prieto
	AUTOR		Diego Martín Schwindt
	COPYRIGHT	Abril, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

$('document').ready(function() {

	event_handlers_window();
	event_handlers_tabs();

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
	  $(this).tab('show')
	})
}