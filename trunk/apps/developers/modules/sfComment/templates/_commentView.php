<?php use_helper('Date', 'Javascript'); ?>
<div class="sf_comment small" id="sf_comment_<?php echo $comment['Id'] ?>">
  <p class="sf_comment_info noSpace">
    <span class="sf_comment_author">
      <?php if (!is_null($comment['AuthorId'])): ?>
        <?php
        $user_config = sfConfig::get('app_sfPropelActAsCommentableBehaviorPlugin_user');
        $class = $user_config['class'];
        $toString = $user_config['toString'];
        $peer = sprintf('%sPeer', $class);
        $author = call_user_func(array($peer, 'retrieveByPk'), $comment['AuthorId']);
        echo linkToProfileWithGravatar($author->getProfile(), 20);
        ?><?php else: ?><?php echo $comment['AuthorName'] ?><?php endif; ?></span>,
    <?php echo __('%1% ago', array('%1%' => distance_of_time_in_words(strtotime($comment['CreatedAt'])))) ?>
  </p>
    <?php if($sf_user->isAuthenticated() && $sf_user->getId() == $author->getId()) : ?>
    	<?php echo link_to_remote(__('Remove'), array(
    			'update' => "sf_comment_".$comment['Id'],
    			'url'    => 'sfComment/remove?id='.$comment['Id']),
    		array('class' => 'alignRight')); ?>
	<?php endif; ?>
  <p class="sf_comment_text">
    <?php echo sfMarkdown::doConvert($comment['Text']); ?>
  </p>
	
</div>