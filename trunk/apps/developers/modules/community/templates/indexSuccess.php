<?php use_helper('Javascript'); ?>
<div id="pageHeader">
	<h2><?php echo link_to(__("Community"), 'community'); ?></h2>
	<p class="subtitle"><?php echo __("We create games!"); ?></p>
</div>

<div id="pageContent">
	<div class="contentRow">
		
		<div class="contentColumn half alignLeft">
			<div class="contentBox">
				<h3 class="header"><?php echo sprintf(__('This is the %s'), link_to(__('Ululand Game Developers Community'), '/community')); ?></h3>
				<?php // @todo texto no internacionalizado ?>
				<p>Bienvenido a la <?php echo link_to(__('Ululand Flash Game Developers Community')); ?>. Esperamos que esta 
				comunidad se convierta en un <strong>punto de encuentro para desarrolladores de juegos flash</strong>. Para conseguirlo, hemos
				puesto a vuestra disposici&oacute;n una serie de herramientas:</p>
				<ul class="">
					<li><?php echo link_to(__('Wiki'), '@wiki_home'); ?></li>
					<li><?php echo link_to(__('Collaboration tool'), 'collaboration'); ?></li>
					<li><?php echo link_to(__('Collaboration offers'), 'collaboration/list'); ?></li>
				</ul>
				<p>Adem&aacute;s, te recomendamos que te suscribas a nuestro <a href="http://groups.google.com/group/desarrolladores-ululand">grupo de Ululand en Google</a>.
				En &eacute;l podr&aacute;s comunicarte directamente con nosotros, participar en discusiones sobre Ululand y sobre el desarrollo de
				juegos flash y te mantendr&aacute;s al tanto de todas las novedades.</p>
				<!-- caja de suscripción a grupo de Google -->
				  <p><b><?php echo __('Subscribe to'); ?> <a href="http://groups.google.com/group/desarrolladores-ululand">our group</a></b></p>
				  <form action="http://groups.google.com/group/desarrolladores-ululand/boxsubscribe">
				  Email: <input type=text name=email <?php if($sf_user->isAuthenticated()) : ?>value="<?php echo $sf_user ?>"<?php endif; ?>>
				  <input type=submit name="sub" value="<?php echo __('Subscribe'); ?>">
				  </form>
			</div>
		</div>
		
		<div class="contentColumn half alignLeft">
			<div class="contentBox">
				<h3 class="header"><?php echo __('Latest news from the community'); ?></h3>
				<div id="latestCommunityNews"><?php echo image_tag('ajax-loader.gif'); ?> <?php echo __('Loading...'); ?></div>
				<?php echo javascript_tag(
				  remote_function(array(
				    'update'  => 'latestCommunityNews',
				    'url'     => 'community/latestCommunityNews'
				  ))
				) ?>
			</div>
		</div>
	</div>
	<div class="contentRow">
	
		<div class="contentColumn half alignLeft">		
			<div class="contentBox">
				<h3 class="header"><?php echo __('Latest collaboration Offers'); ?> <?php if($sf_user->isAuthenticated()) echo '(' . link_to(__('submit your own') .')', 'collaboration/create', array('class' => '')); ?></h3>
				<?php include_component('collaboration', 'list', array('limit' => 3)); ?>
				<p class="right"><?php echo link_to(__('Show full list &raquo;'), 'collaboration/list') ?></p>
				<div style="clear:both;"></div>
			</div>
		</div>
		
		<div class="contentColumn quarter alignLeft">
			<div class="contentBox">
				<?php include_component('collaboration', 'relatedByTags', array('title' => link_to(__('Collaboration Offers'), 'collaboration/list'), 'limit' => 5)); ?>
				<p class="right"><?php echo link_to(__('Show full list &raquo;'), 'collaboration/list') ?></p>
			</div>
		</div>
		<div class="contentColumn quarter alignLeft">
			<div class="contentBox">
				<?php include_component('profile', 'relatedByTags', array('title' => link_to(__('New Developers'), 'profile/list'), 'limit' => 5)); ?>
				<p class="right"><?php echo link_to(__('Show full list &raquo;'), 'profile/list') ?></p>
			</div>
		</div>
		
	</div>
</div>