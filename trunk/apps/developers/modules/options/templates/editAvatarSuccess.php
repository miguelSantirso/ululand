<?php use_helper('Javascript'); ?>

<h2 id="pageTitle"><?php echo link_to(image_tag("iconAvatar.png").__('Change Your Avatar'), '@options_edit_avatar'); ?></h2>

<div id="pageContent">

	<div class="contentColumn quarter alignRight">
	
		<div class="contentBox ">
			<h3 class="header"><?php echo __('Your avatar'); ?></h3>
			
			<div id="avatarPiecesReceiver">
				
			</div>
			
			<p class="small center"><?php echo __('Drag the pieces from your catalog and drop them over your avatar to change it'); ?>
<?php echo javascript_tag(
  remote_function(array(
  	'update'  => 'avatarPiecesReceiver',
	'url'     => 'options/setAvatarPiece'
	))
) ?>
<?php echo drop_receiving_element('avatarPiecesReceiver', array(
  'update'     => 'avatarPiecesReceiver',
  'url'        => 'options/setAvatarPiece',
  'hoverclass' => 'receiverActive'
)) ?>

			
				
		</div>
		
	</div>
		
	<div class="contentColumn wide alignLeft">
	
		<div class="contentBox light">
			<h3 class="header small"><?php echo __('Your Pieces Catalogue'); ?></h3>
			
			<ul id="avatarPiecesCatalogue">
			<?php $avatarIds = array(); ?>
			<?php foreach($avatarPiecesCatalogue as $avatarCataloguePiece) : ?>
			
				<?php $avatarIds[] = $avatarCataloguePiece->getId(); ?>
				<?php $inUse = $avatarCataloguePiece->getInUse() ? 'inUse' : ''; ?>
				<li class="avatarCataloguePiece <?php echo $inUse; ?>">
					
					<span class="pieceImage" id="avatarCataloguePiece_<?php echo $avatarCataloguePiece->getId(); ?>"><?php echo avatarPiece_tag($avatarCataloguePiece); ?></span>
					
					<?php $editPieceUrl = url_for("avatarPiece/edit?id={$avatarCataloguePiece->getId()}"); $editPieceText = $avatarCataloguePiece->getName();  ?>
					<span class="pieceName"><?php echo link_to_function($editPieceText, "Modalbox.show('{$editPieceUrl}', {title: '{$editPieceText}', width: 880})"); ?></span>
					<span class="pieceDescription"><?php echo $avatarCataloguePiece->getDescription(); ?></span>
				
				</li>
			<?php endforeach; ?>
			</ul>
			<?php for($i=0; $i<count($avatarIds); $i++) { echo draggable_element("avatarCataloguePiece_{$avatarIds[$i]}", array('revert' => true)); } ?>
			<div class="clearFloat"></div>
			<?php $createPieceUrl = url_for('avatarPiece/create'); $createPieceText = __('Create a new piece &raquo;');  ?>
			<p class="right noSpace">
				<?php echo select_tag('avatarType',
					array('head' => __('Head'), 'body' => __('Body'), 'arm' => __('Arm'), 'leg' => __('Leg')),
					array('onClick' => '$("createNewLink").href="'.$createPieceUrl.'/pieceType/"+this.value;')); ?>
				<?php echo link_to_function(__('Create a new piece &raquo;'),
					"Modalbox.show(this.href, {title: '{$createPieceText}', width: 880})",
					array('id' => 'createNewLink', 'href' => url_for('avatarPiece/create?pieceType=head'))); ?>
			</p>
		</div>
		
	</div>
	
</div>