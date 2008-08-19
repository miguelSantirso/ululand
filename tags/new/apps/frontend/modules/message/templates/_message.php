<?php use_helper('Javascript'); ?>

<?php $date = new sfDate($message->getCreatedAt()); ?>

<span id="message-<?php echo $message->getId(); ?>"><?php echo $message->getSender()->getProfileLink(); ?></span>
<?php echo $message->getFormattedText(); ?>
<span class="small subtleColor"><?php echo $date->format("j \d\e F \d\e\l Y"); ?>
<?php if($message->getIdSender() == sfContext::getInstance()->getUser()->getAttribute('avatarId')) { ?>

<?php echo link_to_remote('(borrar)', 
	array('confirm' => '¿Seguro que quieres eliminar este mensaje?', 
		'loading' => 'Element.show("indicator")',
		'complete' => 'Element.hide("indicator"); Element.remove("message-'.$message->getId().'")',
		'update' => 'deleteMessage-'.$message->getId(), 
		'url' => 'message/delete?id='.$message->getId()) ); ?>
</span>

<?php } ?>