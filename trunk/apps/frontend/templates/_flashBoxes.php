	<?php if (!is_null($sf_user->getAttribute('daysToValidateEmail'))) : ?>
		<p class="flashBox warning"><?php echo sprintf(__('%s. You have %s days left.'), link_to(__('Validate your email now!'), 'sfGuardAuth/approveEmail'), "<strong>{$sf_user->getAttribute('daysToValidateEmail')}</strong>"); ?></p>
	<?php endif; ?>
	<?php if ($sf_user->hasFlash('error')): ?>
		<p class="flashBox error"><?php echo $sf_user->getFlash('error') ?></p>
	<?php endif ?>
	<?php if ($sf_user->hasFlash('warning')): ?>
		<p class="flashBox warning"><?php echo $sf_user->getFlash('warning') ?></p>
	<?php endif ?>	
	<?php if ($sf_user->hasFlash('success')): ?>
		<p class="flashBox success"><?php echo $sf_user->getFlash('success') ?></p>
	<?php endif ?>