			<?php if(count($members) != 0){ ?>
			<ul class="tags">
				<?php $linkText = ""; ?>
				<?php foreach($members as $member) : ?>
				<?php $linkText = $member->getsfGuardUserProfile() . " (" . sprintf(__('%s points'), $member->getTotalCredits()) . ")"; ?>
				<li><?php echo linkToProfileWithGravatar($member->getsfGuardUserProfile(), 35, array(), $linkText); ?>
					<?php if($edit) { ?>
							<?php if($pending) echo button_to(__("Accept"), 'group/accept?group='.$group->getId().'&player='.$member->getId()); ?>
							<?php echo button_to(__("Expel"), 'group/reject?group='.$group->getId().'&player='.$member->getId()); ?>
							<?php echo button_to(__("Make owner"), 'group/makeOwner?group='.$group->getId().'&player='.$member->getId()); ?>
					<?php } ?>
					<div class="clearFloat"></div>
				</li>
				<?php endforeach; ?>
			</ul>
			<?php } else echo __("You don't have them"); ?>