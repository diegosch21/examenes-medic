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
    private $legajo;
    private $privilegio;
    
	public function __construct()
    {
        parent::__construct();
    
        if($this->usuario->acceso_permitido(PRIVILEGIO_DOCENTE)) 
   		{
            $this->view_data['navbar']['nombre'] = $this->usuario->get_info_sesion_usuario('nom_doc'); 
            $this->view_data['navbar']['apellido'] = $this->usuario->get_info_sesion_usuario('apellido_doc');
            $this->view_data['activo'] = $this->usuario->activo(); 

            $this->legajo = $this->usuario->get_info_sesion_usuario('leg_doc');
            $this->privilegio = $this->usuario->get_info_sesion_usuario('privilegio'); 

            $this->load->model(array('carreras_model','catedras_model','guias_model', 'alumnos_model'));
                
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

        
        //LISTA CARRERAS
        $carreras = $this->_carreras();

        //DEBUG
        echo 'Carreras del docente:<br/>';
        foreach ($carreras as $fila)
        {
            var_dump($fila); echo '<br/>';
        }


        //Carrera seleccionada
        if(isset($carreras[0]))
            $carrera = $carreras[0];     //elegir de la select
        if(isset($carrera) && $carrera)
        {
            
            //LISTA CATEDRAS DE LA CARRERA
            $catedras = $this->_catedras($carrera['cod_carr']);   

            //DEBUG
            echo 'Catedras del docente de '.$carrera['nom_carr'].':<br/>';
            foreach ($catedras as $fila) 
            {
                var_dump($fila); echo '<br/>';
            }
        }

        //CATEDRA SELECCIONADA
        if(isset($catedras[0]))
            $catedra = $catedras[0];     //elegir de la select
        if(isset($catedra) && $catedra)
        {
            //LISTA GUIAS DE LA CATEDRA
            $guias = $this->_guias($catedra['cod_cat']);

            //DEBUG
            echo 'Guias de la catedra '.$catedra['nom_cat'].':<br/>';
            foreach ($guias as $fila) 
            {
                var_dump($fila); echo '<br/>';
            }

            //LISTA ALUMNOS DE LA CATEDRA
            $alumnos = $this->_alumnos($catedra['cod_cat']);

            //DEBUG
            echo 'alumnos de la catedra '.$catedra['nom_cat'].':<br/>';
            foreach ($alumnos as $fila) 
            {
                var_dump($fila); echo '<br/>';
            }
        }

        
        $this->load->view('content/examen/generar', $this->view_data);
        

        $this->load->view('template/footer');  
    }

    /**
     * Devuelve arreglo con las carreras correspondientes al usuario
     *
     * @access  private
     * @return  array  - lista de carreras del usuario
     */
    function _carreras() {
        if($this->privilegio>=PRIVILEGIO_ADMIN)  //si es admin muestra todas las carreras
            $carreras = $this->carreras_model->get_carreras();
        else
            $carreras = $this->carreras_model->get_carreras_docente($this->legajo);
        return $carreras;

    }

    /**
     * Devuelve arreglo con las catedras correspondientes al usuario y la carrera elegida
     *
     * @param   $cod_carr int codigo carrera 
     * @access  private
     * @return  array  - lista de catedras del usuario y la carrera
     */
    function _catedras($cod_carr) {
        
        if($this->privilegio>=PRIVILEGIO_ADMIN)  //si es admin muestra todas las catedras de la carrera
                $catedras = $this->catedras_model->get_catedras_carrera($cod_carr);
            else
                $catedras = $this->catedras_model->get_catedras_docente_carrera($this->legajo,$cod_carr);
        return $catedras;

    }

    /**
     * Devuelve arreglo con las guias correspondientes a la catedra elegida
     *
     * @param   $cod_cat int codigo catedra
     * @access  private
     * @return  array  - lista de guias de la catedra elegida
     */
    function _guias($cod_cat) {
        
        return $this->guias_model->get_guias_catedra($cod_cat);

    }

    /**
     * Devuelve arreglo con los alumnos correspondientes a la catedra elegida
     *
     * @param   $cod_cat int codigo catedra
     * @access  private
     * @return  array  - lista de alumnos de la catedra elegida
     */
    function _alumnos($cod_cat) {
        
        return $this->alumnos_model->get_alumnos_catedra($cod_cat);

    }

}    

/* Fin del archivo examen.php */
/* Ubicación: ./application/controllers/examen.php */