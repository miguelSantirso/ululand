<?php use_helper('ulMisc'); ?>

<?php $playerProfile = $profile->getPlayerProfile(); ?>

<div class="profileBadge">
	<?php if($profile->isFilledIn()) : ?>
	<?php echo linkToProfileWithGravatar($profile, 80, array('class' => 'large')); ?>
	<div class="details">
		<p class=""><small><?php echo linkToCommentProfile($profile, array(), sprintf(__('%1$s notes in your profile').' <span class="arrow">&raquo;</span>', '<strong>'.$playerProfile->getNbCommentsInProfile().'</strong>') ); ?></small></p>
		<p class=""><small><?php echo linkToProfile($profile, array(), sprintf(__('You have %1$s friends').' <span class="arrow">&raquo;</span>', '<strong>'.$playerProfile->getNbFriends().'</strong>') ); ?></small></p>
		<p class=""><small><?php echo linkToGroupsForProfile($profile, array(), sprintf(__('You belong to %1$s groups').' <span class="arrow">&raquo;</span>', '<strong>'.$playerProfile->getNbGroups().'</strong>') ); ?></small></p>
		
	</div>
	<?php else : ?>
	
			<h4 class=""><?php echo link_to(__("Fill in your profile now!"), 'profile/edit?id='.$sf_user->getProfile()->getId()); ?></h4>
			<p class="small"><?php echo __("Your profile is not filled in and you will not be listed here."); ?></p>
			<p class=""><?php echo link_to(__("Fill in your profile &raquo;"), 'profile/edit?id='.$sf_user->getProfile()->getId()); ?></p>
	
	<?php endif; ?>
	<div class="clearFloat"></div>
</div>