<div id="footer">
	<div class="clearFloat"></div>
	<ul id="footerMenu">
		<li>
			<?php echo link_to(__("Games"), 'games'); ?>
			<ul>
				<li><?php echo link_to(__("All games"), 'games/list'); ?></li>
				<li><?php echo link_to(__("Competitions"), 'competitions'); ?></li>
			</ul>
		</li>
		<li>
			<?php echo link_to(__("Community"), 'community'); ?>
			<ul>
				<li><?php echo link_to(__("All people"), 'people/list'); ?></li>
				<li><?php echo link_to(__("Groups"), 'groups'); ?></li>
			</ul>
		</li>
		<li>
			<?php echo link_to(__("Options"), 'options'); ?>
			<ul>
				<li><?php echo link_to(__("Customize avatar"), '@options_edit_avatar'); ?></li>
				<li><?php echo link_to(__("Modify profile"), '@options_edit_profile'); ?></li>
				<li><?php echo link_to(__("Change password"), '@options_change_password'); ?></li>
				<li><?php echo link_to(__("Change language"), '@options_edit_settings'); ?></li>
			</ul>
		</li>
	</ul>
	<?php echo link_to(image_tag('pncilLogo.png', array('id' => 'pncilLogo')), 'http://pncil.com', array('target' => '_blank')); ?>
	<div class="clearFloat"></div>
	<p id="copyrightText">&copy;2008 pncil&rsaquo;</p>
</div>


<!-- Google Analytics -->
  
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-1096368-6");
pageTracker._initData();
pageTracker._trackPageview();
</script>
