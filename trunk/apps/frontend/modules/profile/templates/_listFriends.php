			<ul class="tags">
					<?php foreach($friends as $friend) : ?>
					<li><?php echo linkToProfileWithGravatar($friend->getsfGuardUserProfile(), 15); ?></li>
					<?php endforeach; ?>
			</ul>