<?php

/**
 * Usuario
 *
 *@package      libraries
 *@author       Fernando Andrés Prieto
 *@author       Diego Martín Schwindt
 *@copyright    Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
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

	/**
	 * Loguea al usuario y setea su información básica en la sesión (id, nombre, apellido).
	 * Retorna true si el login se realizó con éxito, false en caso contrario.
	 *
	 * @access	public
	 * @param	string $legajo
	 * @param	string $password
	 * @return	bool - true si el login se realizó con éxito, false en caso contrario
	 */
	public function login($legajo, $password)
	{
		$data_usuario = $this->CI->docentes_model->get_credenciales($legajo, $password);

		if($data_usuario) 
		{
			$this->CI->session->set_userdata('usuario', $data_usuario);
			return true;
		}
		
		return false;
	}

	/**
	 * Desloguea al usuario destruyendo la sesión activa.
	 * @access	public
	 */
	public function logout()
	{
		$this->CI->session->sess_destroy(); 
	}	

	/**
	 * Verifica que el usuario se encuentre logueado (se encuentra en la sesión).
	 * Retorna la información del usuario guardada en la sesión.
	 *	Si la sesión expiró, retorna nulo.
	 *
	 * @access	public
	 * @return 	array | null
	 */
	public function logueado()
    {
    	return $this->CI->session->userdata('usuario');	
    }
    
    /**
	 * Obtiene el campo especificado por $campo de la información
     * correspondiente al usuario guadado en la sesión.
	 *
	 * @access	public
	 * @param	string $campo
	 * @return 	array | null
 	 */
	public function get_info_sesion_usuario($campo)
	{

		$data_usuario = logueado();

		return $data_usuario[$campo];
	}

	/**
	 * Setea el campo especificado por $campo de la información
     * correspondiente al usuario guadado en la sesión.
	 *
	 * @access	public
	 * @param	string $campo
	 * @param	string $valor
	 */
	public function setInfoSesionUsuario($campo, $valor)
	{

		$data_usuario = logueado();
		if($data_usuario) {
			$data_usuario[$campo] = $valor;
			$this->CI->session->set_userdata('usuario',$data_usuario);
		}

	}

	/**
	 * Verifica que el usuario haya sido activado.
	 * Retorna true si el usuario se encuentra activo, false en caso contrario.
	 *
	 * @access	public
	 * @return	bool
	 */
	public function activo()
	{
		return $this->get_info_sesion_usuario('activo'); 
	}

	/**
	 * Verifica que el usuario tenga permiso de acceso.
	 *
	 * @access	public
	 * @return	bool - true si está logueado, activo, y su privilegio es mayor o igual al requerido (por default, 0)
	 */
	public function acceso_permitido($privilegio = PRIVILEGIO_DOCENTE)
	{
		return  $this->logueado() && 
				$this->activo() &&
				$this->get_info_sesion_usuario('privilegio') >= $privilegio;
	}
}

/* Fin del archivo file Usuario.php */
/* Ubicación: ./application/libraries/Usuario.php */