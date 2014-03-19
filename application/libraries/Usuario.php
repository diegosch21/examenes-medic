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
	public function login($id_usuario)
	{
		$data_usuario = registrado();
		if($data_usuario) 
		{
			$this->CI->session->set_userdata('usuario', $data_usuario);
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
	 * Verifica que el usuario se encuentre registrado en la BD.
	 * Retorna los datos del usuario si este se encuentra en la BD.
	 */
	public function registrado()
	{
		return $this->CI->docentes_model->getInformacionBasica($this->profile('id'));
	}

	/*
	 * Verifica que el usuario se encuentre logueado (se encuentra en la sesión).
	 * Retorna la información del usuario guardada en la sesión.
	 */
	public function logueado()
    {
    	return $this->CI->session->userdata('usuario');	
    }
    
    /*
     * Obtiene el campo especificado por $campo de la información
     * correspondiente al usuario guadada en la sesión.
     * Retorna false si el usuario no esta logueado.
     */
	public function getInformacionUsuario($campo)
	{

		$data_usuario = logueado();

		if($data_usuario)
		{
			return $data_usuario[$campo];
		}
		
		return false;
	}
}