<?php use_helper('ulMisc'); ?>

<?php $developerProfile = $profile->getDeveloperProfile(); ?>

<div class="profileBadge">
	<?php if($profile->isFilledIn()) : ?>
	<?php echo linkToProfileWithGravatar($profile, 80, array('class' => 'large')); ?>
	<div class="details">
		<p class=""><small><?php echo linkToCommentProfile($profile, array(), sprintf(__('%1$s comments in your profile').' <span class="arrow">&raquo;</span>', '<strong>'.$developerProfile->getNbCommentsInProfile().'</strong>') ); ?></small></p>
		<p class=""><small><?php echo linkToGamesByUser($profile, array(), sprintf(__('%1$s games submitted').' <span class="arrow">&raquo;</span>', '<strong>'.$developerProfile->getNbGames().'</strong>') ); ?></small></p>
		<p class=""><small><?php echo linkToRecipesByUser($profile, array(), sprintf(__('%1$s recipes sent to the cookbook').' <span class="arrow">&raquo;</span>', '<strong>'.$developerProfile->getNbRecipes().'</strong>') ); ?></small></p>
		<p class=""><small><?php echo linkToCollaborationOffersByUser($profile, array(), sprintf(__('%1$s collaboration offers submitted').' <span class="arrow">&raquo;</span>', '<strong>'.$developerProfile->getNbCollaborations().'</strong>') ); ?></small></p>
	</div>
	<?php else : ?>
	
		<h4 class=""><?php echo linkToEditProfile(null, array(), __("Fill in your profile now!")); ?></h4>
		<p class="small"><?php echo __("Your profile is not filled in and you will not be listed here."); ?></p>
		<p class=""><?php echo linkToEditProfile(null, array(), __("Fill in your profile &raquo;")); ?></p>
	
	<?php endif; ?>
	<div class="clearFloat"></div>
</div>