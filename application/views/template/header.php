<!DOCTYPE html>
<html lang="es" >
<!--
	AUTOR		Fernando Andrés Prieto
	AUTOR		Diego Martín Schwindt
	COPYRIGHT	Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
-->
	<head>
		   	<meta charset="utf-8">
		    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		    <meta name="viewport" content="width=device-width, initial-scale=1">

		    <title><?php echo $title; ?></title>	   	
		
		

		    <link type="text/css" href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet" />
			<link type="text/css" href="<?php echo base_url('assets/css/bootstrap-select.css'); ?>" rel="stylesheet" media="screen"/>		
			<link type="text/css" href="<?php echo base_url('assets/css/styles.css'); ?>" rel="stylesheet" media="screen"/>		
	 
		    <script type="text/javascript"src="<?php echo base_url('assets/js/jquery-1.11.0.min.js'); ?>"></script>
			
			<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		    <!--[if lt IE 9]>
		      <script type="text/javascript"  src="<?php echo base_url('assets/js/html5shiv.js'); ?>"></script>
		      <script type="text/javascript"  src="<?php echo base_url('assets/js/respond.min.js'); ?>"></script>
		    <![endif]-->
			
	 		<script type="text/javascript"  src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>	
	 		<script type="text/javascript"  src="<?php echo base_url('assets/js/bootstrap-select.js'); ?>"></script>
	 		<script type="text/javascript"  src="<?php echo base_url('assets/js/bootstrap-select-ES.js'); ?>"></script>
	 		
	 			
	</head>
	<body>

		<header class="container-fluid">
			<div class="row banner">
				<div class="col-xs-12 col-sm-10 col-sm-offset-1 header-banner-image">					
					<div class="banner header-logo">
						<div class="header-banner logo logo-uns"></div>
					</div>
					<div class="banner header-logo">
						<div class="header-banner logo logo-dcs"></div>
					</div>
					<div class="header-banner header-banner-shadow">
						<div class="header-texto">
							<div class="header-texto-linea1">
								<span class="header-texto-linea1-uns">UNIVERSIDAD NACIONAL DEL SUR -</span>
								<span class="header-texto-linea1-dpto">DEPARTAMENTO DE CIENCIAS DE LA SALUD</span>
							</div>
							<div class="header-texto-linea2">
								<span>LABORATORIO DE COMPETENCIAS PROFESIONALES</span>
							</div>
						</div>
					</div>
				</div>				
			</div>	
		</header>	
			
		<nav class="navbar navbar-default navbar-static-top" role="navigation">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xs-12 col-sm-10 col-sm-offset-1">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="#">Juan Zapata</a>
						</div>

						<!-- Collect the nav links, forms, and other content for toggling -->
						<div id="navbar-collapse-1" class="collapse navbar-collapse">
							<ul class="nav navbar-nav navbar-right">
								<li class="active">
									<a href="#"><span class="glyphicon glyphicon-file"></span> Mis Exámenes</a>
								</li>
								<li>
									<a href="#"><span class="glyphicon glyphicon-edit"></span> Mis Datos</a>
								</li>
								<li>
									<a href="#"><span class="glyphicon glyphicon-off"></span> Cerrar Sesión</a>
								</li>						
							</ul>
						</div><!-- /.navbar-collapse -->
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</nav>

			<div class="row outer-content"><!-- col content-->
				<div class="col-xs-12 col-sm-10 col-sm-offset-1 inner-content">	<!-- col content-->				
				
			