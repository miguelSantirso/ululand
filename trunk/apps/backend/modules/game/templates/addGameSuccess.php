<?php use_helper('Validation') ?>

<div id="pageContent">

	<div class="contentColumn wide alignCenter">
		<div class="contentBox">
			<h3 class="header"><?php echo __('Game Info:'); ?></h3>
			<?php echo form_tag('game/addGame', 'multipart=true') ?>
			
			<p class="noSpace"><?php echo label_for('name', __('Name:')); ?></p>
			<?php echo form_error("name"); ?>
			<?php echo input_tag('name', null, array(
			  'maxlength' => 75
			)) ?>
			<br/>
			<br/>
			<p class="noSpace"><?php echo label_for('thumbnail_path', __('Thumbnail:')); ?></p>
			<?php echo form_error("thumbnail_path"); ?>
			<?php echo input_file_tag("thumbnail_path"); ?>
			<br/>
			<br/>
			<p class="noSpace"><?php echo label_for('description', __('Description:')); ?></p>
			<?php echo form_error('description'); ?>
			<?php echo textarea_tag('description', null, array(
			  'size' => '50x6',
			)) ?>
			<br/>
			<br/>
			<p class="noSpace"><?php echo label_for('instructions', __('Instructions:')); ?></p>
			<?php echo form_error('instructions'); ?>
			<?php echo textarea_tag('instructions', null, array(
			  'size' => '50x3',
			)) ?>
			<br/>
			<br/>
			<p class="noSpace"><?php echo label_for('tags', __('Tags')); ?></p>
			<?php echo form_error('tags'); ?>
			<?php echo input_tag('tags', null, array(
			  'size' => 60,
			)) ?>
			<br/>
			<br/>
			<h3 class="header"><?php echo __('Game Release Info:'); ?></h3>
			
			<p class="noSpace"><?php echo label_for('game_path', __('Release file:')); ?></p>
			<?php echo form_error("game_path"); ?>
			<?php echo input_file_tag("game_path"); ?>
			<p class="noSpace"><small><?php echo __('Single SWF file (for now). The dimensions will be automatically detected.'); ?></small></p>
			<br/>
			
			<div class="center"><?php echo submit_tag(__('submit')) ?>&nbsp;<?php echo link_to(__('cancel'), '/') ?></div>
			<div class="clearFloat"></div>
			</form>
		</div>
	</div>

	
</div>