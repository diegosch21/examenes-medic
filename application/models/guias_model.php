<?php

/**
 * Modelo guias
 *
 *@package      models
 *@author       Fernando Andrés Prieto
 *@author       Diego Martín Schwindt
 *@copyright    Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

class Guias_model extends CI_Model {

	
	public function __construct()
	{

	}


	/**
	 *	Retorna todas las guias de la catedra indicada 
	 *
	 * @access	public
	 * @param 	$cod_catedra int codigo de la catedra
	 * @return	array - datos de las guias
	 *
	 */

	public function get_guias_catedra($cod_catedra)
	{
		$query_string = "SELECT DISTINCT id_guia,nro_guia,tit_guia,subtit_guia FROM guias
				WHERE cod_cat = ? ORDER BY nro_guia ASC";
		$query = $this->db->query($query_string,array($cod_catedra));
	
		return $query->result_array();

	}

	
	
}

/* Fin del archivo guias_model.php */
/* Location: ./application/models/guias_model.php */