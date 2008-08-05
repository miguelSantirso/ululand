<?php use_helper('Javascript') ?>

<div id="pageHeader">
	<h2><?php echo link_to(__("Ululand Developers Network"), "@homepage"); ?></h2>
	<p class="subtitle"><?php echo __("Home"); ?></p>
</div>

<div id="pageContent">

	<div class="contentRow">
		<div class="fixedWidth wide alignLeft contentBox bordered light">
			<h3 class="small header"><?php echo __("NOTICE: We are working on this yet!") ?></h3>
			<p class="small"><?php echo sprintf(__('The Ululand Developers Network is not finished yet, and we have a lot of work to do yet. Please, %s to tell us about bugs, ideas or anything else.'), mail_to('tirso.00@gmail.com', __('send us an email'), 'encode=true')); ?></p>
		</div>
		<div class="contentBox bordered fixedWidth quarter alignRight">
			<h3 class="small header"><?php echo __('Quick Links:'); ?></h3>
			<ul class="small">
				<li><?php echo link_to(__('Wiki'), '@wiki_home'); ?></li>
				<li><?php echo link_to(__('Registered users list'), 'profile/list'); ?></li>
			</ul>
		</div>
	</div>	
	<div class="contentRow">
		<div class="fixedWidth half contentBox alignLeft">
			<h3 class="header"><?php echo __('What is this?'); ?></h3>
			<!-- @todo texto no internacionalizado -->
			<p>Esta es la <?php echo link_to("Red de desarrolladores de Ululand", "@homepage"); ?>, un punto de 
			encuentro para desarrolladores y una herramienta creada por y para creadores de juegos.</p>
			<p>Como es obvio, este sitio está todavía en construcción &mdash;no teníamos previsto abrirlo hasta dentro 
			de, como mínimo, un mes&mdash; pero al final hemos decidido poner disponible algunas partes para ir 
			probándolas y, sobre todo, para empezar a dar el servicio que pretendemos dar.</p>
		</div>
		
		<div class="fixedWidth half contentBox alignRight">
			<h3 class="header"><?php echo sprintf(__('Latests posts from %s'), link_to(__('our blog'), 'http://blog.pncil.com/')); ?></h3>
			<div id="latestNews"><?php echo image_tag('ajax-loader.gif'); ?> <?php echo __('Loading...'); ?></div>
			<?php echo javascript_tag(
			  remote_function(array(
			    'update'  => 'latestNews',
			    'url'     => 'http://ululand.com/developers/home/latestNews'
			  ))
			) ?>
		</div>
	</div>
	
</div>