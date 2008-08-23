<?php use_helper('Object', 'Validation', 'Javascript'); ?>

<div id="pageHeader">
	<h2><?php echo link_to(__("Submit a recipe"), '/recipe/create'); ?></h2>
	<p class="subtitle"><?php echo __("Keep It Simple, Stupid!"); ?></p>
</div>


<div id="pageContent">

	<div class="contentColumn half alignLeft">
		<div class="contentBox light">
			<h3 class="header"><?php echo __('Recipe Info:'); ?></h3>
			<?php echo form_tag('recipe/update') ?>
			
			<?php echo object_input_hidden_tag($code_piece, 'getId') ?>
		
			<!-- Título -->
			<p class="noSpace"><?php echo label_for('title', __('Title:')); ?></p>
			<?php echo form_error("title"); ?>
			<?php echo object_input_tag($code_piece, 'getTitle', array (
			  'size' => 65, 'maxlength' => 75
			)) ?>
			<br/>
			<br/>
			<!-- Código -->
			<p class="noSpace"><?php echo label_for('source', __('Source:')); ?></p>
			<?php echo form_error('source'); ?>
			<?php echo object_textarea_tag($code_piece, 'getSource', array (
			  'size' => '50x12',
			)) ?>
			<p class="noSpace"><small class=''><?php echo __('Paste or write the code here. You can preview it in the right side.'); ?></small></p>
			<br/>
			<!-- Tags -->
			<p class="noSpace"><?php echo label_for('tags', __('Tags:')); ?></p>
			<?php echo form_error('tags'); ?>
			<?php echo object_input_tag($code_piece, 'getTagsString', array (
			  'size' => 65,
			)) ?>
			<p class="noSpace"><small class=''><?php echo __('Comma separated.'); ?></small></p>
			<br/>
			
			<?php echo observe_field('title', array(
					'update'  => 'recipePreview',
					'url'     => 'recipe/preview',
					'before'  => "Element.show('loadIndicator'); Element.setOpacity('recipePreview', 0.5);",
					'complete'=> "Element.hide('loadIndicator'); Element.setOpacity('recipePreview', 1);",
				    'with'    => "'title=' + $('title').value + '&source=' + $('source').value")) ?>
			<?php echo observe_field('description', array(
					'frequency' => '5',
					'update'    => 'recipePreview',
					'url'       => 'recipe/preview',
					'before'  => "Element.show('loadIndicator'); Element.setOpacity('recipePreview', 0.5);",
					'complete'=> "Element.hide('loadIndicator'); Element.setOpacity('recipePreview', 1);",
				    'with'    => "'title=' + $('title').value + '&source=' + $('source').value")) ?>
			<?php echo observe_field('source', array(
					'frequency' => '5',
					'update'    => 'recipePreview',
					'url'       => 'recipe/preview',
					'before'  => "Element.show('loadIndicator'); Element.setOpacity('recipePreview', 0.5);",
					'complete'=> "Element.hide('loadIndicator'); Element.setOpacity('recipePreview', 1);",
				    'with'    => "'title=' + $('title').value + '&source=' + $('source').value")) ?>
				    
				    			
			<?php echo link_to_remote(__('update preview &raquo;'), array(
				'update'  => 'recipePreview',
				'url'     => 'recipe/preview',
				'before'  => "Element.show('loadIndicator'); Element.setOpacity('recipePreview', 0.5);",
				'complete'=> "Element.hide('loadIndicator'); Element.setOpacity('recipePreview', 1);",
		    	'with'    => "'title=' + $('title').value + '&source=' + $('source').value"),
			array('class' => 'large alignRight')); ?>
			
			
			<?php echo submit_tag(__('submit')); ?>
			
			<?php if ($code_piece->getId()): ?>
			  &nbsp;<?php echo link_to(__('cancel'), 'recipe/show?id='.$code_piece->getId()) ?>
			<?php else: ?>
			  &nbsp;<?php echo link_to(__('cancel'), 'recipe/list') ?>
			<?php endif; ?>
			</form>
			
		</div>
	</div>


	<div class="alignRight contentColumn half">
		<div id="loadIndicator" class="alignRight"><?php echo image_tag('ajax-loader.gif'); ?></div>
		<h3 class="header"><?php echo __('Preview'); ?>:</h3>
		<div id="recipePreview" class="contentBox bordered"></div>
			    
		<?php echo javascript_tag(
			  remote_function(array(
			    'update'  => 'recipePreview',
			    'url'     => 'recipe/preview',
			  	'complete'=> "Element.hide('loadIndicator')",
			    'with'    => "'title=' + $('title').value + '&source=' + $('source').value"
			  ))
			) ?>
	</div>

</div>
