<?php
	/* Template name: Katalog */
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
	$id_page = get_the_ID();
	$title = get_the_title();
	$the_content = get_the_content('', '', $id_page);
	$viever_pdf = rwmb_meta('viever_pdf', '', $id_page);
?>
	<div class="hero-top position-relative">
		<div class="container">
			<div class="hero-top-content">
				<div class="page-title-content">
					<h1 class="page-title"><?php echo $title; ?></h1>
				</div>
			</div>
		</div>
	</div>
	<?php if(!empty($the_content)): ?>
	<div class="page-wraper">
		<div class="container">
			<div class="page-content">
				<?php echo apply_filters('the_content', $the_content); ?>
			</div>
		</div>
	</div>
<?php
	endif;
	echo get_template_part('template-parts/content', 'catalog');
	if(!empty($viever_pdf))
	{
		echo do_shortcode($viever_pdf);
	}
	endwhile; endif;
	get_footer();
?>