<?php get_header(); ?>



	<?php 

		$withcomments=1; 

		$sidebar = is_single() || is_page();

		$commentsform = $sidebar;

	?>



	<div id="content">

	<?php if($sidebar) : ?><div class="narrowContent"><?php endif; ?>

	<?php if (have_posts()) : ?>



		<?php while (have_posts()) : the_post(); ?>



			<div class="post" id="post-<?php the_ID(); ?>">

				

				<?php if(!$sidebar) : ?>

					<div class="narrowContent">

				<?php endif;?>

				

				<h2 class="postTitle"><a class="lightEnfasis" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

				<p class="postDate alignright"><?php the_date() ?><!-- by <?php the_author() ?> --></p>

				<br style="clear: both" />

				<?php if(function_exists('wp_seriesmeta_write')) { ?>

					<div class="seriesInfo small">

						<?php echo wp_seriesmeta_write(); ?>

						<?php echo wp_postlist_display(); ?>

					</div>

				<?php } ?>

				<div class="entry">

					<?php the_content(__("Read the rest of this entry &raquo;", "miguelSantirsoTheme")); ?>

					<?php wp_link_pages(); ?>

				<?php if(function_exists('the_ratings')) { ?>

					<br/>

					<div class="small darkEnfasis"><?php the_ratings(); ?></div>

					<br/>

				<?php } ?>

				</div>

				

				<?php if(!$sidebar) : ?>

					</div> <!-- narrowContent div -->

				<?php endif;?>

				

			</div> <!-- post -->

			

			<?php if(!$sidebar) : ?>

				<div class="postRightColumn">

			<?php endif;?>



			<div class="postMetadata">

				<p><span class="lightEnfasis"><?php _e("Category", "miguelSantirsoTheme"); ?>:</span> <?php the_category(', ') ?></p>

				<p><span class="lightEnfasis"><?php _e("Tags", "miguelSantirsoTheme"); ?>:</span> <?php the_tags('', ', ', '.'); ?></p>

				<!--<p><span class="lightEnfasis">Popularidad:</span> 6%</p> -->

				<?php edit_post_link('Edit', '', ''); ?>

			</div>

			<?php comments_template(); ?>

			

			<?php if(!$sidebar) : ?>

				</div> <!-- postLeftColumn div -->

			<?php endif;?>

			

			<br style="clear:both;"/>

			<br/>

			<br/>

		<div class="navigation">

			<div class="alignleft"><?php previous_post_link('%link', '&laquo; Entrada anterior: %title'); ?></div>

			<div class="alignright"><?php next_post_link('%link', 'Entrada siguiente: %title &raquo;'); ?></div>

		</div>

		<?php endwhile; ?>

		<div class="navigation">

			<div class="alignleft"><?php next_posts_link('&laquo; Entradas anteriores') ?></div>

			<div class="alignright"><?php previous_posts_link('Entradas siguientes &raquo;') ?></div>

		</div>



	<?php else : ?>



		<br/>

		<br/>

		<h1 class="center lightEnfasis"><?php _e("Not Found", "miguelSantirsoTheme"); ?></h1>

		<p class="center"><?php _e("Sorry, but you are looking for something that isn't here.", "miguelSantirsoTheme"); ?></p>



	<?php endif; ?>

	

	<?php 

		if($sidebar)

		{

			echo "</div>";

			get_sidebar();

			echo '<br style="clear:both;"/>';

		}		

	?>

	

</div> <!-- content -->

<br style="clear:both;" />

<?php get_footer(); ?>

