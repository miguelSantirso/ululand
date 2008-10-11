<?php use_helper('PagerNavigation', 'Partial'); ?>


<div id="pageContent">

	<div class="contentColumn wide alignLeft">
		<?php include_component('avatarPiece', 'list'); ?>		

	</div>
	
	
	<div class="contentColumn quarter alignLeft">
		<div class="contentBox">
			<?php if($sf_user->isAuthenticated()) : ?>
			<?php echo link_to('Create new avatar piece &rsaquo;', 'avatarPiece/create', array('class' => 'bigBox')); ?>
			<?php endif; ?>
		</div>
	</div>

</div>
