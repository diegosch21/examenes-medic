<!--
	AUTOR		Fernando Andrés Prieto
	AUTOR		Diego Martín Schwindt
	COPYRIGHT	Mayo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
-->


<link type="text/css" href="<?php echo base_url('assets/css/examenes/lista.css'); ?>" rel="stylesheet" media="screen"/>
<script type="text/javascript"  src="<?php echo base_url('assets/js/examenes/lista.js'); ?>"></script>

<div class="div-titulo">
	<?php if(count($lista)>0): ?>
		<label>Lista de exámenes evaluados por <?php echo $docente; ?></label>
	<?php else: ?>
		<label>No hay exámenes evaluados por <?php echo $docente; ?></label>
	<?php endif; ?>	
</div>

<<?php print_r($lista); ?>
