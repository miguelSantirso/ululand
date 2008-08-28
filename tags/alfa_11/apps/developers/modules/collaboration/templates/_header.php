<?php $action = $sf_context->getActionName(); ?>

<div id="moduleHeader">
	<ul>
		<li><?php echo link_to(__('Index'), 'collaboration', array('class' => $action == "index" ? 'selected' : '')); ?></li>
		<li><?php echo link_to(__('List'), 'collaboration/list', array('class' => $action == "list" ? 'selected' : '')); ?></li>
		<li><?php echo link_to(__('Submit'), 'collaboration/create', array('class' => $action == "create" ? 'selected' : '')); ?></li>
	</ul>
	
	<h3>
		<?php
		$separator = ' &raquo; ' ;
		$moduleIndex = link_to(__('Collaboration offers'), 'collaboration');
		switch($sf_context->getActionName()) 
		{
			case "list":
				echo $moduleIndex . $separator . link_to(__('List'), 'collaboration/list');
				break;
			case "show":
				echo $moduleIndex . $separator . __('Show');
				break;
			case "create":
				echo $moduleIndex . $separator . link_to(__('Submit'), 'collaboration/create');
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