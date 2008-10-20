<?php 

$module = $sf_context->getModuleName();

$isHome = $module == 'home' || $module == 'sfGuardAuth';

$isGames = $module == 'game' || $module == 'competition';

$isCommunity = $module == 'group' || $module == 'profile' || $module == 'community';

$isOptions = $module == 'options';

?>
<div id="mainHeader">
	<?php if($isCommunity) : ?>
	<ul>
		<li><?php echo link_to(__('People'), 'profile', array('class' => $module == "profile" ? 'selected' : '')); ?></li>
		<li><?php echo link_to(__('Groups'), 'group', array('class' => $module == "group" ? 'selected' : '')); ?></li>
	</ul>
	<?php endif; ?>
	
	<?php if($isGames) : ?>
	<ul>
		<li><?php echo link_to(__('Games'), 'game', array('class' => $module == "game" ? 'selected' : '')); ?></li>
		<li><?php echo link_to(__('Competitions'), 'competition', array('class' => $module == "competition" ? 'selected' : '')); ?></li>
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
		
		<?php if($isOptions) : ?>
		<?php echo link_to(__('Options'), 'options'); ?>
		<?php endif; ?>
	</h2>
</div>
