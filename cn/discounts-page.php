<?php
	/* Template name: Ceny / zniżki */
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
	$id_front_page = get_option('page_on_front');
	$id_page = get_the_ID();
	$the_content = get_the_content();
	$extra_the_content = rwmb_meta('extra_the_content', '', $id_page);
	$section_discount_name = rwmb_meta('section_discount_name', '', $id_page);
	$section_discount_percent = rwmb_meta('section_discount_percent', '', $id_page);
	$section_discount_txt = rwmb_meta('section_discount_txt', '', $id_page);
	$section_slider_name = rwmb_meta('section_slider_name', '', $id_page);
	$section_slider_txt = rwmb_meta('section_slider_txt', '', $id_page);
	$discounts_date = rwmb_meta('discounts_date', ['object_type' => 'setting'], 'cn_settings');
	$discounts_date_title = rwmb_meta('discounts_date_title', ['object_type' => 'setting'], 'cn_settings');
	$discounts_number = rwmb_meta('discounts_number', ['object_type' => 'setting'], 'cn_settings');
	$discounts_all_number = rwmb_meta('discounts_all_number', ['object_type' => 'setting'], 'cn_settings');
	$discounts_two_number = rwmb_meta('discounts_two_number', ['object_type' => 'setting'], 'cn_settings');
	$discounts_many_number = rwmb_meta('discounts_many_number', ['object_type' => 'setting'], 'cn_settings');
	$discounts_group_number = rwmb_meta('discounts_group_number', ['object_type' => 'setting'], 'cn_settings');
	$discounts_group_count_number = rwmb_meta('discounts_group_count_number', ['object_type' => 'setting'], 'cn_settings');
	$discounts_sibling_number = rwmb_meta('discounts_sibling_number', ['object_type' => 'setting'], 'cn_settings');
	$discounts_year_number = rwmb_meta('discounts_year_number', ['object_type' => 'setting'], 'cn_settings');
	$section_subject_name = rwmb_meta('section_subject_name', '', $id_front_page);
	$section_subject_text = rwmb_meta('section_subject_text', '', $id_front_page);
	$section_subject_slider = rwmb_meta('section_subject_slider', '', $id_front_page);
	$section_images = rwmb_meta('section_images', '', $id_front_page);
	if(has_post_thumbnail($id_page)):
?>
<div class="page-wraper">
	<div class="container-menu">
		<div class="discount-header">
			<div class="discount-header-content">
				<div>
					<?php
						if(!empty($section_discount_name) && !empty($section_discount_percent)):
					?>
					<p class="discount-header-name"><?php echo $section_discount_name; ?></p>
					<p class="discount-header-percent"><?php echo $section_discount_percent; ?></p>
					<?php
						endif;
						if(!empty($section_discount_txt))
						{
							echo apply_filters('the_content', $section_discount_txt);
						}
					?>
				</div>
			</div>
			<?php the_post_thumbnail('full'); ?>
			<?php if(mobile_detect() != 'phone'): ?>
			<div class="slider-front-page-button">
				<div class="container-medium">
					<a class="slider-front-page-url" href="<?php echo get_post_type_archive_link('kurs'); ?>"><span><?php echo __('ZAPISZ SIĘ', 'cn'); ?></span></a>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php
	endif;
	if((!empty($discounts_date) && is_numeric($discounts_number)) || is_numeric($discounts_all_number) || is_numeric($discounts_two_number) || is_numeric($discounts_many_number) || is_numeric($discounts_year_number) || (is_numeric($discounts_group_number) && is_numeric($discounts_group_count_number)) || is_numeric($discounts_sibling_number)):
