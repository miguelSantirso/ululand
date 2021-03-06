<?php use_helper('Validation', 'I18N') ?>
<div id="pageHeader">
	<h2><?php echo link_to(__("Register"), "@register"); ?></h2>
	<p class="subtitle"><?php echo __("Join us!"); ?></p>
</div>

<div id="pageContent">

	<div class="contentColumn half alignCenter">
	
		<?php echo form_tag('@register', array('class' => 'grande')) ?>
			<div class="form-field contentColumn third alignCenter">
				<div class="contentBox light">
					<?php echo
					label_for("username", __("Email")), 
					form_error("username"),
					"<p class='noSpace'>".input_tag("username", $sf_params->get("username"))."</p>",
					"<small class='alignLeft'>".__('Must be a valid e-mail')."</small>"
					?>
				</div>
			</div>
			<div class="form-field contentColumn third alignCenter">
				<div class="contentBox light">
					<?php echo 
					label_for("password", __("Password")),
					form_error("password"),
					"<p class='noSpace'>".input_password_tag("password", $sf_params->get("password"))."</p>"
					?>
				</div>
			</div>
			<div class="form-field contentColumn third alignCenter">
				<div class="contentBox light">
					<?php echo 
					label_for("password_check", __("Retype password")),
					form_error("password_check"),
					"<p class='noSpace'>".input_password_tag("password_check", $sf_params->get("password_check"))."</p>"
					?>
				</div>
			</div>
		      <?php 
			  echo "<p class='center'>".submit_tag(__('Create account'), array("class" => "xLarge")) ."</p>"
			  ?>
		    <div style="clear:both;"></div>
		</form>
		
	</div>
</div>