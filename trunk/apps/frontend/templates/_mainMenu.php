		
		
		<ul id="mainMenu">
			<li class="<?php echo $sf_context->getModuleName() == 'home' ? 'selected' : '' ?>">
				<?php echo link_to(__("Home"), "@homepage"); ?>
			</li>
			<li class="<?php echo $sf_context->getModuleName() == 'game' ? 'selected' : '' ?>">
				<?php echo link_to(__("Games"), '/game'); ?>
			</li>
			<?php $selected = $sf_context->getModuleName() == 'group' || 
								$sf_context->getModuleName() == 'profile'; ?>
			<li class="<?php echo $selected ? 'selected' : '' ?>">
				<?php echo link_to(__("Community"), "/community"); ?>
				<ul>
					<li><?php echo link_to(__("Registered people"), "/profile/list"); ?></li>
					<li><?php echo link_to(__("Groups"), "/group"); ?></li>
				</ul>
			</li>
		</ul>