			<?php if(count($members) != 0){ ?>
			<ul class="tags">
				<?php $linkText = ""; ?>
				<?php foreach($members as $member) : ?>
				<li><?php echo linkToProfileWithGravatar($member->getsfGuardUserProfile(), 35, array()); ?>
					<?php if($edit) { ?>
							<?php if($pending) echo button_to(__("Accept"), 'competition/accept?competition='.$competition->getId().'&player='.$member->getId()); ?>
							<?php echo button_to(__("Expel"), 'competition/reject?competition='.$competition->getId().'&player='.$member->getId()); ?>
							<?php echo button_to(__("Make owner"), 'competition/makeOwner?competition='.$competition->getId().'&player='.$member->getId()); ?>
					<?php } ?>
					<div class="clearFloat"></div>
				</li>
				<?php endforeach; ?>
			</ul>
			<?php } else echo __("You don't have them"); ?>