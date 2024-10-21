<?php
	/* Template name: Wąska kolumna */
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
?>
		<div class="page-wraper">
			<div class="container">
				<div class="page-title-content text-center">
					<h1 class="page-title"><?php the_title(); ?></h1>
				</div>
				<div style="max-width:836px;width:100%;margin:0 auto">
					<div class="page-content">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</div>
<?php 
	endwhile; endif;
	get_footer();
?>