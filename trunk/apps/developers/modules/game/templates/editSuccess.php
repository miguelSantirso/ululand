<?php use_helper('Object', 'Validation', 'Javascript') ?>

<div id="pageContent">

	<div class="contentColumn half alignLeft">
		<div class="contentBox light">
			<h3 class="header"><?php echo __('Game Info:'); ?></h3>
			<?php echo form_tag('game/update', 'multipart=true') ?>
			
			<?php echo object_input_hidden_tag($game, 'getId') ?>
			
			<p class="noSpace"><?php echo label_for('name', __('Name:')); ?></p>
			<?php echo form_error("name"); ?>
			<?php echo object_input_tag($game, 'getName', array (
			  'size' => 65, 'maxlength' => 75
			)) ?>
			<br/>
			<br/>
			<p class="noSpace"><?php echo label_for('thumbnail_path', __('Thumbnail:')); ?></p>
			<?php echo form_error("thumbnail_path"); ?>
			<?php echo input_file_tag("thumbnail_path"); ?>
			<p class="noSpace"><small><?php echo __('Accepts (almost) everything. And don\'t worry; we will resize it for you ;)'); ?></small></p>
			<br/>
			<p class="noSpace"><?php echo label_for('description', __('Description:')); ?></p>
			<?php echo form_error('description'); ?>
			<?php echo object_textarea_tag($game, 'getDescription', array (
			  'size' => '50x6',
			)) ?>
			<p class="noSpace"><small><?php echo sprintf(__('A short description for your game. Accepts %s.'), link_to('Markdown', 'http://daringfireball.net/projects/markdown/syntax')); ?></small></p>
			<br/>
			<p class="noSpace"><?php echo label_for('instructions', __('Instructions:')); ?></p>
			<?php echo form_error('instructions'); ?>
			<?php echo object_textarea_tag($game, 'getInstructions', array (
			  'size' => '50x3',
			)) ?>
			<p class="noSpace"><small><?php echo sprintf(__('Instructions on how to play the game. Accepts %s.'), link_to('Markdown', 'http://daringfireball.net/projects/markdown/syntax')); ?></small></p>
			<br/>
			<p class="noSpace"><?php echo label_for('tags', __('Tags')); ?></p>
			<?php echo form_error('tags'); ?>
			<?php echo object_input_tag($game, 'getTagsString', array (
			  'size' => 65,
			)) ?>
			<p class="noSpace"><small class=''><?php echo __('Comma separated. Examples: physics, arcade, platforms'); ?></small></p>
			<br/>
			
			<?php $with = "'name=' + encodeURIComponent($('name').value) + '&description=' + encodeURIComponent($('description').value) + '&instructions=' + encodeURIComponent($('instructions').value)"; ?>
			<?php echo observe_field('name', array(
					'update'  => 'gamePreview',
					'url'     => 'game/preview',
					'before'  => "Element.show('loadIndicator'); Element.setOpacity('gamePreview', 0.5);",
					'complete'=> "Element.hide('loadIndicator'); Element.setOpacity('gamePreview', 1);",
				    'with'    => $with)) ?>
			<?php echo observe_field('description', array(
					'frequency' => '5',
					'update'  => 'gamePreview',
					'url'     => 'game/preview',
					'before'  => "Element.show('loadIndicator'); Element.setOpacity('gamePreview', 0.5);",
					'complete'=> "Element.hide('loadIndicator'); Element.setOpacity('gamePreview', 1);",
				    'with'      => $with)) ?>
			<?php echo observe_field('instructions', array(
					'frequency' => '5',
					'update'  => 'gamePreview',
					'url'     => 'game/preview',
					'before'  => "Element.show('loadIndicator'); Element.setOpacity('gamePreview', 0.5);",
					'complete'=> "Element.hide('loadIndicator'); Element.setOpacity('gamePreview', 1);",
				    'with'      => $with)) ?>
			
			<?php echo link_to_remote(__('update preview &raquo;'), array(
					'update'  => 'gamePreview',
					'url'     => 'game/preview',
					'before'  => "Element.show('loadIndicator'); Element.setOpacity('gamePreview', 0.5);",
					'complete'=> "Element.hide('loadIndicator'); Element.setOpacity('gamePreview', 1);",
		    		'with'    => $with),
			array('class' => 'large alignRight')) ?>
			<?php echo submit_tag(__('submit')) ?>
			<?php if ($game->getId()): ?>
			  &nbsp;<?php echo linkToGame($game, array(), 'cancel'); ?>
			<?php else: ?>
			  &nbsp;<?php echo link_to(__('cancel'), 'game/list') ?>
			<?php endif; ?>
			<div class="clearFloat"></div>
			</form>
		</div>
	</div>
	
	<div class="alignRight contentColumn half">
		<div id="loadIndicator" class="alignRight"><?php echo image_tag('ajax-loader.gif'); ?></div>
		<h3 class="header"><?php echo __('Preview'); ?>:</h3>
		<div id="gamePreview" class="contentBox bordered"></div>
			    
		<?php echo javascript_tag(
			  remote_function(array(
					'update'  => 'gamePreview',
					'url'     => 'game/preview',
				  	'complete'=> "Element.hide('loadIndicator')",
				    'with'    => $with
			  ))
			) ?>
	</div>

</div>