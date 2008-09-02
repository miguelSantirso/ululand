<?php use_helper('Validation'); ?>
	<div class="contentColumn wide normalBox subtle">
		<h2 class="alignCenter">Crear grupo</h2>
		<p class="alignCenter">Crea un nuevo grupo. Despu&eacute;s invita a tus amigos y &iexcl;a jugar!</p>
	</div>
	
<div class="contentColumn medium">
	<?php echo form_tag('group/create', array('name' => 'groupForm', 'class' => 'card')) ?>
	<fieldset class="labelsAtRight">
	<legend class="xLarge">Crear grupo</legend>
		<ol class="large">
			<li>
			  <?php echo form_error('namegroup', array("class" => "small subtleEmphasis")) ?>
			  <?php echo label_for('namegroup', __('Name')) ?>
			  <?php echo input_tag('namegroup', null, array("class" => "large")) ?>
		  	</li>
		  	<li>
		  	  <?php echo form_error('description', array("class" => "small subtleEmphasis")) ?>
			  <?php echo label_for('description', __('Description')) ?>
			  <?php echo input_tag('description', null, array("class" => "large")) ?>
		  	</li>
		</ol>
	<?php echo submit_tag(__('Create group'), array('class' => 'submit wide large')) ?>
	</fieldset>
		<?php $referer = $sf_params->get('referer') ? $sf_params->get('referer') : $sf_request->getUri(); ?>
	    <?php echo input_hidden_tag('referer', $referer) ?>    
	</form>
</div>

<?php use_helper('Tooltip'); ?>
<?php echo tooltip_script('namegroup', 'Nombre que identifica al grupo dentro de Ululand.', 'creamy', 'width: 250, hook: {target: "topRight", tip: "topLeft"}, stem: "leftTop", showOn: "focus", hideOn: "blur", title: "Nombre"'); ?>
<?php echo tooltip_script('description', 'Frase que describe al grupo dentro de Ululand', 'creamy', 'width: 250, hook: {target: "topRight", tip: "topLeft"}, stem: "leftTop", showOn: "focus", hideOn: "blur", title: "Descripcion"'); ?>
