<?php
	
	if(!isset($objects))
	{
		$objects = TagPeer::getTaggedWith($tagsString, array('model' => 'Game', 'nb_common_tags' => 1));
	}

	if(!isset($title))
	{
		$title = __('Related Games');
	}
	
?>

			<h3 class="header"><?php echo $title; ?></h3>
			<ul class="relatedGames">
			<?php foreach($objects as $object) : ?>
				<?php $linkText = 
					gameThumbnail_tag($object, array('width' => '60px')).
					'<span class="relatedGameLink">'.
						$object->getName().
					'</span>'.
					'<span class="relatedGameDetails">'.
						sprintf(__('%s gameplays'), $object->getCounter()).
					'</span>';
				?>
				<?php if($object->getRating()) :
					$linkText .= '<span class="relatedGameDetails">'.
						sprintf(__('%s stars'), $object->getRating()).
					'</span>';
					endif; ?>
				<li class="">
					<?php echo linkToGame($object, array(), $linkText); ?>
				</li>
			<?php endforeach; ?>
			</ul>
