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
	 * @param 	$item_suelto boolean: indica si es item individual o subitem
	 *
	 */
	function _print_item($item, $item_suelto) 
	{	
		
		$botonera = "<div class='item-botonera pull-right'>";

		if(!$item['solo_texto'])
		{
			$botonera =	$botonera.
						"<div class='btn-group evaluacion' data-toggle='buttons'>
					 	  	<label class='boton-si btn btn-default'>
								<input type='checkbox'> Sí
						    	<span class='glyphicon glyphicon-ok'></span>
						  	</label>
							<label class='boton-no btn btn-default'>
								<input type='checkbox'> No
								<span class='glyphicon glyphicon-remove'></span>
							</label>
						</div>
						<input type='hidden' name='item-estado[]' class='item-estado' id='estado-item-{$item['id']}' data-item='{$item['id']}' value='-1'/>
						<span class='item-value-titulo calificacion'>Respuesta: </span><span class='item-value calificacion'>-</span>";
		}

		$botonera =	$botonera."<a class='btn btn-default boton-obs pull-right evaluacion'>Obs <span class='glyphicon glyphicon-pencil'></span></a>				   		
				    </div>";

		$texto =	"<div class='item-texto'>						
						<input type='hidden' name='item-id[]' id='input-item-{$item['id']}' value='{$item['id']}'/>
						<span class='numero'>{$item['nro']}.</span> {$item['nom']}
					</div>";
		$fin = 	"	<div class='clearboth'></div>
					<div class='item-obs-container'>
						<textarea name='item-obs[]' class='form-control item-obs observaciones' rows='2' placeholder='Ingrese una observación aquí'></textarea>
					</div>";

		if($item_suelto) 
		{
			echo $botonera.$texto.$fin;
		}
		else
		{
			echo "<div class='item borde-item'>".$botonera.$texto.$fin."</div>";
		}		

		//via Javascript cambiar los input de los checkbox por hidden, al hacer clic en Calificar
	}

	/**
	 *	Imprime en HTML un item
	 *
	 * @param 	$grupoitem array: nro, nom, items
	 *
	 */
	function print_item($item) {

		echo "<div class='grupo-item borde-grupoitem'>";
				_print_item($item, true); //imprime inputs y contenido del item
		echo "</div>";

	}

	/**
	 *	Imprime en HTML un grupoitem
	 *
	 * @param 	$grupoitem array: nro, nom, items
	 *
	 */
	function print_grupo_item($grupoitem) {
		echo 	"<div class='grupo-item borde-grupoitem'>
					<div class='item-texto'>
						<span class='numero'>{$grupoitem['nro']}</span>. {$grupoitem['nom']}<br/>"; //nombre del grupoitem
		echo "		</div>
				</div>				
			  	<div class='sangria'>";	
					foreach ($grupoitem['items'] as $item)  //recorro la lista de items del grupo
					{
						_print_item($item, false); //imprime inputs y contenido del item
					}
		echo "  </div>";
	}

	/**
	 *	Imprime en HTML los datos de una seccion
	 *
	 * @param 	$seccion array: nro, nom
	 *
	 */
	function print_seccion($seccion) {
		echo "<div class='seccion'>{$seccion['nro']}. {$seccion['nom']}</div>"; //nombre de la seccion

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

					$tiene_secciones = false;

					foreach ($guia['items'] as $item) 
					{
						if($item['tipo'] == 'seccion') //si el item es una seccion
						{
							$tiene_secciones = true;

							print_seccion($item);

							foreach ($item['items'] as $item2)  //recorro la lista de items de la seccion
							{
								if($item2['tipo']=='grupoitem') //si el item es un grupoitem
								{ 
									print_grupo_item($item2);
								}
								else //item suelto en la seccion
								{
									print_item($item2);
								}		
							}
							echo "<div class='borde-grupoitem borde-final'></div>"; //último borde de la seccion
						} 
						else
						{
							if ($item['tipo']=='grupoitem') //si el item es un grupoitem
							{ 
								print_grupo_item($item);	
							}
							else // item suelto en la guia
							{
								print_item($item);
							}
						}
					}

					if(!$tiene_secciones) {
						echo "<div class='borde-grupoitem borde-final'></div>"; //último borde
					}
			 	?>	
			 	
			 	<h4>Observación General del Examen</h4>
			 	<textarea name="examen-obs" class="examen-obs form-control" rows="3" placeholder="Ingrese una observación aquí"></textarea>

			 	<div class="evaluacion form-group-buttons botonera">
					<a id="btn-cancelar" data-target="#" class="btn btn-default btn-lg">Cancelar</a>
					<a id="btn-calificar" data-target="#" class="btn btn-primary btn-lg">Calificar</a>
				</div>

				<div class="calificacion container-calificacion">
				 	Porcentaje correctas: <span id="porcentaje-realizado">porcentaje</span>
				 	<input type="hidden" name="examen-porc" id="examen-porc" value="-1">

				 	<div class="examen-calificacion">
					 	<h4>CALIFICACION:</h4>
					 	<div id="examen-calificacion" class="opciones-calificacion">
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
					</div>

					<div class="form-group-buttons  botonera">
						<a id="btn-atras" href="#" class="btn btn-default btn-lg">Atrás</a>
						<a id="btn-confirmar" name="boton" class="btn btn-primary btn-lg">Confirmar</a>
					</div>
				</div>

			</form>
		</div>		
	</div>
</div>


<div id="modal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 id="modal-titulo" class="modal-title"></h4>
			</div>
			<div class="modal-body">

				<div id="alert-warning-exit" class="alert alert-warning modal-body-content">
					<strong>ATENCIÓN!</strong> Usted está por abandonar el examen. Si continúa perderá los datos y deberá generar el examen nuevamente.
				</div>

				<div id="alert-warning-save" class="alert alert-warning modal-body-content">
					<strong>ATENCIÓN!</strong> ¿Está realmente seguro que desea guardar este examen?
				</div>

				<div id="alert-success" class="alert alert-success modal-body-content">
					<strong>EXAMEN GUARDADO CORRECTAMENTE!</strong><br/>Cód. Examen: xxxxxxx
				</div>

				<div id="progressbar" class="progress progress-striped active modal-body-content-loadingbar">
					<div class="progress-bar"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
						<span>Guardando Examen</span>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button id="btn-modal-cancelar" rel="btn-modal-warning" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<a id="btn-modal-abortar" rel="btn-modal-warning" class="btn btn-primary">Abortar</a>
				<a id="btn-modal-save" class="btn btn-primary">Continuar</a>

				<a id="btn-modal-inicio" href="<?php echo site_url('home');?>" rel="btn-modal-success" class="btn btn-default">Inicio</a>
				<a id="btn-modal-ver" href="#" rel="btn-modal-success" class="btn btn-primary">Ver Examen</a>
				<a id="btn-modal-nuevo" href="<?php echo site_url('examen/generar');?>" rel="btn-modal-success" class="btn btn-primary">Nuevo Examen</a>
				
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->







