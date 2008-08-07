<?php
// auto-generated by sfPropelCrud
// date: 2008/07/23 19:55:02
?>

<?php use_helper('PagerNavigation') ?>
<?php use_helper('Tags') ?>

<div id="pageHeader">
	<h2><?php echo link_to(__("Registered people"), 'profile/list'); ?></h2>
	<p class="subtitle"><?php echo __("We create games!"); ?></p>
</div>

<div id="pageContent">
	
	<?php if(isset($tag)) : ?>
		<div class="contentBox light fixedWidth half alignCenter">
			<p class="noSpace center"><?php echo sprintf(__('Showing developers tagged with %1$s (%2$s)'), link_to($tag, 'profile/list?tag='.$tag), link_to('show all', 'profile/list')); ?></p>
		</div>
	<?php endif; ?>
		
	<div class="fixedWidth wide alignLeft">
		<?php if(isset($search)) : ?>
			<h3 class="header"><?php echo sprintf(__('Developers whose name is similar to %1$s (%2$s)'), link_to($search, 'profile/list?search='.$search), link_to('show all', 'profile/list')); ?></h3>
		<?php endif; ?>
			
		<div class="center"><?php echo pager_navigation($profilesPager, 'profile/list'); ?></div>
		
		<?php $profiles = $profilesPager->getResults(); ?>
		<?php sfPropelActAsTaggableBehavior::preloadTags($profiles); ?>
		<?php foreach ($profiles as $profile): ?>
			<?php $userProfile = $profile->getsfGuardUserProfile(); ?>
			<?php if($userProfile->isFilledIn()) { ?>
				<div class="contentBox bordered">
					<?php if($sf_user->isAuthenticated() && $userProfile->getId() == $sf_user->getProfile()->getId()) { echo link_to(__('edit'), 'profile/edit?id='.$userProfile->getId(), array('class' => 'button alignRight xSmall')); } ?>
					<?php
						$grav_url = "http://www.gravatar.com/avatar.php?
						gravatar_id=".md5($userProfile->getSfGuardUser()->getUsername());
					?>
					<?php echo link_to(image_tag($grav_url), "profile/show?username=".$userProfile->getUsername(), array('class' => 'alignLeft')); ?>
					<h5 class="header"><?php echo link_to($userProfile, "profile/show?username=".$userProfile->getUsername(), array('class' => 'large')); ?></h5>
					<?php if($profile->getUrl() != '') { ?><p class="noSpace small"><?php echo link_to($profile->getUrl(), $profile->getUrl()); ?></p><?php } ?>
					<p class="noSpace small"><?php echo $profile->getLinkedTagsString(); ?></p>
					<div style="clear: both"></div>
				</div>
			<?php } ?>
		<?php endforeach; ?>
	
		<div class="center"><?php echo pager_navigation($profilesPager, 'profile/list'); ?></div>
	</div>
	
	<div class="fixedWidth third alignRight">
	<?php if($sf_user->isAuthenticated() && !$sf_user->getProfile()->isFilledIn()) { ?>
		<div class="contentBox light">
			<h3 class="header"><?php echo link_to(__("Fill in your profile now!"), 'profile/edit?id='.$sf_user->getProfile()->getId()); ?></h3>
			<p class=""><?php echo __("Your profile is not filled in and you will not be listed here."); ?></p>
			<p class=""><?php echo link_to(__("Fill in your profile &raquo;"), 'profile/edit?id='.$sf_user->getProfile()->getId()); ?></p>
		</div>
	<?php } ?>
		<div class="contentBox light">
			<h3 class="header"><?php echo __('Search'); ?></h3>
			<?php echo form_tag('profile/list'); ?>
				<?php echo input_tag('search', (isset($search) ? $search : '')); ?>
				<?php if(isset($tag)){ echo input_hidden_tag('tag', $tag); } ?>
				<?php echo submit_tag(__('Search!')); ?>
			</form>
		</div>
		<div class="contentBox light">
			<h3 class="header"><?php echo __('Tags'); ?></h3>
			<?php $tags = TagPeer::getPopulars(); ?>
			<?php echo tag_cloud($tags, 'profile/list?tag=%s', array('class' => 'xxSmall')); ?>
		</div>
	</div>
</div>