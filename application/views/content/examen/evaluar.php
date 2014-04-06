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
		echo "<input type='hidden' name='item-id[]' id='input-item-{$id_item}' value='{$id_item}'/>";
		echo "{$item['nro']}. {$item['nom']}";
		if($item['solo_texto'])
		{
			echo " OBS:  (solo texto)<br/>";
			//input name='item-obs' value= texto
		}
		else	
		{
			echo " SI: (checkbox)   NO: (checkbox)  OBS:  <br/>";
			echo "<input type='hidden' name='item-estado[]' id='estado-item-{$id_item}' data-item='{$id_item}' value='-1'/>";
			//input name='item-value' value= -1,0 o 1
			//input name='item-obs' value= texto
		}
		//poner inputs checkbox, y botoon observacion
		//via Javascript cambiar los input de los checkbox por hidden, al hacer clic en Calificar
	}
 ?>

<script type="text/javascript"  src="<?php echo base_url('assets/js/examen/evaluar.js'); ?>"></script>
<link type="text/css" href="<?php echo base_url('assets/css/examen/evaluar.css'); ?>" rel="stylesheet" media="screen"/>

<div id="div-evaluar">
	
	<div>
		<div class="div-titulo">
			<span>Carrera:</span>
		</div>
		<div>
			<span><?php echo $carrera['cod_carr'].' - '.$carrera['nom_carr']; ?></span>
		</div>
	</div>

	<div>
		<div class="div-titulo">
			<span>Cátedra:</span>
		</div>
		<div>
			<span><?php echo $catedra['cod_cat'].' - '.$catedra['nom_cat']; ?></span>
		</div>
	</div>

	<div>
		<div class="div-titulo">
			<span>Alumno:</span>
		</div>
		<div>
			<span><?php echo $alumno['lu_alu'].' - '.$alumno['apellido_alu'].', '.$alumno['nom_alu']; ?></span>
		</div>
	</div>

	<div>
		<div class="div-titulo">
			<span>Fecha del Examen:</span>
		</div>
		<div>
			<span><?php echo $fecha; ?></span>
		</div>
	</div>

	<div class="barra-division"></div>

	<div class="col-xs-12 col-titulo-guia">
		Guía N° <?php echo $guia['nro_guia'].': '.$guia['tit_guia']; ?>
	</div>
	<div class="col-xs-12 col-subtitulo-guia">
		<?php 
			if($guia['subtit_guia']) {
				echo $guia['subtit_guia']; 
			}
		?>
	</div>
			

	<!-- Nav tabs -->
	<ul id="tab" class="nav nav-tabs">
		<li><a href="#descripcion" data-toggle="tab">Descripción</a></li>
		<li class="active"><a href="#evaluacion" data-toggle="tab">Evaluación</a></li>
		<li><a href="#guia-estudiante" data-toggle="tab">Guía Estudiante</a></li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div id="descripcion" class="tab-pane" >
			<?php 
				foreach ($guia['desc'] as $desc) 
				{
					echo "<b>{$desc['nom_desc']}:</b> {$desc['contenido_desc']}<br/>";
				}
			?>
		</div>
		<div id="guia-estudiante" class="tab-pane" >
			<?php 
				foreach ($guia['itemsestudiante'] as $itemest)
				{
					echo "<b>{$itemest['nro_item']})</b> {$itemest['nom_itemest']}<br/>";
				}
			?>
		</div>
		<div id="evaluacion" class="tab-pane active">
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
	</div>
</div>







