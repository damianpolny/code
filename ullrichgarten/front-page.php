<?php

get_header();
$id_front_page = get_option('page_on_front');
$video_front_page = get_field('video_front_page', $id_front_page);
$first_title_front_page = get_field('first_title_front_page', $id_front_page);
$second_title_front_page = get_field('second_title_front_page', $id_front_page);
$third_title_front_page = get_field('third_title_front_page', $id_front_page);
$fourth_title_front_page = get_field('fourth_title_front_page', $id_front_page);
$fifth_title_front_page = get_field('fifth_title_front_page', $id_front_page);
$sixth_title_front_page = get_field('sixth_title_front_page', $id_front_page);
$link_first_front_page = get_field('link_first_front_page', $id_front_page);
$link_second_front_page = get_field('link_second_front_page', $id_front_page);
$img_first_front_page = get_field('img_first_front_page', $id_front_page);
$img_second_front_page = get_field('img_second_front_page', $id_front_page);
$img_third_front_page = get_field('img_third_front_page', $id_front_page);
$img_fourth_front_page = get_field('img_fourth_front_page', $id_front_page);
$img_fifth_front_page = get_field('img_fifth_front_page', $id_front_page);
$img_six_front_page = get_field('img_six_front_page', $id_front_page);
$slider_front_page = get_field('slider_front_page', $id_front_page);
?>
<div class="front-page-hero-top">
	<?php if(is_numeric($video_front_page)): ?>
	<video muted loop autoplay playsinline data-wf-ignore="true" data-object-fit="cover">
		<source src="<?php echo wp_get_attachment_url($video_front_page); ?>" type="video/mp4">
		Your browser does not support the video tag.
	</video>
	<?php endif; ?>
	<div class="front-page-hero-content">
		<div class="container">
			<div class="front-page-hero-content-text text-center" data-animate-text="start">
				<p class="front-page-hero-name char"><?php echo __('SCHLOßBORN', 'ullrichgarten'); ?></p>
				<h1 class="front-page-hero-title char"><?php echo __('ULLRICH GÄRTEN', 'ullrichgarten'); ?></h1>
				<p class="front-page-hero-name char"><?php echo __('GLASHÜTTEN', 'ullrichgarten'); ?></p>
			</div>
		</div>
	</div>
</div>
<div class="section-first-frontpage position-relative" data-scrollbg="#CAD8A9" data-scrollcolor="#283125">
	<div class="section-first-frontpage-svg-bg fade-up" style="height:65%;overflow:hidden;">
		<svg id="svg_draw_circle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2935 2932"><g transform="translate(186 -1035)"><line y2="1371" transform="translate(1271.5 1035.5)" fill="none" stroke="#fff"/><line x2="2925" transform="translate(-186 2406)" fill="none" stroke="#fff"/><line x2="1346" transform="translate(1272 1902)" fill="none" stroke="#fff"/><g transform="translate(-186 1035)" fill="none" stroke="#fff"><ellipse cx="1467.5" cy="1466" rx="1467.5" ry="1466" stroke="none"/> <ellipse cx="1467.5" cy="1466" rx="1466.5" ry="1465" fill="none"/></g></g></svg>
	</div>
	<div class="container">
		<?php
			if(!empty($first_title_front_page) && !empty($second_title_front_page)):
		?>
		<div class="section-title-content">
			<?php
				if(!empty($first_title_front_page)):
			?>
			<div class="grid">
				<div class="col-9_md-12" data-push-left="off-3">
					<p class="section-title fade-left"><?php echo nl2br($first_title_front_page); ?></p>
				</div>
			</div>
			<?php
				endif;
				if(!empty($second_title_front_page)):
			?>
			<div class="grid">
				<div class="col-7_md-12" data-push-left="off-5">
					<p class="section-title fade-right" style="font-style:italic;"><?php echo nl2br($second_title_front_page); ?></p>
				</div>
			</div>
			<?php endif; ?>
		</div>
		<?php
			endif;
			if(!empty($link_first_front_page)):
		?>
		<div class="section-title-content fade-up">
			<?php echo do_shortcode($link_first_front_page); ?>
		</div>
		<?php
			endif;
			if(isset($img_first_front_page[0]) || isset($img_second_front_page[0])):
		?>
		<div class="columns-img">
			<div class="grid-middle">
				<div class="col-8_sm-12">
					<div class="column-img-left">
						<?php
							if(isset($img_first_front_page[0])):
							foreach($img_first_front_page as $item):
						?>
						<div class="column-img-item fade-up">
							<?php echo wp_get_attachment_image($item, 'large'); ?>
						</div>
						<?php endforeach; endif; ?>
					</div>
				</div>
				<div class="col-4_sm-12">
					<div class="column-img-right">
						<?php
							if(isset($img_second_front_page[0])):
							foreach($img_second_front_page as $item):
						?>
						<div class="column-img-item fade-up">
							<?php echo wp_get_attachment_image($item, 'large'); ?>
						</div>
						<?php endforeach; endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>
	</div>
