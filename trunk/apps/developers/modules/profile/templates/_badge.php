<?php use_helper('ulMisc'); ?>

<?php $developerProfile = $profile->getDeveloperProfile(); ?>

<div class="profileBadge">
	<?php if($profile->isFilledIn()) : ?>
	<?php //echo linkToProfile($profile, array(), gravatar_tag($profile->getSfGuardUser()->getUsername(), 80, array('class' => 'gravatar')) ); ?>
	<?php //echo linkToProfile($profile, array('class' => 'username')); ?>
	<?php echo linkToProfileWithGravatar($profile, 80, array('class' => 'large')); ?>
	<div class="details">
		<p class=""><small><?php echo linkToCommentProfile($profile, array(), sprintf(__('%1$s comments in your profile').' <span class="arrow">&raquo;</span>', '<strong>'.$developerProfile->getNbCommentsInProfile().'</strong>') ); ?></small></p>
		<p class=""><small><?php echo linkToGamesByUser($profile, array(), sprintf(__('%1$s games submitted').' <span class="arrow">&raquo;</span>', '<strong>'.$developerProfile->getNbGames().'</strong>') ); ?></small></p>
		<p class=""><small><?php echo linkToRecipesByUser($profile, array(), sprintf(__('%1$s recipes sent to the cookbook').' <span class="arrow">&raquo;</span>', '<strong>'.$developerProfile->getNbRecipes().'</strong>') ); ?></small></p>
		<p class=""><small><?php echo linkToCollaborationOffersByUser($profile, array(), sprintf(__('%1$s collaboration offers submitted').' <span class="arrow">&raquo;</span>', '<strong>'.$developerProfile->getNbCollaborations().'</strong>') ); ?></small></p>
	</div>
	<?php else : ?>
	
			<h4 class=""><?php echo link_to(__("Fill in your profile now!"), 'profile/edit?username='.$sf_user->getProfile()->getUsername()); ?></h4>
			<p class="small"><?php echo __("Your profile is not filled in and you will not be listed here."); ?></p>
			<p class=""><?php echo link_to(__("Fill in your profile &raquo;"), 'profile/edit?id='.$sf_user->getProfile()->getId()); ?></p>
	
	<?php endif; ?>
	<div class="clearFloat"></div>
</div>