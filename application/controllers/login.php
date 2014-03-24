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
     * Carga la vista apropiada dependiendo si el usuario 
     * se encuentra logueado o debe loguearse.
     *
     * @access  public
     */
    public function index()
    {  
    	if($this->usuario->logueado())
    	{   	
    		redirect('home');   
    	}
    	else
    	{     
    		$data['title'] = "Departamento de Ciencias de la Salud";

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
	public function loguear_usuario()
	{	 
        $legajo = $this->input->post('legajo');
        $password = $this->input->post('password');

        $this->usuario->login($legajo, $password);
        $this->index();                    
	}

	/**
     * Desloguea al usuario
     *
     * @access  public
     */
	public function desloguear_usuario()
	{
		$this->usuario->logout();  
		$this->index();
	}

}    

/* Fin del archivo login.php */
/* Ubicación: ./application/controllers/login.php */