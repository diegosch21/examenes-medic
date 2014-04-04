<!--
	AUTOR		Fernando Andrés Prieto
	AUTOR		Diego Martín Schwindt
	COPYRIGHT	Abril, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
-->

<?php 
	/**
	 *	Imprime en HTML los valores del item, incluyendo los input hidden y las opciones de seleccion
	 *
	 * @param 	$item array: id, nro, nom, solo_texto
	 *
	 */
	function print_item($item) 
	{
		$id_item = $item['id'];
		echo "<input type='hidden' name='item{$id_item}' id='input-item{$id_item}'/>";
		echo "{$item['nro']}. {$item['nom']}";
		if($item['solo_texto'])
			echo " OBS:  (solo texto)<br/>";
		else	
			echo " SI:   NO:   OBS:  <br/>";
		//poner inputs checkbox, y botoon observacion
		//via Javascript cambiar los input de los checkbox por hidden, al hacer clic en Calificar
	}
 ?>

<script type="text/javascript"  src="<?php echo base_url('assets/js/examen/generar.js'); ?>"></script>
<link type="text/css" href="<?php echo base_url('assets/css/examen/generar.css'); ?>" rel="stylesheet" media="screen"/>

<div>
	<h4>Fecha: <?php echo $fecha; ?><h4/>
	<h4>Carrera: <?php echo $carrera['cod_carr'].' - '.$carrera['nom_carr']; ?><h4/>
	<h4>Catedra: <?php echo $catedra['cod_cat'].' - '.$catedra['nom_cat']; ?><h4/>
	<h4>Alumno: <?php echo $alumno['lu_alu'].' - '.$alumno['apellido_alu'].', '.$alumno['nom_alu']; ?><h4/>

	<h3>Guía: <?php echo $guia['nro_guia'].'. '.$guia['tit_guia']; ?><h3/>
			<?php	if($guia['subtit_guia']) echo '<h4><i>'.$guia['subtit_guia'].'</i><h4/>'; ?>

	<h4>Descripción:</h4>			
	<?php 
		foreach ($guia['desc'] as $desc) 
		{
			echo "<b>{$desc['nom_desc']}:</b> {$desc['contenido_desc']}<br/>";
		}
	 ?>

	<h4>Guía estudiante:</h4>			
	<?php 
		foreach ($guia['itemsestudiante'] as $itemest)
		{
			echo "<b>{$itemest['nro_item']})</b> {$itemest['nom_itemest']}<br/>";
		}
	 ?>

	 <h4>Evaluación:</h4>

	<form>
		<input type="hidden" name="fecha" id="input-fecha" value="<?php echo $fecha; ?>"/>
		<input type="hidden" name="catedra" id="input-catedra" value="<?php echo $catedra['cod_cat']; ?>"/> <!-- no es necesario -->
		<input type="hidden" name="alumno" id="input-alumno" value="<?php echo $alumno['lu_alu']; ?>"/>
		<input type="hidden" name="guia" id="input-guia" value="<?php echo $guia['id_guia']; ?>"/>

		<?php 
			foreach ($guia['items'] as $item) 
			{
				if($item['tipo']=='seccion') //si el item es una seccion
				{
					echo "<h5>{$item['nro']}. {$item['nom']}</h5>"; //nombre de la seccion
					foreach ($item['items'] as $item2)  //recorro la lista de items de la seccion
					{
						if($item2['tipo']=='grupoitem') //si el item es un grupoitem
						{ 
							echo "{$item2['nro']}. {$item2['nom']}<br/>"; //nombre del grupoitem
							foreach ($item2['items'] as $item3)  //recorro la lista de items del grupo
							{
								print_item($item3); //imprime inputs y contenido del item
							}		
						}
						else //item suelto en la seccion
						{
							print_item($item2); //imprime inputs y contenido del item
						}		
					}
				} 
				elseif ($item['tipo']=='grupoitem') //si el item es un grupoitem
				{ 
					echo "{$item['nro']}. {$item['nom']}<br/>"; //nombre del grupoitem
					foreach ($item['items'] as $item2)  //recorro la lista de items del grupo
					{
						print_item($item2); //imprime inputs y contenido del item
					}
				}
				else // item suelto en la guia
				{
					print_item($item); //imprime inputs y contenido del item
				}

			}
	 	?>		
		


	</form>				

</div>







