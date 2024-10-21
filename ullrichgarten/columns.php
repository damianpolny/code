<?php
	/* Template name: Kolumnen */
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
	$id_page = get_the_ID();
	$subtitle_one = get_field('subtitle_one', $id_page);
	$subtitle_two = get_field('subtitle_two', $id_page);
	$columns_section = get_field('columns_section', $id_page);
?>
	<div class="page-hero-top">
		<div class="page-hero-top-content">
			<div class="container text-center">
				<div class="page-title-content">
					<?php if(!empty($subtitle_one) && !empty($subtitle_two)): ?>
					<p class="page-title fade-left"><?php echo $subtitle_one; ?></p>
					<p class="page-title fade-right"><?php echo $subtitle_two; ?></p>
					<?php elseif(!empty($subtitle_one) && empty($subtitle_two)): ?>
					<p class="page-title fade-left"><?php echo $subtitle_one; ?></p>
					<?php elseif(empty($subtitle_one) && !empty($subtitle_two)): ?>
					<p class="page-title fade-left"><?php echo $subtitle_two; ?></p>
					<?php else: ?>
					<h1 class="page-title fade-left"><?php the_title(); ?></h1>
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
			<?php
				if(isset($columns_section[0])):
			?>
			<div class="section-columns">
			<?php
				$count = 1;
				foreach($columns_section as $item):
			?>
				<div class="section-column">
					<div class="grid-2_md-1-middle">
						<div class="col">
							<div class="section-column-text">
								<?php
									if(isset($item['columns_section_name'])):
								?>
								<div class="section-title-content fade-up">
									<p class="section-title"><?php echo str_pad($count, 2, '0', STR_PAD_LEFT); ?>/</p>
									<p class="section-title"><?php echo $item['columns_section_name']; ?></p>
								</div>
								<?php
									endif;
									if(isset($item['columns_section_txt']))
									{
										echo '<div class="fade-up">'.apply_filters('the_content', $item['columns_section_txt']).'</div>';
									}
								?>
							</div>
						</div>
						<?php
							if(isset($item['columns_section_img'])):
						?>
						<div class="col">
							<div class="section-column-animate-content-img">
								<div class="section-column-img section-column-animate-img">
									<?php echo wp_get_attachment_image($item['columns_section_img'], 'medium'); ?>
								</div>
							</div>
						</div>
						<?php endif; ?>
					</div>
				</div>
			<?php
				$count++;
				endforeach;
			?>
			</div>
			<?php
				endif;
			?>
		</div>
	</div>
<?php 
	endwhile; endif;
	get_footer();
?>