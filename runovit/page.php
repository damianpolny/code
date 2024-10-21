<?php
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
	$show_title = true;
	if(class_exists('WooCommerce'))
	{
		if(wc_get_page_permalink('myaccount') == get_permalink())
		{
			$show_title = false;
		}
	}
?>
		<div class="page-wraper">
			<div class="container">
				<?php if($show_title): ?>
				<div class="page-title-content">
					<h1 class="page-title"><?php the_title(); ?></h1>
				</div>
				<?php endif; ?>
				<div class="page-content">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
<?php 
	endwhile; endif;
	get_footer();
?>