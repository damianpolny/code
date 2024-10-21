<?php
	get_header();
	if(have_posts()): while(have_posts()): the_post();
	$id_post = get_the_ID();
	$offer_shortcode_pdf = rwmb_meta('offer_shortcode_pdf', '', $id_post);
	if(!empty($offer_shortcode_pdf)):
?>
	<div class="showreel-content">
		<?php echo do_shortcode($offer_shortcode_pdf); ?>
	</div>
	<?php endif; ?>
	<div class="page-wraper position-relative" id="start">
		<div class="container fade-up">
			<div class="section-title-content">
				<h1 class="section-title"><?php the_title(); ?></h1>
			</div>
			<?php the_content(); ?>
		</div>
	</div>
<?php 
	endwhile; endif;
	get_footer();
?>