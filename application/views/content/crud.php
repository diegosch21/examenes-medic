
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>

<div class="container-fluid">
	<div class="row">	
		<div class='crud col-xs-12' style="overflow:auto;">
			<?php echo $output; ?>
		</div>
	</div>
</div>
