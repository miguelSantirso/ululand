<?php use_helper('ulMisc'); ?>
 
<div id="webTitle">
	<h1>
		<?php $linktText = sprintf(__('%1$s is where we %2$s from.'), '<span class="url">backend.ululand.com</span>', '<span class="important">'.__('control our world').'</span>') ?>
		<?php echo link_to(__($linktText), '@homepage') ?>
	</h1>
</div>