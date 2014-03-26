<?php

/**
 * Modelo docentes
 *
 *@package      models
 *@author       Fernando Andrés Prieto
 *@author       Diego Martín Schwindt
 *@copyright    Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

class Docentes_model extends CI_Model {

	private $docente_actual;
	
	public function __construct()
	{
		$this->docente_actual = $this->usuario->logueado();
	}

	/**
	 * Retorna la información básica del docente, si el legajo y el password son válidos
	 *
	 * @access	public
	 * @param	string $legajo
	 * @param	string $password
	 * @return	array - datos del docente | NULL si legajo y/o password no son validos
	 */
	public function get_credenciales($legajo, $password)
	{
		$query_string = "SELECT leg_doc,apellido_doc,nom_doc,dni_doc,email_doc,tel_doc,activo,privilegio FROM docentes WHERE leg_doc = ? AND pass = MD5(?)";

		$query = $this->db->query($query_string,array($legajo,$password));

		return $query->row_array();
	}


	
	
}

/* Fin del archivo file docentes_model.php */
/* Location: ./application/models/docentes_model.php */