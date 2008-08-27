<?php use_helper('Date', 'Javascript', 'ulMisc'); ?>

	<?php
        $user_config = sfConfig::get('app_sfPropelActAsCommentableBehaviorPlugin_user');
        $class = $user_config['class'];
        $toString = $user_config['toString'];
        $peer = sprintf('%sPeer', $class);
        $author = call_user_func(array($peer, 'retrieveByPk'), $comment['AuthorId']);
	?>
	
	<?php
		$linkToRemove = link_to_remote(__('Remove'), array(
    			'update' => "comment_".$comment['Id'],
    			'url'    => 'sfComment/remove?id='.$comment['Id']),
    		array('class' => ''));
	?>

<div class="comment" id="comment_<?php echo $comment['Id'] ?>">
	<div class="meta">
		<span class="date"><?php echo __('%1% ago', array('%1%' => distance_of_time_in_words(strtotime($comment['CreatedAt'])) ) ); ?></span>
	</div>
	<span class="author">
		<?php $linkText = '<span class="authorImage">'.gravatar_tag($author->getUsername()).'</span>'.$author->getProfile(); ?>
		<?php echo linkToProfile($author->getProfile(), array(), $linkText); ?>
		<?php echo __('wrote:'); ?>
	</span>
	<blockquote><?php echo sfMarkdown::doConvert($comment['Text']); ?></blockquote>
	<p class="actions">
	<?php echo linkToProfile($author->getProfile(), array(), __('See Profile')); ?>
	<?php if($sf_user->isAuthenticated() && $sf_user->getId() == $author->getId()) : ?>
   		<?php echo " | " . $linkToRemove ?>
  	<?php endif; ?>
  	</p>
</div>
