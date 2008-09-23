
<table class="releasesList">
	<thead>
		<tr>
			<th><?php echo __('Release'); ?></th>
			<th><?php echo __('Status'); ?></th>
			<th><?php echo __('Date'); ?></th>
			<th><?php echo __('By'); ?></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($gameReleases as $gameRelease) : ?>
		<tr id="release_<?php echo $gameRelease->getId(); ?>" class="<?php echo ulToolkit::stripText($gameRelease->getGameReleaseStatus()); ?>">
			<td class="name"><?php echo linkToGameRelease($gameRelease); ?></td>
			<td><?php echo $gameRelease->getGameReleaseStatus() ?></td>
			<td><?php echo format_date($gameRelease->getCreatedAt()); ?></td>
			<td><?php echo linkToProfile($gameRelease->getsfGuardUser()->getProfile()); ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
