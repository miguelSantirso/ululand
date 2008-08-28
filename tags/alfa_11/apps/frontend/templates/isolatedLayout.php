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
	<!-- Cajitas especiales de avisos -->
	<?php if($formErrors != NULL): ?>
	  <p class="messageBox error"><?php echo $formErrors; ?></p>
	<?php endif; ?>
	<?php if($warnings != NULL): ?>
	  <p class="messageBox warning"><?php echo $warnings; ?></p>
	<?php endif; ?>
	<?php if($successes != NULL): ?>
	  <p class="messageBox success"><?php echo $successes; ?></p>
	<?php endif; ?>
<br/>
<div id="header" class="rounded alignCenter">
	<?php echo image_tag('header_logo.png', array("class" => "alignCenter")); ?>
</div>

<div id="content" class="rounded">

	<?php echo $sf_data->getRaw('sf_content') ?> 
	
	<div style="clear: both"></div>
</div>
 
<div id="footer" class="alignCenter">
	<p><strong>ulu</strong>land versi&oacute;n <?php echo sfConfig::get('app_version'); ?>. Desarrollado por <a href="#">Christian Ca&ntilde;ete</a> &amp; <a href="http://miguelsantirso.es">Miguel Santirso</a></p>
	<br/>
	<!-- <p><a href="http://validator.w3.org/check?uri=referer">XHTML v&aacute;lido.</a></p>  -->
	
</div>



<!-- Google Analytics -->
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-1096368-6");
pageTracker._initData();
pageTracker._trackPageview();
</script>



</body>
</html>
