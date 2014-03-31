<!--
	AUTOR		Fernando Andrés Prieto
	AUTOR		Diego Martín Schwindt
	COPYRIGHT	Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
-->

<script type="text/javascript"  src="<?php echo base_url('assets/js/login/index.js'); ?>"></script>
<link type="text/css" href="<?php echo base_url('assets/css/login/index.css'); ?>" rel="stylesheet" media="screen"/>

<div id="div-form">

	<form id="form" class="form form-login" role="form" method="post" action="<?php echo site_url('login/loguear_usuario');?>">

		<h2 class="form-login-heading">Iniciar Sesión</h2>

		<input id="input-legajo" name="legajo" class="form-control" type="text"  placeholder="Legajo" autofocus=""/>
		<input id="input-password" name="password" class="form-control" type="password"  placeholder="Contraseña"/>

		<button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>

		<?php if (function_exists('validation_errors')) echo validation_errors(); ?>  <!-- aplicar estilo, divs, etc -->
		<?php if (isset($error_login)) echo $error_login; ?>	 <!-- aplicar estilo, divs, etc -->

	</form>

</div>