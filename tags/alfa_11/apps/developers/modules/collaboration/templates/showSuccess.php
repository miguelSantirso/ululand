<?php use_helper('Date', 'Partial'); ?>

<div id="pageContent">
	<div class="contentColumn wide alignLeft">
		<div class="contentBox">
			<h3 class="header">
				<?php echo linkToCollaborationOffer($collaboration_offer); ?>
				<?php if($sf_user->isAuthenticated() && $sf_user->getId() == $collaboration_offer->getCreatedBy()) : ?>
					<span>(<?php echo linkToEditCollaborationOffer($collaboration_offer, array(), __('edit')); ?>)</span>
				<?php endif; ?>
			</h3>
			
			<div class="xSmall right">
				<p class="noSpace"><?php echo sprintf(__('Submitted by %1$s %2$s ago (%3$s)'),
							linkToProfile($collaboration_offer->getsfGuardUser()->getProfile()),
							time_ago_in_words($collaboration_offer->getCreatedAt('U')), 
							format_date($collaboration_offer->getCreatedAt()) ); ?></p>
			</div>
			
			<?php echo sfMarkdown::doConvert( $collaboration_offer->getDescription() ); ?>
			
		</div>
		<div class="contentBox bordered light">
			<h4 class="header"><?php echo __('Collaboration offer details'); ?></h4>
			<p class="noSpace small"><strong><?php echo __('Tags'); ?>:</strong> <?php echo $collaboration_offer->getLinkedTagsString(); ?></p>
			<p class="noSpace small"><strong><?php echo __('Autor'); ?>:</strong> <?php echo linkToProfile($collaboration_offer->getsfGuardUser()->getProfile()); ?></p>
			<p class="noSpace small"><strong><?php echo __('Date'); ?>:</strong> <?php echo format_date($collaboration_offer->getCreatedAt()); ?></p>
			<p class="noSpace small"><strong><?php echo __('Visits'); ?>:</strong> <?php echo $collaboration_offer->getCounter(); ?></p>
		</div>
		<div class="contentBox">
			<h4 class="header small"><?php echo __('Comments:') ?></h4>
			<?php
				include_component('sfComment', 'commentForm', array('object' => $collaboration_offer, 'order' => 'desc'));
				include_component('sfComment', 'commentList', array('object' => $collaboration_offer, 'order' => 'desc'));
			?>
		</div>
	</div>
	<div class="contentColumn quarter alignLeft">
		<?php include_partial('searchForm'); ?>
		
		<?php include_partial('relatedByTags', array('title' => __('Similar Offers'), 'tagsString' => $collaboration_offer->getTagsString())); ?>
		
		<?php include_component('profile', 'relatedByTags', array('tagsString' => $collaboration_offer->getTagsString(), 'onlyFree' => true)); ?>
	</div>
	
	<div class="clearFloat"></div>
	<div class="contentColumn quarter alignCenter">
		<?php echo link_to(sprintf('&laquo; %s', __('List')), 'collaboration/list', array('class' => 'button')) ?>
	</div>
	
</div>
