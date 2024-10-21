<?php
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
	$post_id_page_archive = get_option('page_for_posts', true);
	if(is_numeric($post_id_page_archive))
	{
		$title = get_the_title($post_id_page_archive);
	}
?>
		<div class="page-wraper">
			<div class="container">
				<?php if(!empty($title)): ?>
				<div class="bar-title fade-up"><span></span><strong><?php echo $title; ?></strong><span></span></div>
				<?php endif; ?>
				<div class="container-small">
					<div class="grid-center">
						<div class="col-12">
							<div class="page-title-content fade-up">
								<p class="page-title"><?php echo __('GOLDENSPACE', ' goldenrocket'); ?></p>
							</div>
							<div class="post-title-content fade-up">
								<h1 class="post-title"><?php the_title(); ?></h1>
							</div>
							<div class="post-entry">
								<div class="post-entry-img fade-up">
								<?php
									if(has_post_thumbnail())
									{
										the_post_thumbnail('large');
									}
								?>
								</div>
								<div class="post-entry-content fade-up">
									<div>
										<span class="number-day"><?php echo get_the_date('d'); ?></span>
										<span><?php echo get_the_date('F'); ?></span>
									</div>
								</div>
							</div>
							<div class="page-content fade-up">
								<?php the_content(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php 
	endwhile; endif;
	get_footer();
?>