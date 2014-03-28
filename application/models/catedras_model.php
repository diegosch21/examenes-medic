<?php

/**
 * Modelo catedras
 *
 *@package      models
 *@author       Fernando Andrés Prieto
 *@author       Diego Martín Schwindt
 *@copyright    Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

class Catedras_model extends CI_Model {

	
	public function __construct()
	{

	}


	/**
	 *	Retorna todas las catedras de la carrera indicada 
	 *
	 * @access	public
	 * @param 	$cod_carrera int codigo de la carrera
	 * @return	array - todas las catedras de la carrera (codigo y nombre)
	 *
	 */

	public function get_catedras_carrera($cod_carrera)
	{
		$query_string = "SELECT DISTINCT cod_cat,nom_cat FROM catedras
				WHERE cod_carr = ? ORDER BY cod_cat ASC";
		$query = $this->db->query($query_string,array($cod_carrera));
	
		return $query->result_array();

	}

	/**
	 *	Retorna las catedras a las que está asociado el docente, de la carrera indicada.
	 *
	 * @access	public
	 * @param 	$legajo int legajo del docente
	 * @param 	$cod_carrera int codigo de la carrera
	 * @return	array - catedra asociadas al docente y la carrera (codigo y nombre)
	 *
	 */
	public function get_catedras_docente_carrera($legajo,$cod_carrera)
	{
		$query_string = "SELECT DISTINCT cod_cat,nom_cat
				FROM catedras NATURAL JOIN docentes_catedras NATURAL JOIN docentes
				WHERE leg_doc = ? AND cod_carr = ? ORDER BY cod_cat ASC";
		$query = $this->db->query($query_string,array($legajo,$cod_carrera));
			
		return $query->result_array();

	}
	
}

/* Fin del archivo catedras_model.php */
/* Location: ./application/models/catedras_model.php */