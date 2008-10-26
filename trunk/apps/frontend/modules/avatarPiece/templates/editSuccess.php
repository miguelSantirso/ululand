<?php use_helper('Partial') ?>

<div id="pageContent">
	<div class="contentBox center">
		<?php $flashVars = isset($avatar_piece) ? "pieceUuid={$avatar_piece->getUuid()}" : ""; ?>
		<?php if(isset($pieceType)) $flashVars .= "&pieceType={$pieceType}"; ?>
		<?php include_component('widget', 'widget', array('widgetName' => 'partEditor', 'flashVars' => $flashVars)) ?>
	</div>
</div>