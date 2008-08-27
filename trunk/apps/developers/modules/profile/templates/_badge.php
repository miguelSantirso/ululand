<?php use_helper('ulMisc'); ?>

<?php $developerProfile = $profile->getDeveloperProfile(); ?>

<div class="profileBadge">
	<?php if($profile->isFilledIn()) : ?>
	<?php echo linkToProfile($profile, array(), gravatar_tag($profile->getSfGuardUser()->getUsername(), 80, array('class' => 'gravatar')) ); ?>
	<?php echo linkToProfile($profile, array('class' => 'username')); ?>
	<div class="details">
		<p class=""><small><?php echo sprintf('%s visits to your profile', $developerProfile->getCounter()); ?></small></p>
		<p class=""><small><?php echo sprintf('%1$s comments in your profile', $developerProfile->getNbCommentsInProfile()); ?></small></p>
		<p class=""><small><?php echo sprintf('%1$s recipes sent to the cookbook', $developerProfile->getNbRecipes()); ?></small></p>
		<p class=""><small><?php echo sprintf('%1$s collaboration offers submitted', $developerProfile->getNbCollaborations()); ?></small></p>
	</div>
	<?php else : ?>
	
			<h4 class=""><?php echo link_to(__("Fill in your profile now!"), 'profile/edit?username='.$sf_user->getProfile()->getUsername()); ?></h4>
			<p class="small"><?php echo __("Your profile is not filled in and you will not be listed here."); ?></p>
			<p class=""><?php echo link_to(__("Fill in your profile &raquo;"), 'profile/edit?id='.$sf_user->getProfile()->getId()); ?></p>
	
	<?php endif; ?>
	<div class="clearFloat"></div>
</div>