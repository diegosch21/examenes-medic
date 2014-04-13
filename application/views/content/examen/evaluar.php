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
	function print_item($item, $item_suelto) 
	{		
		$clase_botonera = '';
		if($item_suelto) {
			echo "<div>";
			$clase_botonera = 'item-suelto-botonera';
		}
		else 
		{
			echo "<div class='item'>";
		}

		
		echo"	<div class='item-botonera {$clase_botonera} pull-right'>";
					if(!$item['solo_texto'])
					{
						echo 	'<div class="btn-group" data-toggle="buttons">
							 	  	<label class="boton-si btn btn-default">
										<input type="checkbox"> Sí
								    	<span class="glyphicon glyphicon-ok"></span>
								  	</label>
									<label class="boton-no btn btn-default">
										<input type="checkbox"> No
										<span class="glyphicon glyphicon-remove"></span>
									</label>
								</div>
								<input type="hidden" name="item-estado[]" id="estado-item-{$id_item}" data-item="{$id_item}" value="-1"/>
								<span class="item-value"></span>';
					}
		echo 	'<a class="boton-obs btn btn-default">Obs <span class="glyphicon glyphicon-pencil"></span></a>
				<textarea name="item-obs[]" class="item-obs form-control" rows="2" style="display:none;"></textarea>';

		echo "</div><div>
				<div class='item-texto'>";
		$id_item = $item['id'];
		echo "<input type='hidden' name='item-id[]' id='input-item-{$id_item}' value='{$id_item}'/>";
		echo "<span class='numero'>{$item['nro']}.</span> {$item['nom']}";
		//echo "<span>";
		echo "</div></div>

		<div class='clearboth'></div>
		</div>";


		//via Javascript cambiar los input de los checkbox por hidden, al hacer clic en Calificar
	}
 ?>

<script type="text/javascript"  src="<?php echo base_url('assets/js/examen/evaluar.js'); ?>"></script>
<link type="text/css" href="<?php echo base_url('assets/css/examen/evaluar.css'); ?>" rel="stylesheet" media="screen"/>

