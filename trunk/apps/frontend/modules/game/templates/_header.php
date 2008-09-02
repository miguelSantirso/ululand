<?php $action = $sf_context->getActionName(); ?>
<div id="moduleHeader">
	<ul>
		<li><?php echo link_to(__('List'), 'game/list', array('class' => $action == "list" ? 'selected' : '')); ?></li>
	</ul>
	
	<h3>
		<?php
		$separator = ' &raquo; ' ;
		$moduleIndex = link_to(__('Games'), 'game');
		switch($action) 
		{
			case "list":
				echo $moduleIndex . $separator . link_to(__('List'), 'profile/list');
				break;
			case "show":
				echo $moduleIndex . $separator . __('Play');
				break;
			default:
				echo $moduleIndex;
				break;
		}
		?>
	</h3>
	
</div>