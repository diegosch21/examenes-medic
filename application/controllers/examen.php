<?php 

/**
 * Controlador Examen. Encargado de la generación de un examen (armado de listas de catedras, guias y alumnos),
 * evaluación, y almacenamiento en la BD
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
     * Controlador de la pagina de seleccion de catedra-guia-alumno
     *  
     * En POST se pueden mandar selecciones default: carrera (codigo), catedra (codigo), guia (id), alumno (lu)
     * 
     * @param $selects array - Arreglo con las opciones seleccionadas por defecto (ej: $selects['carrera'] = codigo)
     * @access  public
     */
    public function generar($selects = NULL)
    { 
        $this->view_data['title'] = "Generar Examen - Departamento de Ciencias de la Salud";          
        $this->load->view('template/header', $this->view_data);
        
        //FECHA ACTUAL
        $this->view_data['fecha'] = date('d/m/Y');
        
        //LISTA CARRERAS
        $carreras = $this->_carreras();
        //DEBUG
        //echo 'Carreras del docente:<br/>';
        //foreach ($carreras as $fila)
        //    var_dump($fila); echo '<br/>';

        if(count($carreras)>0)  //si no hay carreras no manda datos a la view
        {
            $this->view_data['carreras']['list'] = $carreras;  //en la view: $carreras['list'][indice]['cod_carr'].
            $index_carrera = 0; //Por defecto, primer carrera

            //Busco en post si hay carrera seleccionada por default, y actualiza el index seleccionado de la lista
            $cod_carr_default = $this->input->post('carrera') ;
            if($cod_carr_default)
            {
                $index_carrera = $this->util->buscar_indice($carreras,'cod_carr',$cod_carr_default);
                //Si el codigo es erroneo, queda no_selected
            }
                
            $this->view_data['carreras']['selected'] = $index_carrera;

            //Si no hay carrera seleccionada, las demas listas están vacías.
            if($index_carrera >= 0 && isset($carreras[$index_carrera]))
            {
                $carrera = $carreras[$index_carrera];   //Carrera seleccionada

                //LISTA CATEDRAS DE LA CARRERA
                $catedras = $this->_catedras($carrera['cod_carr']); 
                //DEBUG
                //echo 'Catedras del docente de '.$carrera['nom_carr'].':<br/>';
                //foreach ($catedras as $fila)
                //    var_dump($fila); echo '<br/>';
                
        
                if(count($catedras)>0)  //si no hay catedras no manda datos a la view
                {
                    $this->view_data['catedras']['list'] = $catedras;  //en la view: $catedras['list'][indice]['cod_cat'].
                    $index_catedra = 0; //Por defecto, primera catedra

                    //Busco en post si hay catedra seleccionada por default, y actualiza el index seleccionado de la lista
                    $cod_cat_default = $this->input->post('catedra') ;
                    if($cod_cat_default)
                    {
                        $index_catedra = $this->util->buscar_indice($catedras,'cod_cat',$cod_cat_default);
                    }
                    
                    $this->view_data['catedras']['selected'] = $index_catedra;

                    //Si no hay catedra seleccionada, las demas listas están vacías.
                    if($index_catedra >= 0 && isset($catedras[$index_carrera]))
                    {
                        $catedra= $catedras[$index_catedra];   //Catedra seleccionada

                        //LISTA GUIAS DE LA CATEDRA
                        $guias = $this->_guias($catedra['cod_cat']);
                        
                        //DEBUG
                        //echo 'Guias de la catedra '.$catedra['nom_cat'].':<br/>';
                        //foreach ($guias as $fila) 
                        //   var_dump($fila); echo '<br/>';
                        
                    
                        if(count($guias)>0)  //si no hay guias no manda datos a la view
                        {
                            $this->view_data['guias']['list'] = $guias;  //en la view: $guias['list'][indice]['id_guia'].
                            $index_guia = NO_SELECTED; //Por defecto, no seleccionada

                            //Busco en post si hay guia seleccionada por default, y actualiza el index seleccionado de la lista
                            $id_guia_default = $this->input->post('guia') ;
                            if($id_guia_default) 
                            {
                                $index_guia = $this->util->buscar_indice($guias,'id_guia',$id_guia_default);
                            }
                            $this->view_data['guias']['selected'] = $index_guia;

                        } //hay guias

                        //LISTA ALUMNOS DE LA CATEDRA
                        $alumnos = $this->_alumnos($catedra['cod_cat']);
                        //DEBUG
                        //echo 'alumnos de la catedra '.$catedra['nom_cat'].':<br/>';
                        //foreach ($alumnos as $fila) 
                        //    var_dump($fila); echo '<br/>';
                        
                      
                        if(count($alumnos)>0)  //si no hay guias no manda datos a la view
                        {
                            $this->view_data['alumnos']['list'] = $alumnos;  //en la view: $alumnos['list'][indice]['lu_alu'].
                            $index_alumno = NO_SELECTED; //Por defecto, no seleccionado

                            //Busco en post si hay guia seleccionada por default, y actualiza el index seleccionado de la lista
                            $lu_alu_default = $this->input->post('alumno') ;
                            if($lu_alu_default) 
                            {
                                $index_alumno = $this->util->buscar_indice($alumnos,'lu_alu',$lu_alu_default);
                            }
                            $this->view_data['alumnos']['selected'] = $index_alumno;

                        } //hay alumnos

                    } //hay catedra seleccionada
                }//hay catedras
            }// hay carrera seleccionada
        }//hay carreras
        
        $this->load->view('content/examen/generar', $this->view_data);

        $this->load->view('template/footer');  
    }

    /**
     * Devuelve arreglo con las carreras correspondientes al usuario
     *
     * @access  private
     * @return  array  - lista de carreras del usuario
     */
    function _carreras() 
    {
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
    function _catedras($cod_carr) 
    {
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
    function _guias($cod_cat) 
    {
        return $this->guias_model->get_guias_catedra($cod_cat);
    }

    /**
     * Devuelve arreglo con los alumnos correspondientes a la catedra elegida
     *
     * @param   $cod_cat int codigo catedra
     * @access  private
     * @return  array  - lista de alumnos de la catedra elegida
     */
    function _alumnos($cod_cat) 
    {
        return $this->alumnos_model->get_alumnos_catedra($cod_cat);
    }

    /**
     * Controlador de la lista de catedras (accedido mediante AJAX). Retorna JSON
     *  
     * En POST se envia parametro: carrera (codigo)
     * 
     * @access  public
     */
    public function get_catedras()
    {
        $cod_carr = $this->input->post('carrera') ;
        if($cod_carr)
        {
            $catedras = $this->_catedras($cod_carr); 
            if(count($catedras)>0)
                $this->util->json_response(TRUE,STATUS_OK,$catedras);    
            else
                $this->util->json_response(FALSE,STATUS_INVALID_PARAM,""); 
        }
        else
            $this->util->json_response(FALSE,STATUS_EMPTY_POST,"");
    }

    /**
     * Controlador de la lista de guias y alumnos (accedido mediante AJAX). Retorna JSON
     *  
     * En POST se envia parametro: catedra (codigo)
     * 
     * @access  public
     */
    public function get_guias_alumnos()
    {
        $cod_cat = $this->input->post('catedra') ;
        if($cod_cat)
        {
            $guias = $this->_guias($cod_cat); 
            $alumnos = $this->_alumnos($cod_cat); 
            
            $this->util->json_response(TRUE,STATUS_OK,array('guias' => $guias,'alumnos' => $alumnos));    
            
        }
        else
            $this->util->json_response(FALSE,STATUS_EMPTY_POST,"");
    }

    /**
     * Controlador de la pagina de muestra de la guia para evaluar
     *  
     * En POST se reciben las opciones seleccionadas: carrera (codigo), catedra (codigo), guia (id), alumno (lu)
     * 
     * @param $seleccion array - Arreglo con las opciones seleccionadas (ej: $seleccion['carrera'] = codigo)
     * @access  public
     */
    public function evaluar($seleccion = NULL)
    {
        $this->view_data['title'] = "Evaluar Guía - Departamento de Ciencias de la Salud";          
        $this->load->view('template/header', $this->view_data);

        $this->load->view('content/examen/evaluar', $this->view_data);

        $this->load->view('template/footer'); 
    }


}    

/* Fin del archivo examen.php */
/* Ubicación: ./application/controllers/examen.php */