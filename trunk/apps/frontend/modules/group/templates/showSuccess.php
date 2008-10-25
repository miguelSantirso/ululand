<h2 id="pageTitle"><?php echo link_to(image_tag("iconOptions.png").$group->getName(), linkToGroup($group)); ?></h2>

<div id = "pageContent" >
	
	<div class = "contentColumn quarter alignLeft">
		<div class = "contentBox">
			<?php echo linkToGroupWithThumbnail($group, 200, array('class' => 'firstRow xLarge')); ?>
		</div>
		
		<div class = "contentBox">
			<?php if($sf_user->isAuthenticated()) : ?>
			<?php $status = $group->getStatus($sf_user->getPlayerProfile()); ?>
				<?php if($status == GroupPeer::OWNER) : ?>
					<p><?php echo link_to(__("Admin"), 'group/edit?id='.$group->getId()); ?></p>
				<?php endif; ?>
				
				<?php if($status == GroupPeer::MEMBER || $status == GroupPeer::OWNER) : ?>
					<?php echo button_to(__("Leave group"), 'group/reject?group='.$group->getId().'&player='.$sf_user->getPlayerProfile()->getId()); ?>	
				<?php elseif($status == GroupPeer::PENDING) : ?>
					<?php echo __("You must be approved by one of the owners"); ?>
				<?php elseif($status == GroupPeer::NOT_MEMBER) : ?>
					<?php echo button_to(__("Join us!"), 'group/union?group='.$group->getId()); ?>	
				<?php endif; ?>
			<?php endif; ?>
		</div>
		
		<div class = "contentBox bordered">
			<p class="noSpace small"><strong><?php echo __('Visits:'); ?></strong> <?php echo $group->getCounter(); ?></p>
		</div>
	</div>
	
	<div class = "contentColumn half alignLeft">
		<div class = "contentBox ">
			<h3 class = "header"><?php echo linkToGroup($group); ?></h3>
			<?php if($group->getDescription() != ''){ ?> 
				<?php echo sfMarkdown::doConvert( $group->getDescription() ); ?>
			<?php } else { ?>
				<p><?php echo __('There is no description for this group'); ?></p>
			<?php } ?>
		</div>
		<div class="contentBox" id="postComment">
			<h4 class="header small"><?php echo __('Comments:') ?></h4>
			<?php
				if ($sf_user->isAuthenticated() && ($status == GroupPeer::OWNER || $status == GroupPeer::MEMBER))
				{
					include_component('sfComment', 'commentForm', array('object' => $group, 'order' => 'desc'));
				}
				include_component('sfComment', 'commentList', array('object' => $group, 'order' => 'desc'));
			?>
		</div>
	</div>
	
	<div class = "contentColumn quarter alignLeft">
		<div class="contentBox">
			<h4 class="header small"><?php echo __('Ranking:') ?></h4>
			<?php
				 include_component('group', 'listMembers', array('group' => $group, 'orderDescendingBy' => PlayerProfilePeer::TOTAL_CREDITS));
			?>
		</div>
		
		<div class="contentBox">
			<h4 class="header small"><?php echo __('Members:') ?></h4>
			<?php
				 include_component('group', 'listMembers', array('group' => $group, 'orderDescendingBy' => PlayerProfile_GroupPeer::CREATED_AT));
			?>
		</div>
	</div>
	
	
</div>