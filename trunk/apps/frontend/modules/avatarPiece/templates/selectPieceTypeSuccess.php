<div id="pageContent">
	<div class="contentBox center">
		<h3 class="center"><?php echo __('Step 1') ?>:</h3>
		<h3 class="header center xLarge"><?php echo __('Select the part you want to create') ?></h3>
		
		<div class="contentColumn third alignCenter">
		<?php echo link_to(__('Head'), 'avatarPiece/create?pieceType=head', array('class' => 'bigBox large')); ?>
		<?php echo link_to(__('Body'), 'avatarPiece/create?pieceType=body', array('class' => 'bigBox large')); ?>
		<?php echo link_to(__('Arm'), 'avatarPiece/create?pieceType=arm', array('class' => 'bigBox large')); ?>
		<?php echo link_to(__('Leg'), 'avatarPiece/create?pieceType=leg', array('class' => 'bigBox large')); ?>
		</div>
	</div>
</div>