<?php
	get_header();
	/* Template name: Lista przedmiotów */
	if(have_posts()): while(have_posts()): the_post();
	$id_page = get_the_ID();
?>
	<div class="page-wraper">
		<div class="container">
			<div class="page-title-content text-center">
				<h1 class="page-title"><?php the_title(); ?></h1>
			</div>
			<div style="max-width:836px;width:100%;margin:0 auto">
				<div class="page-content">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
	<?php
		$subject_slider = array (
			'post_type' => 'page',
			'posts_per_page' => -1,
			'orderby' => 'rand',
			'post_status' => 'publish',
			'post_parent' => $id_page,
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
	<div class="page-section-content" style="padding-top:0">
		<div class="container-medium">
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
												<svg viewBox="0 0 19.998933 19.997457" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg"> <defs id="defs1" /> <g transform="matrix(0.978,-0.208,0.208,0.978,-0.11540444,2.1201315)"> <rect width="20" height="20" fill="none" x="0" y="0" /> <g id="Dribbble-Light-Preview" transform="rotate(12.088691,10.016932,1.6725644)"> <g transform="rotate(-0.16653957,9.9992846,10.000001)"> <path data-name="arrow_left-[#350]" d="m 94,6499 -1.435,-1.393 7.607,-7.607 H 84 v -2 h 16.172 L 92.586,6480.414 94,6479 l 10,10 -10,10" transform="translate(-84,-6479)" /> </g> </g> </g> </svg>
												</a>
											</p>
											<p>
												<a href="<?php the_permalink(); ?>"><?php echo __('Opis kursu', 'cn'); ?>
													<svg viewBox="0 0 19.998933 19.997457" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg"> <defs id="defs1" /> <g transform="matrix(0.978,-0.208,0.208,0.978,-0.11540444,2.1201315)"> <rect width="20" height="20" fill="none" x="0" y="0" /> <g id="Dribbble-Light-Preview" transform="rotate(12.088691,10.016932,1.6725644)"> <g transform="rotate(-0.16653957,9.9992846,10.000001)"> <path data-name="arrow_left-[#350]" d="m 94,6499 -1.435,-1.393 7.607,-7.607 H 84 v -2 h 16.172 L 92.586,6480.414 94,6479 l 10,10 -10,10" transform="translate(-84,-6479)" /> </g> </g> </g> </svg>
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
<?php
	endif;
	endwhile;
	endif;
	get_footer();
?>