<?php
	/* Template name: O kursach */
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
	$id_front_page = get_option('page_on_front');
	$id_page = get_the_ID();
	$about_courses_video = rwmb_meta('about_courses_video', '', $id_page);
	$about_courses_video_img = rwmb_meta('about_courses_video_img', '', $id_page);
	$section_subject_name = rwmb_meta('section_subject_name', '', $id_front_page);
	$section_subject_text = rwmb_meta('section_subject_text', '', $id_front_page);
	$section_subject_slider = rwmb_meta('section_subject_slider', '', $id_front_page);
	$section_images = rwmb_meta('section_images', '', $id_front_page);
	$section_info_video = rwmb_meta('section_info_video', '', $id_front_page);
	$section_info_procent = rwmb_meta('section_info_procent', '', $id_front_page);
	$section_info_title = rwmb_meta('section_info_title', '', $id_front_page);
	$section_info_url = rwmb_meta('section_info_url', '', $id_front_page);
	$section_info_button = rwmb_meta('section_info_button', '', $id_front_page);
	$about_courses_extra_txt = rwmb_meta('about_courses_extra_txt', '', $id_page);
	if(isset(reset($about_courses_video)['src'])):
?>
	<div class="page-section-content" style="margin-bottom:50px;padding-bottom:0">
		<div class="container-medium">
			<div class="section-info">
				<video loop muted autoplay>
					<source src="<?php echo reset($about_courses_video)['src']; ?>" type="video/mp4">
						Your browser does not support the video tag.
				</video>
				<?php if(isset($about_courses_video_img['ID'])): ?>
				<div class="section-info-content">
					<?php echo wp_get_attachment_image($about_courses_video_img['ID'], 'medium'); ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php
		endif;
	?>
	<div class="container">
		<div class="page-title-content big-margin text-center">
			<h1 class="page-title"><?php the_title(); ?></h1>
		</div>
		<div style="max-width:836px;width:100%;margin:0 auto">
			<?php the_content(); ?>
		</div>
	</div>
	<?php
		if(isset(reset($section_info_video)['src'])):
	?>
	<div class="page-section-content" style="padding-bottom:50px">
		<div class="section-info-before position-relative">
			<div class="container-medium">
				<div class="section-info">
					<?php if(isset(reset($section_info_video)['src'])): ?>
						<video loop muted autoplay>
							<source src="<?php echo reset($section_info_video)['src']; ?>" type="video/mp4">
							Your browser does not support the video tag.
						</video>
					<?php
						endif;
						if(mobile_detect() != 'phone'):
					?>
					<div class="section-info-content xs-hidden">
						<div class="section-info-text">
							<div class="grid-center-middle">
								<div class="col-4_lg-6_sm-12">
								<?php
									if(!empty($section_info_procent)):
								?>
									<p class="section-info-percent"><?php echo $section_info_procent; ?><span>%</span></p>
								<?php
									endif;
									if(!empty($section_info_url)):
								?>
									<p class="text-right">
										<a class="custom-button" href="<?php echo esc_url($section_info_url); ?>">
										<?php
											if(!empty($section_info_button))
											{
												echo $section_info_button;
											}
											else
											{
												echo __('więcej', 'cn');
											}
										?>
										</a>
									</p>
								<?php
									endif;
								?>
								</div>
								<div class="col-5_lg-6_sm-12">
								<?php
									if(!empty($section_info_title)):
								?>
									<p class="section-info-title"><?php echo $section_info_title; ?></p>
								<?php
									endif;
								?>
								</div>
							</div>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<?php
		endif;
		if(!empty($about_courses_extra_txt)):
	?>
	<div class="page-wraper">
		<div class="container">
			<div style="max-width:836px;width:100%;margin:0 auto">
				<?php echo apply_filters('the_content', $about_courses_extra_txt); ?>
			</div>
		</div>
	</div>
	<?php
	endif;
	if(!empty($section_subject_slider)):
		$subject_slider = array (
			'post_type' => 'page',
			'posts_per_page' => -1,
			'orderby' => 'rand',
			'post_status' => 'publish',
			'post_parent' => $section_subject_slider,
			'meta_query' => [
				'relation' => 'AND',
				[
					'key' => 'page_subject_term',
					'compare' => 'EXIST'
				],
				[
				'relation' => 'OR',
					[
						'key' => 'page_subject_level_term',
						'value' => 28,
						'compare' => '='
					],
					[
						'key' => 'page_subject_level_term',
						'value' => 29,
						'compare' => '='
					]
				]
			]
		);
		$subject_slider = new WP_Query($subject_slider);
		if($subject_slider -> have_posts()):
	?>
	<div class="page-wraper">
		<div class="page-section-content">
			<div class="container-medium">
				<?php if(!empty($section_subject_name)): ?>
				<div class="section-title-content text-center">
					<p class="section-title"><?php echo $section_subject_name; ?></p>
					<?php
						if(!empty($section_subject_text))
						{
							echo apply_filters('the_content', $section_subject_text);
						}
					?>
				</div>
				<?php endif; ?>
				<div class="swiper-navigation-out-container slider_subject">
					<div class="swiper" id="slider_subject">
						<div class="swiper-wrapper">
							<?php
								$array_multiple = array();
								while($subject_slider -> have_posts()): $subject_slider -> the_post();
								$id_post = get_the_ID();
								$year = null;
								$page_subject_term = rwmb_meta('page_subject_term', '', $id_post);
								$page_subject_year_term = rwmb_meta('page_subject_year_term', '', $id_post);
								if(isset($page_subject_year_term->slug))
								{
									$year = '?year_check='.$page_subject_year_term->slug;
								}
								if($page_subject_term->count > 0 && !in_array($page_subject_term->name, $array_multiple)):
								$array_multiple[] = $page_subject_term->name;
								$subject_ids = get_posts(
									array(
										'post_type' => 'kurs',
										'posts_per_page' => -1,
										'tax_query' => array(
											array(
												'taxonomy' => $page_subject_term->taxonomy,
												'field' => 'slug',
												'terms' => $page_subject_term->slug
											)
										),
										'fields' => 'ids'
									)
								);
								$level = wp_get_object_terms($subject_ids, 'poziom');
								$color_subject = rwmb_meta('color_subject', ['object_type' => 'term'], $page_subject_term->term_id);
							?>
							<div class="swiper-slide">
								<?php if(!empty($color_subject)): ?>
								<style>
									:root .subject-slider-item-<?php echo $id_post; ?> {
										--color-subject-slider: <?php echo $color_subject; ?>
									};
								</style>
								<?php endif; ?>
								<div class="subject-slider-item subject-slider-item-<?php echo $id_post; ?>">
									<div class="subject-slider-item-default">
										<p class="subject-slider-item-name"><?php echo $page_subject_term->name; ?></p>
										<?php if(isset($level[0]->name)): ?>
										<div class="subject-slider-item-letter">
											<?php
												foreach($level as $item):
												$letter_level = rwmb_meta('letter_level', ['object_type' => 'term'], $item->term_id);
												if(!empty($letter_level)):
											?>
											<p><?php echo $letter_level; ?></p>
											<?php endif; endforeach; ?>
										</div>
										<div class="subject-slider-item-list">
											<div>
											<?php
												foreach($level as $item)
												{
													$short_name_level = rwmb_meta('short_name_level', ['object_type' => 'term'], $item->term_id);
													if(!empty($short_name_level))
													{
														echo '<p>'.$short_name_level.'</p>';
													}
												}
											?>
											</div>
										</div>
										<div class="subject-slider-item-list-url">
											<div>
												<p>
													<a style="margin-left:-65px;" href="<?php echo get_term_link($page_subject_term); echo $year; ?>"><?php echo __('Zapisz się', 'cn'); ?>
													<svg viewBox="0 0 19.998933 19.997457" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg"> <defs/> <g transform="matrix(0.978,-0.208,0.208,0.978,-0.11540444,2.1201315)"> <rect width="20" height="20" fill="none" x="0" y="0" /> <g transform="rotate(12.088691,10.016932,1.6725644)"> <g transform="rotate(-0.16653957,9.9992846,10.000001)"> <path d="m 94,6499 -1.435,-1.393 7.607,-7.607 H 84 v -2 h 16.172 L 92.586,6480.414 94,6479 l 10,10 -10,10" transform="translate(-84,-6479)" /> </g> </g> </g> </svg>
													</a>
												</p>
												<p>
													<a href="<?php the_permalink(); ?>"><?php echo __('Opis kursu', 'cn'); ?>
														<svg viewBox="0 0 19.998933 19.997457" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg"> <defs/> <g transform="matrix(0.978,-0.208,0.208,0.978,-0.11540444,2.1201315)"> <rect width="20" height="20" fill="none" x="0" y="0" /> <g transform="rotate(12.088691,10.016932,1.6725644)"> <g transform="rotate(-0.16653957,9.9992846,10.000001)"> <path d="m 94,6499 -1.435,-1.393 7.607,-7.607 H 84 v -2 h 16.172 L 92.586,6480.414 94,6479 l 10,10 -10,10" transform="translate(-84,-6479)" /> </g> </g> </g> </svg>
													</a>
												</p>
											</div>
										</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
							<?php endif; endwhile; wp_reset_postdata(); ?>
						</div>
					</div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>
			</div>
		</div>
	</div>
	<?php
		endif; endif;
		if(isset($section_images['ID'])):
	?>
	<div class="page-wraper">
		<div class="page-section-content">
			<div class="container">
					<?php echo wp_get_attachment_image($section_images['ID'], 'large'); ?>
			</div>
		</div>
	</div>
<?php
	endif;
	endwhile; endif;
	get_footer();
?>