</div>
<div class="section-second-frontpage position-relative" data-scrollbg="#6A624C" data-scrollcolor="#ffffff">
	<div class="container">
		<?php
			if(!empty($fourth_title_front_page) && !empty($third_title_front_page)):
		?>
		<div class="section-title-content">
			<?php
				if(!empty($third_title_front_page)):
			?>
			<div class="grid">
				<div class="col-9_md-12" data-push-left="off-3">
					<p class="section-title fade-left"><?php echo nl2br($third_title_front_page); ?></p>
				</div>
			</div>
			<?php
				endif;
				if(!empty($fourth_title_front_page)):
			?>
			<div class="grid">
				<div class="col-7_md-12" data-push-left="off-5">
					<p class="section-title fade-right"><?php echo nl2br($fourth_title_front_page); ?></p>
				</div>
			</div>
			<?php endif; ?>
		</div>
		<?php
			endif;
			if(!empty($link_second_front_page)):
		?>
		<div class="section-title-content fade-up">
			<?php echo do_shortcode($link_second_front_page); ?>
		</div>
		<?php endif; ?>
	</div>
</div>
<?php if(is_numeric($img_third_front_page)): ?>
<div class="section-third-front-page">
	<div class="section-zoom">
		<div class="section-img-zoom">
			<?php echo wp_get_attachment_image($img_third_front_page, 'full'); ?>
		</div>
	</div>
</div>
<?php
	endif;
