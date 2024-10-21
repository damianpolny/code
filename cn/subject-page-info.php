<?php
	get_header();
	/* Template name: Strona informacyjna przedmiotu */
	if(have_posts()): while(have_posts()): the_post();
	$id_front_page = get_option('page_on_front');
	$id_page = get_the_ID();
	$page_subject_term = rwmb_meta('page_subject_term', '', $id_page);
	$page_subject_year_term = rwmb_meta('page_subject_year_term', '', $id_page);
	$page_subject_level_term = rwmb_meta('page_subject_level_term', '', $id_page);
	$page_subject_slogan = rwmb_meta('page_subject_slogan', '', $id_page);
	$box_subject_item = rwmb_meta('box_subject_item', '', $id_page);
	$page_subject_faq = rwmb_meta('page_subject_faq', '', $id_page);
	$section_subject_name = rwmb_meta('section_subject_name', '', $id_front_page);
	$section_subject_slider = rwmb_meta('section_subject_slider', '', $id_front_page);
	$color_subject = null;
	$level = null;
	$name_subject = null;
	$level_select = null;
	$subject_term_id = null;
	$page_subject = null;
	$page_subject_tax = array();
	if(isset($page_subject_term->term_id))
	{
		$name_subject = $page_subject_term->name;
		$subject_term_id = $page_subject_term->term_id;
		$color_subject = rwmb_meta('color_subject', ['object_type' => 'term'], $page_subject_term->term_id);
	}
	if(isset($page_subject_level_term->term_id))
	{
		$level_select = $page_subject_level_term->term_id;
	}
	
	if(is_numeric($subject_term_id))
	{
		$page_subject = get_pages(array(
			'post_type' => 'page',
			'meta_key' => 'page_subject_term',
			'hierarchical' => 0,
			'meta_value' => $subject_term_id
		));
	}
	
	if(isset($page_subject[0]))
	{
		foreach($page_subject as $item)
		{
			$ids = get_post_meta($item->ID, 'page_subject_level_term');
			if(isset($ids[0]))
			{
				$page_subject_tax[] = array(
					$ids[0] => $item->ID
				);
			}
		}
	}
	
	if(is_numeric($subject_term_id) && isset($page_subject_year_term->term_id))
	{
		$subject_ids = get_posts(
			array(
				'post_type' => 'kurs',
				'posts_per_page' => -1,
				'tax_query' => array(
				'relation' => 'AND',
					array(
						'taxonomy' => 'kurs',
						'field' => 'term_id',
						'terms' => $subject_term_id
					),
					array(
						'taxonomy' => 'rok',
						'field' => 'term_id',
						'terms' => $page_subject_year_term->term_id
					)
				),
				'fields' => 'ids'
			)
		);
		$level = wp_get_object_terms($subject_ids, 'poziom');
	}
			
	if(!empty($color_subject)):
