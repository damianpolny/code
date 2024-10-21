<?php
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
?>
		<div class="page-wraper">
			<div class="container">
				<div class="page-title-content fade-up">
					<h1 class="page-title"><?php the_title(); ?></h1>
				</div>
				<div class="page-content fade-up">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
<?php 
	endwhile; endif;
	get_footer();
?>