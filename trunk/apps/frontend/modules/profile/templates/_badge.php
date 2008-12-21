<?php use_helper('ulMisc'); ?>

<?php $playerProfile = $profile->getPlayerProfile(true); ?>

<div class="profileBadge">
	<?php if($profile->isFilledIn()) : ?>
	<?php echo linkToProfileWithGravatar($profile, 80, array('class' => 'large')); ?>
	<div class="details">
		<p class=""><small><?php echo linkToCommentProfile($profile, array(), sprintf(__('%1$s notes in your profile').' <span class="arrow">&raquo;</span>', '<strong>'.$playerProfile->getNbCommentsInProfile().'</strong>') ); ?></small></p>
		<p class=""><small><?php echo linkToProfile($profile, array(), sprintf(__('You have %1$s friends').' <span class="arrow">&raquo;</span>', '<strong>'.$playerProfile->getNbFriends().'</strong>') ); ?></small></p>
		<p class=""><small><?php echo linkToCompetitionsForProfile($profile, array(), sprintf(__('Taking part in %1$s competitions').' <span class="arrow">&raquo;</span>', '<strong>'.$playerProfile->getNbCompetitions().'</strong>') ); ?></small></p>
		<p class=""><small><?php echo linkToGroupsForProfile($profile, array(), sprintf(__('You belong to %1$s groups').' <span class="arrow">&raquo;</span>', '<strong>'.$playerProfile->getNbGroups().'</strong>') ); ?></small></p>
		
	</div>
	<?php else : ?>
	
		<h4 class=""><?php echo linkToEditProfile(null, array(), __("Fill in your profile now!")); ?></h4>
		<p class="small"><?php echo __("Your profile is not filled in and you will not be listed here."); ?></p>
		<p class=""><?php echo linkToEditProfile(null, array(), __("Fill in your profile &raquo;")); ?></p>
		
	<?php endif; ?>
	<div class="clearFloat"></div>
</div>