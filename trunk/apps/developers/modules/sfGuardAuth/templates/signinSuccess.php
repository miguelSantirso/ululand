<?php use_helper('Validation', 'I18N') ?>
<div id="pageHeader">
	<h2><?php echo link_to(__("Log In"), "@sf_guard_signin"); ?></h2>
	<p class="subtitle"><?php echo __("Come on in!"); ?></p>
</div>

<div id="pageContent">
	<div class="fixedWidth half alignCenter">
		<?php echo form_tag('@sf_guard_signin') ?>
		
		    <div class="form-field fixedWidth third contentBox light alignCenter" id="sf_guard_auth_username">
		      <?php
		      echo  
		      "<p class='noSpace center'>".label_for('username', __('Email'))."</p>",
		      form_error('username'),
		      "<p class='noSpace center'>".input_tag('username', $sf_data->get('sf_params')->get('username'))."</p>";
		      ?>
		    </div>
		    <div class="form-field fixedWidth third contentBox light alignCenter" id="sf_guard_auth_password">
		      <?php
		      echo  
		        "<p class='noSpace center'>".label_for('password', __('Password'))."</p>",
		      	form_error('password'),
		        "<p class='noSpace center'>".input_password_tag('password')."</p>";
		      ?>
		    </div>
		    <div class="form-field fixedWidth third contentBox light alignCenter" id="sf_guard_auth_remember">
		      <?php
		      echo "<p class='noSpace center'>".label_for('remember', __('Remember me?')." "),
		      checkbox_tag('remember')."</p>";
		      ?>
		    </div>
		      <?php 
			  echo "<p class='center contentBox'>".submit_tag(__('sign in')) ."</p>"
			  ?>
		    <div style="clear:both;"></div>
		  	<p class="center"><?php echo link_to(__('Forgot your password?'), '@sf_guard_password', array('id' => 'sf_guard_auth_forgot_password')) ?></p>
		</form>
	</div>
</div>