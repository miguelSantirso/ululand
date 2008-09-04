<?php use_helper('Tooltip'); ?>
<?php use_helper('nahoWiki'); ?>

<div class="contentColumn wide normalBox subtle">
	<h2 class="alignCenter"><?php echo __('Group'), ": ", $group;?></h2>
	<p class="alignCenter"><?php echo $description;?></p>
	<p class="noSpace small"><strong><?php echo __('Visits'); ?>:</strong> <?php echo $group->getCounter(); ?></p>
</div>

<div class="contentColumn wide normalBox subtle">
	<?php $belongs = false; $ispetition = false; $isowner = false; ?>
	<p>
	<?php 
		if(count($owners)) echo __('Owners'); echo "<br/>";
		foreach ($owners as $owner)
		{
			echo linkToProfile(sfGuardUserProfilePeer::retrieveByPk($owner->getUserProfileId()));
			if ($profile==$owner)
			{
				echo " ", link_to(__('Leave'), 'group/reject?group='.$group->getId().'&player='.$owner->getId());
				$belongs = true;
				$isowner = true;
			} 
		} 
	?>
	</p>
	
	<p>
	<?php 
		if(count($avatars)) echo __('Other members'); echo "<br/>";
		foreach ($avatars as $avatar)
		{  
			echo linkToProfile(sfGuardUserProfilePeer::retrieveByPk($avatar->getUserProfileId()));
			if ($profile==$avatar) 
			{ 
				echo " ", link_to(__('Leave'), 'group/reject?group='.$group->getId().'&player='.$avatar->getId()); 
				$belongs = true; 
			} 
			if ($isowner) echo " ", link_to(__('Expel'), 'group/reject?group='.$group->getId().'&player='.$avatar->getId()); 
		}
	?> 
	</p>
		
	<p>
	<?php 
		if(count($requests)) echo __('Requests '); echo "<br/>"; 
		foreach ($requests as $request)
		{
			echo linkToProfile(sfGuardUserProfilePeer::retrieveByPk($request->getUserProfileId()));
			if ($profile==$request) 
			{
				echo " ", link_to(__('Delete request'), 'group/reject?group='.$group->getId().'&player='.$request->getId()); 
				$ispetition = true; 
			} 
			if ($isowner) echo " ", link_to(__('Accept request'), 'group/accept?group='.$group->getId().'&player='.$request->getId()), " ", link_to("Rechazar", 'group/reject?group='.$group->getId().'&player='.$request->getId()); 
		}
	?>
	</p>
	
	<p>
	
	<?php 
		if ($ispetition == true) echo __('Your request is being tried'); 
	?>
	</p>
	
	<p>
	<?php 
		if ($ispetition == false && $belongs == false) echo link_to(__('Join group'), 'group/union?group='.$group->getId()); 
	?>
	</p>
</div>
	
	<div class="contentColumn wide normalBox subtle">
	<p>
	<?php 
		if(count($members)) echo __('Ranking'); echo "<br/>";
		foreach ($members as $member)
		{
			echo linkToProfile(sfGuardUserProfilePeer::retrieveByPk($member->getUserProfileId())), " ", $member->getTotalCredits();
			echo "<br/>";
		} 
	?>
	</p>
	
</div>
			<div class="contentBox" id="postComment">
			<h4 class="header small"><?php echo __('Comments:') ?></h4>
			<?php
				include_component('sfComment', 'commentForm', array('object' => $group, 'order' => 'desc'));
				include_component('sfComment', 'commentList', array('object' => $group, 'order' => 'desc'));
			?>
			</div>
	<div class="clearFloat"></div>
</div>