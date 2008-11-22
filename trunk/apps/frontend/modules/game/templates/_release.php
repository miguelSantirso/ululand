<?php if($game) { ?>
	<div id="leaderboard_bridge">
	</div>
	<script src="http://xs.mochiads.com/static/pub/swf/leaderboard.js" type="text/javascript"></script>
	<script type="text/javascript">
		// Mochi Publisher Bridge
		var options = {partnerID: "e60b7d6125fdc7bb", id: "leaderboard_bridge"};
		<?php if($sf_user->isAuthenticated()) : ?>
			options.username = "<?php echo $sf_user->getProfile()->getUsername(); ?>";
		<?php endif; ?>
		// optional
		options.sessionID = "sf908uw098urerjw3948";
		// optional
		//options.gateway = "http://www.example.com/bridge/";
		// optional
		options.userPrefix = "http://ululand.com/people/";
		// optional
		options.logoURL = "http://ululand.com/images/logoUluland_mochi.png";
		// optional
		//options.callback = function (params) { alert(params.name + " (" + params.username + ") just scored " + params.score + "!"); }
		
		// uncomment this to display global scores
		// options.globalScores = "true";
		
		/*
		// uncomment this block for debug mode
		options.width = 320;
		options.height = 240;
		options.debug = "true";
		*/
		Mochi.addLeaderboardIntegration(options);
	</script>
	<?php
		if(!isset($width))
			$width = $gameRelease->getWidth().'px';
		if(!isset($height))
			$height = $gameRelease->getHeight().'px';
	?>
	
	<object id='game-<?php echo $gameRelease->getStrippedName(); ?>' classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000'
		codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/
			swflash.cab#version=9,0,0,0'
		width='<?php echo $width; ?>' height='<?php echo $height; ?>'>
		<param name='src' value='<?php echo $gameRelease->getCompleteUrl(); ?>' />
		<param name="wmode" value="transparent">
		<param name='flashVars' value='<?php echo($flashVars); ?>' />
		<embed name='mySwf' src='<?php echo $gameRelease->getCompleteUrl(); ?>'
			pluginspage='http://
			www.macromedia.com/shockwave/download/
			index.cgi?P1_Prod_Version=ShockwaveFlash'
			width='<?php echo $width; ?>' height='<?php echo $height; ?>'
			wmode="transparent"
			flashVars='<?php echo($flashVars); ?>' />
	</object>

<?php } else { ?>

	<p class="strongColor">El juego solicitado no ha sido cargado en el sistema</p>

<?php } ?>