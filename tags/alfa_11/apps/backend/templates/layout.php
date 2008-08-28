<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />
</head>
<body>

<div id="userMenu">
	<ul class="horizontalListMenu small">
		<li><a href="/">Usuario</a></li>
		<li><a href="/index.php/home/Logout.html">Logout</a></li>
		<li><?php echo link_to('Admin', 'admin') ?></li>
	</ul>
</div>

<div id="header" class="rounded">
	<div id="mainMenu" class="rounded">
		<ul class="horizontalListMenu">
			<li><?php echo link_to('&Iacute;ndice', 'admin') ?></li>
			<li><a href="/">Zona de usuario</a></li>
		    <li class="rounded"></li>
		</ul>
	</div>
</div>

<div style="clear: both"></div>
<div id="indicator" style="display: none"></div>
<div id="content" class="rounded">
	
	<?php echo $sf_data->getRaw('sf_content') ?>
	
	<div style="clear: both"></div>
</div>
 
<div id="footer" class="alignCenter">
	<p><strong>ulu</strong>land est&aacute; siendo desarrollado por <a href="#">Christian Ca&ntilde;ete</a> y <a href="http://miguelsantirso.es">Miguel Santirso</a></p>
</div>

</body>
</html>
