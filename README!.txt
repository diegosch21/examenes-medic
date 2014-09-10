	
USUARIOS (legajo password):
		5201 hola
		123 admin
		7865 7865
		10325 123456
		12198 stepanosky    //Admin (no Super Admin). //Asociada a Fundamentos II con permiso total
		12821 coronel  //Asociado a Familiar I con permiso total
		12179 steel  //Asociada a Familiar III con permiso total. A familiar I y II con permiso ver (no evaluar)


ACTIVIDAD ACTUAL:
Guardo un string en la session (usar funcion get_actividad_actual o set de Usuario) para ver que esta haciendo. Con eso se controla que no salga de un examen.
	(TENERLA EN CUENTA ANTES DE CADA METODO DE CONTROLADORES PARA REDIRECCIONAR)
		
	
HREFs:
	Cuando uses links para hacer ajax, es decir, que la pagina actual no va a ser redireccionada a una nueva o cuando lo 
	uses como si fuera un boton, en lugar de poner # en el href, ponelo en data-target. Eso evita que en la url del browser  
	te quede con un # al final y quede feo.

	Ejemplo <a href="#">Hago Ajax<a>     (no hacer esto) -> url browser = http://localhost/Medicina/#
			<a data-target="#">Hago Ajax<a> (hacer esto) -> url browser = http://localhost/Medicina

	
