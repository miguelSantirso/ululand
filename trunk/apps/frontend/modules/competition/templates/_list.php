		<?php use_helper('PagerNavigation'); ?>
		
		<div class="center"><?php echo pager_navigation($competitionsPager, 'competition/list'); ?></div>
		
		<?php $competitions = $competitionsPager->getResults(); ?>
		<?php //sfPropelActAsTaggableBehavior::preloadTags($profiles); ?>
		
		<?php if(count($competitions) != 0){ ?>
		<ul class="compound">
			<?php foreach ($competitions as $competition): ?>
				<li class="">
					<?php echo linkToCompetition($competition, array('class' => 'firstRow')); ?>
					<div class="lastRow">
						<?php //if($sf_user->isAuthenticated() && $userProfile->getId() == $sf_user->getProfile()->getId()) { echo linkToEditProfile($sf_user->getProfile(), array('class' => 'alignRight xSmall')); } ?>
					</div>
					<div class="clearFloat"></div>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php } else echo __("There are no competitions still"); ?>
	
		<div class="center"><?php echo pager_navigation($competitionsPager, 'profile/list'); ?></div>