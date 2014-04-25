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
	 *	Retorna la catedra de codigo y  de la carrera indicada 
	 *
	 * @access	public
	 * @param 	$cod_carr int codigo de la carrera
	 * @param 	$cod_cat int codigo de la catedra
	 * @return	array - catedra de la carrera (codigo y nombre)
	 *
	 */

	public function get_catedra_carrera($cod_cat,$cod_carr)
	{
		$query_string = "SELECT DISTINCT cod_cat,nom_cat FROM catedras
				WHERE cod_carr = ? AND cod_cat = ?";
		$query = $this->db->query($query_string,array($cod_carr,$cod_cat));
	
		return $query->row_array();
	}

	/**
	 *	Retorna las catedras a las que está asociado el docente, de la carrera indicada.
	 *
	 * @access	public
	 * @param 	$legajo int legajo del docente
	 * @param 	$cod_carrera int codigo de la carrera
	 * @return	array - catedras asociadas al docente y la carrera (codigo y nombre)
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

	/**
	 *	Retorna la catedra de codigo y  de la carrera indicada, verificando asociación al docente 
	 *
	 * @access	public
	 * @param 	$cod_carr int codigo de la carrera
	 * @param 	$cod_cat int codigo de la catedra
	 * @param 	$legajo int legajo del docente
	 * @return	array - catedra de la carrera (codigo y nombre)
	 *
	 */

	public function get_catedra_docente_carrera($cod_cat,$legajo,$cod_carr)
	{
		$query_string = "SELECT DISTINCT cod_cat,nom_cat
				FROM catedras NATURAL JOIN docentes_catedras NATURAL JOIN docentes
				WHERE leg_doc = ? AND cod_carr = ? AND cod_cat = ?";
		$query = $this->db->query($query_string,array($legajo,$cod_carr,$cod_cat));
	
		return $query->row_array();
	}

	/**
	 *	Verifica que una catedra esté asociada al docente 
	 *
	 * @access	public
	 * @param 	$cod_cat int codigo de la catedra
	 * @param 	$legajo int legajo del docente
	 * @return	TRUE: docente asociado a catedra | FALSE: caso contrario.
	 *
	 */

	public function check_catedra_docente($cod_cat,$legajo)
	{
		$query_string = "SELECT * FROM docentes_catedras
				WHERE leg_doc = ? AND cod_cat = ?";
		$query = $this->db->query($query_string,array($legajo,$cod_cat));
	
		return $query->num_rows()>0;
	}

	/**
	 *	Verifica que una catedra esté asociada al docente con permiso mayor o igual al requerido
	 *
	 * @access	public
	 * @param 	$cod_cat int codigo de la catedra
	 * @param 	$legajo int legajo del docente
	 * @param   $permiso int permiso requerido
	 * @return	TRUE: docente asociado a catedra | FALSE: caso contrario.
	 *
	 */

	public function check_catedra_docente_permiso($cod_cat,$legajo,$permiso)
	{
		$query_string = "SELECT * FROM docentes_catedras
				WHERE leg_doc = ? AND cod_cat = ? AND permiso_doc >= ?";
		$query = $this->db->query($query_string,array($legajo,$cod_cat,$permiso));
	
		return $query->num_rows()>0;
	}
	
}

/* Fin del archivo catedras_model.php */
/* Location: ./application/models/catedras_model.php */