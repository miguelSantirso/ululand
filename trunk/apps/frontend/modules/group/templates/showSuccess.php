<?php use_helper('Tooltip'); ?>
<?php use_helper('nahoWiki'); ?>

<div class="contentColumn wide normalBox subtle">
	<h2 class="alignCenter"><?php echo "Grupo: ", $group;?></h2>
	<p class="alignCenter"><?php echo $description;?></p>
</div>

<div class="contentColumn wide normalBox subtle">
	<?php $belongs = false; $ispetition = false; $isowner = false; ?>
	<p>
	<?php 
		if(count($owners)) echo "Propietarios: <br/>";
		foreach ($owners as $owner)
		{
			echo linkToProfile(sfGuardUserProfilePeer::retrieveByPk($owner->getId()));//$owner->getProfileLink();
			if ($profile==$owner) 
			{
				echo " ", link_to("(Abandonar)", 'group/reject?group='.$group->getId().'&player='.$owner->getId());
				$belongs = true;
				$isowner = true; 
			} 
		} 
	?>
	</p>
	
	<p>
	<?php 
		if(count($avatars)) echo "Resto de miembros: <br/>";
		foreach ($avatars as $avatar)
		{  
			echo linkToProfile(sfGuardUserProfilePeer::retrieveByPk($avatar->getId()));//$avatar->getProfileLink(); 
			if ($profile==$avatar) 
			{ 
				echo " ", link_to("Abandonar", 'group/reject?group='.$group->getId().'&player='.$avatar->getId()); 
				$belongs = true; 
			} 
			if ($isowner) echo " ", link_to("Expulsar", 'group/reject?group='.$group->getId().'&player='.$avatar->getId()); 
		}
	?> 
	</p>
		
	<p>
	<?php 
		if(count($peticiones)) echo "Peticiones de ingreso: <br/>"; 
		foreach ($peticiones as $petition)
		{
			echo linkToProfile(sfGuardUserProfilePeer::retrieveByPk($petition->getId()));//$petition->getProfileLink();
			if ($profile==$petition) 
			{
				echo " ", link_to("Eliminar petici&oacute;n", 'group/reject?group='.$group->getId().'&player='.$petition->getId()); 
				$ispetition = true; 
			} 
			if ($isowner) echo " ", link_to("Aceptar", 'group/accept?group='.$group->getId().'&player='.$petition->getId()), " ", link_to("Rechazar", 'group/reject?group='.$group->getId().'&player='.$petition->getId()); 
		}
	?>
	</p>
	
	<p>
	
	<?php 
		if ($ispetition == true) echo "T&uacute; petici&oacute;n de uni&oacute;n al grupo est&aacute; siendo estudiada"; 
	?>
	</p>
	
	<p>
	<?php 
		if ($ispetition == false && $belongs == false) echo link_to("Unirse al grupo", 'group/union?group='.$group->getId()); 
	?>
	</p>
	<div class="clearFloat"></div>
</div>