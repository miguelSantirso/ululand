<?php use_helper('ulMisc'); ?>

<?php $developerProfile = $profile->getDeveloperProfile(); ?>

<div class="profileBadge">
	<?php if($profile->isFilledIn()) : ?>
	<?php echo linkToProfileWithGravatar($profile, 80, array('class' => 'large')); ?>
	<div class="details">
	</div>
	<?php else : ?>
	
			<h4 class=""><?php echo link_to(__("Fill in your profile now!"), 'profile/edit?id='.$sf_user->getProfile()->getId()); ?></h4>
			<p class="small"><?php echo __("Your profile is not filled in and you will not be listed here."); ?></p>
			<p class=""><?php echo link_to(__("Fill in your profile &raquo;"), 'profile/edit?id='.$sf_user->getProfile()->getId()); ?></p>
	
	<?php endif; ?>
	<div class="clearFloat"></div>
</div>