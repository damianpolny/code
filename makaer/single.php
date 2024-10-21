<?php
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
?>
		<div class="page-wraper">
			<div class="page-title-content">
				<div class="container">
					<h1 class="page-title"><?php the_title(); ?></h1>
				</div>
			</div>
			<div class="container">
				<div class="page-content">
					<?php the_content(); ?>
				</div>
				<div class="post-entry grid-spaceBetween-noGutter-middle">
					<p>
						<?php previous_post_link('%link', __('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.9 17.227"> <g transform="translate(-1033.65 -3643.939)"> <g transform="translate(264.801 902.201)"> <path d="M0,0H19.4" transform="translate(789 2750.353) rotate(180)" fill="none" stroke-linecap="round" stroke-width="1.5"/> <path d="M0,0,7.553,7.553,0,15.106" transform="translate(777.154 2757.905) rotate(180)" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/> </g> </g> </svg> Poprzedni wpis', 'makaer')); ?>
					</p>
					<p class="post-entry-button text-center">
						<a href="<?php echo get_post_type_archive_link('post'); ?>" class="custom-button"><?php echo __('WSZYSTKIE NEWSY', 'makaer'); ?></a>
					</p>
					<p class="text-right">
						<?php next_post_link('%link', __('Następny wpis <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.9 17.227"> <g transform="translate(-1033.65 -3643.939)"> <g transform="translate(264.801 902.201)"> <path d="M0,0H19.4" transform="translate(789 2750.353) rotate(180)" fill="none" stroke-linecap="round" stroke-width="1.5"/> <path d="M0,0,7.553,7.553,0,15.106" transform="translate(777.154 2757.905) rotate(180)" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/> </g> </g> </svg>', 'makaer')); ?>
					</p>
				</div>
			</div>
		</div>
<?php 
	endwhile; endif;
	get_footer();
?>