<?php

/**
 * Login
 *
 *@package      controllers
 *@author       Fernando Andrés Prieto
 *@author       Diego Martín Schwindt
 *@copyright    Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    
   		$this->load->model('docentes_model');
    }

    /**
     * Carga la vista apropiada dependiendo si es un usuario 
     * se encuentra logueado o debe loguearse.
     *
     * @access  public
     */
    public function index()
    {  
    	if($this->usuario->logueado())
    	{   	
    		if($this->usuario->activo())  // Usuario con cuenta activa. (cambió la contraseña por defecto).
    		{	   		
    			redirect('home');    			
    		}
    		else // El usuario debe activar su cuenta.
    		{
    			redirect('home/activar');  
    		}  
    	}
    	else
    	{     
    		$data['title'] = "Exámenes - Departamento de Ciencias de la Salud";

			$this->load->view('template/header', $data);
		    $this->load->view('content/login/index');
		    $this->load->view('template/footer'); 	  		
    	}
    	
    }

    /**
     * Loguea al usuario
     *
     * @access  public
     */
	public function login()
	{	 
		$this->user->login();
		$this->index();
	}

	/**
     * Desloguea al usuario
     *
     * @access  public
     */
	public function logout()
	{
		$this->user->logout();  
		$this->index();
	}
}    

/* Fin del archivo login.php */
/* Ubicación: ./application/controllers/login.php */