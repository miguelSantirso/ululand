<?php use_helper('Date', 'PagerNavigation'); ?>

<div class="center"><?php echo pager_navigation($recipesPager, 'recipe/list'); ?></div>

<ul class="compound">
	<?php
		$recipes = $recipesPager->getResults();
		sfPropelActAsTaggableBehavior::preloadTags($recipes);
	?>
	<?php foreach ($recipes as $recipe): ?>
	<li class="">
		<strong><?php echo linkToRecipe($recipe, array('class' => 'firstRow')); ?></strong>
		<div class="lastRow">
			<p class="alignRight xSmall noSpace"><?php echo sprintf('by %1$s %2$s ago', 
					linkToProfile($recipe->getsfGuardUser()->getProfile()), 
					time_ago_in_words($recipe->getCreatedAt('U')) ); ?></p>
			<?php if($recipe->hasBeenRated()) : ?>
				<p class="noSpace xSmall"><strong><?php echo __('Rating'); ?>:</strong> <?php echo sprintf(__('%s out of %s'), $recipe->getRating(), $recipe->getMaxRating()); ?></p>
			<?php endif; ?>
			<?php if(($linkedTagsString = $recipe->getLinkedTagsString()) != "") : ?>
				<p class="noSpace xSmall"><strong><?php echo __('Tags'); ?>:</strong> <?php echo $linkedTagsString; ?></p>
			<?php endif; ?>
			<p class="noSpace xSmall"><strong><?php echo __('Visits'); ?>:</strong> <?php echo $recipe->getCounter(); ?></p>
		</div>
	</li>
<?php endforeach; ?>
</ul>

<div class="center"><?php echo pager_navigation($recipesPager, 'profile/list'); ?></div>