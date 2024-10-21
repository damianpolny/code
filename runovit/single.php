<?php
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
?>
		<div class="page-wraper">
			<div class="container">
				<div class="grid-center">
					<div class="col-8_lg-12">
						<div class="page-title-content text-left">
							<h1 class="page-title"><?php the_title(); ?></h1>
							<p style="padding-top:10px;margin-bottom:0"><span class="runovit_ico_calendar" style="font-size:17px; vertical-align:text-top;margin-right:6px;"></span> <?php echo get_the_date('d.m.Y'); ?></p>
						</div>
						<?php
							if(has_post_thumbnail())
							{
								echo '<p style="margin-bottom:35px">';
								the_post_thumbnail('large');
								echo '</p>';
							}
						?>
						<div class="page-content">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
				<div class="grid-center">
					<div class="col-10_lg-12">
						<div class="post-entry grid-spaceBetween-noGutter-middle">
							<p>
								<?php previous_post_link('%link', __('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.274 26.548"> <path d="M287.518,460.284l-11.86,11.86L287.518,484" transform="translate(-274.658 -458.869)" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path> </svg> Poprzedni wpis', 'runovit')); ?>
							</p>
							<p class="post-entry-button">
								<a href="<?php echo get_post_type_archive_link('post'); ?>" class="button button-fill"><?php echo __('Wróć do aktualności', 'runovit'); ?></a>
							</p>
							<p class="text-right">
								<?php next_post_link('%link', __('Następny wpis <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.274 26.548"> <path d="M287.518,460.284l-11.86,11.86L287.518,484" transform="translate(-274.658 -458.869)" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path> </svg>', 'runovit')); ?>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php 
	endwhile; endif;
	get_footer();
?>