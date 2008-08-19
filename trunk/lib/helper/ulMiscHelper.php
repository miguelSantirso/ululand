<?php

	function dynamicContextUrl($context)
	{
		//$url = url_for($context->getModuleName().'/'.$context->getActionName(), true);
		$url = currentPageURL();
		$url = str_replace("http://", "", $url);
		
		$urlParts = array();
		$urlParts = explode('/', $url);
		
		$finalUrl = "<span>";
		$reconstructedUrl = "http:/";
		$level = 0;
		foreach($urlParts as $urlPart)
		{
			if($urlPart != "")
			{
				$reconstructedUrl .= '/' .$urlPart;
				$finalUrl .= link_to(substr(urldecode($urlPart), 0, 20), $reconstructedUrl, array('class' => 'urlLevel-'.$level)) . '/<span>';
				$level++;
			}
		}
		$finalUrl = trim($finalUrl, " &raquo;");
		for($i = $level; $i >= 0; $i--)
		{
			$finalUrl .= "</span>";
		}
		
		return trim($finalUrl, " &raquo;");
	}
	
	function currentPageURL()
	{
		$pageURL = 'http';
		if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
?>