<div id="div-evaluar">
	
	<div>
		<div class="div-titulo" style="height: 100%;">
			<span>Carrera:</span>
		</div>
		<div class="div-titulo-dato">
			<span><?php echo $carrera['cod_carr'].' - '.$carrera['nom_carr']; ?></span>
		</div>
	</div>

	<div>
		<div class="div-titulo">
			<span>Cátedra:</span>
		</div>
		<div class="div-titulo-dato">
			<span><?php echo $catedra['cod_cat'].' - '.$catedra['nom_cat']; ?></span>
		</div>
	</div>

	<div>
		<div class="div-titulo">
			<span>Alumno:</span>
		</div>
		<div class="div-titulo-dato">
			<span><?php echo $alumno['lu_alu'].' - '.$alumno['apellido_alu'].', '.$alumno['nom_alu']; ?></span>
		</div>
	</div>

	<div>
		<div class="div-titulo">
			<span>Fecha del Examen:</span>
		</div>
		<div class="div-titulo-dato">
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
		<li>
			<a href="#descripcion" data-toggle="tab">Descripción</a>
		</li>
		<li class="active">
			<a href="#evaluacion" data-toggle="tab">Evaluación</a>
		</li>
		<li>
			<a href="#guia-estudiante" data-toggle="tab">Guía Estudiante</a>
		</li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div id="descripcion" class="tab-pane fade" >
			<?php 
				foreach ($guia['desc'] as $desc) 
				{
					echo "<b>{$desc['nom_desc']}:</b> {$desc['contenido_desc']}<br/>";
				}
			?>
		</div>
		<div id="guia-estudiante" class="tab-pane fade" >
			<?php 
				foreach ($guia['itemsestudiante'] as $itemest)
				{
					echo "<b>{$itemest['nro_item']})</b> {$itemest['nom_itemest']}<br/>";
				}
			?>
		</div>
		<div id="evaluacion" class="tab-pane fade in active">
		<!--CAMBIAR FORM: EL BOTON ES POR AJAX -->
			<form id="form-evaluar" class="form-evaluar" role="form" method="post" action="<?php echo site_url('examen/generar');?>">
				<input type="hidden" name="fecha" id="input-fecha" value="<?php echo $fecha; ?>"/>
				<input type="hidden" name="carrera" id="input-carrera" value="<?php echo $carrera['cod_carr']; ?>"/>
				<input type="hidden" name="catedra" id="input-catedra" value="<?php echo $catedra['cod_cat']; ?>"/> <!-- no es necesario -->
				<input type="hidden" name="alumno" id="input-alumno" value="<?php echo $alumno['lu_alu']; ?>"/>
				<input type="hidden" name="guia" id="input-guia" value="<?php echo $guia['id_guia']; ?>"/>


				<?php 
					foreach ($guia['items'] as $item) 
					{
						if($item['tipo']=='seccion') //si el item es una seccion
						{
							echo "<div class='seccion'>
									{$item['nro']}. {$item['nom']}
								 </div>"; //nombre de la seccion

							foreach ($item['items'] as $item2)  //recorro la lista de items de la seccion
							{
								if($item2['tipo']=='grupoitem') //si el item es un grupoitem
								{ 
									echo 	"<div class='sangria'>
												<div class='grupo-item'>
													<div class='item-texto'>
														<span class='numero'>{$item2['nro']}</span>. {$item2['nom']}<br/>"; //nombre del grupoitem
									echo "			</div>
												</div>
											
										  	<div class='sangria'>";	
									foreach ($item2['items'] as $item3)  //recorro la lista de items del grupo
									{
										print_item($item3, false); //imprime inputs y contenido del item
									}
									echo "</div></div>";
								}
								else //item suelto en la seccion
								{
									echo "<div class='grupo-item sangria'>";
										print_item($item2, true); //imprime inputs y contenido del item
									echo "</div>";
								}		
							}
						} 
						else
						{
							if ($item['tipo']=='grupoitem') //si el item es un grupoitem
							{ 
								echo "<div class='grupo-item'>
										{$item['nro']}. {$item['nom']}<br/>"; //nombre del grupoitem

								foreach ($item['items'] as $item2)  //recorro la lista de items del grupo
								{
									print_item($item2, false); //imprime inputs y contenido del item
								}
								echo "</div>";	
							}
							else // item suelto en la guia
							{
								echo "<div class='grupo-item'>";
										print_item($item, true); //imprime inputs y contenido del item
								echo "</div>";
							}
						}
					}
			 	?>	

			 	<h4>Observación general del examen</h4>
			 	<textarea name="examen-obs" class="examen-obs form-control" rows="3"	></textarea>

			 	<div class="form-group-buttons">
					<a id="btn-cancelar" href="#" class="btn btn-default">Cancelar</a>
					<a id="btn-calificar" href="#" class="btn btn-primary">Calificar</a>
				</div>

			 	<h4>Porcentaje realizado:</h4> (calcular via js)
			 	<input type="hidden" name="examen-porc" id="examen-porc" value="-1">

			 	<h4>CALIFICACION:</h4>
			 	<div id="examen-calificacion">
			 		<div class="radio">
				 	<label>
						<input type="radio" name="examen-calif" id="calificacion2" value="2">
						Competencia adquirida
				 	</label>
				 	</div>
				 	<div class="radio">
				 	<label>
						<input type="radio" name="examen-calif" id="calificacion1" value="1">
						Competencia medianamente adquirida
				 	</label>
				 	</div>
				 	<div class="radio">
				 	<label>
						<input type="radio" name="examen-calif" id="calificacion0" value="0">
						Competencia no adquirida
				 	</label>
				 	</div>
				</div>

				<div class="form-group-buttons">
					<a id="btn-atras" href="#" class="btn btn-default">Atrás</a>
					<button id="btn-submit" name="boton" class="btn btn-primary" type="submit">Confirmar</button>
				</div>
	


			</form>
		</div>		
	</div>
</div>







