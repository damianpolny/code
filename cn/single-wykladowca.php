<?php
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
	$id_post = get_the_ID();
?>
		<div class="page-wraper">
			<div class="container">
				<div class="page-content">
					<div class="grid">
						<div class="col-5_md-12">
							<?php
								if(has_post_thumbnail())
								{
									echo '<p>';
									the_post_thumbnail('medium');
									echo '</p>';
								}
							?>
						</div>
						<div class="col-7_md-12">
							<div class="page-title-content page-title-small-content">
								<h1 class="page-title"><?php the_title(); ?></h1>
								<p style="color:#5f5f5f;text-transform:uppercase;"><strong><?php echo strip_tags(get_the_term_list($id_post, 'przedmiot-wykladowcy', '', ', ')); ?></strong></p>
							</div>
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