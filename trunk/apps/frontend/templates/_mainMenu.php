		
	<div id="mainMenuDiv">
		<ul id="mainMenu">
			<li id="mainLogo">
				<?php echo link_to(image_tag('header_logo.png'), "@homepage"); ?>
			</li>
			<li class="<?php echo $sf_context->getModuleName() == 'home' ? 'selected' : '' ?>">
				<?php echo link_to(__("Home"), "@homepage"); ?>
			</li>
			<?php $selected = $sf_context->getModuleName() == 'game' ||
								$sf_context->getModuleName() == 'competition'; ?>
			<li class="<?php echo $selected ? 'selected' : '' ?>">
				<?php echo link_to(__("Games"), '/game'); ?>
				<ul>
					<li><?php echo link_to(__("All Games List"), "/game/list"); ?></li>
					<li><?php echo link_to(__("Competitions"), "/competition"); ?></li>
				</ul>
			</li>
			<?php $selected = $sf_context->getModuleName() == 'group' || 
								$sf_context->getModuleName() == 'profile' ||
								$sf_context->getModuleName() == 'community'; ?>
			<li class="<?php echo $selected ? 'selected' : '' ?>">
				<?php echo link_to(__("Community"), "/community"); ?>
				<ul>
					<li><?php echo link_to(__("Registered people"), "/profile/list"); ?></li>
					<li><?php echo link_to(__("Groups"), "/group"); ?></li>
				</ul>
			</li>
		</ul>
		<div class="clearFloat"></div>
	</div>