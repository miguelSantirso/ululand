<table class="gamestatTable">
	<tr class="header">
		<th>#</th>
		<th><?php echo __('Player'); ?></th>
		<?php $valueLabel = is_null($gamestat->getScoreLabel()) || $gamestat->getScoreLabel() == 'undefined' ? 'Value' : $gamestat->getScoreLabel(); ?>
		<th><?php echo __($valueLabel); ?></th>
	</tr>
	<?php $i=1; $alt=""; ?>
	
	<?php foreach($gamestat->getOrderedValues(10) as $value) : ?>
	
	<tr class="row_<?php echo $i; ?> <?php echo $alt; ?>">
		<td class="position"><?php echo $i; ?></td>
		<td class="player"><?php echo linkToProfile($value->getPlayerProfile()->getsfGuardUserProfile()); ?></td>
		<td class="value"><?php echo $value->getValue(); ?></td>
	</tr>
	
	<?php $i++; $alt = $alt == "" ? "alt" : ""; ?>
	<?php endforeach; ?>
	
</table>
