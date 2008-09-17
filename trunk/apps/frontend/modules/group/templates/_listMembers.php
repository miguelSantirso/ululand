			<ul class="tags">
				<?php $linkText = ""; ?>
				<?php foreach($members as $member) : ?>
				<?php $linkText = $member->getsfGuardUserProfile() . " (" . sprintf(__('%s points'), $member->getTotalCredits()) . ")"; ?>
				<li><?php echo linkToProfileWithGravatar($member->getsfGuardUserProfile(), 35, array(), $linkText); ?></li>
				<?php endforeach; ?>
			</ul>