<?php use_helper('Date', 'PagerNavigation'); ?>

<div class="center"><?php echo pager_navigation($collaborationsPager, 'profile/list'); ?></div>

<ul class="compound">
	<?php
		$collaborationOffers = $collaborationsPager->getResults();
		sfPropelActAsTaggableBehavior::preloadTags($collaborationOffers);
	?>
	<?php foreach ($collaborationOffers as $collaboration_offer): ?>
	<li class="">
		<strong><?php echo linkToCollaborationOffer($collaboration_offer, array('class' => 'firstRow')); ?></strong>
		<div class="lastRow">
			<p class="alignRight xSmall noSpace"><?php echo sprintf('by %1$s %2$s ago', 
					linkToProfile($collaboration_offer->getsfGuardUser()->getProfile()), 
					time_ago_in_words($collaboration_offer->getCreatedAt('U')) ); ?></p>
			<p class="noSpace xSmall"><strong><?php echo __('Tags'); ?>:</strong> <?php echo $collaboration_offer->getLinkedTagsString(); ?></p>
		</div>
	</li>
<?php endforeach; ?>
</ul>

<div class="center"><?php echo pager_navigation($collaborationsPager, 'profile/list'); ?></div>