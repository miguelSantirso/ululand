<?php use_helper('Object', 'Javascript') ?>

<div id="pageContent">
	<?php echo form_tag('competition/update') ?>
	
	<?php echo object_input_hidden_tag($competition, 'getId'); ?>
	
		<div class="contentColumn half alignLeft">
			<div class="contentBox light">
					<?php $gameStat = $competition->getGameStat(); ?>
					<h3 class="header"><?php echo __('Competition Info'); ?>:</h3>
					<?php echo form_tag('competition/update', 'multipart=true') ?>
					
					<p class="noSpace"><?php echo label_for('name', __('Competition Name')); ?>:</p>
					<?php echo object_input_tag($competition, 'getName', array (
				  		'size' => 20,
						'class' => 'grande',
						)) ?>
					<br/>
					<br/>
					
					<p class="noSpace"><?php echo label_for('thumbnail_path', __('Thumbnail:')); ?></p>
					<?php echo input_file_tag("thumbnail_path"); ?>
					<br/>
					<br/>

					<p class="noSpace"><?php echo label_for('gameStatId', __('Competition GameStat:')); ?></p>
					<?php if (!is_null($game))echo select_tag('gameStatId', objects_for_select($game->getGameStats(), 'getId', 'getName', $gameStat ? $gameStat->getId() : null, array('include_blank' => true) )); ?>
					<br/>
					<br/>
					
					<p class="noSpace"><?php echo label_for('start', __('Competition Start:')); ?></p>
					<?php echo object_input_date_tag($competition, 'getStartsAt', array ( 
						'rich' => true, 
						'withtime' => true,
						), 'now') ?>
					<br/>
					<br/>
					
					<p class="noSpace"><?php echo label_for('end', __('Competition End:')); ?></p>
					<?php echo object_input_date_tag($competition, 'getFinishesAt', array ( 
						'rich' => true, 
						'withtime' => true,
						), 'now') ?>
					<br/>
					<br/>

					<p class="noSpace"><?php echo label_for('description', __('Competition Description')); ?>:</p>
					<?php echo object_textarea_tag($competition, 'getDescription', array (
					  'rows' => 15,
					  'cols' => 51
					)) ?>
				<br/>
				
			<?php $with = "'username=' + encodeURIComponent($('name').value) + '&description=' + encodeURIComponent($('description').value)"; ?>
			<?php echo observe_field('name', array(
				'update'  => 'competitionPreview',
				'url'     => 'competition/preview',
				'before'  => "Element.show('loadIndicator'); Element.setOpacity('competitionPreview', 0.5);",
				'complete'=> "Element.hide('loadIndicator'); Element.setOpacity('competitionPreview', 1);",
			    'with'    => $with)) ?>
			<?php echo observe_field('description', array(
				'frequency' => '5',
				'update'    => 'competitionPreview',
				'url'       => 'competition/preview',
				'before'  => "Element.show('loadIndicator'); Element.setOpacity('competitionPreview', 0.5);",
				'complete'=> "Element.hide('loadIndicator'); Element.setOpacity('competitionPreview', 1);",
			    'with'      => $with)) ?>
			<?php echo link_to_remote(__('update preview'), array(
				'update'  => 'competitionPreview',
				'url'     => 'competition/preview',
				'before'  => "Element.show('loadIndicator'); Element.setOpacity('competitionPreview', 0.5);",
				'complete'=> "Element.hide('loadIndicator'); Element.setOpacity('competitionPreview', 1);",
		    	'with'    => $with),
			array('class' => 'large alignRight')) ?>
				<div class="clearFloat"></div>

		</div>

	</div>

	<div class="alignRight contentColumn half">
		<div id="loadIndicator" class="alignRight"><?php echo image_tag('ajax-loader.gif'); ?></div>
		<h3 class="header"><?php echo __('Preview'); ?>:</h3>
		<div id="groupPreview" class="contentBox bordered small"></div>
			    
		<?php echo javascript_tag(
			  remote_function(array(
			    'update'  => '"competitionPreview"',
			    'url'     => 'competition/preview',
			  	'complete'=> "Element.hide('loadIndicator')",
			    'with'    => $with
			  ))
			) ?>
			
		<div class="contentBox">
			<h4 class="header small"><?php echo __('Members:') ?></h4>
			<?php
				 include_component('competition', 'listMembers', array('competition' => $competition, 'excludeOwners' => true, 'edit' => true, 'orderDescendingBy' => Competition_PlayerProfilePeer::CREATED_AT));
			?>
		</div>
		
		<div class="contentBox">
			<h4 class="header small"><?php echo __('Pending') ?>:</h4>
			<?php
				 include_component('competition', 'listMembers', array('competition' => $competition, 'pending' => true, 'edit' => true, 'orderDescendingBy' => Competition_PlayerProfilePeer::CREATED_AT));
			?>
		</div>
		
	</div>
	
	<div class="clearFloat"></div>
	
	<div class="contentBox" style="text-align: center">
		<?php echo submit_tag(__('save')) ?>
		<?php if ($competition->getId()): ?>
		  &nbsp;<?php echo link_to(__('cancel'), 'competition/show?id='.$competition->getId()) ?>
		<?php else: ?>
		  &nbsp;<?php echo link_to(__('cancel'), 'competition/list') ?>
		<?php endif; ?>
	</div>

	</form>
</div>