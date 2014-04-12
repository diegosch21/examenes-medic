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

	/**
	 *	Retorna la guia de la catedra e id indicados
	 *
	 * @access	public
	 * @param 	$cod_cat int codigo de la catedra
	 * @param 	$id_guia int id de la guia
	 * @return	array - dato de las guia
	 *
	 */

	public function get_guia_catedra($id_guia,$cod_cat)
	{
		$query_string = "SELECT DISTINCT id_guia,nro_guia,tit_guia,subtit_guia FROM guias
				WHERE cod_cat = ? AND id_guia = ?";
		$query = $this->db->query($query_string,array($cod_cat,$id_guia));
	
		return $query->row_array();
	}

	/**
	 *	Verifica que la guia este asociada a la catedra
	 *
	 * @access	public
	 * @param 	$cod_cat int codigo de la catedra
	 * @param 	$id_guia int id de la guia
	 * @return	array - dato de las guia
	 *
	 */

	public function check_guia_catedra($id_guia,$cod_cat)
	{
		$query_string = "SELECT * FROM guias
				WHERE cod_cat = ? AND id_guia = ?";
		$query = $this->db->query($query_string,array($cod_cat,$id_guia));
	
		return $query->num_rows()>0;
	}

	/**
	 *	Retorna todos los items de la guia
	 *
	 * @access	public
	 * @param 	$id_guia int id de la guia
	 * @return	array de items - item: id,pos,nro_seccion,nombre_seccion,nro_grupoitem,nombre_grupoitem,nro_item,nombre_item,solo_texto
	 *
	 */

	public function get_items($id_guia)
	{
		$query_string = "SELECT id_item,pos_item,nro_sec,nom_sec,nro_grupoitem,nom_grupoitem,nro_item,nom_item,solo_texto 
			FROM items NATURAL LEFT JOIN items_guias NATURAL LEFT JOIN secciones NATURAL LEFT JOIN grupositems 
			WHERE id_guia = ? ORDER BY pos_item ASC";
		$query = $this->db->query($query_string,array($id_guia));
	
		return $query->result_array();
	}

	/**
	 *	Retorna las descripciones de la guia
	 *
	 * @access	public
	 * @param 	$id_guia int id de la guia
	 * @return	array de descripciones - desc: nom_desc,contenido_desc
	 *
	 */

	public function get_descripciones($id_guia)
	{
		$query_string = "SELECT nom_desc,contenido_desc
			FROM descripciones
			WHERE id_guia = ?";
		$query = $this->db->query($query_string,array($id_guia));
	
		return $query->result_array();
	}

	/**
	 *	Retorna las lista de itemes del estudiante
	 *
	 * @access	public
	 * @param 	$id_guia int id de la guia
	 * @return	array de items_estudiante - item_estudiante: nro_item,nom_itemest
	 *
	 */

	public function get_itemsestudiante($id_guia)
	{
		$query_string = "SELECT nro_item,nom_itemest
			FROM itemsestudiante NATURAL JOIN itemsestudiante_guias NATURAL JOIN guias 
			WHERE id_guia = ?";
		$query = $this->db->query($query_string,array($id_guia));
	
		return $query->result_array();
	}



	
	
}

/* Fin del archivo guias_model.php */
/* Location: ./application/models/guias_model.php */