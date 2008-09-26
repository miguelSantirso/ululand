<?php $action = $sf_context->getActionName(); ?>
<div id="moduleHeader">
	<ul>
		<li><?php echo link_to(__('Index'), 'competition', array('class' => $action == "index" ? 'selected' : '')); ?></li>
		<li><?php echo link_to(__('List'), 'competition/list', array('class' => $action == "list" ? 'selected' : '')); ?></li>
		<li><?php echo link_to(__('New Competition'), 'competition/edit', array('class' => $action == "edit" ? 'selected' : '')); ?></li>
	</ul>
	
	<h3>
		<?php
		$separator = ' &raquo; ' ;
		$moduleIndex = link_to(__('Competitions'), 'competition');
		switch($action) 
		{
			case "list":
				echo $moduleIndex . $separator . link_to(__('List'), 'competition/list');
				break;
			case "show":
				echo $moduleIndex . $separator . __('Show');
				break;
			case "edit":
				echo $moduleIndex . $separator . __('Edit');
				break;
			default:
				echo $moduleIndex;
				break;
		}
		?>
	</h3>
	
</div>