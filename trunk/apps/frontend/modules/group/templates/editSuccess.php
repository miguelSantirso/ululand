<?php use_helper('Object', 'Javascript') ?>

<h2 id="pageTitle"><?php echo image_tag("iconOptions.png").__('Group Administration'); ?></h2>

<div id="pageContent">
	<?php echo form_tag('group/update') ?>
	
	<?php echo object_input_hidden_tag($group, 'getId'); ?>
	
		<div class="contentColumn half alignLeft">
			<div class="contentBox light">

					<h3 class="header"><?php echo __('Group Info'); ?>:</h3>
					
					<p class="noSpace"><?php echo label_for('name', __('Group Name')); ?>:</p>
					<?php echo object_input_tag($group, 'getName', array (
				  		'size' => 20,
						'class' => 'grande',
						)) ?>
					<br/>

					<p class="noSpace"><?php echo label_for('description', __('Group Description')); ?>:</p>
					<?php echo object_textarea_tag($group, 'getDescription', array (
					  'rows' => 15,
					  'cols' => 51
					)) ?>
				<br/>
				
			<?php $with = "'username=' + encodeURIComponent($('name').value) + '&description=' + encodeURIComponent($('description').value)"; ?>
			<?php echo observe_field('name', array(
				'update'  => 'groupPreview',
				'url'     => 'group/preview',
				'before'  => "Element.show('loadIndicator'); Element.setOpacity('groupPreview', 0.5);",
				'complete'=> "Element.hide('loadIndicator'); Element.setOpacity('groupPreview', 1);",
			    'with'    => $with)) ?>
			<?php echo observe_field('description', array(
				'frequency' => '5',
				'update'    => 'groupPreview',
				'url'       => 'group/preview',
				'before'  => "Element.show('loadIndicator'); Element.setOpacity('groupPreview', 0.5);",
				'complete'=> "Element.hide('loadIndicator'); Element.setOpacity('groupPreview', 1);",
			    'with'      => $with)) ?>
			<?php echo link_to_remote(__('update preview'), array(
				'update'  => 'groupPreview',
				'url'     => 'group/preview',
				'before'  => "Element.show('loadIndicator'); Element.setOpacity('groupPreview', 0.5);",
				'complete'=> "Element.hide('loadIndicator'); Element.setOpacity('groupPreview', 1);",
		    	'with'    => $with),
			array('class' => 'large alignRight')) ?>
				<div class="clearFloat"></div>

		</div>

	</div>

	<div class="alignRight contentColumn half">
		<div id="loadIndicator" class="alignRight"><?php echo image_tag('ajax-loader.gif'); ?></div>
		<h3 class="header"><?php echo __('Preview'); ?>:</h3>
		<div id="groupPreview" class="contentBox bordered small"></div>
			    
		<?php echo javascript_tag(
			  remote_function(array(
			    'update'  => '"groupPreview"',
			    'url'     => 'group/preview',
			  	'complete'=> "Element.hide('loadIndicator')",
			    'with'    => $with
			  ))
			) ?>
			
		<div class="contentBox">
			<h4 class="header small"><?php echo __('Members:') ?></h4>
			<?php
				 include_component('group', 'listMembers', array('group' => $group, 'excludeOwners' => true, 'edit' => true, 'orderDescendingBy' => PlayerProfile_GroupPeer::CREATED_AT));
			?>
		</div>
		
		<div class="contentBox">
			<h4 class="header small"><?php echo __('Pending') ?>:</h4>
			<?php
				 include_component('group', 'listMembers', array('group' => $group, 'pending' => true, 'edit' => true, 'orderDescendingBy' => PlayerProfile_GroupPeer::CREATED_AT));
			?>
		</div>
		
	</div>
	
	<div class="clearFloat"></div>
	
	<div class="contentBox" style="text-align: center">
		<?php echo submit_tag(__('save')) ?>
		<?php if ($group->getId()): ?>
		  &nbsp;<?php echo link_to(__('cancel'), 'group/show?id='.$group->getId()) ?>
		<?php else: ?>
		  &nbsp;<?php echo link_to(__('cancel'), 'group/list') ?>
		<?php endif; ?>
	</div>

	</form>
</div>