?>
<div class="section-fourth-front-page" data-scrollbg="#696F69" data-scrollcolor="#ffffff">
	<div class="container-small">
		<div class="grid">
			<div class="col-5_md-12">
				<?php if(is_numeric($img_fourth_front_page)): ?>
				<div class="section-fourth-img-front-page">
					<div class="section-column-animate-content-img">
						<div class="section-column-img section-column-animate-img">
							<?php echo wp_get_attachment_image($img_fourth_front_page, 'medium'); ?>
						</div>
					</div>
				</div>
				<?php endif; ?>
			</div>
			<div class="col-6_md-12">
				<div class="section-fourth-right-front-page">
					<?php
						if(!empty($fifth_title_front_page)):
					?>
					<div class="section-title-content">
						<p class="section-title"><?php echo $fifth_title_front_page; ?></p>
						<?php
							if(!empty($sixth_title_front_page)):
						?>
						<p style="padding-top:15px"><?php echo $sixth_title_front_page; ?></p>
						<?php endif; ?>
					</div>
					<?php
						endif;
					?>
					<div class="signature-svg fade-up">
						<svg id="draw_svg" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 662 498"> <path d="M13.9,288l25.6-118c4.4-20,7.9-40.9,10.5-62.7,2.7-21.8,4-41.8,4-60.3s0-8-.2-11.3l22.5-10.2v5.7c0,9-.8,23.5-2.5,43.6s-3.3,35.5-5.1,46.2c8.3-19.5,18.7-37.6,31.1-54.3,12.4-16.7,25.1-29.9,38.2-39.6,13-9.7,24.9-14.5,35.5-14.5s19.2,4.3,25.7,12.8c6.5,8.5,9.7,19.9,9.7,34.3s-3.9,36.1-11.7,54.2c-7.8,18.1-18.4,34.9-31.8,50.1-13.4,15.3-28.2,27.3-44.2,36.1-16,8.8-31.9,13.2-47.6,13.2s-7.7-.5-12.5-1.4l10.8-14.5c6.7,2.2,13.5,3.3,20.5,3.3,11.3,0,22.7-3.8,34.1-11.4,11.4-7.6,21.6-18.2,30.6-32,8.3-12.7,15.4-28.5,21.3-47.4,5.9-18.9,8.8-35.2,8.8-49s-1.9-20.4-5.8-26.8c-3.9-6.4-9.3-9.6-16.3-9.6s-21.1,5.6-34,16.9c-12.8,11.3-25.4,26.5-37.6,45.7-8.9,13.6-16.3,28.4-22.2,44.2-5.9,15.8-11.2,34.2-15.9,55l-22.1,101.7H13.9Z" fill="#fff"/><path d="M309.1,167.1l-19.2,74.9c-2,8.2-3.1,14.6-3.1,19.2s.9,7.6,2.7,10.6c1.8,3,4,4.5,6.5,4.5,4,0,10.5-4.8,19.6-14.5l2.9,2.9-2.2,2.7c-7.2,8.3-12.8,14.2-16.7,17.5-3.9,3.3-7.3,5-10.1,5-4.4,0-8.2-2.3-11.4-6.9-3.2-4.6-4.8-9.9-4.8-15.9s1.6-14.3,4.9-29.7l1.6-7.8c-5,11.7-11.8,23-20.3,33.8-14.2,18-27.8,27-40.7,27s-13.9-2.8-18.4-8.4c-4.5-5.6-6.8-13.1-6.8-22.5s3.7-26.3,10.9-40.3c7.3-14,16.4-25.6,27.2-34.7,10.8-9.1,21.4-13.6,31.6-13.6s18.8,4,24.1,11.9l2.3-7.8,19.2-8ZM285.6,193.3c-1.6-5.2-4.4-9.2-8.3-12.2-3.9-2.9-8.4-4.4-13.4-4.4s-12.3,2.8-19,8.3c-6.7,5.5-12.8,13.2-18.4,23-4.4,7.8-8,16.4-10.9,25.8-2.9,9.4-4.4,17.2-4.4,23.3s1.3,12.4,4,16.4c2.7,4,6.4,5.9,11.4,5.9s12.8-2.9,19.6-8.8c6.8-5.9,13.6-14.2,20.3-25.2,4.1-6.3,7.3-12.5,9.6-18.8,2.3-6.3,4.9-15,7.8-26.2l1.8-7.2Z" fill="#fff"/><path d="M369.1,178.7l-15.5,68.1c-1.6,7.5-2.5,12.8-2.5,16,0,4.9,1.2,8.9,3.5,11.9,2.3,3,5.4,4.5,9.2,4.5s7.1-1.1,10.1-3.2c3.1-2.1,7.7-6.5,14-13.2l2.5-2.5,3.1,3.1c-8,9.8-14.8,16.7-20.2,20.8-5.4,4-10.7,6-15.9,6s-11.8-2.1-15.7-6.4c-3.9-4.3-5.8-9.9-5.8-16.9s1-12.7,3.1-22.5l13.3-65.7h-19.6l1.4-7h19.6l11.5-55.2,19.6-7.8-14.3,63h33.1l-1.4,7h-33.1Z" fill="#fff"/><path d="M405.1,229.9c11.7-14.2,19.6-27.4,23.5-39.7-11-6.1-16.6-14.9-16.6-26.4s1.3-9.9,3.9-13.3c2.6-3.4,5.9-5.1,9.8-5.1s7.4,1.9,10,5.6c2.6,3.8,3.9,8.6,3.9,14.6s-.8,8.9-2.3,14.1c3.7,1,7,1.4,10,1.4,8.5,0,15.4-2.5,20.9-7.4h9.8l-1.4,2.9c-9.8,18-17.9,35.7-24.2,53.1-6.3,17.4-9.5,30.4-9.5,39s.8,5.8,2.5,7.9c1.6,2.1,3.6,3.2,5.9,3.2,5.6,0,14.6-5.9,27-17.8l3.3,3.7c-3.8,4.2-9.8,9.5-17.8,15.8-7.2,5.7-14,8.6-20.3,8.6s-9.5-1.8-12.6-5.3c-3.1-3.5-4.6-8.4-4.6-14.5,0-10.2,4-23.2,11.9-38.9,2.9-5.9,6.5-12.5,11-20,4.5-7.5,10.2-16.4,17-26.8l2-2.9c-4.5,4.1-8.8,7-13,8.7-4.2,1.7-8.9,2.6-14.2,2.6s-5-.3-7.8-1c-4.4,13.4-12.5,27.1-24.6,41.3l-3.7-3.3ZM433.1,177.9c.5-3.4.8-6.3.8-8.6,0-4.8-.8-8.5-2.4-11.3-1.6-2.7-3.6-4.1-6-4.1s-2.6.6-3.6,1.9c-1,1.3-1.5,2.9-1.5,4.8,0,6.4,4.2,12.1,12.7,17.2Z" fill="#fff"/><path d="M536.6,168.3l-18,67.3c-3,11-4.5,19.9-4.5,26.6s.7,7.9,2.3,10.6c1.5,2.7,3.5,4.1,5.9,4.1,4.2,0,11-5,20.3-15.1l3.3,2.9-2,2.3c-7.8,9.1-13.5,15.3-17.2,18.5s-7.1,4.8-10.2,4.8-7.8-2.1-10.7-6.4c-2.9-4.3-4.4-9.6-4.4-16.1s.8-10.6,2.5-19.4l12.9-71.6,20.1-8.4ZM542.6,88.1c3.5,0,6.4,1.1,8.6,3.3,2.2,2.2,3.3,5,3.3,8.6s-1.2,6.3-3.5,8.6c-2.3,2.3-5.1,3.5-8.4,3.5s-5.9-1.2-8.4-3.7-3.7-5.2-3.7-8.4,1.2-6.1,3.5-8.4,5.2-3.5,8.6-3.5Z" fill="#fff"/><path d="M642,257.3c-8.3,11.7-16.4,20.3-24.2,25.7-7.8,5.4-16.5,8.1-26.1,8.1s-19.1-3.7-25.7-11c-6.6-7.4-9.9-16.9-9.9-28.6s3.2-24.8,9.6-37.4,14.6-23.2,24.7-31.5c10-8.3,19.7-12.5,28.9-12.5s11.3,1.7,15.1,5.2c3.8,3.5,5.7,8.2,5.7,14s-2,10.4-6,15.2c-4,4.8-8.4,7.3-13,7.3s-3.9-.8-5.5-2.5c8.9-4,13.3-11.3,13.3-22.1s-1-6.8-3-8.9c-2-2.1-4.6-3.2-7.9-3.2-5,0-10.1,2-15.2,6.1-5.1,4.1-9.9,9.8-14.4,17.1-4.5,7.3-8,15.1-10.5,23.3-2.5,8.3-3.8,16.6-3.8,25.1s2.4,18.3,7.2,24.6c4.8,6.3,11,9.4,18.8,9.4s13.2-2.1,19.4-6.3c6.3-4.2,12.8-10.7,19.6-19.4l2.9,2.5Z" fill="#fff"/></svg>
					</div>
					<?php if(is_numeric($img_six_front_page)): ?>
					<div class="section-fourth-right-img-front-page">
						<div class="section-column-animate-content-img">
							<div class="section-column-img section-column-animate-img">
								<?php echo wp_get_attachment_image($img_six_front_page, 'medium'); ?>
							</div>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	if(isset($slider_front_page[0])):
?>
<div class="slider-front-page">
	<div class="container">
		<div class="slider-testimonials fade-up">
			<div class="swiper" id="swiper_testimonials">
				<div class="swiper-wrapper">
					<?php foreach($slider_front_page as $item): ?>
					<div class="swiper-slide">
						<div class="slider-testimonials-item">
							<?php echo apply_filters('the_content', $item['slider_item_front_page']); ?>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
				<div class="swiper-pagination swiper-pagination-count"></div>
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
			</div>
		</div>
	</div>
</div>
<?php endif; get_footer(); ?>
