<?php

/**
 * Modelo exámenes
 *
 *@package      models
 *@author       Fernando Andrés Prieto
 *@author       Diego Martín Schwindt
 *@copyright    Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

class Examenes_model extends CI_Model {

	
	public function __construct()
	{

	}


	/**
	 *	Almacena en la Base de Datos un nuevo  examen
	 *
	 * @access	public
	 * @param 	$id_guia int id de la guia correspondiente
	 * @param 	$lu_alu int lu del alumno que rindió
	 * @param 	$leg_doc int legajo del docente que evaluó
	 * @param 	$fecha timestamp fecha y hora del examen
	 * @param 	$calificacion int calificacion dada al examen (-1,0,1,2: usar constantes)
	 * @param 	$obs_exam string observación general del examen
	 * @param 	$items array(id,estado,obs) arreglo de los items
	 * @param 	$porcentaje_exam float porcentaje de items hechos
	 * @return	int - id_examen
	 *
	 */
	public function guardar_examen($id_guia,$lu_alu,$leg_doc,$fecha,$calificacion,$obs_exam,$items,$porcentaje_exam) 
	{
		//Verifico que no exista un examen con misma guia, alumno, legajo y diferencia de fecha menor a 5 minutos
		$query_string = "SELECT fecha FROM examenes
				WHERE id_guia = ? AND lu_alu = ? AND leg_doc = ? AND TIMESTAMPDIFF(MINUTE,fecha,?) < 5";
		$this->db->query($query_string,array($id_guia,$lu_alu,$leg_doc,$fecha));
		if($this->db->affected_rows() > 0) 
		{
			throw new Exception(ERROR_REPETIDO);
		}
		//Inserto info en la tabla examenes
		if($obs_exam)
		{
			$query_string = "INSERT INTO examenes (id_guia,lu_alu,leg_doc,fecha,calificacion,obs_exam,porcentaje_exam) 
				 VALUES (?,?,?,?,?,?,?)";
			$this->db->query($query_string,array($id_guia,$lu_alu,$leg_doc,$fecha,$calificacion,$obs_exam,$porcentaje_exam));
		}
		else 
		{
			$query_string = "INSERT INTO examenes (id_guia,lu_alu,leg_doc,fecha,calificacion,porcentaje_exam) 
				 VALUES (?,?,?,?,?,?,?)";
			$this->db->query($query_string,array($id_guia,$lu_alu,$leg_doc,$fecha,$calificacion,$porcentaje_exam));
		}
		
		if($this->db->affected_rows() == 0)
		{
			throw new Exception(ERROR_NO_INSERT);
		}
		$id_exam = $this->db->insert_id();
		
		//insert items: Transacción, deben ejecutarse todas.
		$this->db->trans_start();
		foreach ($items as $item)
		{
			if(isset($item['obs']))
			{
				$query_string = "INSERT INTO items_examenes(id_item,id_exam,estado_item,obs_item)
								VALUES (?,?,?,?)";
				$this->db->query($query_string,array($item['id'],$id_exam,$item['estado'],$item['obs']));
			}
			else 
			{
				$query_string = "INSERT INTO items_examenes(id_item,id_exam,estado_item)
								VALUES (?,?,?)";
				$this->db->query($query_string,array($item['id'],$id_exam,$item['estado']));
			}
		}
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
		    $query_string = "DELETE FROM examenes WHERE id_exam = ?";
			$this->db->query($query_string,array($id_exam));
		    throw new Exception(ERROR_NO_INSERT);
		}
		return $id_exam;

	}




	
	
}

/* Fin del archivo examenes_model.php */
/* Location: ./application/models/examenes_model.php */