<?php $action = $sf_context->getActionName(); ?>

<div id="moduleHeader">
	<ul>
		<li><?php echo link_to(__('Log in'), '@sf_guard_signin'); ?></li>
		<li><?php echo link_to(__('Register'), '@register'); ?></li>
	</ul>
	
	<h3>
		<?php
		$separator = ' &raquo ' ;
		$moduleIndex = link_to(__('Home'), 'home');
		switch($action) 
		{
			case "disabled":
				echo $moduleIndex . $separator . link_to(__('Disabled module'), 'home/disabled');
				break;
			default:
				echo $moduleIndex;
				break;
		}
		?>
	</h3>
</div>