<div id="sf_comment_list">
  <?php if (count($comments) > 0): ?>
  	<ul class="full">
    <?php foreach ($comments as $comment): ?>
    	<li>
     		<?php include_partial('sfComment/commentView', array('comment' => $comment)) ?>
     	</li>
    <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <p><?php echo __('There is no comment for the moment.') ?></p>
  <?php endif; ?>
</div>