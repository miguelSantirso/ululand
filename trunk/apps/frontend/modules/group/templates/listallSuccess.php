<?php
// auto-generated by sfPropelCrud
// date: 2008/02/21 12:09:13
?>

<div class="fixedWidth wide normalBox subtle">
	<h2 class="alignCenter">Todos los grupos</h2>
	<p class="alignCenter">&iexcl;Todos los grupos en ululand! Jugar en grupo mola m&aacute;s, &iquest;no?</p>
</div>

<?php use_helper('PagerNavigation') ?>

<div class="fixedWidth medium alignLeft">
	<?php echo pager_navigation($groupsPager, 'group/listall') ?>
	<ul class="normalList subtle">
	<?php $alt=""; ?>
	<?php foreach ($groupsPager->getResults() as $group): ?>
		<li class="<?php echo $alt; ?>">
		<p><?php echo link_to($group->getName(), 'group/show?group='.$group->getId()), "<br/>"; ?></p>
		</li>
		<?php $alt = $alt == "" ? "alt" : ""; ?>
	<?php endforeach; ?>
	</ul>
	<?php echo pager_navigation($groupsPager, 'group/listall') ?>
</div>

<div class="fixedWidth medium normalBox subtle alignRight">
<h3>Crear un grupo:</h3>
<?php echo link_to('Crear un grupo &raquo;', 'group/create', array('class' => 'navigation')) ?>
</div>