?>
	<style>
		:root .subject-page-wraper {
			--color-subject: <?php echo $color_subject; ?>
		};
	</style>
	<?php endif; ?>
	<div class="page-wraper subject-page-wraper">
		<div class="container">
			<div class="page-title-content text-center">
				<p class="page-title"><?php the_title(); ?></p>
			</div>
			<div class="grid-center">
				<div class="col-12">
					<div class="subject-page-top">
						<div class="grid">
							<div class="col-2_lg-12"></div>
							<div class="col-5_lg-7_md-12">
								<div class="subject-page-top-blob">
									<h2 class="subject-page-top-title"><?php echo $name_subject; ?></h2>
									<?php
										if(!empty($level) && is_array($level)):
									?>
									<ul class="list-blob">
										<?php
											$active_level = null;
											$non_active_level = array();
											foreach($level as $item):
											$letter_level = rwmb_meta('letter_level', ['object_type' => 'term'], $item->term_id);
											if(!empty($letter_level))
											{
												$link_url = null;
												if(isset($page_subject_tax[0]))
												{
													foreach($page_subject_tax as $url)
													{
														if(isset($url[$item->term_id]))
														{
															$link_url = get_permalink($url[$item->term_id]);
														}
													}
												}
												if($level_select == $item->term_id)
												{
													$short_name_level = rwmb_meta('short_name_level', ['object_type' => 'term'], $item->term_id);
													if(!empty($short_name_level))
													{
														$active_level = '<li class="active" data-url="'.$link_url.'"><span class="list-blog-letter">'.$letter_level.'</span>'.$short_name_level.'</li>';
													}
												}
												else
												{
													$short_name_level = rwmb_meta('short_name_level', ['object_type' => 'term'], $item->term_id);
													if(!empty($short_name_level))
													{
														$non_active_level[] = '<li data-url="'.$link_url.'">'.$short_name_level.'</li>';
													}
												}
											}
											endforeach;
											if(isset($non_active_level[0]))
											{
												$count = 1;
												foreach($non_active_level as $a)
												{
													if($count == 2)
													{
														echo $active_level;
													}
													echo $a;
													$count++;
												}
												if(count($non_active_level) == 1)
												{
													echo $active_level;
												}
											}
											else
											{
												echo '<li></li>';
												echo $active_level;
											}
										?>
									</ul>
									<?php endif; ?>
								</div>
							</div>
							<?php if(!empty($page_subject_slogan)): ?>
							<div class="col-5_md-12">
								<div class="subject-page-top-slogan">
									<?php echo apply_filters('the_content', $page_subject_slogan); ?>
								</div>
							</div>
							<?php endif; ?>
						</div>
					</div>
					<div class="grid-center">
						<div class="col-8_lg-12">
							<div class="page-content" style="padding-bottom:25px;">
								<?php the_content(); ?>
								<div class="grid-center">
									<div class="col-7_lg-12">
										<?php
											if(!empty($level) && is_array($level)):
										?>
										<ul class="list-level-select-slide">
											<?php
												foreach($level as $item):
												$letter_level = rwmb_meta('letter_level', ['object_type' => 'term'], $item->term_id);
												if(!empty($letter_level)):
												$link_url = null;
												if(isset($page_subject_tax[0]))
												{
													foreach($page_subject_tax as $url)
													{
														if(isset($url[$item->term_id]))
														{
															$link_url = get_permalink($url[$item->term_id]);
														}
													}
												}
											?>
											<li<?php if($level_select == $item->term_id): ?> class="active"<?php endif; ?> data-letter="<?php echo $letter_level; ?>" data-url="<?php echo $link_url; ?>"><?php echo $item->name; ?></li>
											<?php
												endif;
												endforeach;
											?>
										</ul>
										<?php
											endif;
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
						if(is_numeric($level_select)):
					?>
					<div class="page-section-content">
						<div class="section-title-content text-center">
							<p class="section-title"><?php echo __('WYBIERZ KURS', 'cn'); ?></p>
						</div>
						<?php
							$subject_sliders = array (
								'post_type' => 'kurs',
								'posts_per_page' => -1,
								'post_status' => 'publish',
								'tax_query' => [
									[
										'taxonomy' => 'poziom',
										'field' => 'term_id',
										'terms' => $level_select
									],
									[
										'taxonomy' => 'kurs',
										'field' => 'term_id',
										'terms' => $subject_term_id
									],
									[
										'taxonomy' => 'rok',
										'field' => 'term_id',
										'terms' => $page_subject_year_term->term_id
									]
								],
							);
							$subject_sliders = new WP_Query($subject_sliders);
							if($subject_sliders -> have_posts()):
						?>
						<div class="section-slider-level">
							<div class="swiper-navigation-out-container slider-subject-list">
								<div class="swiper slider_subject_list">
									<div class="swiper-wrapper">
										<?php
											while($subject_sliders -> have_posts()): $subject_sliders -> the_post();
										?>
										<div class="swiper-slide">
											<?php echo get_template_part('template-part/subject', 'slider'); ?>
										</div>
										<?php endwhile; wp_reset_postdata(); ?>
									</div>
								</div>
								<div class="swiper-button-next"></div>
								<div class="swiper-button-prev"></div>
							</div>
						</div>
						<?php
							endif;
						?>
					</div>
					<?php
						endif;
						if(isset($box_subject_item[0])):
					?>
					<div class="page-section-content">
						<div class="grid-3_lg-2_sm-1-center">
							<?php foreach($box_subject_item as $item): ?>
							<div class="col">
								<div class="box-title box-title-subject">
									<div class="section-title-content text-center">
										<?php if(isset($item['page_subject_item_name'])): ?>
										<p class="section-title"><?php echo $item['page_subject_item_name']; ?></p>
										<?php
											endif;
											if(isset($item['page_subject_item_text']))
											{
												echo apply_filters('the_content', $item['page_subject_item_text']);
											}								
										?>
									</div>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
					<?php
						endif;
					?>
				</div>
			</div>
		</div>
		<?php
			if(has_post_thumbnail() || isset($page_subject_faq[0])):
		?>
		<div class="page-section-content">
			<?php
				if(has_post_thumbnail()):
			?>
				<div class="post-image-thumbnail">
					<div class="container">
						<?php the_post_thumbnail('large'); ?>
					</div>
				</div>
			<?php
				endif;
				if(isset($page_subject_faq[0])):
			?>
			<div class="container">
				<div class="grid-center">
					<div class="col-7_lg-12">
						<div class="acccordion-container">
							<?php
								foreach($page_subject_faq as $item):
								if(isset($item['page_subject_faq_name']) && isset($item['page_subject_faq_text'])):
							?>
							<div class="acccordion-item">
								<div class="acccordion-head">
									<?php echo $item['page_subject_faq_name']; ?>
									<div class="acccordion-open">
										<svg class="plus" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M24 10h-10v-10h-4v10h-10v4h10v10h4v-10h10z"/></svg>
										<svg class="minus" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 10h24v4h-24z"/></svg>
									</div>
								</div>
								<div class="acccordion-content">
									<?php echo apply_filters('the_content', $item['page_subject_faq_text']); ?>
								</div>
							</div>
							<?php
								endif;
								endforeach;
							?>
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>
		<?php
			endif;
		?>
	</div>
	<?php
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
	<div class="page-section-content">
		<div class="container-medium">
			<?php if(!empty($section_subject_name)): ?>
			<div class="section-title-content text-center">
				<p class="section-title"><?php echo $section_subject_name; ?></p>
			</div>
			<?php endif; ?>
			<div class="swiper-navigation-out-container slider_subject">
				<div class="swiper" id="slider_subject">
					<div class="swiper-wrapper">
						<?php
							$array_multiple = array();
							while($subject_slider -> have_posts()): $subject_slider -> the_post();
							$id_post = get_the_ID();
							$page_subject_term = rwmb_meta('page_subject_term', '', $id_post);
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
												<a style="margin-left:-65px;" href="<?php echo get_term_link($page_subject_term); ?>"><?php echo __('Zapisz się', 'cn'); ?>
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
	endif;
	endwhile;
	endif;
	get_footer();
?>