<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="en-us" />

<style type="text/css" media="screen">
body {
	margin: 0;
	padding: 0;
	font-family: Verdana, Arial, sans-serif;
}

body,html {
	background-color: #faf4ff;
	font-family: Verdana, Arial;
}

.rounded {
	border-radius: 6px;
	-moz-border-radius: 6px;
	-webkit-border-radius: 6px;
}
.alignRight {
	float: right;
}

.alignLeft {
	float: left;
}

.alignCenter {
	margin: auto;
	text-align: center;
}

div.fixedWidth.wide {
	width: 930px;
	margin: 0 auto;
}

div.fixedWidth.medium {
	width: 420px;
	margin: 1em;
}

#content {
	font-family: "Verdana";
	width: 950px;
	margin: 1em auto 0.5em auto;
	padding: 2em;
	background: #ffffff;
	border: 1px solid #f2e2ff;
	/*border-top: 0;*/
}

#content p {
	margin-top: 0.5em;
	margin-bottom: 0.3em;
}

#content a {
	color: #6d009b;
}

#content a:hover {
	color: #b400ff;
}

#content a:active {
	color: #de00ff;
}

#content div.normalBox {
	padding: 0.5em;
	margin-bottom: 1em;
	border: 1px solid;
	border-radius: 6px;
	-moz-border-radius: 6px;
	-webkit-border-radius: 6px;
}

#content div.normalBox.defaultColor {
	color: #4a0077;
	background-color: #f7eaff;
	border-color: #efdafd;
}

#content div.normalBox.lightColor {
	color: #626262;
	border-color: #cfcfcf;
	background-color: #fdfdfd;
}

#content .normalBox .header {
	padding-top: 0;
	margin-bottom: 0.5em;
	text-transform: capitalize;
	border-bottom: 1px solid;
}

#content .normalBox.defaultColor .header {
	border-color: #fcf8ff;
}
</style>
</head>

<body>
	<div id="header" class="alignCenter">
		<img class="alignCenter" src="cid:CID1" />
	</div>

	<div id="content" class="rounded">
		<div class="fixedWidth wide normalBox lightColor">
			<h1 class="alignCenter">Email de confirmaci&oacute;n de email</h1>
			<p class="alignCenter">Haz click en el enlace que encontrarás abajo</p>
		</div>
		
		<div class="fixedWidth wide normalBox defaultColor">
			<h2 class="header">Eh... Hola, buenos d&iacute;as</h2>
			<p>Lo primero es darte la bienvenida a <strong>ulu</strong>land. Estamos encantados de tener un nuevo amigo entre nosotros.</p>
			 
			<h3>Valida tu email:</h3>
			<p>Necesitamos asegurarnos de que tu email es v&aacute;lido y por eso tienes que hacer clic en el enlace que te ponemos a continuaci&oacute;n:</p>
			<a href="<?php echo url_for($approvalLink, true); ?>"><?php echo url_for($approvalLink, true); ?></a>
			<p>Si, por cualquier motivo, no funciona el enlace, prueba a copiarlo y pegarlo en la barra de direcciones del navegador de internet.</p>
			<p>&iexcl;Y ya est&aacute;! Esperamos verte mucho en <strong>ulu</strong>land</p>
		 </div>
		<p>Ululand.com</p>
	
	
		<div style="clear: both"></div>
	</div>
</body>
</html>