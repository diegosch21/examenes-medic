$('document').ready(function() {

	$('#form-login').submit(function(event) {

		if(!validar()) {

			event.preventDefault();
			alert("PERSONALIZAR MSJ - HAY ERRORES");
		}
	});

});

function validar() {

	if( $('#input-legajo').val() == "" || !es_integer($('#input-legajo').val()) || $('#input-password').val() == "") {
		return false;
	}
	
	return true;
}

function es_integer(valor) {
    return (valor == parseInt(valor));
}