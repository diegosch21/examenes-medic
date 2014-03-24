<!--
	AUTOR		Fernando Andrés Prieto
	AUTOR		Diego Martín Schwindt
	COPYRIGHT	Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
-->

<script type="text/javascript"  src="<?php echo base_url('assets/js/login/script.js'); ?>"></script>

<div class="form-login">

	<form id="form-login" class="form-signin" role="form" method="post" action="<?php echo site_url('login/loguear_usuario');?>">

		<h2 class="form-signin-heading">Iniciar Sesión</h2>

		<input id="input-legajo" name="legajo" class="form-control" type="text"  placeholder="Legajo" autofocus=""/>
		<input id="input-password" name="password" class="form-control" type="password"  placeholder="Contraseña"/>

		<button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>

	</form>

</div>