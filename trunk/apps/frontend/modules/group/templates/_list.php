		<?php use_helper('PagerNavigation'); ?>
		
		<div class="center"><?php echo pager_navigation($groupsPager, 'group/list'); ?></div>
		
		<?php $groups = $groupsPager->getResults(); ?>
		
		<?php if(count($groups) != 0){ ?>
		<ul class="compound">
			<?php foreach ($groups as $group): ?>
				<li class="">
					<?php echo linkToGroup($group, array('class' => 'firstRow')); ?>
					<div class="lastRow">
						<p class="noSpace small"><?php echo sprintf(__('This group has %s members'), '<strong>'.$group->getNbMembers().'</strong>'); ?></p>
					</div>
					<div class="clearFloat"></div>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php } else echo __("There are no groups yet"); ?>
	
		<div class="center"><?php echo pager_navigation($groupsPager, 'group/list'); ?></div>