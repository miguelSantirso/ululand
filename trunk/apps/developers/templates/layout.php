<? use_helper('Partial'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />

</head>
<body>

	<!-- header and menu -->
	<div id="header">
	
		<?php include_partial('global/userMenu'); ?>
		
		<?php include_partial('global/title'); ?>
		
		<?php include_partial('global/mainMenu'); ?>
	</div>
	
	
	<div style="clear:both;"></div>

	<!-- flash boxes -->
	
	<?php include_partial('global/flashBoxes'); ?>
	
	
	<!-- content -->
	
	<div id="content">
		<?php echo $sf_data->getRaw('sf_content') ?>
		
		<div style="clear:both;"></div>
	</div>
	
	<?php include_partial('global/footer'); ?>

</body>
</html>
