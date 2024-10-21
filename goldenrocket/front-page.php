<?php

get_header();
$id_front_page = get_option('page_on_front');
$the_content = get_the_content('', '', $id_front_page);
$offer_front_page = rwmb_meta('offer_front_page', '', $id_front_page);
$offer_box_front_page = rwmb_meta('offer_box_front_page', '', $id_front_page);
$showreel_front_page = rwmb_meta('showreel_front_page', '', $id_front_page);
$video_front_page = rwmb_meta('video_front_page', '', $id_front_page);
$counter_front_page = rwmb_meta('counter_front_page', '', $id_front_page);
$logos_front_page = rwmb_meta('logos_front_page', '', $id_front_page);
$case_study_args = array(
	'post_type' => 'case-study',
	'posts_per_page' => 6,
	'post_status' => 'publish',
);
$case_study_args = new WP_Query($case_study_args);
$post_args = array(
	'post_type' => 'post',
	'posts_per_page' => 3,
	'post_status' => 'publish',
);
$post_args = new WP_Query($post_args);
$bg_img_one_front_page = rwmb_meta('bg_img_one_front_page', '', $id_front_page);
$bg_img_two_front_page = rwmb_meta('bg_img_two_front_page', '', $id_front_page);
?>
<div class="showreel-content">
<?php
	if(is_array($showreel_front_page) && !empty($showreel_front_page))
	{
		foreach($showreel_front_page as $item)
		{
			echo '<div class="showreel-video"><video id="showreel_player_loop" muted autoplay loop preload="none" data-plyr-config=\'{"volume":0, "enabled":true,"storage":{"enabled":false},"muted":true}\'><source src="'.$item['src'].'" type="video/mp4">Your browser does not support the video tag.</video><div id="volume_up" class="volume-up-showreel"><i id="volume_up_icon" class="fa-solid fa-volume-off"></i></div></div>';
		}
	}
?>
</div>
<?php
	if(isset($video_front_page[0])):
?>
<div class="front-page-video-wall fade-up">
	<div class="grid-4_lg-3_sm-2-noGutter">
		<?php
			$count = 0;
			foreach($video_front_page as $video):
			if(isset($video['video_file'])):
		?>
		<div class="col">
			<?php if(isset($video['video_name']) && isset($video['video_url'])): ?>
			<a href="<?php echo esc_url($video['video_url']); ?>">
			<?php endif; ?>
				<div class="video-hover" data-number="<?php echo $count; ?>"<?php if(isset($video['video_img']) && mobile_detect() == 'phone'): ?> style="--bg-image: url(<?php echo wp_get_attachment_image_url($video['video_img'], 'logo_size'); ?>)"<?php endif; if(isset($video['video_img']) && mobile_detect() != 'phone'): ?> style="--bg-image: url(<?php echo wp_get_attachment_image_url($video['video_img'], 'medium'); ?>)"<?php endif; ?>>
					<?php if(mobile_detect() == 'phone'): ?>
						<?php echo wp_get_attachment_image($video['video_img'], 'medium'); ?>
					<?php else: ?>
					<video class="player-hover" controls playsinline preload="none" data-plyr-config='{"volume":0, "enabled":true,"storage":{"enabled":false},"muted":true}'>
						<source src="<?php echo wp_get_attachment_url($video['video_file'][0]); ?>" type="video/mp4" />
					</video>
					<?php endif; ?>
				</div>
			<?php if(isset($video['video_name']) && isset($video['video_url'])): ?>
			</a>
			<?php endif; ?>
		</div>
		<?php
			$count++;
			endif;
			endforeach;
		?>
	</div>
</div>
<?php
	endif;
	if(!empty($the_content)):
?>
<div class="front-page-content position-relative">
	<?php if(mobile_detect() != 'phone'): ?>
	<div class="lazy lazy-content" data-bg="<?php if(isset($bg_img_one_front_page['ID'])): echo wp_get_attachment_image_url($bg_img_one_front_page['ID'], 'full'); else: echo get_template_directory_uri(); ?>/img/earth.webp<?php endif; ?>"></div>
	<?php endif; ?>
	<div class="container-medium">
		<div class="grid-middle-center">
			<div class="col-4_lg-3_md-12">
			
			</div>
			<div class="col-5_lg-7_md-12 fade-up">
				<?php echo apply_filters('the_content', $the_content); ?>
			</div>
		</div>
	</div>
</div>
<?php
	endif;
	if(!empty($offer_front_page)):
?>
<div class="front-page-rocket-bg">
	<div class="lazy lazy-content" data-bg="<?php if(isset($bg_img_two_front_page['ID'])): echo wp_get_attachment_image_url($bg_img_two_front_page['ID'], 'full'); else: echo get_template_directory_uri(); ?>/img/space_shuttle.webp<?php endif; ?>"></div>
	<div class="front-page-offer position-relative">
		<div class="section-title-content fade-up">
			<div class="section-title-line">
				<span class="line"></span><?php echo __('OFERTA', 'goldenrocket'); ?>
			</div>
		</div>
		<div class="container-small fade-up">
			<div class="grid-2_md-1-middle">
				<div class="col">
					<?php
						echo apply_filters('the_content', $offer_front_page);
						if(isset($offer_box_front_page[0])):
					?>
					<div class="grid-3_xs-2 small-grid">
						<?php foreach($offer_box_front_page as $item): if(isset($item['box_name'])): ?>
						<div class="col">
							<div class="box-item">
								<div>
									<?php
										if(isset($item['box_icon']))
										{
											echo '<p>'.wp_get_attachment_image($item['box_icon'], 'logo_size').'</p>';
										}
									?>
									<p><?php echo $item['box_name']; ?></p>
								</div>
							</div>
						</div>
						<?php endif; endforeach; ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	endif;
	if(isset($counter_front_page[0])):
