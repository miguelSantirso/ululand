<?php use_helper('Object', 'Validation', 'Javascript') ?>
<?php
	$prototypeDir = sfConfig::get('sf_prototype_web_dir');
	$sf_context->getResponse()->addJavascript($prototypeDir.'/js/prototype');
?>

<div id="pageContent">

	<div class="contentColumn half alignLeft">
		<div class="contentBox light">
			<h3 class="header"><?php echo __('Game Release Info:'); ?></h3>
			<?php echo form_tag('gameRelease/update', 'multipart=true') ?>
			
			<input type="hidden" name="gameReleaseId" id="gameReleaseId" value="<?php echo $gameRelease->getId(); ?>" />
			<input type="hidden" name="gameId" id="gameId" value="<?php echo $game->getId(); ?>" />
			
			<p class="noSpace"><?php echo label_for('name', __('Release Name:')); ?></p>
			<?php echo form_error("name"); ?>
			<?php echo object_input_tag($gameRelease, 'getName', array (
			  'size' => 15, 'maxlength' => 15
			)) ?>
			<p class="noSpace"><small><?php echo __('A unique identifier for this version. Examples: "0.35" or "BETA 1"'); ?></small></p>
			<br/>
			<p class="noSpace"><?php echo label_for('game_path', __('Release file:')); ?></p>
			<?php echo form_error("game_path"); ?>
			<?php echo input_file_tag("game_path"); ?>
			<p class="noSpace"><small><?php echo __('Single SWF file (for now). The dimensions will be automatically detected.'); ?></small></p>
			<br/>
			<p class="noSpace"><?php echo label_for('releaseStatusId', __('Release Status:')); ?></p>
			<?php echo form_error("releaseStatusId"); ?>
			<?php echo object_select_tag($gameRelease, 'getGameReleaseStatusId'); ?>
			<br/>
			<br/>
			<p class="noSpace"><?php echo label_for('description', __('Release Notes:')); ?></p>
			<?php echo form_error('description'); ?>
			<?php echo object_textarea_tag($gameRelease, 'getDescription', array (
			  'size' => '50x2',
			)) ?>
			<p class="noSpace"><small><?php echo sprintf(__('Notes for this game release. Accepts %s.'), link_to('Markdown', 'http://daringfireball.net/projects/markdown/syntax')); ?></small></p>
			<br/>
			<p class="noSpace"><?php echo label_for('privacity', __('Privacity')); ?></p>
			<?php $selectedPrivacity = $gameRelease->getIsPublic() ? 'public' : ($gameRelease->getPassword() ? 'password' : 'private'); ?>
			<?php $privacityOptions = options_for_select(array('public' => __('Public'), 'password' => __('Password Protected'), 'private' => __('For My Eyes Only')), $selectedPrivacity); ?>
			<?php echo select_tag('privacity', $privacityOptions); ?>
			<p class="noSpace"><small><?php echo __('Select the desired privacity level for this version of the game.'); ?></small></p>
			<br/>
			<div id="passwordField">
			<p class="noSpace"><?php echo label_for('password', __('Password')); ?>:</p>
			<?php echo form_error("password"); ?>
			<?php echo object_input_tag($gameRelease, 'getPassword', array (
			  'size' => 13, 'maxlength' => 13
			)) ?>
			<p class="noSpace"><small><?php echo __('Anyone will gain access with this password, even if not registered in ululand.'); ?></small></p>
			<br/>
			</div>
			
			<?php echo javascript_tag('
				function updatePasswordField(event)
				{
					if($F("privacity") == "password") $("passwordField").show();
					else $("passwordField").hide();
				}'); ?>
			<?php echo javascript_tag('updatePasswordField();') ?>
			<?php echo javascript_tag('$("privacity").observe("change", updatePasswordField);') ?>
			
			<?php echo submit_tag(__('submit')) ?>
			<?php if ($gameRelease->getId()): ?>
			  &nbsp;<?php echo linkToGameRelease($gameRelease, array(), 'cancel'); ?>
			<?php else: ?>
			  &nbsp;<?php echo linkToGame($game, array(), __('cancel')); ?>
			<?php endif; ?>
			<div class="clearFloat"></div>
			</form>
		</div>
	</div>

	<div class="contentColumn half alignLeft">
		<div class="contentBox">
			<h3 class="header large"><?php echo __("New version of {$game}") ?></h3>
			
		</div>
	</div>
</div>