?>
<div class="page-wraper" style="padding-bottom:0;">
	<div class="page-section-content">
		<div class="container-medium">
			<?php if(!empty($section_slider_name)): ?>
			<div class="section-title-content text-center">
				<p class="section-title"><?php echo $section_slider_name; ?></p>
				<?php
					if(!empty($section_slider_txt))
					{
						echo apply_filters('the_content', $section_slider_txt);
					}
				?>
			</div>
			<?php endif; ?>
			<div class="swiper-navigation-out-container slider_discounts">
				<div class="swiper" id="slider_discounts">
					<div class="swiper-wrapper">
						<?php if(!empty($discounts_date) && is_numeric($discounts_number)): ?>
						<div class="swiper-slide">
							<div class="slider-discounts-item">
								<div>
									<p class="slider-discounts-percent">-<?php echo $discounts_number; ?><span>%</span></p>
									<p class="slider-discounts-name"><?php echo $discounts_date_title; ?> <?php echo sprintf(__('OFERTA WAŻNA TYLKO DO %s LUB WYCZERPANIA MIEJSC W GRUPACH', 'cn'),wp_date("d F Y", strtotime($discounts_date))); ?></p>
								</div>
							</div>
						</div>
						<?php
							endif;
							if(is_numeric($discounts_all_number)):
						?>
						<div class="swiper-slide">
							<div class="slider-discounts-item">
								<div>
									<p class="slider-discounts-percent">-<?php echo $discounts_all_number; ?><span>%</span></p>
									<p class="slider-discounts-name"><?php echo __('ZA PŁATNOŚĆ JEDNORAZOWĄ W CAŁOŚCI', 'cn'); ?></p>
								</div>
							</div>
						</div>
						<?php
							endif;
							if(is_numeric($discounts_two_number)):
						?>
						<div class="swiper-slide">
							<div class="slider-discounts-item">
								<div>
									<p class="slider-discounts-percent">-<?php echo $discounts_two_number; ?><span>%</span></p>
									<p class="slider-discounts-name"><?php echo __('DRUGI PRZEDMIOT KURSU', 'cn'); ?></p>
								</div>
							</div>
						</div>
						<?php
							endif;
							if(is_numeric($discounts_many_number)):
						?>
						<div class="swiper-slide">
							<div class="slider-discounts-item">
								<div>
									<p class="slider-discounts-percent">-<?php echo $discounts_many_number; ?><span>%</span></p>
									<p class="slider-discounts-name"><?php echo __('TRZECI I KAŻDY NASTĘPNY PRZEDMIOT KURSU', 'cn'); ?></p>
								</div>
							</div>
						</div>
						<?php
							endif;
							if(is_numeric($discounts_year_number)):
						?>
						<div class="swiper-slide">
							<div class="slider-discounts-item">
								<div>
									<p class="slider-discounts-percent">-<?php echo $discounts_year_number; ?><span>%</span></p>
									<p class="slider-discounts-name"><?php echo __('KONTYNUACJA NAUKI W CN <br/>(TYLE PRZEDMIOTÓW ILE BYŁO W ROKU UBIEGŁYM)', 'cn'); ?></p>
								</div>
							</div>
						</div>
						<?php
							endif;
							if(is_numeric($discounts_group_number) && is_numeric($discounts_group_count_number)):
						?>
						<div class="swiper-slide">
							<div class="slider-discounts-item">
								<div>
									<p class="slider-discounts-percent">-<?php echo $discounts_group_number; ?><span>%</span></p>
									<p class="slider-discounts-name"><?php echo sprintf(__('ZNIŻKA DLA ZNAJOMYCH <br/>(POWYŻEJ %s OSÓB)', 'cn'), $discounts_group_count_number); ?></p>
								</div>
							</div>
						</div>
						<?php
							endif;
							if(is_numeric($discounts_sibling_number)):
						?>
						<div class="swiper-slide">
							<div class="slider-discounts-item">
								<div>
									<p class="slider-discounts-percent">-<?php echo $discounts_sibling_number; ?><span>%</span></p>
									<p class="slider-discounts-name"><?php echo __('RODZEŃSTWO BIORĄCE UDZIAŁ W KURSIE (rok bieżący lub poprzednie lata)', 'cn'); ?></p>
								</div>
							</div>
						</div>
						<?php
							endif;
						?>
					</div>
				</div>
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
			</div>
		</div>
	</div>
</div>
<?php
endif;
if(!empty($the_content) || !empty($extra_the_content)):
?>
<div class="page-wraper" style="padding-top:0;padding-bottom:0;">
	<div class="page-section-content">
		<div class="container-medium">
			<?php
				if(!empty($extra_the_content))
				{
					echo apply_filters('the_content', $extra_the_content);
				}
				if(!empty($the_content)):
			?>
			<div style="max-width:836px;width:100%;margin:0 auto">
				<?php echo apply_filters('the_content', $the_content); ?>
			</div>
			<?php endif; ?>
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