<?php use_helper('Tooltip'); ?>
<?php use_helper('nahoWiki'); ?>

<div class="fixedWidth wide normalBox subtle">
	<h2 class="alignCenter">Tus grupos</h2>
	<p class="alignCenter"><?php echo "&iexcl;T&iacute;o, est&aacute;s en ", count($groups), " grupos!"; ?></p>
</div>

<?php if(count($groups) == 0) { ?>
	<p>A&uacute;n no est&aacute;s en ning&uacute;n grupo. <?php echo link_to('Ver todos los grupos', 'group/listall') ?>.</p>
<? } else { ?>
	<h3>Listado de tus grupos</h3>
	<ul class="normalList subtle">
	<?php $alt = ""; ?>
	<?php foreach ($groups as $group): ?>
		<li class="<?php echo $alt; ?>">
		<p><?php echo link_to($group->getName(), 'group/show?group='.$group->getId()), "<br/>"; ?></p>
		</li>
		<?php $alt = $alt == "" ? "alt" : ""; ?>
	<?php endforeach; ?>
	</ul>
<?php } ?>


<?php echo link_to('&laquo; Todos los grupos', 'group/listall', array('class' => 'navigation')) ?>
