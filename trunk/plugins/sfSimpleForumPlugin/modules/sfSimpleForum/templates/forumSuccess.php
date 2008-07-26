<?php use_helper('I18N', 'Pagination', 'sfSimpleForum') ?>


<div class="sfSimpleForum">
  
	<div class="fixedWidth wide normalBox lightColor">
		<h2 class="alignCenter"><?php echo $forum->getName() ?></h2>
		<p class="alignCenter"><?php echo $forum->getDescription() ?></p>
	</div>
<?php if (sfConfig::get('app_sfSimpleForumPlugin_include_breadcrumb', true)): ?>
<?php //slot('forum_navigation') ?>
<div class="normalBox lightColor">
  <?php echo forum_breadcrumb(array(
    array(sfConfig::get('app_sfSimpleForumPlugin_forum_name', 'Forums'), 'sfSimpleForum/forumList'),
    $forum->getName()
  )) ?>
</div>
<?php //end_slot() ?>
<?php endif; ?>
  <ul class="forum_actions">
    <li><?php echo link_to(__('New topic'), 'sfSimpleForum/createTopic?forum_name='.$forum->getStrippedName()) ?></li>
  </ul>
  
  <?php include_partial('sfSimpleForum/figures', array(
    'display_topic_link'  => false,
    'nb_topics'           => $forum->getNbTopics(),
    'topic_rule'          => '',
    'display_post_link'   => true,
    'nb_posts'            => $forum->getNbPosts(),
    'post_rule'           => 'sfSimpleForum/forumLatestPosts?forum_name='.$forum->getStrippedName(),
    'feed_rule'           => 'sfSimpleForum/forumLatestPostsFeed?forum_name='.$forum->getStrippedName(),
    'feed_title'          => $feed_title
  )) ?>
  


  <?php if ($forum->getNbTopics()): ?>
    
    <?php include_partial('sfSimpleForum/topic_list', array('topics' => $topics, 'include_forum' => false)) ?>
    
    <?php echo pager_navigation($topic_pager, 'sfSimpleForum/forum?forum_name='.$forum->getStrippedName()) ?>    
  <?php else: ?>
    <p><?php echo __('There is no topic in this discussion yet. Perhaps you would like to %start%?', array('%start%' =>  link_to(__('start a new one'), 'sfSimpleForum/createTopic?forum_name='.$forum->getStrippedName()))) ?></p>
  <?php endif; ?>

</div>