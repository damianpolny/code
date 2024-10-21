<?php

get_header();

$id_front_page = get_option('page_on_front');
$slider_front_page = rwmb_meta('slider_front_page', '', $id_front_page);
$section_subject_name = rwmb_meta('section_subject_name', '', $id_front_page);
$section_subject_text = rwmb_meta('section_subject_text', '', $id_front_page);
$section_subject_slider = rwmb_meta('section_subject_slider', '', $id_front_page);
$box_one_front_page = rwmb_meta('box_one_front_page', '', $id_front_page);
$box_two_front_page = rwmb_meta('box_two_front_page', '', $id_front_page);
$section_info_video = rwmb_meta('section_info_video', '', $id_front_page);
$section_info_procent = rwmb_meta('section_info_procent', '', $id_front_page);
$section_info_title = rwmb_meta('section_info_title', '', $id_front_page);
$section_info_url = rwmb_meta('section_info_url', '', $id_front_page);
$section_info_button = rwmb_meta('section_info_button', '', $id_front_page);
$section_list_img = rwmb_meta('section_list_img', '', $id_front_page);
$section_slogan_name = rwmb_meta('section_slogan_name', '', $id_front_page);
$section_slogan_group_one_name = rwmb_meta('section_slogan_group_one_name', '', $id_front_page);
$section_slogan_group_two_name = rwmb_meta('section_slogan_group_two_name', '', $id_front_page);
$section_slogan_group_one = rwmb_meta('section_slogan_group_one', '', $id_front_page);
$section_slogan_group_two = rwmb_meta('section_slogan_group_two', '', $id_front_page);
$section_images = rwmb_meta('section_images', '', $id_front_page);
$section_comments_video = rwmb_meta('section_comments_video', '', $id_front_page);
$section_comment_title = rwmb_meta('section_comment_title', '', $id_front_page);
$section_comment_text = rwmb_meta('section_comment_text', '', $id_front_page);
$section_comment_url = rwmb_meta('section_comment_url', '', $id_front_page);
$lecturer_args = array (
	'post_type' => 'wykladowca',
	'posts_per_page' => 10,
	'orderby' => 'rand',
	'post_status' => 'publish',
);
$lecturer_args = new WP_Query($lecturer_args);
$post_args = array (
	'post_type' => 'post',
	'posts_per_page' => 5,
	'post_status' => 'publish',
);
$post_args = new WP_Query($post_args);
$the_content = get_the_content('', '', $id_front_page);
if(isset($slider_front_page[0])):
?>
<div class="slider-front-page">
	<div class="swiper" id="slider_front_page">
		<div class="swiper-wrapper">
			<?php
				foreach($slider_front_page as $item):
				if(isset($item['slider_front_page_video'][0]) || isset($item['slider_front_page_img'])):
			?>
			<div class="swiper-slide">
				<div class="slider-front-page-content">
					<?php if(isset($item['slider_front_page_video'])): ?>
					<video muted class="slider-front-page-video">
						<source src="<?php echo wp_get_attachment_url($item['slider_front_page_video'][0]); ?>" type="video/mp4">
						Your browser does not support the video tag.
					</video>
					<?php
						endif;
						if(isset($item['slider_front_page_words_image']))
						{
							if(isset($item['slider_front_page_words_image_position']))
							{
								echo '<div class="slider-front-page-img"><div class="container-medium" style="text-align:'.$item['slider_front_page_words_image_position'].'">';
							}
							else
							{
								echo '<div class="slider-front-page-img"><div class="container-medium">';
							}
							echo wp_get_attachment_image($item['slider_front_page_words_image'], 'medium');
							echo '</div></div>';
						}						
					?>
				</div>
			</div>
			<?php
				endif;
				endforeach;
			?>
		</div>
	</div>
	<?php if(mobile_detect() != 'phone'): ?>
	<div class="slider-front-page-button">
		<div class="container-medium">
			<a class="slider-front-page-url" href="<?php echo get_post_type_archive_link('kurs'); ?>"><span><?php echo __('ZAPISZ SIĘ', 'cn'); ?></span></a>
		</div>
	</div>
	<?php endif; ?>
</div>
<div class="custom-swiper-pagination">
	<div class="swiper-pagination"></div>
