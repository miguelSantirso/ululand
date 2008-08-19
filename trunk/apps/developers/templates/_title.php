<?php use_helper('ulMisc'); ?>

<!--  <div id="logo">
	<h1><?php echo link_to(__('ulu<span id="land">land</span>'), "@homepage"); ?></h1> 
	<p><?php echo __('Developers<br/>Network'); ?></p>
</div>

-->
<!-- 
<div id="logo">
	<h1>
		<a href="http://ululand.com/">ululand.com</a> / <?php echo link_to('developers', '@homepage'); ?> /
		<?php if($sf_context->getModuleName() != 'home') : ?>
			<?php echo link_to($sf_context->getModuleName(), $sf_context->getModuleName()); ?> /
		<?php endif; ?>
		<?php if($sf_context->getActionName() != 'index') : ?>
			<?php echo link_to($sf_context->getActionName(), $sf_context->getModuleName().'/'.$sf_context->getActionName()); ?> /
		<?php endif; ?>
	</h1>
</div>
 -->
 
<div id="title">
	<h1>
		<?php echo dynamicContextUrl($sf_context); ?>
	</h1>
</div>