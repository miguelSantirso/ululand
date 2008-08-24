<?php use_helper('Date', 'Partial'); ?>

<div id="pageContent">
	<div class="contentColumn wide alignLeft">
		<div class="contentBox bordered">
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
			
			<p class="noSpace small"><strong><?php echo __('Tags'); ?>:</strong> <?php echo $collaboration_offer->getLinkedTagsString(); ?></p>
			<p class="noSpace small"><strong><?php echo __('Visits'); ?>:</strong> <?php echo $collaboration_offer->getCounter(); ?></p>
			
		</div>
		<div class="contentBox">
			<?php
				include_component('sfComment', 'commentList', array('object' => $collaboration_offer));
				include_component('sfComment', 'commentForm', array('object' => $collaboration_offer));
			?>
		</div>
	</div>
	<div class="contentColumn quarter alignLeft">
		<?php include_partial('searchForm'); ?>
		
		<?php include_partial('relatedByTags', array('title' => __('Similar Offers'), 'tagsString' => $collaboration_offer->getTagsString())); ?>
		
		<?php include_component('profile', 'relatedByTags', array('tagsString' => $collaboration_offer->getTagsString(), 'onlyFree' => true)); ?>
	</div>
	
	<div style="clear:both"></div>
	<div class="contentColumn quarter alignCenter">
		<?php echo link_to(sprintf('&laquo; %s', __('List')), 'collaboration/list', array('class' => 'button')) ?>
	</div>
	
</div>
