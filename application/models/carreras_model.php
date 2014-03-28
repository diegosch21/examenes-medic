<?php

/**
 * Modelo carreras
 *
 *@package      models
 *@author       Fernando Andrés Prieto
 *@author       Diego Martín Schwindt
 *@copyright    Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

class Carreras_model extends CI_Model {

	
	public function __construct()
	{

	}


	/**
	 *	Retorna todas las carreras
	 *
	 * @access	public
	 * @return	array - carreras (codigo y nombre)
	 *
	 */

	public function get_carreras()
	{
		$query_string = "SELECT cod_carr,nom_carr FROM carreras";
		$query = $this->db->query($query_string);
		
		return $query->result_array();

	}

	/**
	 *	Retorna las carreras a las que está asociado el docente. 
	 *
	 * @access	public
	 * @param 	$legajo int legajo del docente
	 * @return	array - carreras asociadas al docente (codigo y nombre)
	 *
	 */

	public function get_carreras_docente($legajo)
	{
		$query_string = "SELECT DISTINCT cod_carr,nom_carr
			FROM carreras NATURAL JOIN catedras NATURAL JOIN docentes_catedras NATURAL JOIN docentes
			WHERE leg_doc = ?";
		$query = $this->db->query($query_string,array("000000"));
			
		return $query->result_array();

	}

	
}

/* Fin del archivo file carreras_model.php */
/* Location: ./application/models/carreras_model.php */