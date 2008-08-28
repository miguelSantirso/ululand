<?php use_helper('Javascript'); ?>

<div id="pageContent">
	<div class="contentRow">
		
		<div class="contentColumn half alignLeft">
			<div class="contentBox">
				<h3 class="header"><?php echo link_to(__('Ululand Flash Game Developers Community'), '/community'); ?></h3>
				<?php // @todo texto no internacionalizado ?>
				<p>Bienvenido a la <?php echo link_to(__('Ululand Flash Game Developers Community')); ?>. Esperamos que esta 
				comunidad se convierta en un <strong>punto de encuentro para desarrolladores de juegos flash</strong>.</p>
				<strong><?php __('Quick Links:'); ?></strong>
				<ul class="">
					<li><?php echo link_to(__('Wiki'), '@wiki_home'); ?></li>
					<li><?php echo link_to(__('Collaboration tool'), 'collaboration'); ?></li>
					<li><?php echo link_to(__('Collaboration offers'), 'collaboration/list'); ?></li>
					<li><?php echo link_to(__('Registered People'), 'profile/list'); ?></li>
				</ul>
				<p><?php echo sprintf(
					__('Suscribe to our %s to keep up to date with the latest news about Ululand and to discuss about flash games development.'), 
					link_to('Ululand\'s Group in Google', 'http://groups.google.com/group/desarrolladores-ululand'));  ?>
				<!-- caja de suscripción a grupo de Google -->
				  <p><b><?php echo __('Subscribe to'); ?> <a href="http://groups.google.com/group/desarrolladores-ululand">our group</a></b></p>
				  <form action="http://groups.google.com/group/desarrolladores-ululand/boxsubscribe">
				  Email: <input type=text name=email <?php if($sf_user->isAuthenticated()) : ?>value="<?php echo $sf_user->getUsername(); ?>"<?php endif; ?> />
				  <input type=submit name="sub" value="<?php echo __('Subscribe'); ?>" />
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
	                <h3 class="header">
	                    <?php echo link_to(__('Collaboration Offers'), 'collaboration/list'); ?> 
	                    <?php if($sf_user->isAuthenticated()) : ?>
	                        <?php echo '(' . link_to(__('submit your own') .')', 'collaboration/create', array('class' => '')); ?>
	                    <?php else : ?>
	                        <small>(<?php echo sprintf(__('%1$s or %2$s to submit'),
	                            link_to(__('login'), '@sf_guard_signin', array('class' => '')),
	                            link_to(__('register'), '@register') ); ?>)</small>
	                    <?php endif; ?>
	                </h3>
	                <p class="small"><?php echo __('Looking for a project to work on? Here you can find some projects in which you can collaborate.') ?></p>
	                
	                <div class="alignRight">
	                <?php include_partial('collaboration/searchForm', array('title' => '')); ?>
	                </div>
	                <h4>&nbsp;<?php echo __("Latest offers"); ?></h4>
	                <?php include_component('collaboration', 'list'); ?>
	                <p class="right"><?php echo link_to(__('Show full list &raquo;'), 'collaboration/list') ?></p>
	                
	                <div style="clear:both;"></div>
	            </div>
	        </div>
	        
	        <div class="contentColumn half alignRight">
	            <div class="contentBox">
	                <h3 class="header">
	                    <?php echo __('Collaborators'); ?>
	                    <?php if(!$sf_user->isAuthenticated()) : ?>
	                        <small>(<?php echo sprintf(__('%1$s to appear here'),
	                            link_to(__('register'), '@register') ); ?>)</small>
	                    <?php endif; ?>
	                </h3>
	                <p class="small"><?php echo __('Looking for someone to help you in your latest project? Here you can find some people that might want to help you.') ?></p>
	                
	                <div class="alignRight">
	                <?php include_partial('profile/searchForm', array('title' => '', 'onlyFree' => true)); ?>
	                </div>
	                <h4>&nbsp;<?php echo __("Recent collaborators"); ?></h4>
	                <?php include_component('profile', 'list', array('onlyFree' => true)); ?>
	                <p class="right"><?php echo link_to(__('Show full list &raquo;'), 'profile/list') ?></p>
	            </div>
	        </div>
	     
	</div>
	    
</div>