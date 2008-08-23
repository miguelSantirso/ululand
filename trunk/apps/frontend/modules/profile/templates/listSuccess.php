<div class="contentColumn wide normalBox subtle">
	<h2 class="alignCenter">Las habitaciones</h2>
	<p class="alignCenter">Aqu&iacute; estamos todos.</p>
</div>

<?php use_helper('PagerNavigation') ?>

<?php echo pager_navigation($profilesPager, 'profile/list') ?>

<ul class="normalList subtle">
<?php $alt = ""; ?>
<?php foreach ($profilesPager->getResults() as $profile): ?>
	<li class="<?php echo $alt; ?>">
		<h4 class=""><?php echo $profile->getUsername(); ?></h4>
		<br style="clear:both" />
	</li>
	<?php $alt = $alt == "" ? "alt" : ""; ?>
<?php endforeach; ?>
</ul>

<?php echo pager_navigation($profilesPager, 'profile/list') ?>

<?php echo link_to('&laquo; Portada', 'home/Welcome', array('class' => 'navigation')) ?>