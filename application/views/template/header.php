<!DOCTYPE html>
<html lang="es" >
<head>
	   	<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">

	    <title><?php echo $title; ?></title>

	    <!-- Bootstrap -->
	    <link href="css/bootstrap.min.css" rel="stylesheet">

	    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	    <![endif]-->	   	
	
		<link href=" <?php echo base_url('assets/img/icons/favicon.ico')?>" rel="shortcut icon" type="image/ico" />

	    <link type="text/css" href="<?php echo base_url('assets/css/bootstrap/bootstrap.css') ?>" rel="stylesheet" />
	  	
		<link type="text/css" href="<?php echo base_url('assets/css/font-awesome/font-awesome.css') ?>" rel="stylesheet" media="screen"/>
		<link type="text/css" href="<?php echo base_url('assets/css/bootstrap/bootstrap-datepicker.css') ?>" rel="stylesheet" media="screen"/>
		<link type="text/css" href="<?php echo base_url('assets/css/bootstrap/bootstrap-select.min.css') ?>" rel="stylesheet" media="screen"/>
		<link type="text/css" href="<?php echo base_url('assets/css/select/select2.css') ?>" rel="stylesheet" media="screen"/>
		<link type="text/css" href="<?php echo base_url('assets/css/bootstrap/bootstrap-switch.css') ?>" rel="stylesheet" media="screen"/>
		
		<link type="text/css" href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet" media="screen"/>
 
	    <script type="text/javascript"src="<?php echo base_url('assets/js/jquery/jquery-1.7.2.min.js') ?>"></script>
		<script type="text/javascript"  src="<?php echo base_url('assets/js/jquery/jquery-ui.min.js') ?>"></script>
		
		
 		<script type="text/javascript"  src="<?php echo base_url('assets/js/bootstrap/bootstrap.js') ?>"></script>	
 		<script type="text/javascript"  src="<?php echo base_url('assets/js/bootstrap/datepicker/bootstrap-datetimepicker.min.js') ?>"></script>
 		<script type="text/javascript"  src="<?php echo base_url('assets/js/bootstrap/bootstrap-select.min.js') ?>"></script>
 		<script type="text/javascript"  src="<?php echo base_url('assets/js/bootstrap/select/select2.js') ?>"></script>
 		<script type="text/javascript"  src="<?php echo base_url('assets/js/bootstrap/bootstrap-switch.js') ?>"></script>
 		<script type="text/javascript"  src="<?php echo base_url('assets/js/jquery/jquery.tablesorter.js') ?>"></script>
 		<script type="text/javascript"  src="<?php echo base_url('assets/js/general_script.js') ?>"></script>
 		
 		<?php
 				if(currentLanguage() == 'es')
				{ 
					echo '<script type="text/javascript"  src="'.base_url("assets/js/bootstrap/datepicker/locales/bootstrap-datetimepicker.es.js").'"></script>';
				}
 		?>
 		
 		<script type="text/javascript"  src="<?php echo base_url('assets/js/lang/lang.'.currentLanguage().'.js');?>"></script>
 		
 			
</head>
<body data-baseurl="<?php echo base_url(); ?>" data-siteurl="<?php echo site_url(); ?>" data-language = "<?php echo currentLanguage();?>" data-googleapikey = "<?php echo $this->config->item('google_apiKey');?>">