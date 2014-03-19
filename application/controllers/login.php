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

class Login extends CI_Controller {

	

	public function __construct()
    {
        parent::__construct();
    
   		$this->load->model('docentes_model');
    }


	public function index()
	{
		$this->load->view('welcome_message');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/login.php */