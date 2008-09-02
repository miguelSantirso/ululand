<?php use_helper('Object', 'Javascript') ?>

<div id="pageContent">
	<?php echo form_tag('profile/update') ?>
	
	<?php echo object_input_hidden_tag($sf_guard_user_profile, 'getId') ?>
	
		<div class="contentColumn half alignLeft">
			<div class="contentBox light">
				<div id="generalInfo">
					<h3 class="header"><?php echo __('General Data'); ?></h3>
					
					<p class="noSpace"><?php echo label_for('username', __('Nick:')); ?></p>
					<?php echo object_input_tag($sf_guard_user_profile, 'getUsername', array (
				  		'size' => 20,
						'class' => 'grande',
						)) ?>
					<p class="noSpace"><small class=''><?php echo __('Don\'t use your team name. You will be able to create it after.'); ?></small></p>
					<br/>
					
					<p class="noSpace"><?php echo label_for('culture', __('Language:')); ?></p>
					<?php echo select_language_tag('culture', $sf_guard_user_profile->getCulture(), array('languages' => array('es', 'en'))); ?>
					<br/>
					<br/>
				</div>
				
				
				<div id="developerDescription">
					<h3 class="header"><?php echo __('Description'); ?></h3>
					<p class="noSpace"><?php echo sprintf(__('Write whatever you want. Accepts %s.'), link_to('Markdown', 'http://daringfireball.net/projects/markdown/syntax')); ?></p>
					<?php echo object_textarea_tag($playerProfile, 'getDescription', array (
					  'rows' => 15,
					  'cols' => 51
					)) ?>
				</div>
				<br/>
				
			<?php $with = "'username=' + encodeURIComponent($('username').value) + '&description=' + encodeURIComponent($('description').value)"; ?>
			<?php echo observe_field('username', array(
				'update'  => 'profilePreview',
				'url'     => 'profile/preview',
				'before'  => "Element.show('loadIndicator'); Element.setOpacity('profilePreview', 0.5);",
				'complete'=> "Element.hide('loadIndicator'); Element.setOpacity('profilePreview', 1);",
			    'with'    => $with)) ?>
			<?php echo observe_field('description', array(
				'frequency' => '5',
				'update'    => 'profilePreview',
				'url'       => 'profile/preview',
				'before'  => "Element.show('loadIndicator'); Element.setOpacity('profilePreview', 0.5);",
				'complete'=> "Element.hide('loadIndicator'); Element.setOpacity('profilePreview', 1);",
			    'with'      => $with)) ?>
			<?php echo link_to_remote(__('update preview'), array(
				'update'  => 'profilePreview',
				'url'     => 'profile/preview',
				'before'  => "Element.show('loadIndicator'); Element.setOpacity('profilePreview', 0.5);",
				'complete'=> "Element.hide('loadIndicator'); Element.setOpacity('profilePreview', 1);",
		    	'with'    => $with),
			array('class' => 'large alignRight')) ?>
				<div class="clearFloat"></div>
			</div>
		</div>


	<div class="alignRight contentColumn half">
		<div id="loadIndicator" class="alignRight"><?php echo image_tag('ajax-loader.gif'); ?></div>
		<h3 class="header"><?php echo __('Preview'); ?>:</h3>
		<div id="profilePreview" class="contentBox bordered small"></div>
			    
		<?php echo javascript_tag(
			  remote_function(array(
			    'update'  => 'profilePreview',
			    'url'     => 'profile/preview',
			  	'complete'=> "Element.hide('loadIndicator')",
			    'with'    => $with
			  ))
			) ?>
	</div>
	
	<div class="clearFloat"></div>
	
	<div class="contentBox" style="text-align: center">
		<?php echo submit_tag(__('save')) ?>
		<?php if ($sf_guard_user_profile->getId()): ?>
		  &nbsp;<?php echo link_to(__('cancel'), 'profile/show?username='.$sf_guard_user_profile->getUsername()) ?>
		<?php else: ?>
		  &nbsp;<?php echo link_to(__('cancel'), 'profile/list') ?>
		<?php endif; ?>
	</div>

	</form>
</div>