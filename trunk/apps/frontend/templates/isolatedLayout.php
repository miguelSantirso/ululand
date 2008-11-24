<?php use_helper("Tooltip"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />

</head>
<body>
	<div id="" class="alignCenter">
		<br/>
		<?php echo image_tag('header_logo.png', array("class" => "alignCenter")); ?>
		<br/>
	</div>

	<!-- flash boxes -->
	<?php if ($sf_flash->has('error')): ?>
		<p class="flashBox error"><?php echo $sf_flash->get('error') ?></p>
	<?php endif ?>
	<?php if ($sf_flash->has('warning')): ?>
		<p class="flashBox warning"><?php echo $sf_flash->get('warning') ?></p>
	<?php endif ?>	
	<?php if ($sf_flash->has('success')): ?>
		<p class="flashBox success"><?php echo $sf_flash->get('success') ?></p>
	<?php endif ?>
	
	<div id="content" class="">
		<br/>
		<?php echo $sf_data->getRaw('sf_content') ?> 
		
		<div style="clear: both"></div>
	</div>
	 
	<?php include_partial('global/footer'); ?>


</body>
</html>
