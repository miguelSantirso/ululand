<?php use_helper('Object', 'Javascript', 'Validation') ?>

<h2 id="pageTitle"><?php echo link_to(image_tag("iconEditProfile.png").__('Edit your profile'), '@options_edit_profile'); ?></h2>


<div id="pageContent">
	<?php echo form_tag('options/editProfile') ?>
	
	<?php echo object_input_hidden_tag($sf_guard_user_profile, 'getId') ?>
	
		<div class="contentColumn half alignLeft">
			<div class="contentBox light">
				<div id="generalInfo">
					<h3 class="header"><?php echo __('General Data'); ?></h3>
					
					<p class="noSpace"><?php echo label_for('username', __('Nick:')); ?></p>
					<?php echo form_error('username'); ?>
					<?php echo object_input_tag($sf_guard_user_profile, 'getUsername', array (
				  		'size' => 20,
						'class' => 'grande',
						)) ?>
					<p class="noSpace"><small class=''><?php echo __('This is the name that everyone will see.'); ?></small></p>
					<br/>
					
					<p class="noSpace"><?php echo label_for('username', __('First Name:')); ?></p>
					<?php echo object_input_tag($sf_guard_user_profile, 'getFirstName', array (
				  		'size' => 20,
						'class' => 'grande',
						)) ?>
					<p class="noSpace"><small class=''><?php echo __('Your real name (optional).'); ?></small></p>
					<br/>
					
					<p class="noSpace"><?php echo label_for('username', __('Last Name:')); ?></p>
					<?php echo object_input_tag($sf_guard_user_profile, 'getLastName', array (
				  		'size' => 20,
						'class' => 'grande',
						)) ?>
					<p class="noSpace"><small class=''><?php echo __('Your real last name (optional).'); ?></small></p>
					<br/>
					<p class="noSpace"><?php echo label_for('gender', __('Gender:')); ?></p>
					<?php echo select_tag('gender', options_for_select(array(
						'' => '',
						'male' => 'Male',
						'female' => 'Female',
						), isset($sf_guard_user_profile) && !is_null($sf_guard_user_profile->getGender()) ? $sf_guard_user_profile->getGender() : '')); ?>
					<br/>
					<br/>
				</div>
				
				<div id="developerInfo">
					<h3 class="header"><?php echo __('Developer Data'); ?></h3>
					
					<p class="noSpace"><?php echo label_for('Url', __('Url:')); ?></p>
					<?php echo object_input_tag($developerProfile, 'getUrl', array (
					  'size' => 25,
					)) ?>	
					<br/>
					<br/>
					
					<p class="noSpace"><?php echo label_for('tagsString', __('Tags:')); ?></p>
					<?php echo object_input_tag($developerProfile, 'getTagsString', array (
					  'size' => 35,
					)) ?>
					<p class="noSpace"><small class=''><?php echo __('Comma separated. Examples: coder, artist, musician, full-time'); ?></small></p>
					<br/>
					
					<p class="noSpace"><?php echo label_for('isFree', __('Looking for a project to work on?')); ?> <?php echo object_checkbox_tag($developerProfile, 'getIsFree') ?></p>
					<br/>
				</div>
				
				<div id="developerDescription">
					<h3 class="header"><?php echo __('Description'); ?></h3>
					<p class="noSpace"><?php echo sprintf(__('Write whatever you want. Accepts %s.'), link_to('Markdown', 'http://daringfireball.net/projects/markdown/syntax')); ?></p>
					<?php echo object_textarea_tag($developerProfile, 'getDescription', array (
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
		&nbsp;<?php echo link_to(__('cancel'), 'options') ?>
	</div>

	</form>
</div>