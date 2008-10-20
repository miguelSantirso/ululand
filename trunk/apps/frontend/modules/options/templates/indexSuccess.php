<h2 id="pageTitle"><?php echo link_to(image_tag("iconOptions.png").__('Options'), '@options'); ?></h2>

<div id="pageContent">

	<!-- profile & avatar -->
	<div class="contentRow">
		<div class="contentColumn half alignLeft">
			<!-- profile -->
			<div class="contentBox">
				<?php $linkText = image_tag("iconEditProfile.png") . sprintf('%s<span>%s</span>', __("Edit Profile"), __("Edit your name, your description and other personal info")); ?>
				<?php echo link_to($linkText, '@options_edit_profile', array('class' => 'largeIconButton')); ?>
			</div>
		</div>
		<!-- avatar -->
		<div class="contentColumn half alignLeft">
			<div class="contentBox">
				<?php $linkText = image_tag("iconAvatar.png") . sprintf('%s<span>%s</span>', __("Edit Your Avatar"), __("Edit the appearance of your avatar")); ?>
				<?php echo link_to($linkText, '@options_edit_avatar', array('class' => 'largeIconButton')); ?>
			</div>
		</div>
	</div>
	
	<div class="contentRow">
		<!-- password & interface settings -->
		<div class="contentColumn half alignLeft">
			<!-- password -->
			<div class="contentBox">
				<?php $linkText = image_tag("iconLock.png") . sprintf('%s<span>%s</span>', __("Change Your Password"), __("You can change your password here")); ?>
				<?php echo link_to($linkText, '@options_change_password', array('class' => 'largeIconButton')); ?>
			</div>
		</div>
		<div class="contentColumn half alignLeft">
			<!-- interface -->
			<div class="contentBox">
				<?php $linkText = image_tag("iconConfiguration.png") . sprintf('%s<span>%s</span>', __("Interface Settings"), __("Change the language of the interface")); ?>
				<?php echo link_to($linkText, '@options_edit_settings', array('class' => 'largeIconButton')); ?>
			</div>
		</div>
		
	</div>
</div>