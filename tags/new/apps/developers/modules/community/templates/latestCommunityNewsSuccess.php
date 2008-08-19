<?php use_helper('Date'); ?>

<?php $i=0; ?>
<?php foreach($feed->getItems() as $post): ?>

	<?php if($i == 0) { ?>
		<div class="contentBox light">
			<h4 class="header"><?php echo link_to($post->getTitle(), $post->getLink()); ?></h4>
			<div class="small"><?php echo $post->getDescription(); ?></div>
			<p class="xSmall"><?php echo sprintf(__('by %s %s ago.'), $post->getAuthorName(), time_ago_in_words($post->getPubDate())); ?>
		</div>
		<div class="contentBox bordered">
		<h5 class="header"><?php echo __('Older posts...'); ?></h5>
	<?php } else { ?>
		<p class="noSpace small">&raquo; <?php echo link_to($post->getTitle(), $post->getLink()); ?></p>
	<?php } ?>
	<?php $i++; ?>
	
<?php endforeach; ?>
		</div>