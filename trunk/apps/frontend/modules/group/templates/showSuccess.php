<div id="pageContent">

	<div class="contentColumn twoThirds alignLeft">
		<div class="contentBox">
			<h3 class="header"><?php echo linkToGroup($group); ?></h3>
			
			<?php if($group->getDescription()) : ?>
				<?php echo sfMarkdown::doConvert($group->getDescription()); ?>
			<?php else : ?>
				<?php echo __("There is no description for this group"); ?>
			<?php endif; ?>
		</div>

		<div class="contentBox" id="rankings">
			<h4 class="header small"><?php echo __('Members clasification:') ?></h4>
			<?php $members = $group->getMembers(); ?>
			<ul class="tags xLarge">
				<?php $linkText = ""; ?>
				<?php foreach($members as $member) : ?>
				<?php $linkText = $member->getsfGuardUserProfile() . " (" . sprintf(__('%s points'), $member->getTotalCredits()) . ")"; ?>
				<li><?php echo linkToProfileWithGravatar($member->getsfGuardUserProfile(), 25, array(), $linkText); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
		
		<div class="contentBox" id="postComment">
		<h4 class="header small"><?php echo __('Comments:') ?></h4>
		<?php
			 include_component('sfComment', 'commentForm', array('object' => $group, 'order' => 'desc'));
			 include_component('sfComment', 'commentList', array('object' => $group, 'order' => 'desc'));
		?>
		</div>
	</div>

</div>
