<!--
	AUTOR		Fernando Andrés Prieto
	AUTOR		Diego Martín Schwindt
	COPYRIGHT	Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
-->

<script type="text/javascript"  src="<?php echo base_url('assets/js/examen/generar.js'); ?>"></script>
<link type="text/css" href="<?php echo base_url('assets/css/examen/generar.css'); ?>" rel="stylesheet" media="screen"/>

<div id="div-form">

	<form class="form form-horizontal form-generar" role="form" method="post" action="<?php echo site_url('examen/evaluar');?>">

		<h2 class="form-login-heading">Generar Examen</h2>

		<div class="form-group form-group-generar">
			<label for="fecha" class="col-xs-12 control-label">Fecha</label>
			<div class="col-xs-12">
				<input id="fecha" class="form-control" type="date" name="fecha"/>
			</div>
		</div>

		<div class="form-group form-group-generar">
			<label for="fecha" class="col-xs-12 control-label">Carrera</label>
			<div class="col-xs-12 ">

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
		</div>
		<div class="form-group form-group-generar">
			<label for="fecha" class="col-xs-12 control-label">Cátedra</label>
			<div class="col-xs-12">
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
		</div>
		<div class="form-group form-group-generar">
			<label for="fecha" class="col-xs-12 control-label">Guía</label>
			<div class="col-xs-12">
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
		</div>
		<div class="form-group form-group-generar">
			<label for="fecha" class="col-xs-12 control-label">Alumno</label>
			<div class="col-xs-12">
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
		</div>

		<div class="form-group">
			<div class="col-xs-12 div-buttons">
				<a id="btn-cancelar" href="<?php echo site_url('home');?>" class="btn btn-default">Cancelar</a>
				<button id="btn-submit" name="boton" class="btn btn-primary" type="submit">Continuar</button>
			</div>
		</div>
			
	</form>

	<?php 
		if(isset($error))
			echo 'Mensaje error: '.$error;
	?>
</div>