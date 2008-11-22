		
		
		<div id="userMenu">
			<?php if(!$sf_user->isAuthenticated()) { ?>
				<?php echo __(sprintf(__('Hello! You can %1$s or %2$s.'), link_to(__("Log in"), "@sf_guard_signin"), link_to(__("Register"), "@register"))); ?>
			<?php } else { ?>
				<?php 
				if($sf_user->getProfile()->isFilledIn()) { 
					$user = $sf_user->getProfile();
				} else {
					$user = $sf_user->getProfile();
				}
				?>				
				<?php echo __(sprintf(__('Welcome back, %1$s! %2$s? %3$s?'), linkToProfile($user), link_to(__("Options"), '@options'), link_to(__("Logout"), "@sf_guard_signout"))); ?>
			<?php } ?>
		</div>