<?php use_helper('Validation', 'I18N', 'Object') ?>

<h2 id="pageTitle"><?php echo link_to(image_tag("iconConfiguration.png").__('Change The Interface Settings'), '@options_edit_settings'); ?></h2>

<div id="pageContent">

	<div class="contentColumn half alignCenter">
	
		<?php echo form_tag('@options_edit_settings', array('class' => 'grande')) ?>
		<?php echo object_input_hidden_tag($sf_guard_user_profile, 'getId') ?>
		
			<div class="form-field contentColumn third alignCenter">
				<div class="contentBox light">
					<?php echo
					label_for("culture", __("Language")), 
					form_error("culture"),
					"<p class='noSpace'>".select_language_tag('culture', $sf_guard_user_profile->getCulture(), array('languages' => array('es', 'en')))."</p>"
					?>
				</div>
			</div>
			
		    <p class='center'><?php echo submit_tag(__('Save'), array("class" => "xLarge")); ?></p>
			<p class='center'><?php echo link_to(__('cancel'), 'options') ?></p>
		    <div class="clearFloat"></div>
		</form>
		
	</div>
</div>