<?php use_helper('Tooltip'); ?>
<?php use_helper('Javascript'); ?>
<?php use_helper('UlulandAjax'); ?>
<?php use_helper('nahoWiki'); ?>

<div>
	<!-- avatar info -->
	<div class="fixedWidth wide normalBox subtle alignLeft">
		<div class="">
		<?php include_component('widget', 'widget', array('widgetName' => 'UlulandAvatarRepresentator', 
														'width' => '100px', 'height' => '150px',
														'flashVars' => 'sizeStretch=0.6&avatarApiKeys='.$profile->getApiKey() )); ?>
		</div>
		<h2 class="xLarge"><?php echo $profile->getProfileLink(); ?></h2>
		<?php if($ownProfile) { ?>
			<p class="xSmall">(Est&aacute;s viendo tu perfil)</p>
		<?php } ?>
		<?php if($friendship && $friendship->getStatus() == Friendship::STATUS_CONFIRMED) { ?>
			<p class="xSmall">(<?php echo $profile->getName(); ?> es tu amigo)</p>
		<?php } ?>
		<br style="clear:both;" />
	</div>
	<br style="clear:both;" />

	<!-- friends -->
	<div class="fixedWidth wide normalBox subtle">
		<h3 class="header">Amigos</h3>
		<div class="alignCenter">
			<?php
				$flashVars = 'sizeStretch=0.25&avatarApiKeys=';
				$nAvatars = 0;
				foreach($friends as $friend)
				{
					$flashVars .= $friend->getApiKey().',';
					$nAvatars++;
				}
				include_component('widget', 'widget', array('widgetName' => 'UlulandAvatarRepresentator',
														'width' => '600px', 'height' => '60px',
														'flashVars' => $flashVars )); 
			?>
		</div>
		<p><?php echo count($friends); ?> amigos de <?php echo $profile->getName(); ?> en la foto: <?php foreach ($friends as $friend): ?><?php echo $friend->getProfileLink(); ?>, <?php endforeach; ?></p>
		<div style="clear:both"></div>
	</div>

	<!-- messages -->
	<div id="messages" class="fixedWidth medium alignLeft">
		<div class="normalBox subtle">
			<h3 class="header">Tabl&oacute;n de mensajes</h3>
			<ol id="messagesList" class="normalList subtle">
			<?php $alt = ""; ?>
			<?php foreach ($profile->getReceivedMessages() as $message): ?>
			  <li class="message <?php echo $alt; ?>">
			  <?php use_helper('Partial'); ?>
			  <?php include_partial('message/message', array('message' => $message)) ?>
			  </li>
			  <?php $alt = $alt == "" ? "alt" : ""; ?>
			<?php endforeach; ?>
			</ol>
			
			<br/>
			
			<div id="add_message">
	
				<form method="post" class="card" action="<?php echo url_for('@add_message'); ?>" onsubmit='<?php echo ajaxUpdater_instance(url_for('@add_message'), 'success: "messagesList"', 'messagesList', 'add_message'); ?>'>
	
	
				<fieldset class="labelsAtTop">
						<legend class="xLarge">Dejar una nota</legend>
						<label for="body">Nota, admite <em>Textile</em> (<a href="#textileHelp" id="textileHelp">ayuda</a>):</label>
						<?php echo textarea_tag('body', $sf_params->get('body'), array('cols' => '45', 'rows' => '5')) ?>
						<?php echo input_hidden_tag('recipient_id', $profile->getId()) ?>
					<?php echo submit_tag('Guardar', array('class' => 'submit wide large')) ?>
				</fieldset>
				<?php echo predefined_tooltip('textileHelp'); ?>
			</form>
			</div>
		</div>
	</div>
	
	<!-- avatar info -->
	<div class="fixedWidth medium alignRight">
		<div class="normalBox normal">
			<h3 class="header">Informaci&oacute;n del avatar:</h3>
			<h4>Cr&eacute;ditos totales:</h4>
			<p><?php echo $profile->getTotalCredits() ?></p>
			<h4>Cr&eacute;ditos disponibles:</h4>
			<p><?php echo $profile->getAvailableCredits() ?></p>
			<h4>&Uacute;ltimos Gamestats:</h4>
			<ol>
				<?php foreach($profile->getLatestGamestats(5) as $value) : ?>
				<li><?php echo $value->getGamestat(); ?>: <?php echo $value->getValue(); ?></li>
				<?php endforeach; ?>
			</ol>
		</div>
		
		<div class="normalBox normal">
			<h3 class="header">Vuestra relaci&oacute;n:</h3>
			<?php if(!$ownProfile && !$friendship) { ?>
				<p>No sois amigos. <?php echo link_to('A&ntilde;adir como amigo', 'profile/addFriend?id='.$profile->getId()); ?></p>
				
			<?php } ?>
			<h4>Peticiones de amistad:</h4>
			<?php if(count($notConfirmedFriends) == 0) { ?>
				<p class="small normalEmphasis"><?php echo $profile->getProfileLink(); ?> no tiene peticiones de amistad pendientes.</p>
			<?php } ?>
			<ol>
			<?php foreach ($notConfirmedFriends as $friend): ?>
				<li><?php echo $friend->getProfileLink(); ?> <?php if($ownProfile) echo link_to('(Confirmar)', 'profile/addFriend?id='.$friend->getId().'&redirectToProfile='.$profile->getId()); ?></li>
			<?php endforeach; ?>
			</ol>
		</div>
	</div>
	
	<div style="clear:both"></div>
 
<?php echo link_to('&laquo; Listado', 'profile/list', array('class' => 'navigation')) ?>