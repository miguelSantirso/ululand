<?php $action = $sf_context->getActionName(); ?>
<div id="moduleHeader">
	<ul>
		<li><?php echo link_to(__('List'), 'profile/list', array('class' => $action == "list" ? 'selected' : '')); ?></li>
	</ul>
	
	<h3>
		<?php
		$separator = ' &raquo; ' ;
		$moduleIndex = link_to(__('People'), 'profile');
		switch($action) 
		{
			case "list":
				echo $moduleIndex . $separator . link_to(__('List'), 'profile/list');
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