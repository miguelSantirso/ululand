<?php sfLoader::loadHelpers('I18N') ?>
<?php if (isset($object)): ?>
<?php $dom_id = 'sf_rating_details_'.$object_type.'_'.$object->getId() ?>
<?php $ratingsCount = 0; ?>
<table id="<?php echo $dom_id; ?>" class="ratingDetailsTable">
<tr>
<?php foreach ($rating_details as $rating => $details): ?>
		<?php $ratingsCount += $details['count']; ?>
		<td style="height: 75px" class="ratingBarBackground">
		<div style="height:<?php echo $details['percent'] * 0.75 ?>px">&nbsp;</div>
		</td>
<?php endforeach; ?>
</tr>
<tr>
<?php foreach ($rating_details as $rating => $details): ?>
		<td class="ratingBarLegend">
		<span><?php echo $rating; ?></span>
		</td>
<?php endforeach; ?>
</tr>
</table>

<ul class="ratingDetailsInfo">
	<li><?php echo sprintf(__('%s ratings'), '<strong>'.$ratingsCount.'</strong>'); ?></li>
	<li><?php echo sprintf(__('Average: %s'), '<strong>'.$object->getRating().'</strong>'); ?></li>
</ul>

<div class="clearFloat"></div>
<?php endif; ?>