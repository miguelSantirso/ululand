<?php use_helper('Object', 'Validation', 'Javascript', 'ModalBox', 'ulMisc'); ?>

<div id="pageContent">

	<div class="contentColumn half alignLeft">
		<div class="contentBox light">
			<h3 class="header"><?php echo __('Recipe Info:'); ?></h3>
			<?php echo form_tag('recipe/update') ?>
			
			<?php echo object_input_hidden_tag($code_piece, 'getId') ?>
		
			<!-- Título -->
			<p class="noSpace"><?php echo label_for('title', __('Title:')); ?></p>
			<?php echo form_error("title"); ?>
			<?php echo object_input_tag($code_piece, 'getTitle', array (
			  'size' => 60, 'maxlength' => 75
			)) ?>
			<br/>
			<br/>
			<!-- Código -->
			<?php echo link_to_function(__('add code'), 'Modalbox.show($("codeSnippetInsertion"), {title: "'. __('Code Snippet Insertion') .'", width: 880});', array('class' => 'alignRight')); ?>
			<p class="noSpace"><?php echo label_for('source', __('Source:')); ?></p>
			<?php echo form_error('source'); ?>
			<?php echo object_textarea_tag($code_piece, 'getSource', array (
			  'size' => '56x12',
			)) ?>
			<p class="noSpace"><small class=''><?php echo sprintf(__('Press the %s link to insert source code beautifully formatted.'), link_to_function(__('add code'), 'Modalbox.show($("codeSnippetInsertion"), {title: "'. __('Code Snippet Insertion') .'", width: 880});') ); ?></small></p>
			<br/>
			<!-- Tags -->
			<p class="noSpace"><?php echo label_for('tags', __('Tags:')); ?></p>
			<?php echo form_error('tags'); ?>
			<?php echo object_input_tag($code_piece, 'getTagsString', array (
			  'size' => 60,
			)) ?>
			<p class="noSpace"><small class=''><?php echo __('Comma separated.'); ?></small></p>
			<br/>
			
			<!-- insert code box -->
			<div id="codeSnippetInsertion" class="contentColumn wide alignCenter" style="display: none;">
				<h5 class="header"><strong>1. </strong><?php echo __('Select a programming language'); ?></h5>
				<?php  echo  select_programming_language_tag('programming language', null, array('id' => 'programmingLanguage', 'class' => 'large') ); ?>
				<br/>
				<h5 class="header"><strong>2. </strong><?php echo __('Paste or write the code'); ?></h5>
				<textarea id="codeToAdd" cols="80" rows="18" name="codeToAdd"></textarea>
				<p class="noSpace"><small class=''><?php echo __('Paste or write your code here. You will be able to preview it after pressing "insert".'); ?></small></p>
				<br/>
				<div class="center">
					<input class="large" type="button" value="<?php echo __('insert'); ?>" name="insert" onclick="addCodeAndClose();"/>
					<?php echo link_to_function(__('cancel'), 'Modalbox.hide();'); ?>
				</div>
				
			</div>
			<?php $with = "'title=' + encodeURIComponent($('title').value) + '&source=' + encodeURIComponent($('source').value)"; ?>
			<?php echo observe_field('title', array(
					'update'  => 'recipePreview',
					'url'     => 'recipe/preview',
					'script'    => 'true',
					'before'  => "Element.show('loadIndicator'); Element.setOpacity('recipePreview', 0.5);",
					'complete'=> "Element.hide('loadIndicator'); Element.setOpacity('recipePreview', 1);",
				    'with'    => $with)) ?>
			<?php echo observe_field('description', array(
					'frequency' => '5',
					'update'    => 'recipePreview',
					'url'       => 'recipe/preview',
					'script'    => 'true',
					'before'  => "Element.show('loadIndicator'); Element.setOpacity('recipePreview', 0.5);",
					'complete'=> "Element.hide('loadIndicator'); Element.setOpacity('recipePreview', 1);",
				    'with'    => $with)) ?>
			<?php echo observe_field('source', array(
					'frequency' => '5',
					'update'    => 'recipePreview',
					'url'       => 'recipe/preview',
					'script'    => 'true',
					'before'  => "Element.show('loadIndicator'); Element.setOpacity('recipePreview', 0.5);",
					'complete'=> "Element.hide('loadIndicator'); Element.setOpacity('recipePreview', 1);",
				    'with'    => $with)) ?>
				    
				    			
			<?php echo link_to_remote(__('update preview &raquo;'), array(
				'update'  => 'recipePreview',
				'url'     => 'recipe/preview',
				'script'    => 'true',
				'before'  => "Element.show('loadIndicator'); Element.setOpacity('recipePreview', 0.5);",
				'complete'=> "Element.hide('loadIndicator'); Element.setOpacity('recipePreview', 1);",
		    	'with'    => $with),
			array('class' => 'large alignRight')); ?>
			
			
			<?php echo submit_tag(__('submit')); ?>
			
			<?php if ($code_piece->getId()): ?>
			  &nbsp;<?php echo link_to(__('cancel'), 'recipe/show?id='.$code_piece->getId()) ?>
			<?php else: ?>
			  &nbsp;<?php echo link_to(__('cancel'), 'recipe/list') ?>
			<?php endif; ?>
			</form>
			
		</div>
	</div>


	<div class="alignRight contentColumn half">
		<div id="loadIndicator" class="alignRight"><?php echo image_tag('ajax-loader.gif'); ?></div>
		<h3 class="header"><?php echo __('Preview'); ?>:</h3>
		<div id="recipePreview" class="contentBox bordered"></div>
			    
		<?php echo javascript_tag(
			  remote_function(array(
			    'update'  => 'recipePreview',
			    'url'     => 'recipe/preview',
			  	'script'    => 'true',
			  	'complete'=> "Element.hide('loadIndicator')",
			    'with'    => $with
			  ))
			) ?>
	</div>

</div>
