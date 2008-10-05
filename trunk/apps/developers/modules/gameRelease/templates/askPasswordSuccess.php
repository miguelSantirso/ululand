<?php use_helper('Javascript'); ?>

<div id="pageContent">

	<div class="contentColumn wide alignCenter">
	<?php $linkToGame = linkToGame($game); ?>
	<h3 class="header center"><?php echo __("This version of {$linkToGame} is protected by password") ?></h3>
	<div class="contentBox light center">
		<?php echo form_tag("gameRelease/show?game_stripped_name={$game->getStrippedName()}&release_stripped_name={$gameRelease->getStrippedName()}", array('class' => 'grande')); ?>
			<br/>
			<?php echo label_for('password', __('Enter the Password'), array('class' => 'large')); ?><br/>			
			<?php echo input_tag('password'); ?><br/>
			<br/>
			<?php echo submit_tag(__('Enter')); ?>
		</form>
	</div>
	
	<p class="large center"><?php echo __('or') ?></p>
	
	<p class="center"><?php echo linkToGame($game, array('class' => 'xLarge'), '&laquo; ' . __('Go back')) ?></p>
	
	</div>
	
</div>

<?php echo javascript_tag('document.getElementById("password").focus();') ?>