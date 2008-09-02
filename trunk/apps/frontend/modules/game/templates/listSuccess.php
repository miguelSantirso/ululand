
<div class="contentColumn wide normalBox subtle">
	<h2 class="alignCenter">La sala de m&aacute;quinas</h2>
	<p class="alignCenter">Elige un juego. Divi&eacute;rtete. Esto es <strong>ulu</strong>land; esta es tu casa.</p>
</div>

<?php if(isset($tag)) { ?>
	<div class="normalBox normal">
		<h3 class="small alignCenter">Mostrando juegos etiquetados con "<strong><?php echo $tag; ?></strong>" (<?php echo link_to("mostrar todos", "game/list"); ?>)</h3>
	</div>
<?php } ?>

<?php use_helper('PagerNavigation') ?>

<?php echo pager_navigation($gamesPager, 'game/list') ?>
<?php $alt = ""; ?>
<ul class="normalList subtle">
<?php foreach ($gamesPager->getResults() as $game): ?>
	<li class=<?php echo $alt; ?>>
		<?php echo link_to(
			image_tag($game->getThumbnailUrl(), array('alt' => 'Game Logo', 'class' => 'gameThumbnail')),
			'game/show?id='.$game->getId(), array('class' => "alignLeft")); ?>
		<h4 class="xLarge"><?php echo link_to($game->getName(), 'game/show?id='.$game->getId()); ?></h4>
		<p class=""><?php echo $game->getDescription(); ?></p>
		<p class="small">Puntuaci&oacute;n: <?php echo $game->getRating(); ?> de 5</p>
		<p class="small"><?php echo $game->getCommentsAmount(); ?> comentarios</p>
		<p class="small"><?php echo $game->getGameplays(); ?> partidas jugadas</p>
		<div style="clear: both;"></div>
	</li>
	<?php $alt = $alt == "" ? "alt" : ""; ?>
<?php endforeach; ?>
</ul>

<?php echo pager_navigation($gamesPager, 'game/list') ?>

<?php echo link_to('&laquo; Portada', 'home/Welcome', array('class' => 'navigation')) ?>