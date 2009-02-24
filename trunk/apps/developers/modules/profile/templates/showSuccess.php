<div id="pageContent">

	<div class="contentColumn wide alignLeft">
		<div class="contentBox">
			<h3 class="header">
				<?php echo linkToProfileWithGravatar($sf_guard_user_profile, 70); ?>
				<?php if($sf_user->isAuthenticated() && $sf_guard_user_profile->getId() == $sf_user->getProfile()->getId()) { ?> 
				<span class="">(<?php echo linkToEditProfile(); ?>)</span>
				<?php } ?>
			</h3>
			<small class="noSpace subtitle"><?php echo sprintf(__("Profile for %s"), linkToProfile($sf_guard_user_profile)); ?></small>
			<div style="clear: both"></div>
			<?php if($developerProfile->getIsFree()) { ?>
				<div class="contentBox light center"><span><?php echo __('Hey! I\'m looking for a project to work on!'); ?></span></div>
			<?php } ?>
			
			<div class="">
			<?php if($developerProfile->getDescription() != ''){ ?> 
				<?php echo sfMarkdown::doConvert( $developerProfile->getDescription() ); ?>
			<?php } else { ?>
				<p><?php echo __('There is no description for this user'); ?></p>
			<?php } ?>
			</div>
			<div class="contentBox light bordered">
			<h4 class="header small"><?php echo __('Developer Details:') ?></h4>
			
			<?php if($developerProfile->getUrl() != '') : ?>
				<p class="noSpace small"><?php echo __('Url') ?>: <?php echo link_to($developerProfile->getUrl(), $developerProfile->getUrl()); ?></p>
			<?php endif; ?>
			<p class="noSpace small"><?php echo __('Tags'); ?>: <?php echo $developerProfile->getLinkedTagsString(); ?></p>
			<p class="noSpace small"><?php echo __('Visits'); ?>: <strong><?php echo $developerProfile->getCounter(); ?></strong></p>
			
			<?php if($sf_user->isAuthenticated() && $sf_guard_user_profile->getId() == $sf_user->getProfile()->getId()) { ?> 
				<span class="small"><?php echo linkToEditProfile(); ?></span>
			<?php } ?>
			</div>
			<div class="contentBox" id="postComment">
			<h4 class="header small"><?php echo __('Comments:') ?></h4>
			<?php
				include_component('sfComment', 'commentForm', array('object' => $developerProfile, 'order' => 'desc'));
				include_component('sfComment', 'commentList', array('object' => $developerProfile, 'order' => 'desc'));
			?>
			</div>
		</div>
	</div>

	<div class="contentColumn quarter alignLeft">
		<?php include_partial('searchForm'); ?>
		
		<?php include_partial('relatedByTags', array('title' => __('Similar Developers'), 'tagsString' => $developerProfile->getTagsString())) ?>
		
		<?php include_partial('collaboration/relatedByTags', array('tagsString' => $developerProfile->getTagsString())) ?>
	</div>
	
	<div class="clearFloat"></div>
	
	<div class="contentColumn quarter contentBox alignCenter">
		<?php echo link_to(sprintf('&laquo; %s', __('List')), 'profile/list', array('class' => 'button')) ?>
	</div>

</div>