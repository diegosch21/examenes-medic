<?php

/**
	* ========================================================================================
	* Autores: FERNANDO ANDRES PRIETO - DIEGO MARTIN SCHWINDT
	*
	* Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
	*
	* Fecha: Marzo, 2014.
	* ========================================================================================
*/

	class Docentes_model extends CI_Model 
	{
		public function __construct()
		{
			$this->load->database();
		}

		/*
		 * Retorna la información básica de. docente con legajo = $legajo y password = $password
		 */
		public function getCredenciales($legajo, $password)
		{
			$query_string = "SELECT leg_doc, apellido_doc, nom_doc, activo, privilegio FROM docentes WHERE leg_doc = {$legajo} AND pass = MD5('{$password}')";

			$query = $this->db->query($query_string);
	
			return $query->result_array();
		}
		
	}

/* Fin del archivo file docentes_model.php */
/* Location: ./application/models/docentes_model.php */

?>