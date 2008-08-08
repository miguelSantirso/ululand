<ul>
<?php foreach($collaboration_offers as $collaboration_offer) { ?>
	<li><?php echo link_to($collaboration_offer->getTitle(), 'collaboration/show?id='.$collaboration_offer->getId()); ?></li>
<?php } ?>
</ul>