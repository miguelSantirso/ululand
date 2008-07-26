<div class="fixedWidth wide normalBox subtle">
	<h2 class="alignCenter">Las habitaciones</h2>
	<p class="alignCenter">Aqu&iacute; estamos todos.</p>
</div>

<?php use_helper('PagerNavigation') ?>

<?php echo pager_navigation($profilesPager, 'profile/list') ?>

<ul class="normalList subtle">
<?php $alt = ""; ?>
<?php foreach ($profilesPager->getResults() as $profile): ?>
	<li class="<?php echo $alt; ?>">
		<div class="alignLeft">
		<?php include_component('widget', 'widget', array('widgetName' => 'UlulandAvatarRepresentator', 
														'width' => '50px', 'height' => '75px',
														'flashVars' => 'sizeStretch=0.6&avatarApiKeys='.$profile->getApiKey() )); ?>
		</div>
		<h4 class=""><?php echo $profile->getProfileLink(); ?></h4>
		<p class="">Tiene <?php echo $profile->getFriendsNumber(); ?> amigos.</p>
		<br style="clear:both" />
	</li>
	<?php $alt = $alt == "" ? "alt" : ""; ?>
<?php endforeach; ?>
</ul>

<?php echo pager_navigation($profilesPager, 'profile/list') ?>

<?php echo link_to('&laquo; Portada', 'home/Welcome', array('class' => 'navigation')) ?>