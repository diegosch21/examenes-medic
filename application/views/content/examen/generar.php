<!--
	AUTOR		Fernando Andrés Prieto
	AUTOR		Diego Martín Schwindt
	COPYRIGHT	Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
-->

<script type="text/javascript"  src="<?php echo base_url('assets/js/examen/generar.js'); ?>"></script>
<link type="text/css" href="<?php echo base_url('assets/css/examen/generar.css'); ?>" rel="stylesheet" media="screen"/>

<div id="div-form" class="form-container">

	<div class="div-titulo">
		<label>Generar Examen</label>
	</div>

	<form id="form-generar" class="form-generar" role="form" method="post" action="<?php echo site_url('examen/evaluar');?>">
	
		<div class="form-group-generar">
			<label for="fecha" class="control-label">Fecha</label>
			<div>
				<input id="fecha" class="form-control fecha" type="date" name="fecha" value="<?php echo $fecha;?>"/>
			</div>
			<label id="error-fecha" class="label-error" rel="errores">Fecha inválida</label>
		</div>

		<div class="form-group-generar">
			<div>
				<label for="select-carrera" class="control-label">Carrera</label>
			</div>
			<div>

		<?php

			/* SELECT DE CARRERAS */

			if(!isset($carreras)) // si no existen carreras
			{
				echo 	'<select id="select-carrera" name="carrera" disabled>
						 </select>';
			}
			else
			{ 
				echo '<select id="select-carrera" name="carrera">';

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
		?>
			</div>
			<label id="error-carrera" class="label-error" rel="errores">Carrera inválida</label>
		</div>
		<div class="form-group-generar">
			<div>
				<label for="select-catedra" class="control-label">Cátedra</label>
			</div>
			<div>
		<?php

			/* SELECT DE CATEDRAS */

			if(!isset($catedras)) // si no existen cátedras
			{
				echo 	'<select id="select-catedra" name="catedra" disabled>
						 </select>';
			}
			else
			{ 
				echo '<select id="select-catedra" name="catedra" >';

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
		?>
			</div>
			<label id="error-catedra" class="label-error" rel="errores">Cátedra inválida</label>
		</div>
		<div class="form-group-generar">
			<div>
				<label for="select-guia" class="control-label">Guía</label>
			</div>
			<div>
		<?php

			/* SELECT DE GUIAS */

			if(!isset($guias)) // si no existen guías
			{
				echo 	'<select id="select-guia" name="guia" data-live-search="true" disabled>
						 </select>';
			}
			else
			{ 
				echo '<select id="select-guia" name="guia" data-live-search="true">';

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

		?>
			</div>
			<label id="error-guia" class="label-error" rel="errores">Guía inválida</label>
		</div>
		<div class="form-group-generar">
			<div>
				<label for="select-alumno" class="control-label">Alumno</label>
			</div>
		<div>	
		<?php

			/* SELECT DE ALUMNOS */

			if(!isset($alumnos)) // si no existen alumnos
			{
				echo 	'<select id="select-alumno" name="alumno" data-live-search="true" disabled>
						 </select>';
			}
			else
			{ 
				echo '<select id="select-alumno" name="alumno" data-live-search="true">';

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
			</div>
			<label id="error-alumno" class="label-error" rel="errores">Alumno inválido</label>
		</div>

		<div class="form-group-buttons">
			<a id="btn-cancelar" href="<?php echo site_url('home');?>" class="btn btn-default">Cancelar</a>
			<button id="btn-submit" name="boton" class="btn btn-primary" type="submit">Continuar</button>
		</div>

	</form>

	<?php 
		if(isset($error))
			echo 'Mensaje error: '.$error;
	?>
</div>