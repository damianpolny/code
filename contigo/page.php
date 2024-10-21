<?php
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
?>
		<div class="page-wraper">
			<div class="container">
				<div class="page-content">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
<?php 
	endwhile; endif;
	get_footer();
?>