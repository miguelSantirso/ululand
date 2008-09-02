<?php use_helper('ulMisc'); ?>
 
<div id="webTitle">
	<h1>
		<?php $linktText = sprintf(__('%1$s is the best place to play %2$s.'), '<span class="url">ululand.com</span>', '<span class="important">'.__('free flash games').'</span>') ?>
		<?php echo link_to(__($linktText), '@homepage') ?>
	</h1>
</div>