?>
<div class="front-page-counter position-relative fade-up">
	<div class="container-medium">
		<div class="grid">
			<div class="col-2_lg-12">
			</div>
			<div class="col-8_lg-12">
				<div class="grid-4_md-3_sm-2_xs-1-center" id="counter_start">
					<?php
						foreach($counter_front_page as $item):
						if(isset($item['counter_number']) && isset($item['counter_name']) && isset($item['counter_txt'])):
					?>
					<div class="col">
						<div class="counter-box">
							<span class="counter-box-number purecounter"><?php echo $item['counter_number']; ?></span>
							<span class="counter-box-name"><?php echo $item['counter_name']; ?></span>
							<div class="counter-box-txt">
								<?php echo $item['counter_txt']; ?>
							</div>
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
</div>
<?php
	endif;
	if($case_study_args -> have_posts()):
?>
<div class="front-page-case-study position-relative">
	<div class="lazy lazy-content" data-bg="<?php echo get_template_directory_uri(); ?>/img/case_study_bg.webp"></div>
	<div class="container-medium">
		<div class="section-title-content fade-up">
			<p class="section-title"><?php echo __('Case Study', 'goldenrocket'); ?></p>
		</div>
		<div class="swiper-content-case-study fade-up">
			<div class="swiper" id="swiper_case_study">
				<div class="swiper-wrapper">
					<?php
						while($case_study_args -> have_posts()): $case_study_args -> the_post();
					?>
					<div class="swiper-slide">
						<?php echo get_template_part('template-part/case-study', 'content'); ?>
					</div>
					<div class="swiper-slide">
						<?php echo get_template_part('template-part/case-study', 'content'); ?>
					</div>
					<?php
						endwhile; wp_reset_postdata();
					?>
				</div>
			</div>
			<div class="swiper-button-prev"></div>
			<div class="swiper-button-next"></div>
		</div>
		<p class="text-center"><a class="custom-button" href="<?php echo get_post_type_archive_link('case-study'); ?>"><?php echo __('ZOBACZ WSZYSTKIE', 'goldenrocket'); ?></a></p>
	</div>
</div>
<?php
	endif;
	if(isset($logos_front_page[0])):
?>
<div class="front-page-logos position-relative">
	<div class="section-title-content">
		<?php if(mobile_detect() != 'phone'): ?>
		<div class="section-title-line fade-up sm-hidden">
			<span class="line"></span><?php echo __('KOGO OBSŁUGUJEMY?', 'goldenrocket'); ?>
		</div>
		<?php endif; ?>
		<div class="container fade-up">
			<p class="section-title"><?php echo __('Nasi klienci', 'goldenrocket'); ?></p>
		</div>
	</div>
	<div class="container">
		<div class="swiper-content-logo fade-up">
			<div class="swiper" id="swiper_logos">
				<div class="swiper-wrapper">
					<?php
						foreach($logos_front_page as $item):
						if(isset($item['logo_img'])):
					?>
					<div class="swiper-slide">
						<div class="swiper-logo">
							<?php
								if(isset($item['logo_url']))
								{
									echo '<a href="'.esc_url($item['logo_url']).'">';
								}
								echo wp_get_attachment_image($item['logo_img'], 'logo_size');
								if(isset($item['logo_url']))
								{
									echo '</a>';
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
			<div class="swiper-button-prev"></div>
			<div class="swiper-button-next"></div>
		</div>
	</div>
</div>
<?php
	endif;
	if($post_args -> have_posts()):
?>
<div class="front-page-post position-relative">
	<div class="container">
		<div class="section-title-content fade-up">
			<p class="section-subtitle"><?php echo __('GOLDENSPACE', 'goldenrocket'); ?></p>
			<p class="section-title"><?php echo __('Blog', 'goldenrocket'); ?></p>
		</div>
		<div class="grid-3_md-2_sm-1 fade-up">
			<?php
				while($post_args -> have_posts()): $post_args -> the_post();
					echo get_template_part('template-part/post', 'content');
				endwhile; wp_reset_postdata();
			?>
		</div>
		<p class="text-center fade-up"><a rel="nofollow noopener" href="#contact"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="10" viewBox="0 0 27.568 15.761"><path d="M16,19.974,26.433,9.551a1.97,1.97,0,0,0-2.79-2.782L11.824,18.579a1.966,1.966,0,0,0-.057,2.717L23.634,33.187a1.97,1.97,0,1,0,2.79-2.782Z" transform="translate(-6.194 27.011) rotate(-90)" fill="#fff" opacity="0.678"/></svg></a></p>
	</div>
</div>
<?php endif; get_footer(); ?>
