<?php use_helper('Date', 'Partial', 'sfRating'); ?>
<?php $isOwner =  $sf_user->isAuthenticated() && $sf_user->getId() == $code_piece->getCreatedBy(); ?>

<div id="pageContent">

	<div class="contentRow">
	
		<div class="contentColumn wide alignLeft">
			<div class="contentBox">
				<div class="alignRight"><?php echo sf_rater($code_piece) ?></div>
				<h3 class="header">
					<?php echo linkToRecipe($code_piece); ?>
					<?php if($isOwner) : ?>
						<span class="">(<?php echo linkToEditRecipe($code_piece, array(), __('edit')); ?>)</span>
					<?php endif; ?>
				</h3>
				<div class="xSmall alignLeft">
					<p class="noSpace">
						<a href="#recipeDetails"><?php echo __('Embed &amp; details'); ?></a>
						| <a href="#comments"><?php echo __('Comment'); ?></a>
					</p>
				</div>
				<div class="xSmall right">
						<p class="noSpace"><?php echo sprintf(__('Submitted by %1$s %2$s ago (%3$s)'),
									linkToProfile($code_piece->getsfGuardUser()->getProfile()),
									time_ago_in_words($code_piece->getCreatedAt('U')), 
									format_date($code_piece->getCreatedAt()) ); ?></p>
				</div>
				
				<?php echo $code_piece->getHtmlSource(); ?>
				
			</div>
			<div class="contentBox light">
				<div class="contentColumn half alignLeft">
					<div id="recipeDetails" class="">
						<h4 class="header"><?php echo __('Embed:'); ?></h4>
						<?php
							$url = url_for('recipe/embed?r='.$code_piece->getUuid(), true); 
							$embedCode = '<script type="text/javascript" language="javascript" charset="utf-8" src="'.$url.'"></script>';
						?>
						<input name="embedCode" id="embedCode" type="text" readonly="" onclick="javascript:$('embedCode').focus();$('embedCode').select();" value='<?php echo $embedCode; ?>' />
						<h4 class="header"><?php echo __('Recipe details'); ?></h4>
						<p class="noSpace small"><?php echo __('Tags'); ?>: <strong><?php echo $code_piece->getLinkedTagsString(); ?></strong></p>
						<p class="noSpace small"><?php echo __('Autor'); ?>: <strong><?php echo linkToProfile($code_piece->getsfGuardUser()->getProfile(), 15); ?></strong></p>
						<p class="noSpace small"><?php echo __('Date'); ?>: <strong><?php echo format_date($code_piece->getCreatedAt()); ?></strong></p>
						<p class="noSpace small"><?php echo __('Visits'); ?>: <strong><?php echo $code_piece->getCounter(); ?></strong></p>
						<?php if($isOwner) : ?>
								<p class="small"><strong><?php echo linkToEditRecipe($code_piece, array(), __('edit')); ?></strong>
								| <strong><?php echo link_to(__('delete'), "recipe/delete?id={$code_piece->getId()}", array('class' => 'delete', 'onClick' => 'javascript:return confirm("'.__('Are you sure you want to delete this?\n(Can\'t be undone. Seriously!)').'");')); ?></strong></p>
						<?php endif; ?>
					</div>
				</div>
				<div class="contentColumn alignRight">
					<h4 class="header"><?php echo __('Detailed ratings'); ?></h4>
					<?php include_component('sfRating', 'ratingDetails', array('object' => $code_piece)); ?>
				</div>
				<div class="clearFloat"></div>
			</div>
			
			<div id="comments" class="contentBox">
				<h4 class="header small"><?php echo __('Comments:') ?></h4>
				<?php
				include_component('sfComment', 'commentForm', array('object' => $code_piece, 'order' => 'desc'));
				include_component('sfComment', 'commentList', array('object' => $code_piece, 'order' => 'desc'));
				?>
			</div>
		</div>
		
		<div class="contentColumn quarter alignRight">
			<?php include_partial('searchForm'); ?>
			
			<?php include_partial('relatedByTags', array('title' => __('Similar Recipes'), 'tagsString' => $code_piece->getTagsString())); ?>
		</div>
	
	</div>
	
</div>

