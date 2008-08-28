<?php use_helper('ulMisc'); ?>
 
<div id="webTitle">
	<h1>
		<?php $linktText = sprintf(__('%1$s is a flash game %2$s.'), '<span class="url">developers.ululand.com</span>', '<span class="important">'.__('developers community').'</span>') ?>
		<?php echo link_to(__($linktText), '@homepage') ?>
	</h1>
</div>