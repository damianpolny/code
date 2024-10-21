<?php
	get_header();
	if(have_posts()): while(have_posts()): the_post();
	$id_post = get_the_ID();
	$gallery_case_study = rwmb_meta('gallery_case_study', '', $id_post);
	$count_case_study = rwmb_meta('count_case_study', '', $id_post);
?>
	<div class="page-wraper page-wraper-case-study position-relative">
		<div class="bg-stroke-text position-absolute fade-up">
			<?php echo __('case study', 'goldenrocket'); ?>
		</div>
		<div class="section-title-content fade-up">
			<div class="section-title-line">
				<span class="line"></span>
			</div>
			<div class="container-small">
				<h1 class="section-title"><?php the_title(); ?></h1>
			</div>
		</div>
		<div class="container">
			<div class="grid-2_lg-1">
				<div class="col">
					<div class="padding-right-column">
						<?php
							echo '<div class="fade-up">';
							the_content();
							echo '</div>';
							if(isset($count_case_study[0])):
						?>
						<ul class="list-counter">
							<?php
								foreach($count_case_study as $item):
								if(isset($item['count_number']) && isset($item['count_txt'])):
							?>
							<li class="fade-up">
								<span class="list-counter-number purecounter"><?php echo $item['count_number']; ?></span>
								<?php echo apply_filters('the_content', $item['count_txt']); ?>
							</li>
							<?php
								endif;
								endforeach;
							?>
						</ul>
						<?php endif; ?>
					</div>
				</div>
				<div class="col">
					<div class="gallery-column">
						<?php
							if(has_post_thumbnail())
							{
								echo '<p class="fade-up"><a data-fslightbox="gallery_case_study" href="'.get_the_post_thumbnail_url('', 'full').'">';
								the_post_thumbnail('medium');
								echo '</a></p>';
							}
							if(is_array($gallery_case_study) && !empty($gallery_case_study)):
						?>
						<div class="grid-2_xs-1 small-grid">
							<?php foreach($gallery_case_study as $item): ?>
							<div class="col fade-up">
								<p><a data-fslightbox="gallery_case_study" href="<?php echo wp_get_attachment_image_url($item['ID'], 'full'); ?>"><?php echo wp_get_attachment_image($item['ID'], 'medium_size'); ?></a></p>
							</div>
							<?php endforeach; ?>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php 
	endwhile; endif;
	get_footer();
?>