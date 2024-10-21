<?php
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
	$id_page = get_the_ID();
	$subtitle_one = get_field('subtitle_one', $id_page);
	$subtitle_two = get_field('subtitle_two', $id_page);
?>
	<div class="page-hero-top">
		<div class="page-hero-top-content">
			<div class="container text-center">
				<div class="page-title-content">
					<?php if(!empty($subtitle_one) && !empty($subtitle_two)): ?>
					<p class="page-title"><?php echo $subtitle_one; ?></p>
					<p class="page-title"><?php echo $subtitle_two; ?></p>
					<?php elseif(!empty($subtitle_one) && empty($subtitle_two)): ?>
					<p class="page-title"><?php echo $subtitle_one; ?></p>
					<?php elseif(empty($subtitle_one) && !empty($subtitle_two)): ?>
					<p class="page-title"><?php echo $subtitle_two; ?></p>
					<?php else: ?>
					<h1 class="page-title"><?php the_title(); ?></h1>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
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