<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />

	<link rel="stylesheet" href="splash_css/splash.css" type="text/css" media="screen" title="no title" charset="utf-8">
	<style>
		html, body {
			/*text-align: center;*/
			height: 100%;
			font-family: Verdana, Arial, sans-serif;
		}
		
		* { margin: 0; padding: 0;}
		
		#developers {
			position: fixed;
			right: 20px;
			bottom: 20px;
		
		}
		#developers a {
			text-decoration: none;
			border-radius: 6px;
			-moz-border-radius: 6px;
			-webkit-border-radius: 6px;
			display: block;
			padding: 1em;
			background-color: #e4e4e4;
			color: #575757;
			border: 1px solid #a4a4a4;
		}
		#developers a:hover {
			color: #0098de;
			background-color: #f1f9ff;
			border-color: #96d1ff;
		}
		#developers a:active {
			color: #00afff;
			background-color: #0077ad;
			border-color: #00afff;
		}
		
		
		#content {
			background: url('/images/sombra-fuera.gif') repeat-y;
			width: 747px;
			margin: 0 auto;
			padding: 0;
			height: 100%;
		}
		
		#header {
			background: url('/images/fondo-header.png') no-repeat;
			display: block;
			margin: 0 auto;
			width: 295px;
			height: 120px;
		}
		
		#video {
			display: block;
			margin: 0 auto 0 auto;
			text-align: center;
		}
		
		#dibu img {
			display: block;
			margin: 45px auto;
		}
		
		#vaamolar {
			margin-left: 600px;
			margin-top: 35px;
			position: absolute;
		}
		
		#pncil {
			margin-top: 65px;
			font-family: "Arno Pro", "Georgia", "Times New Roman", Times, Serif;
			text-align: center;
			font-size: 3em;
		}
		#pncil a {
			color: #444;
			text-decoration: none;
		}
		#pncil a:hover
		{
			color: #111;
		}
		#pncil a:active
		{
			color: #00aaff;
		}
		#pncil a span.colored
		{
			color: #8c8c8c;
		}
		#pncil a:hover span.colored	{color: #00aaff;}
	</style>
	<!--[if IE]>
		<style>
			html, body{ text-align: center; }
			#vaamolar{ margin-left: 230px !important; }
		</style>
	<![endif]-->
	
</head>
<body>

<?php echo $sf_data->getRaw('sf_content') ?>

<!-- Google Analytics -->
<!-- 
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-1096368-6");
pageTracker._initData();
pageTracker._trackPageview();
</script>
-->

</body>
</html>
