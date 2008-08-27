<?php use_helper('Form', 'Validation', 'Javascript', 'Date', 'ulMisc'); ?>

<?php if(!$sf_user->isAuthenticated()) : ?>
	<div class="contentBox light">
		<strong><?php echo sprintf(__("You must %s or %s to comment!"), link_to(__('log in'), '@sf_guard_signin'), link_to(__('Register'), '@register')); ?></strong>
	</div>
<?php else : ?>
  <?php
  echo form_tag('sfComment/'.$action, 
                array('class' => 'commentForm', 
                      'id'    => 'sf_comment_form', 
                      'name'  => 'sf_comment_form'));
  ?>

	<span class="gravatar">
		<?php echo gravatar_tag($sf_user->getUsername()); ?>
	</span>    
    <div class="required">
      <?php echo form_error('sf_comment') ?>
      <?php echo textarea_tag('sf_comment') ?>
    </div>


    <?php
    switch (sfConfig::get('sf_path_info_array'))
    {
      case 'SERVER':
        $pathInfoArray =& $_SERVER;
        break;
      case 'ENV':
      default:
        $pathInfoArray =& $_ENV;
    }

    $referer = sfRouting::getInstance()->getCurrentInternalUri();
    
    if ($pathInfoArray['QUERY_STRING'] != '')
    {
      $referer .= '?'.$pathInfoArray['QUERY_STRING'];
    }
    ?>
    <?php echo input_hidden_tag('sf_comment_referer', sfContext::getInstance()->getRequest()->getParameter('sf_comment_referer', $referer)) ?>
    <?php echo input_hidden_tag('sf_comment_object_token', $token) ?>

    <?php if (isset($namespace) && ($namespace != null)): ?>
      <?php echo input_hidden_tag('sf_comment_namespace', $namespace) ?>
    <?php endif; ?>

    <?php if ($config['use_ajax']): ?>
      <div id="sf_comment_ajax_indicator" style="display: none">&nbsp;</div>
      <div class="actions">
	      <?php
	      echo submit_to_remote('sf_comment_ajax_submit',
	                           __('Post this comment'),
	                           array('update'   => array('success' => 'sf_comment_list', 'failure' => 'sf_comment_form'),
	                                 'url'      => 'sfComment/'.$action,
	                                 'loading'  => "Element.show('sf_comment_ajax_indicator')",
	                           		 'success'  => "Element.hide('sf_comment_form');",
	                                 'complete' => "Element.hide('sf_comment_ajax_indicator'); new Effect.Highlight($(\"commentsList\").firstDescendant())",
	                                 'script'   => true),
	                           array('class' => 'submit'));
	      ?>
	      <noscript>
	        <?php echo submit_tag(__('Submit'), array('class' => 'submit')) ?>
	      </noscript>
	    <?php else: ?>
	      <?php echo submit_tag(__('Submit'), array('class' => 'submit')) ?>
	    <?php endif; ?>
	    <span><?php echo __('Accepts Markdown'); ?></span>
    </div>
  </form>
<?php endif; ?>