<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />

</head>
<body>

	<!-- header and menu -->
	<div id="header">
		<div id="userMenu">
			<?php if(!$sf_user->isAuthenticated()) { ?>
				<?php echo __(sprintf(__('Hello! You can %1$s or %2$s.'), link_to(__("Log in"), "@sf_guard_signin"), link_to(__("Register"), "@register"))); ?>
			<?php } else { ?>
				<?php 
				if($sf_user->getProfile()->isFilledIn()) { 
					$username = $sf_user->getProfile();
				} else {
					$username = $sf_user->getUsername();
				}
				?>
				<?php echo __(sprintf(__('Welcome back, %1$s! %2$s?'), link_to($username, "profile/edit?id=".$sf_user->getProfile()->getId()), link_to(__("Logout"), "@sf_guard_signout"))); ?>
			<?php } ?>
		</div>
		<div id="logo"><h1><?php echo link_to(__('ulu<span id="land">land</span>'), "@homepage"); ?></h1> <p><?php echo __('Developers<br/>Network'); ?></p></div>
		<ul id="mainMenu">
			<li class="<?php echo $sf_context->getModuleName() == 'home' ? 'selected' : '' ?>">
				<?php echo link_to(__("Home"), "@homepage"); ?>
			</li>
			<li class="<?php echo $sf_context->getModuleName() == 'game' ? 'selected' : '' ?>">
				<?php echo link_to(__("Games"), '/game'); ?>
			</li>
			<li class="<?php echo $sf_context->getModuleName() == 'profile' ? 'selected' : '' ?>">
				<?php echo link_to(__("People"), "/profile"); ?>
				<ul>
					<?php if($sf_user->isAuthenticated()) { ?><li><?php echo link_to(__('My Profile'), "profile/show?id=".$sf_user->getProfile()->getId()); ?></li> <?php } ?>
					<li><?php echo link_to(__("Registered people"), "/profile/list"); ?></li>
				</ul>
			</li>
			<li class="<?php echo $sf_context->getModuleName() == 'nahoWiki' ? 'selected' : '' ?>">
				<?php echo link_to(__("Community"), "@wiki_home"); ?>
				<ul>
					<li><?php echo link_to(__("Wiki"), "@wiki_home"); ?></li>
					<li><?php echo link_to(__("Google Group"), "http://groups.google.com/group/desarrolladores-ululand"); ?></li>
				</ul>
			</li>
		</ul>
	</div>
	
	
	<div style="clear:both;"></div>

	<!-- flash boxes -->
	
	<?php if ($sf_flash->has('error')): ?>
		<p class="flashBox error"><?php echo $sf_flash->get('error') ?></p>
	<?php endif ?>
	<?php if ($sf_flash->has('warning')): ?>
		<p class="flashBox warning"><?php echo $sf_flash->get('warning') ?></p>
	<?php endif ?>	
	<?php if ($sf_flash->has('success')): ?>
		<p class="flashBox success"><?php echo $sf_flash->get('success') ?></p>
	<?php endif ?>
	
	
	<!-- content -->
	
	<div id="content">
		<?php echo $sf_data->getRaw('sf_content') ?>
		
		<div style="clear:both;"></div>
	</div>

	<p class="center small"><?php echo link_to('pncil.com', 'http://pncil.com'); ?></p>
	

<!-- Google Analytics -->
<!-- 
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-1096368-6");
pageTracker._initData();
pageTracker._trackPageview();
</script>
 -->

</body>
</html>
