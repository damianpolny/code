<?php
	/* Template name: Koszyk */
	get_header();
	if(have_posts()): while(have_posts()): the_post();
?>
		<div class="page-wraper">
			<div class="container">
				<div class="page-title-content text-center">
					<h1 class="page-title"><?php the_title(); ?></h1>
				</div>
				<?php
					if(has_post_thumbnail())
					{
						echo '<p class="text-center">';
						the_post_thumbnail('large');
						echo '</p>';
					}
				?>
			</div>
			<div class="cart-ajax-content">
				<?php cart_content(); ?>
			</div>
			<?php if(class_exists("Favorites")): ?>
				<div style="display:none;">
					<?php echo get_clear_favorites_button(); ?>
				</div>
			<?php endif; ?>
		</div>
<?php 
	endwhile; endif;
	get_footer();
?>