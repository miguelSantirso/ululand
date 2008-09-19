			<ul class="tags">
					<?php if(count($friends) != 0){ ?>
					<?php foreach($friends as $friend) : ?>
					<li><?php echo linkToProfileWithGravatar($friend->getsfGuardUserProfile(), 15); ?></li>
					<?php endforeach; ?>
					<?php } else echo __("You don't have them"); ?>
			</ul>