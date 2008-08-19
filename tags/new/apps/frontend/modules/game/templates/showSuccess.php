<?php
// auto-generated by sfPropelCrud
// date: 2008/02/21 12:09:13
?>
<?php use_helper('Tooltip'); ?>
<?php use_helper('nahoWiki'); ?>
<?php use_helper('sfRating') ?>

	<!-- game box -->
	<div class="contentColumn wide normalBox subtle">
		<h2><?php echo link_to($game->getName(), 'game/show?id='.$game->getId()); ?></h2>
		<div class="alignCenter" style="width: <?php echo $game->getWidth()+200 ?>px; margin-left: auto;">
			<div class="alignLeft">
			 	<?php include_component('game', 'game', array('gameId' => $game->getId())) ?>
			</div>
			<div class="alignLeft">
			 	<?php include_component('widget', 'widget', array('widgetName' => 'UlulandChat', 'flashVars' => 'avatarApiKey='.$avatarApiKey)); ?>
			</div>
			<br style="clear:both" />
		</div>
	</div>

	<!-- game info -->
	<div class="contentColumn medium normalBox subtle alignLeft">
		<div class="alignLeft">
			<?php echo sf_rater($game) ?>
			<img class="gameThumbnail" alt="game logo" src="<?php echo $game->getThumbnailUrl(); ?>" />
		</div>
		<h2 class="strongEmphasis xLarge"><?php echo link_to($game->getName(), 'game/show?id='.$game->getId()); ?></h2>
		<p class=""><?php echo $game->getDescription(); ?></p>
		<p class="small"><strong>Tags:</strong> 
			<?php foreach($game->getTags() as $tag): ?>
				<?php echo link_to($tag, 'game/list?tag='.$tag); echo ' '; ?>
			<?php endforeach; ?>
		</p>
		<p class="small"><?php echo $game->getGameplays(); ?> partidas jugadas y <?php echo $game->getCommentsAmount(); ?> comentarios.</p>
		<br style="clear:both;" />
	</div>
	
	<!-- game author info -->
	<div class="contentColumn medium normalBox subtle alignRight">
		<img class="alignRight gameThumbnail" alt="game logo" src="<?php echo $game->getThumbnailUrl(); ?>" />
		<h2 class="strongEmphasis xLarge">Nombre del autor</h2>
		<p class="">Texto breve del autor</p>
		<p class="small">Estadísticas e información del autor</p>
		<br style="clear:both;" />
	</div>
	
	<br style="clear:both" />

	<!-- game comments -->
	<div class="contentColumn medium alignLeft normalBox subtle">
		<h3 class="header">Comentarios</h3>
		<?php if($game->getCommentsAmount() == 0) { ?>
			<p>No hay comentarios todav&iacute;a. &iexcl;S&eacute; el primero!</p>
		<?php } else { ?>
			<p class="">Hay <?php echo $game->getCommentsAmount(); ?> comentarios:</p>
			<ol id="commentsList" class="normalList subtle">
			<?php $alt = ""; ?>
			<?php foreach ($game->getComments() as $comment): ?>
			  <li class="<?php echo $alt; ?>">
			  <?php include_partial('comment/comment', array('comment' => $comment)) ?>
			  </li>
			  <?php $alt = $alt == "" ? "alt" : ""; ?>
			<?php endforeach; ?>
			</ol>
		<?php } ?>
		
		<div id="add_comment">
		<?php use_helper("Javascript"); ?>
		<?php use_helper("UlulandAjax"); ?>
		<form method="post" class="card" action="<?php echo url_for('@add_comment'); ?>" onsubmit='<?php echo ajaxUpdater_instance(url_for('@add_comment'), 'success: "commentsList"', 'commentsList', 'add_comment'); ?>'>
		  	
			<fieldset class="labelsAtTop">
					<legend class="xLarge">Comentar</legend>
					<label class="" for="body">Comentario, admite <em>Textile</em> (<a href="#textileHelp" id="textileHelp">ayuda</a>):</label>
					<?php echo textarea_tag('body', $sf_params->get('body'), array('class' => 'leftMargin', 'cols' => '45', 'rows' => '5', 'id' => 'commentTextArea')) ?>
					<?php echo input_hidden_tag('game_id', $game->getId()) ?>
				<?php echo submit_tag('Comenta', array('class' => 'submit wide large')) ?>
				<?php echo predefined_tooltip('textileHelp'); ?>
			</fieldset>
		</form>
		</div>
	</div>
	
	<!-- game info -->
	<div id="gameInfo" class="contentColumn medium alignRight normalBox subtle">
		<h3 class="header">Rankings</h3>
		<?php $gamestats = $game->getGameStats(); ?>
		<?php if(count($gamestats) == 0) { ?>
			<p class="small">Este juego no tiene gamestats activos. <a href="#">&iexcl;P&iacute;dele a su autor que los configure!</a>.</p>
		<?php } else { ?>
			<?php foreach($gamestats as $gamestat) : ?>
				<h4 class="header medium"><?php echo $gamestat; ?></h4>
				<ol class="normalList normal">
					<?php foreach($gamestat->getOrderedValues(10) as $value) : ?>
					<li><?php echo $value->getAvatar()->getProfileLink(); ?>: <?php echo $value->getValue(); ?></li>
					<?php endforeach; ?>
				</ol>
			<?php endforeach; ?>
		<?php } ?>
	</div>
	<div style="clear:both"></div>

<?php echo link_to('&laquo; Listado', 'game/list', array('class' => 'navigation')) ?>