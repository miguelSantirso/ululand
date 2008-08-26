<?php use_helper('ulMisc'); ?>

<div class="profileBadge contentBox light bordered">
	<?php echo gravatar_tag($profile->getSfGuardUser()->getUsername(), 80, array('class' => 'alignLeft')); ?>
	<?php echo linkToProfile($profile, array('class' => 'large')); ?>
	<p class="noSpace"><small><?php echo sprintf('%s visits to your profile', $profile->getDeveloperProfile()->getCounter()); ?></small></p>
	
	
	<div style="clear:both"></div>
</div>