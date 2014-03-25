<?php 

/**
 * Controlador Examen
 *
 *@package      controllers
 *@author       Fernando Andrés Prieto
 *@author       Diego Martín Schwindt
 *@copyright    Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Examen extends CI_Controller {

    private $view_data;
    
	public function __construct()
    {
        parent::__construct();
    
        if($this->usuario->acceso_permitido(PRIVILEGIO_DOCENTE)) 
   		{
            $this->view_data['navbar']['nombre'] = $this->usuario->get_info_sesion_usuario('nom_doc'); 
            $this->view_data['navbar']['apellido'] = $this->usuario->get_info_sesion_usuario('apellido_doc');
            $this->view_data['activo'] = $this->usuario->activo(); 
        }
        else if($this->usuario->logueado()) //no tiene privilegio, pero esta logueado
        { 
            redirect('home/index/error_privilegio');

        }
        else
        {
            redirect('login');
        }
    }


	/**
     * Redirecciona al controlador correspondiente a la actividad actual del usuario
     *
     * @access  public
     */
    public function index()
    {
        $actividad_actual = $this->usuario->get_actividad_actual();
        if($actividad_actual == FALSE || $actividad_actual=='generar_examen' )
            redirect('examen/generar');
        //else
        //    redirect(....)
    }

    /**
     * Redirecciona al controlador correspondiente a la actividad actual del usuario
     *
     * @param array $selects Arreglo con las opciones seleccionadas por defecto (ej: $selects['carrera'] = codigo)
     * @access  public
     */
    public function generar($selects = NULL)
    { 
        $this->view_data['title'] = "Generar Examen - Departamento de Ciencias de la Salud";          
        $this->load->view('template/header', $this->view_data);
        
        $this->load->view('content/examen/generar', $this->view_data);
        

        $this->load->view('template/footer');  
    }
}    

/* Fin del archivo home.php */
/* Ubicación: ./application/controllers/home.php */