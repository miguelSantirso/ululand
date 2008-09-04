
	<?php
	
		if(!isset($title))
		{
			$title = __('Search');
		}
		
	?>

			<?php if($title != "") : ?><h3 class="header"><?php echo $title ?></h3><?php endif; ?>
			<?php echo form_tag('game/list'); ?>
				<?php echo input_tag('search', (isset($search) ? $search : '')); ?>
				<!-- <?php if(isset($tag)){ echo input_hidden_tag('tag', $tag); } ?> -->
				<?php echo submit_tag(__('Search!')); ?>
			</form>