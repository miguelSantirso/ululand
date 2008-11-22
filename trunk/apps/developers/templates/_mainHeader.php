<?php 

$module = $sf_context->getModuleName();

$isHome = $module == 'home' || $module == 'sfGuardAuth';

$isGames = $module == 'game' || $module == 'gameRelease';

$isCommunity = $module == 'nahoWiki' ||
	$module == 'collaboration' ||
	$module == 'recipe' ||
	$module == 'community' ||
	$module == 'profile';

$isOptions = $module == 'options';

?>
<div id="mainHeader">
	<?php if($isCommunity) : ?>
	<ul>
		<li><?php echo link_to(__('Recipes'), 'recipe', array('class' => $module == "recipe" ? 'selected' : '')); ?></li>
		<li><?php echo link_to(__('Collaborations'), 'collaboration', array('class' => $module == "collaboration" ? 'selected' : '')); ?></li>
		<li><?php echo link_to(__('People'), 'profile', array('class' => $module == "profile" ? 'selected' : '')); ?></li>
		<li><?php echo link_to(__('Wiki'), '@wiki_home', array('class' => $module == "nahoWiki" ? 'selected' : '')); ?></li>
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
