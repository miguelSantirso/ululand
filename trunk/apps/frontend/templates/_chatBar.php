	<?php if($sf_user->isAuthenticated()): ?>
	<div id="chatBar">
		<div id="chatBarUi">
			<div id="chatClient" class="">
				<?php include_component('widget', 'widget', array('widgetName' => 'ululandChat')); ?>			
			</div>
			<?php echo link_to_function(__('Toggle Chat'), "toggleChat()", array('class' => 'alignRight', 'id' => 'toggleChatButton')); ?>
		</div>
	</div>
	<?php endif; ?>