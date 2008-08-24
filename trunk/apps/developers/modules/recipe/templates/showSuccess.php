<?php use_helper('Date', 'Partial', 'sfRating'); ?>

<div id="pageContent">

	<div class="contentRow">
	
		<div class="contentColumn wide alignLeft">
			<div class="contentBox bordered">
				<div class="alignRight"><?php echo sf_rater($code_piece) ?></div>
				<h3 class="header">
					<?php echo linkToRecipe($code_piece); ?>
					<?php if($sf_user->isAuthenticated() && $sf_user->getId() == $code_piece->getCreatedBy()) : ?>
						<span class="">(<?php echo linkToEditRecipe($code_piece, array(), __('edit')); ?>)</span>
					<?php endif; ?>
				</h3>
				<div class="xSmall right">
						<p class="noSpace"><?php echo sprintf(__('Submitted by %1$s %2$s ago (%3$s)'),
									linkToProfile($code_piece->getsfGuardUser()->getProfile()),
									time_ago_in_words($code_piece->getCreatedAt('U')), 
									format_date($code_piece->getCreatedAt()) ); ?></p>
				</div>
				
				<?php echo sfMarkdown::doConvert( $code_piece->getSource() ); ?>
				
				<p class="noSpace small"><strong><?php echo __('Tags'); ?>:</strong> <?php echo $code_piece->getLinkedTagsString(); ?></p>
				<p class="noSpace small"><strong><?php echo __('Visits'); ?>:</strong> <?php echo $code_piece->getCounter(); ?></p>
				
			</div>
			<div class="contentBox">
				<h4 class="header">Comentarios</h4>
				<?php
					include_component('sfComment', 'commentList', array('object' => $code_piece));
					include_component('sfComment', 'commentForm', array('object' => $code_piece));
				?>
			</div>
		</div>
		
		<div class="contentColumn quarter alignRight">
			<?php include_partial('searchForm'); ?>
			
			<?php include_partial('relatedByTags', array('title' => __('Similar Recipes'), 'tagsString' => $code_piece->getTagsString())); ?>
			
		</div>
	
	</div>
	
</div>