</div>
<?php
	endif;
?>
<div class="page-wraper">
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
			<h1 class="text-center">Kursy maturalne Warszawa</h1>
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
	<?php endif; endif; if(isset($box_one_front_page[0])): ?>
	<div class="page-section-content">
		<div class="container">
			<div class="grid-3_md-2_sm-1">
				<?php foreach($box_one_front_page as $item): ?>
				<div class="col">
					<div class="box-title">
						<div class="section-title-content text-center">
							<?php if(isset($item['box_one_front_page_name'])): ?>
							<p class="section-title"><?php echo $item['box_one_front_page_name']; ?></p>
							<?php
								endif;
								if(isset($item['box_one_front_page_text']))
								{
									echo apply_filters('the_content', $item['box_one_front_page_text']);
								}								
								if(isset($item['box_one_front_page_url'])):
							?>
							<p class="content-custom-button-next"><a class="custom-button-next" href="<?php echo esc_url($item['box_one_front_page_url']); ?>"><span><?php echo __('więcej', 'cn'); ?></span></a></p>
							<?php
								endif;
							?>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php
		endif;
		if(isset(reset($section_info_video)['src'])):
	?>
	<div class="page-section-content">
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
					?>
					<div class="section-info-content">
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
				</div>
			</div>
		</div>
	</div>
	<?php
		endif;
		if(isset($box_two_front_page[0])):
	?>
	<div class="page-section-content">
		<div class="container">
			<div class="grid-3_md-2_sm-1">
				<?php foreach($box_two_front_page as $item): ?>
				<div class="col">
					<div class="box-title">
						<?php
							if(isset($item['box_two_front_page_icon']))
							{
								echo wp_get_attachment_image($item['box_two_front_page_icon'], 'medium');
							}	
						?>
						<div class="section-title-content text-center">
							<?php
								if(isset($item['box_two_front_page_name'])):
							?>
							<p class="section-title"><?php echo $item['box_two_front_page_name']; ?></p>
							<?php
								endif;
								if(isset($item['box_two_front_page_text']))
								{
									echo apply_filters('the_content', $item['box_two_front_page_text']);
								}								
								if(isset($item['box_two_front_page_url'])):
							?>
							<p class="content-custom-button-next"><a class="custom-button-next" href="<?php echo esc_url($item['box_two_front_page_url']); ?>"><span><?php echo __('więcej', 'cn'); ?></span></a></p>
							<?php
								endif;
							?>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php
		endif;
		if(isset($section_list_img['ID']) || !empty($section_slogan_name) || !empty($section_slogan_group_one_name) || !empty($section_slogan_group_two_name) || isset($section_slogan_group_two[0]) || isset($section_slogan_group_one[0])):
	?>
	<div class="page-section-content">
		<div class="section-group-list position-relative">
			<div class="container-medium">
				<div class="grid-middle-center">
					<div class="col-6_lg-5_md-12">
						<?php
							if(isset($section_list_img['ID']))
							{
								echo '<div class="section-group-list-img">';
								echo wp_get_attachment_image($section_list_img['ID'], 'large');
								echo '</div>';
							}	
						?>
					</div>
					<div class="col-6_lg-7_md-12">
						<?php if(!empty($section_slogan_name)): ?>
						<div class="section-title-content bottom-10">
							<p class="section-title"><?php echo $section_slogan_name; ?></p>
						</div>
						<?php
							endif;
							if(!empty($section_slogan_group_one_name)):
						?>
						<p><?php echo $section_slogan_group_one_name; ?></p>
						<?php
							endif;
							if(isset($section_slogan_group_one[0])):
						?>
						<div class="grid-2_sm-1" style="padding-bottom:20px;">
							<?php foreach($section_slogan_group_one as $item): ?>
							<div class="col">
								<p class="paragraph-title"><?php echo $item; ?></p>
							</div>
							<?php endforeach; ?>
						</div>
						<?php
							endif;
							if(!empty($section_slogan_group_two_name)):
						?>
						<p><?php echo $section_slogan_group_two_name; ?></p>
						<?php
							endif;
							if(isset($section_slogan_group_two[0])):
						?>
						<div class="grid-1">
							<?php foreach($section_slogan_group_two as $item): ?>
							<div class="col">
								<p class="paragraph-title"><?php echo $item; ?></p>
							</div>
							<?php endforeach; ?>
						</div>
						<?php
							endif;
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		endif;
		if(!empty($the_content)):
	?>
	<div class="page-section-content">
		<div class="container">
			<div style="max-width:836px;width:100%;margin:0 auto">
				<?php echo apply_filters('the_content', $the_content); ?>
			</div>
		</div>
	</div>
	<?php
		endif;
		if(isset($section_images['ID'])):
	?>
	<div class="page-section-content">
		<div class="container">
			<?php echo wp_get_attachment_image($section_images['ID'], 'large'); ?>
		</div>
	</div>
	<?php
		endif;
		if(isset(reset($section_comments_video)['src'])):
	?>
	<div class="page-section-content">
		<div class="section-info-before position-relative">
			<div class="container-medium">
				<div class="section-info section-info-second">
					<?php if(isset(reset($section_comments_video)['src'])): ?>
						<video loop muted autoplay>
							<source src="<?php echo reset($section_comments_video)['src']; ?>" type="video/mp4">
							Your browser does not support the video tag.
						</video>
					<?php
						endif;
					?>
					<div class="section-info-content">
						<div class="section-info-text">
							<div class="grid-middle">
								<div class="col-5_lg-6_md-12">
								<?php
									if(!empty($section_comment_title)):
								?>
									<p class="section-info-title" style="margin-bottom:10px;"><?php echo $section_comment_title; ?></p>
								<?php
									endif;
									if(!empty($section_comment_text))
									{
										echo '<div style="font-size:22px;line-height:1.4;text-shadow:0px 3px 6px rgb(0 0 0 / 20%);">';
										echo apply_filters('the_content', $section_comment_text);
										echo '</div>';
									}
									if(!empty($section_comment_url)):
								?>
								<p class="content-custom-button-next" style="margin-bottom:0;"><a class="custom-button-next" href="<?php echo esc_url($section_comment_url); ?>"><span><?php echo __('więcej', 'cn'); ?></span></a></p>
								<?php
									endif;
								?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		endif;
		if($lecturer_args -> have_posts()):
	?>
	<div class="page-section-content">
		<div class="container">
			<div class="section-title-content text-center">
				<p class="section-title"><?php echo __('POZNAJ NASZYCH WYKŁADOWCÓW', 'cn'); ?></p>
			</div>
			<div class="swiper-navigation-out-container slider_lecturer">
				<div class="swiper" id="slider_lecturer">
					<div class="swiper-wrapper">
						<?php
							while($lecturer_args -> have_posts()): $lecturer_args -> the_post();
							$id_post = get_the_ID();
						?>
						<div class="swiper-slide">
							<a href="<?php the_permalink(); ?>" class="slider-lecturer-item">
								<?php
									if(has_post_thumbnail())
									{
										the_post_thumbnail('thumbnail');
									}
								?>
								<p class="slider-lecturer-item-name"><?php the_title(); ?></p>
								<p class="slider-lecturer-item-subject"><?php echo strip_tags(get_the_term_list($id_post, 'przedmiot-wykladowcy', '', ', ')); ?></p>
							</a>
						</div>
						<?php endwhile; wp_reset_postdata(); ?>
					</div>
				</div>
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
			</div>
		</div>
	</div>
	<?php endif; ?>
</div>
<?php
	if($post_args -> have_posts()):
?>
	<div class="page-section-content">
		<div class="container-between">
			<div class="section-title-content text-center">
				<p class="section-title"><?php echo __('AKTUALNOŚCI', 'cn'); ?></p>
			</div>
			<div class="swiper-navigation-out-container slider_post">
				<div class="swiper" id="slider_post">
					<div class="swiper-wrapper">
					<?php
						while($post_args -> have_posts()): $post_args -> the_post();
							echo '<div class="swiper-slide"><div class="grid-1">';
							echo get_template_part('template-part/post', 'content');
							echo '</div></div>';
						endwhile; wp_reset_postdata();
					?>
					</div>
				</div>
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
			</div>
		</div>
	</div>
<?php endif; get_footer(); ?>
