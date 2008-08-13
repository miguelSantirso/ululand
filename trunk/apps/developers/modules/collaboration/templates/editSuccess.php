<?php use_helper('Object', 'Validation', 'Javascript') ?>

<div id="pageHeader">
	<h2><?php echo link_to(__("Submit a collaboration offer"), '/collaboration/create'); ?></h2>
	<p class="subtitle"><?php echo __("Colaborative work is great, isn't it?"); ?></p>
</div>


<div id="pageContent">

	<div class="contentColumn half alignLeft">
		<div class="contentBox light">
			<h3 class="header"><?php echo __('Collaboration Offer Info:'); ?></h3>
			<?php echo form_tag('collaboration/update') ?>
			
			<?php echo object_input_hidden_tag($collaboration_offer, 'getId') ?>
			
			<p class="noSpace"><?php echo label_for('title', __('Title:')); ?></p>
			<?php echo form_error("title"); ?>
			<?php echo object_input_tag($collaboration_offer, 'getTitle', array (
			  'size' => 65, 'maxlength' => 75
			)) ?>
			<br/>
			<br/>
			<p class="noSpace"><?php echo label_for('description', __('Description:')); ?></p>
			<?php echo form_error('description'); ?>
			<?php echo object_textarea_tag($collaboration_offer, 'getDescription', array (
			  'size' => '50x12',
			)) ?>
			<br/>
			<br/>
			<p class="noSpace"><?php echo label_for('tags', __('What are you looking for? (tags)')); ?></p>
			<?php echo form_error('tags'); ?>
			<?php echo object_input_tag($collaboration_offer, 'getTagsString', array (
			  'size' => 65,
			)) ?>
			<p class="noSpace"><small class=''><?php echo __('Comma separated. Examples: coder, artist, musician, full-time'); ?></small></p>
			<br/>
			
			<?php echo observe_field('title', array(
					'update'  => 'offerPreview',
					'url'     => 'collaboration/preview',
					'before'  => "Element.show('loadIndicator'); Element.setOpacity('offerPreview', 0.5);",
					'complete'=> "Element.hide('loadIndicator'); Element.setOpacity('offerPreview', 1);",
				    'with'    => "'title=' + $('title').value + '&description=' + $('description').value")) ?>
			<?php echo observe_field('description', array(
					'frequency' => '5',
					'update'    => 'offerPreview',
					'url'       => 'collaboration/preview',
					'before'  => "Element.show('loadIndicator'); Element.setOpacity('offerPreview', 0.5);",
					'complete'=> "Element.hide('loadIndicator'); Element.setOpacity('offerPreview', 1);",
				    'with'      => "'title=' + $('title').value + '&description=' + $('description').value")) ?>
			</form>
			<?php echo link_to_remote(__('update preview &raquo;'), array(
				'update'  => 'offerPreview',
				'url'     => 'collaboration/preview',
				'before'  => "Element.show('loadIndicator'); Element.setOpacity('offerPreview', 0.5);",
				'complete'=> "Element.hide('loadIndicator'); Element.setOpacity('offerPreview', 1);",
		    	'with'    => "'title=' + $('title').value + '&description=' + $('description').value"),
			array('class' => 'large alignRight')) ?>
			<?php echo submit_tag('save') ?>
			<?php if ($collaboration_offer->getId()): ?>
			  &nbsp;<?php echo link_to('cancel', 'collaboration/show?id='.$collaboration_offer->getId()) ?>
			<?php else: ?>
			  &nbsp;<?php echo link_to('cancel', 'collaboration/list') ?>
			<?php endif; ?>
			<div style="clear:both"></div>
		</div>
	</div>
	
	<div class="alignRight contentColumn half">
		<div id="loadIndicator" class="alignRight"><?php echo image_tag('ajax-loader.gif'); ?></div>
		<h3 class="header"><?php echo __('Preview'); ?>:</h3>
		<div id="offerPreview" class="contentBox bordered"></div>
			    
		<?php echo javascript_tag(
			  remote_function(array(
			    'update'  => 'offerPreview',
			    'url'     => 'collaboration/preview',
			  	'complete'=> "Element.hide('loadIndicator')",
			    'with'    => "'title=' + $('title').value + '&description=' + $('description').value"
			  ))
			) ?>
	</div>

</div>