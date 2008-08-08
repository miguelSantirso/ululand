<?php use_helper('Date'); ?>
<div id="pageHeader">
	<h2><?php echo __('Collaboration Offer') ?></h2>
	<p class="subtitle"><?php echo __("Colaborative work is great, isn't it?"); ?></p>
</div>

<div id="pageContent">
	<h3 class="header"><?php echo link_to($collaboration_offer->getTitle(), '/collaboration/show?id='.$collaboration_offer->getId()); ?></h3>
	<div class="fixedWidth quarter contentBox alignLeft right small">
		<h4><?php echo __('Info:'); ?></h4>
		<p class="noSpace"><?php echo sprintf(__('Created at %s'), format_date($collaboration_offer->getCreatedAt())); ?></p>
		<p class="noSpace"><?php echo sprintf(__('Sent by %s'), $collaboration_offer->getsfGuardUser()->getProfile()); ?></p>
		<p class="noSpace"><?php echo sprintf(__('Tags: %s'), $collaboration_offer->getLinkedTagsString()); ?></p>
		<?php if($sf_user->getId() == $collaboration_offer->getCreatedBy()) : ?>
			<p><?php echo link_to(__('Edit'), 'collaboration/edit?id='.$collaboration_offer->getId()); ?></p>
		<?php endif; ?>
		<?php echo link_to(__('&laquo; List'), 'collaboration/list', array('class' => 'button center')) ?>
	</div>
	
	

	<div class="fixedWidth wide contentBox bordered alignLeft">
		<?php echo sfMarkdown::doConvert( $collaboration_offer->getDescription() ); ?>
	</div>
	
	<div style="clear:both"></div>
	
	<div class="fixedWidth quarter alignCenter">
		<?php echo link_to(__('&laquo; List'), 'collaboration/list', array('class' => 'button center')) ?>
	</div>
	
</div>
