/*	
	AUTOR		Fernando Andrés Prieto
	AUTOR		Diego Martín Schwindt
	COPYRIGHT	Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

$('document').ready(function() {

	centrar_contenido('div-form');

	$('#form').submit(function(event) {

		if(!validar()) {

			event.preventDefault();
			alert("PERSONALIZAR MSJ - HAY ERRORES");
		}
	});

	$(window).resize(function() {
		centrar_contenido('div-form');
	});

});

function validar() {

	if( $('#input-legajo').val() == "" || !es_integer($('#input-legajo').val()) || $('#input-password').val() == "") {
		return false;
	}
	
	return true;
}