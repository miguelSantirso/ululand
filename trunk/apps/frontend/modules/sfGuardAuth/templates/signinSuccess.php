<?php use_helper('Validation', 'I18N') ?>

<h2 id="pageTitle"><?php echo link_to(image_tag("iconLock.png").__("Log In"), "@sf_guard_signin"); ?></h2>

<div id="pageContent">
	<div class="contentColumn half alignCenter">
		<?php echo form_tag('@sf_guard_signin', array('class' => 'grande')) ?>
		
		    <div class="form-field contentColumn third alignCenter" id="sf_guard_auth_username">
		    	<div class="contentBox light">
				      <?php
				      echo  
				      label_for('username', __('Email')),
				      form_error('username'),
				      "<p class='noSpace'>".input_tag('username', $sf_data->get('sf_params')->get('username'))."</p>";
				      ?>
		      	</div>
		    </div>
		    <div class="form-field contentColumn third alignCenter" id="sf_guard_auth_password">
		    	<div class="contentBox light">
				      <?php
				      echo  
				        label_for('password', __('Password')),
				      	form_error('password'),
				        "<p class='noSpace'>".input_password_tag('password')."</p>";
				      ?>
				</div>
		    </div>
		    <div class="form-field contentColumn third alignCenter" id="sf_guard_auth_remember">
		    	<div class="contentBox light">
				      <?php
				      echo "<p class='noSpace center'>".label_for('remember', __('Remember me?')." "),
				      checkbox_tag('remember')."</p>";
				      ?>
		      	</div>
		    </div>
		      <?php 
			  echo "<p class='center contentBox'>".submit_tag(__('sign in')) ."</p>"
			  ?>
		    <div style="clear:both;"></div>
		  	<!-- <p class="center"><?php echo link_to(__('Forgot your password?'), '@sf_guard_password', array('id' => 'sf_guard_auth_forgot_password')) ?></p> -->
		  	<p class="center"><?php echo link_to(__('Need an account?'), '@register', array('id' => '')) ?></p>
		</form>
	</div>
</div>