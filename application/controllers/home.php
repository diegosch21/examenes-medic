<?php 

/**
 * Home
 *
 *@package      controllers
 *@author       Fernando Andrés Prieto
 *@author       Diego Martín Schwindt
 *@copyright    Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    private $docente;

	public function __construct()
    {
        parent::__construct();
    
        if($this->usuario->logueado())
   		{
            $this->load->model('docentes_model');
        }
        else
        {
            redirect('login');
        }
    }


	/**
     * Carga la vista apropiada dependiendo si el usuario 
     * se encuentra activo o no.
     *
     * @access  public
     */
    public function index()
    { 
        $data['title'] = "Exámenes - Departamento de Ciencias de la Salud";          
        $data['navbar']['nombre'] = $this->usuario->get_info_sesion_usuario('nom_doc'); 
        $data['navbar']['apellido'] = $this->usuario->get_info_sesion_usuario('apellido_doc');  
  
        if($this->usuario->activo()) {
            $data['activo'] =  TRUE;

            $this->load->view('template/header', $data); 
            $this->load->view('content/home/index');
        }
        else {
            $data['activo'] =  FALSE; 

            $this->load->view('template/header', $data); 
            $this->load->view('content/home/activar');
        }

        $this->load->view('template/footer');  
    }
}    

/* Fin del archivo home.php */
/* Ubicación: ./application/controllers/home.php */