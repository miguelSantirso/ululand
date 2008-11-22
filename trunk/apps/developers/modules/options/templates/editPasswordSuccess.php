<?php use_helper('Validation', 'I18N') ?>
<h2 id="pageTitle"><?php echo link_to(image_tag("iconLock.png").__('Change Your Password'), '@options_change_password'); ?></h2>

<div id="pageContent">

	<div class="contentColumn half alignCenter">
	
		<?php echo form_tag('@options_change_password', array('class' => 'grande')) ?>
			<div class="form-field contentColumn third alignCenter">
				<div class="contentBox light">
					<?php echo
					label_for("current_password", __("Current Password")), 
					form_error("current_password"),
					"<p class='noSpace'>".input_password_tag("current_password")."</p>"
					?>
				</div>
			</div>
			<div class="form-field contentColumn third alignCenter">
				<div class="contentBox light">
					<?php echo 
					label_for("password", __("New Password")),
					form_error("password"),
					"<p class='noSpace'>".input_password_tag("password", $sf_params->get("password"))."</p>"
					?>
				</div>
			</div>
			<div class="form-field contentColumn third alignCenter">
				<div class="contentBox light">
					<?php echo 
					label_for("password_check", __("Retype new password")),
					form_error("password_check"),
					"<p class='noSpace'>".input_password_tag("password_check", $sf_params->get("password_check"))."</p>"
					?>
				</div>
			</div>
			<p class='center'><?php echo submit_tag(__('Change Password'), array("class" => "xLarge")); ?></p>
			<p class='center'><?php echo link_to(__('cancel'), 'options') ?></p>
		    <div style="clear:both;"></div>
		</form>
		
	</div>
</div>