<?php use_helper('Object', 'Validation', 'Javascript') ?>

<div id="pageContent">

	<div class="contentColumn">
		<div class="contentBox light">
			<h3 class="header"><?php echo __('Game Release Info:'); ?></h3>
			<?php echo form_tag('game/updateRelease', 'multipart=true') ?>
			
			<input type="hidden" name="gameReleaseId" id="gameReleaseId" value="<?php echo $gameRelease->getId(); ?>" />
			<input type="hidden" name="gameId" id="gameId" value="<?php echo $game->getId(); ?>" />
			
			<p class="noSpace"><?php echo label_for('name', __('Release Name:')); ?></p>
			<?php echo form_error("name"); ?>
			<?php echo object_input_tag($gameRelease, 'getName', array (
			  'size' => 65, 'maxlength' => 75
			)) ?>
			<br/>
			<br/>
			<p class="noSpace"><?php echo label_for('game_path', __('Release file:')); ?></p>
			<?php echo form_error("game_path"); ?>
			<?php echo input_file_tag("game_path"); ?>
			<p class="noSpace"><small><?php echo __('Single file (for now). SWF format. The dimensions will be automatically detected.'); ?></small></p>
			<br/>
			<p class="noSpace"><?php echo label_for('releaseStatusId', __('Release Status:')); ?></p>
			<?php echo form_error("releaseStatusId"); ?>
			<?php echo object_select_tag($gameRelease, 'getGameReleaseStatusId'); ?>
			<br/>
			<br/>
			<p class="noSpace"><?php echo label_for('description', __('Release Notes:')); ?></p>
			<?php echo form_error('description'); ?>
			<?php echo object_textarea_tag($gameRelease, 'getDescription', array (
			  'size' => '50x6',
			)) ?>
			<p class="noSpace"><small><?php echo sprintf(__('Notes for this game release. Accepts %s.'), link_to('Markdown', 'http://daringfireball.net/projects/markdown/syntax')); ?></small></p>
			<br/>
			<p class="noSpace"><?php echo label_for('is_public', __('This release is public')); ?> <?php echo object_checkbox_tag($gameRelease, 'getIsPublic'); ?></p>
			<br/>
			<br/>
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

</div>