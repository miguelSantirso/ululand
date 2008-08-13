<?php use_helper('Validation', 'I18N') ?>
<div id="pageHeader">
	<h2><?php echo link_to(__("Register"), "@register"); ?></h2>
	<p class="subtitle"><?php echo __("Join us!"); ?></p>
</div>

<div id="pageContent">
	<div class="contentColumn half alignCenter">
	
		<?php echo form_tag('@register') ?>
			<div class="form-field contentColumn half contentBox light alignCenter">
				<?php echo
				"<p class='noSpace alignCenter'>".label_for("username", __("Email"))."</p>", 
				form_error("username"),
				"<p class='noSpace alignCenter'>".input_tag("username", $sf_params->get("username"))."</p>"
				?>
			</div>
			<div class="form-field contentColumn half contentBox light alignCenter">
				<?php echo 
				"<p class='noSpace alignCenter'>".label_for("password", __("Password"))."</p>",
				form_error("password"),
				"<p class='noSpace alignCenter'>".input_password_tag("password", $sf_params->get("password"))."</p>"
				?>
			</div>
			<div class="form-field contentColumn half contentBox light alignCenter">
				<?php echo 
				"<p class='noSpace alignCenter'>".label_for("password_check", __("Retype password"))."</p>",
				form_error("password_check"),
				"<p class='noSpace alignCenter'>".input_password_tag("password_check", $sf_params->get("password_check"))."</p>"
				?>
			</div>
		      <?php 
			  echo "<p class='alignCenter'>".submit_tag(__('Create account'), array("class" => "xLarge")) ."</p>"
			  ?>
		    <div style="clear:both;"></div>
		</form>
	
	</div>
</div>