<?php 

$module = $sf_context->getModuleName();

$isHome = $module == 'home' || $module == 'sfGuardAuth';

$isGames = $module == 'game';

$isCommunity = $module == 'nahoWiki' ||
	$module == 'collaboration' ||
	$module == 'recipe' ||
	$module == 'community' ||
	$module == 'profile';

?>
<div id="mainHeader">
	<?php if($isCommunity) : ?>
	<ul>
		<li><?php echo link_to(__('People'), 'profile', array('class' => $module == "profile" ? 'selected' : '')); ?></li>
	</ul>
	<?php endif; ?>
	
	
	<h2>
		<?php if($isHome) : ?>
		<?php echo link_to(__('Home'), 'home'); ?>
		<?php endif; ?>
		
		<?php if($isGames) : ?>
		<?php echo link_to(__('Games'), 'game'); ?>
		<?php endif; ?>
		
		<?php if($isCommunity) : ?>
		<?php echo link_to(__('Community'), 'community'); ?>
		<?php endif; ?>
	</h2>
</div>
