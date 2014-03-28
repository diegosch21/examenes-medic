<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/*
|
|	Constantes definidas para la aplicación
|
*/

define('PRIVILEGIO_NULO',-1);
define('PRIVILEGIO_DOCENTE',0); //Docente: solo puede tomar examenes. Y crear guías si tiene permiso en catedra
define('PRIVILEGIO_ADMIN', 2);  //Es admin (acceso a todos los ABM), pero no puede nombrar nuevos admin, ni borrar/modificar examenes
define('PRIVILEGIO_SUPERADMIN',3); //Admin, que puede nombrar nuevos admin, y borrar/modificar examenes

define('PERMISO_NULO',-1); //Permiso en cátedra: no puede tomar examen
define('PERMISO_BASICO',0); //Permiso en cátedra: puede tomar examen y asociar alumno
define('PERMISO_TOTAL', 1); //Permiso en cátedra: puede tomar examen, cargar y modificar guias, asociar y dar de baja alumnos

define('NO_SELECTED', -1);

define('STATUS_OK', 100);
define('STATUS_EMPTY_POST', 101);
define('STATUS_INVALID_PARAM', 102);



/* End of file constants.php */
/* Location: ./application/config/constants.php */