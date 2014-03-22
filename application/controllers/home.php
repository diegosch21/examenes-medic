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

class Home extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    
   		$this->load->model('docentes_model');
    }


	/*
     * Carga la vista apropiada dependiendo de si es un usuario 
     * que debe loguearse, o se encuentra logueado.
     */
    public function index()
    { 
    	$data['title'] = "Exámenes - Departamento de Ciencias de la Salud";

    	if(!$this->user->logueado())
    	{      				              						              
			$this->load->view('template/header', $data); 			
		    $this->load->view('content/index');
		    $this->load->view('template/footer'); 	  		
    	}
    	else
    	{    		
    		if($this->user->activo())
    		{	   		
    			redirect('home');    			
    		}
    		else 
    		{
    			redirect('home/activar');  
    		}    		
    	}
    }
}    

/* Fin del archivo home.php */
/* Ubicación: ./application/controllers/home.php */

?>