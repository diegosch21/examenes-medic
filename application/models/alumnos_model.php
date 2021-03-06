<?php

/**
 * Modelo alumnos
 *
 *@package      models
 *@author       Fernando Andrés Prieto
 *@author       Diego Martín Schwindt
 *@copyright    Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

class Alumnos_model extends CI_Model {

	
	public function __construct()
	{

	}


	/**
	 *	Retorna todos los alumnos asociados a la catedra indicada 
	 *
	 * @access	public
	 * @param 	$cod_catedra int codigo de la catedra
	 * @return	array - datos de los alumnos asociados a la catedra
	 *
	 */

	public function get_alumnos_catedra($cod_catedra)
	{
		$query_string = "SELECT DISTINCT lu_alu,apellido_alu,nom_alu,dni_alu
				FROM alumnos NATURAL JOIN alumnos_catedras 
				WHERE cod_cat = ? ORDER BY lu_alu ASC";
		$query = $this->db->query($query_string,array($cod_catedra));
	
		return $query->result_array();
	}

	/**
	 *	Retorna el alumno de lu indicado, verificando que este asociado a la catedra 
	 *
	 * @access	public
	 * @param 	$lu_alu int lu alumno
	 * @param 	$cod_catedra int codigo de la catedra
	 * @return	array - datos de los alumnos asociados a la catedra
	 *
	 */

	public function get_alumno_catedra($lu_alu,$cod_catedra)
	{
		$query_string = "SELECT DISTINCT lu_alu,apellido_alu,nom_alu,dni_alu
				FROM alumnos NATURAL JOIN alumnos_catedras 
				WHERE lu_alu = ? AND cod_cat = ?";
		$query = $this->db->query($query_string,array($lu_alu,$cod_catedra));
	
		return $query->row_array();
	}

	/**
	 *	Verificando que el alumno este asociado a la catedra 
	 *
	 * @access	public
	 * @param 	$lu_alu int lu alumno
	 * @param 	$cod_catedra int codigo de la catedra
	 * @return	TRUE: alumno asociado a catedra | FALSE: caso contrario.
	 *
	 */

	public function check_alumno_catedra($lu_alu,$cod_catedra)
	{
		$query_string = "SELECT * FROM alumnos_catedras
				WHERE lu_alu = ? AND cod_cat = ?";
		$query = $this->db->query($query_string,array($lu_alu,$cod_catedra));
	
		return $query->num_rows()>0;
	}
	
	
}

/* Fin del archivo alumnos_model.php */
/* Location: ./application/models/alumnos_model.php */