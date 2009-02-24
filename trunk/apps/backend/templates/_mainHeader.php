<?php 

$module = $sf_context->getModuleName();

$isHome = $module == 'admin' || $module == 'sfGuardAuth';

?>
<div id="mainHeader">

	
	
	<h2>
		<?php if($isHome) : ?>
		<?php echo link_to(__('Home'), 'admin/index'); ?>
		<?php endif; ?>
		
	</h2>
</div>
