<!--
	AUTOR		Fernando Andrés Prieto
	AUTOR		Diego Martín Schwindt
	COPYRIGHT	Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
-->

<script type="text/javascript"  src="<?php echo base_url('assets/js/examen/generar.js'); ?>"></script>
<link type="text/css" href="<?php echo base_url('assets/css/examen/generar.css'); ?>" rel="stylesheet" media="screen"/>

<div id="div-content">

	<form action="<?php echo site_url('examen/generar');?>" method="post">

		<?php

			/* SELECT DE CARRERAS */

			if(!isset($carreras)) // si no existen carreras
			{
				echo 	'<select id="select-carrera" name="carrera" data-live-search="true" disabled>
							<option value="'.NO_SELECTED.'">Seleccione una Carrera</option>
						 </select>';
			}
			else
			{ 
				echo '<select id="select-carrera" name="carrera" data-live-search="true">
							<option value="'.NO_SELECTED.'">Seleccione una Carrera</option>';

				foreach ($carreras['list'] as $indice => $carrera): 

					if($indice == $carreras['selected'])
					{
						echo '<option value="'.$carrera['cod_carr'].'" selected = "selected">'.$carrera['cod_carr']." - ".$carrera['nom_carr'].'</option>';
					}
					else
					{
						echo '<option value="'.$carrera['cod_carr'].'">'.$carrera['cod_carr']." - ".$carrera['nom_carr'].'</option>';
					}

				endforeach; 

				echo '</select>';
			}

			/* SELECT DE CATEDRAS */

			if(!isset($catedras)) // si no existen cátedras
			{
				echo 	'<select id="select-catedra" name="catedra" data-live-search="true" disabled>
							<option value="'.NO_SELECTED.'">Seleccione una Cátedra</option>
						 </select>';
			}
			else
			{ 
				echo '<select id="select-catedra" name="catedra" data-live-search="true">
							<option value="'.NO_SELECTED.'">Seleccione una Cátedra</option>';

				foreach ($catedras['list'] as $indice => $catedra): 
					if($indice == $catedras['selected'])
					{
						echo '<option value="'.$catedra['cod_cat'].'" selected = "selected">'.$catedra['cod_cat'].' - '.$catedra['nom_cat'].'</option>';
					}
					else
					{
						echo '<option value="'.$catedra['cod_cat'].'">'.$catedra['cod_cat'].' - '.$catedra['nom_cat'].'</option>';
					}

				endforeach; 
				echo '</select>';
			}

			/* SELECT DE GUIAS */

			if(!isset($guias)) // si no existen guías
			{
				echo 	'<select id="select-guia" name="guia" data-live-search="true" disabled>
							<option value="'.NO_SELECTED.'">Seleccione una Guía</option>
						 </select>';
			}
			else
			{ 
				echo '<select id="select-guia" name="guia" data-live-search="true">
							<option value="'.NO_SELECTED.'">Seleccione una Guía</option>';

				foreach ($guias['list'] as $indice => $guia): 
					if($indice == $guias['selected'])
					{
						echo '<option value="'.$guia['id_guia'].'" selected = "selected">'.$guia['nro_guia'].' - '.$guia['tit_guia'].'</option>';
					}
					else
					{
						echo '<option value="'.$guia['id_guia'].'">'.$guia['nro_guia'].' - '.$guia['tit_guia'].'</option>';
					}

				endforeach; 
				echo '</select>';
			}

			/* SELECT DE ALUMNOS */

			if(!isset($alumnos)) // si no existen alumnos
			{
				echo 	'<select id="select-alumno" name="alumno" data-live-search="true" disabled>
							<option value="'.NO_SELECTED.'">Seleccione un Alumno</option>
						 </select>';
			}
			else
			{ 
				echo '<select id="select-alumno" name="alumno" data-live-search="true">
							<option value="'.NO_SELECTED.'">Seleccione una Alumno</option>';

				foreach ($alumnos['list'] as $indice => $alumno): 
					if($indice == $alumnos['selected'])
					{
						echo '<option value="'.$alumno['lu_alu'].'" selected = "selected">'.$alumno['lu_alu'].' - '.$alumno['apellido_alu'].', '.$alumno['nom_alu'].'</option>';
					}
					else
					{
						echo '<option value="'.$alumno['lu_alu'].'">'.$alumno['lu_alu'].' - '.$alumno['apellido_alu'].', '.$alumno['nom_alu'].'</option>';
					}

				endforeach; 
				echo '</select>';
			}
		?>

		<a id="btn-cancelar" href="" class="btn btn-default">Cancelar</a>
		<input id="btn-submit" class="btn btn-primary" type="submit" value="Continuar">	
	</form>
</div>