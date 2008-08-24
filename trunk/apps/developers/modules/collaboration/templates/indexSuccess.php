<?php use_helper('Partial'); ?>

<div id="pageContent">

	<div class="contentRow">
		<div class="contentColumn wide alignCenter">
			<div class="contentBox">
				<h3 class="xLarge" style="font-weight: normal"><?php echo __('We help you work together.'); ?></h3>
				
				<?php if($sf_user->isAuthenticated()) : ?>
					<a href="<?php echo url_for('collaboration/create'); ?>" class="bigBox">
						<span class="header xLarge"><?php echo __('Submit a collaboration offer'); ?></span>
						<span class="description"><?php echo __('Once you have send your collaboration offer, the Kollaborator will search the collaborators who fit your offer within the registered developers.'); ?></span>
					</a>
				<?php else : ?>
					<a href="<?php echo url_for('@register'); ?>" class="bigBox">
						<span class="header xLarge"><?php echo __('Register'); ?></span>
						<span class="description"><?php echo __('Register to submit your own collaboration offers or to appear in the list of available collaborators.'); ?></span>
					</a>
				<?php endif; ?>
				
				<a href="<?php echo url_for('collaboration/list'); ?>" class="bigBox">
					<span class="header xLarge"><?php echo __('Search within the existing collaboration offers'); ?></span>
					<span class="description"><?php echo __('If you are looking for a project to work on, check the latest collaboration offers.'); ?></span>
				</a>
			</div>
		</div>
	</div>
	
</div>