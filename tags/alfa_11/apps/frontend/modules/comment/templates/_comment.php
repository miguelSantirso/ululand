<?php use_helper('Javascript'); ?>

<?php $date = new sfDate($comment->getCreatedAt()); ?>

<span id="comment-<?php echo $comment->getId(); ?>"><?php echo $comment->getAuthor()->getProfileLink(); ?></span>
<?php echo $comment->getFormattedText(); ?>
<span class="small subtleColor"><?php echo $date->format("j \d\e F \d\e\l Y"); ?>
<?php if($comment->getIdAvatar() == sfContext::getInstance()->getUser()->getAttribute('avatarId')) { ?>

<?php echo link_to_remote('(borrar)', 
	array('confirm' => '¿Seguro que quieres eliminar este comentario?', 
		'loading' => 'Element.show("indicator")',
		'complete' => 'Element.hide("indicator"); Element.remove("comment-'.$comment->getId().'")',
		'update' => 'deleteComment-'.$comment->getId(), 
		'url' => 'comment/delete?id='.$comment->getId()) ); ?>
</span>

<?php } ?>
