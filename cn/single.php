<?php
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
?>
		<div class="page-wraper">
			<div class="container">
				<div class="page-title-content text-center">
					<p class="page-title"><?php echo __('Aktualności', 'cn'); ?></p>
				</div>
				<div class="page-content">
					<?php
						if(has_post_thumbnail())
						{
							the_post_thumbnail('large');
						}
					?>
					<div class="page-content-wrap">
						<div class="page-title-content">
							<h1 class="page-title" style="color:var(--second);text-transform:initial"><?php the_title(); ?></h1>
						</div>
						<div style="max-width:836px;width:100%;margin:0 auto">
						<?php the_content(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php 
	endwhile; endif;
	get_footer();
?>