		
		
		<ul id="mainMenu">
			<li id="mainLogo">
				<?php echo link_to(image_tag('header_logo.png'), "@homepage"); ?>
			</li>
			<li class="<?php echo $sf_context->getModuleName() == 'home' ? 'selected' : '' ?>">
				<?php echo link_to(__("Home"), "@homepage"); ?>
			</li>
			<?php $selected = $sf_context->getModuleName() == 'game' ||
								$sf_context->getModuleName() == 'gameRelease'; ?>
			<li class="<?php echo $selected ? 'selected' : '' ?>">
				<?php echo link_to(__("Games"), '/game'); ?>
				<ul>
					<li><?php echo link_to(__("Games List"), "game/list"); ?></li>
					<?php if($sf_user->isAuthenticated()) : ?>
					<li><hr/></li>
					<li><?php echo link_to(__("My Games"), "game/myGames"); ?></li>
					<li><?php echo link_to(__("Submit a new game"), "game/create"); ?></li>
					<?php endif; ?>
				</ul>
			</li>
			<?php $selected = $sf_context->getModuleName() == 'nahoWiki' ||
								$sf_context->getModuleName() == 'collaboration' ||
								$sf_context->getModuleName() == 'recipe' ||
								$sf_context->getModuleName() == 'community' || 
								$sf_context->getModuleName() == 'profile'; ?>
			<li class="<?php echo $selected ? 'selected' : '' ?>">
				<?php echo link_to(__("Community"), "/community"); ?>
				<ul>
					<li><?php echo link_to(__("Recipes"), "recipe"); ?></li>
					<li><?php echo link_to(__("Collaboration Offers"), "/collaboration"); ?></li>
					<li><?php echo link_to(__("Registered people"), "/profile/list"); ?></li>
					<li><hr/></li>
					<li><?php echo link_to(__("Wiki"), "@wiki_home"); ?></li>
					<li><?php echo link_to(__("Google Group"), "http://groups.google.com/group/desarrolladores-ululand"); ?></li>
				</ul>
			</li>
		</ul>