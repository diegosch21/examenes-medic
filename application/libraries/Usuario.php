<?php
/**
	* ========================================================================================
	* Autores: FERNANDO ANDRES PRIETO - DIEGO MARTIN SCHWINDT
	*
	* Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
	*
	* Fecha: Marzo, 2014.
	* ========================================================================================
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario
{
	private $CI;
	
	
	function __construct()
	{            
        $this->CI =& get_instance();
        $this->CI->load->model('docentes_model');
	}

	/*
	 * Loguea al usuario y setea su información básica en la sesión (id, nombre, apellido).
	 * Retorna true si el login se realizó con éxito, false en caso contrario.
	 */
	public function login($legajo, $password)
	{
		$docente = $this->CI->docentes_model->getCredenciales($legajo, $password);

		if($docente) 
		{
			$this->CI->session->set_userdata('usuario', $docente);
			return true;
		}
		
		return false;
	}

	/*
	 * Desloguea al usuario destruyendo la sesión activa.
	 */
	public function logout()
	{
		$this->CI->session->sess_destroy(); 
	}	

	/*
	 * Verifica que el usuario se encuentre logueado (se encuentra en la sesión).
	 * Retorna la información del usuario guardada en la sesión.
	 *	Si la sesión expiró, retorna nulo.
	 */
	public function logueado()
    {
    	return $this->CI->session->userdata('usuario');	
    }
    
    /*
     * Obtiene el campo especificado por $campo de la información
     * correspondiente al usuario guadado en la sesión.
     */
	public function getInfoSesionUsuario($campo)
	{

		$data_usuario = logueado();

		return $data_usuario[$campo];
	}

	/*
     * Setea el campo especificado por $campo de la información
     * correspondiente al usuario guadado en la sesión.
     */
	public function setInfoSesionUsuario($campo,$valor)
	{

		$data_usuario = logueado();
		if($data_usuario) {
			$data_usuario[$campo] = $valor;
			$this->CI->session->set_userdata('usuario',$data_usuario);
		}

	}

	/*
	 * Verifica que el usuario se activo.
	 * Retorna true si el usuario se encuentra activo, false en caso contrario.
	 */
	public function activo()
	{
		return $this->getInfoSesionUsuario('activo'); 
	}

	/*
	 *  Verifica que el usuario tenga acceso:
	 *	Retorna true si está logueado, activo, y su privilegio es mayor o igual al requerido (por default, 0)
	 */

	public function accesoPermitido($privilegio = PRIVILEGIO_DOCENTE)
	{
		return  $this->logueado() && 
				$this->activo() &&
				$this->getInfoSesionUsuario('privilegio') >= $privilegio;
	}
}

/* Fin del archivo file Usuario.php */
/* Location: ./application/libraries/Usuario.php */

?>