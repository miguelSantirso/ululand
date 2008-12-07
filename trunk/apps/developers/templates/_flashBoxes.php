	<?php if (!is_null($sf_user->getAttribute('daysToValidateEmail'))) : ?>
		<p class="flashBox warning"><?php echo sprintf(__('%s. You have %s days left.'), link_to(__('Validate your email now!'), 'sfGuardAuth/approveEmail'), "<strong>{$sf_user->getAttribute('daysToValidateEmail')}</strong>"); ?></p>
	<?php endif; ?>
	<?php if ($sf_flash->has('error')): ?>
		<p class="flashBox error"><?php echo $sf_flash->get('error') ?></p>
	<?php endif ?>
	<?php if ($sf_flash->has('warning')): ?>
		<p class="flashBox warning"><?php echo $sf_flash->get('warning') ?></p>
	<?php endif ?>	
	<?php if ($sf_flash->has('success')): ?>
		<p class="flashBox success"><?php echo $sf_flash->get('success') ?></p>
	<?php endif ?>