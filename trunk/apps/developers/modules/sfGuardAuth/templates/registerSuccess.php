<?php use_helper('Validation', 'I18N') ?>

<h2 id="pageTitle"><?php echo link_to(image_tag("iconLock.png").__("Register"), "@register"); ?></h2>

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
					label_for("screenname", __("Username")), 
					form_error("screenname"),
					"<p class='noSpace'>".input_tag("screenname", $sf_params->get("screenname"))."</p>",
					"<small class='alignLeft'>".__('The name everyone will see.')."</small>"
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