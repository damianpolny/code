<?php

get_header();
$id_front_page = get_option('page_on_front');
$home_top_video = rwmb_meta('home_top_video', '', $id_front_page);
$home_top_video_text = rwmb_meta('home_top_video_text', '', $id_front_page);
$home_category_products = rwmb_meta('home_category_products', '', $id_front_page);
$the_content = get_the_content('', '', $id_front_page);
$home_top_text_section = rwmb_meta('home_top_text_section', '', $id_front_page);
$home_middle_img_section = rwmb_meta('home_middle_img_section', '', $id_front_page);
$home_middle_text_section = rwmb_meta('home_middle_text_section', '', $id_front_page);
$home_post_img_section = rwmb_meta('home_post_img_section', '', $id_front_page);
$home_bottom_text = rwmb_meta('home_bottom_text', '', $id_front_page);
$home_bottom_img = rwmb_meta('home_bottom_img', '', $id_front_page);
$newsletter_content = rwmb_meta('newsletter_content', '', $id_front_page);
$instagram_code = rwmb_meta('instagram_code', '', $id_front_page);
$new_post_args = array (
	'post_type' => 'post',
	'posts_per_page' => 5,
	'post_status' => 'publish',
	'order' => 'DESC',
	'orderby' => 'date'
);
$new_post_args = new WP_Query($new_post_args);
?>
<div class="home-top-video">
	<?php
		if(is_array($home_top_video) && !empty($home_top_video)):
		foreach($home_top_video as $item):
	?>
	<video muted loop autoplay playsinline data-wf-ignore="true" data-object-fit="cover">
		<source src="<?php echo $item['src'] ?>" type="video/mp4">
		Your browser does not support the video tag.
	</video>
	<?php
		endforeach;
		endif;
		if(!empty($home_top_video_text)):
	?>
	<div class="home-top-video-content">
		<div class="container">
			<?php
				echo apply_filters('the_content', $home_top_video_text);
				if(mobile_detect() == 'phone'):
			?>
			<div class="text-center"><a href="#first"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="60" height="92" viewBox="0 0 60 92"> <defs> <filter id="move" x="0" y="26.667" width="60" height="65.333" filterUnits="userSpaceOnUse"> <feOffset dy="3" input="SourceAlpha"/> <feGaussianBlur stdDeviation="6" result="blur"/> <feFlood flood-opacity="0.078"/> <feComposite operator="in" in2="blur"/> <feComposite in="SourceGraphic"/> </filter> <filter id="move-2" x="2.667" y="0" width="54.667" height="54.667" filterUnits="userSpaceOnUse"> <feOffset dy="3" input="SourceAlpha"/> <feGaussianBlur stdDeviation="6" result="blur-2"/> <feFlood flood-opacity="0.078"/> <feComposite operator="in" in2="blur-2"/> <feComposite in="SourceGraphic"/> </filter> </defs> <g id="Group_3939" data-name="Group 3939" transform="translate(691 404.392)"> <g transform="matrix(1, 0, 0, 1, -691, -404.39)" filter="url(#move)"> <path id="move-3" data-name="move" d="M31.109,44.558a1.333,1.333,0,0,1,0,1.885L20.443,57.11a1.333,1.333,0,0,1-1.885,0L7.891,46.443a1.333,1.333,0,1,1,1.885-1.885l8.391,8.391V29.5a1.333,1.333,0,1,1,2.667,0V52.948l8.391-8.391a1.333,1.333,0,0,1,1.885,0Z" transform="translate(10.5 13.5)" fill="#fff"/> </g> <g transform="matrix(1, 0, 0, 1, -691, -404.39)" filter="url(#move-2)"> <path id="move-4" data-name="move" d="M28.833,10.833A9.333,9.333,0,1,0,19.5,20.167a9.333,9.333,0,0,0,9.333-9.333Zm-16,0A6.667,6.667,0,1,1,19.5,17.5a6.667,6.667,0,0,1-6.667-6.667Z" transform="translate(10.5 13.5)" fill="#fff"/> </g> </g> </svg></a></div>
			<?php endif; ?>
		</div>
	</div>
	<?php endif; ?>
</div>
<?php
	if(!empty($home_category_products) && is_array($home_category_products)):
	$ids = array();
	foreach($home_category_products as $id)
	{
		$ids[] = $id->term_id;
	}
	if(isset($ids[0])):
?>
	<div class="page-wraper page-wraper-big" id="first">
		<div class="section-products section-name-text position-relative" data-name="<?php echo __('Produkty', 'makaer'); ?> &#8213;" id="home_section_products">
			<div class="container">
				<?php if(mobile_detect() == 'phone'): ?>
				<p class="section-heading"><span><?php echo __('Produkty', 'makaer'); ?></span><span class="section-heading-line"></span></p>
				<?php endif; ?>
				<div class="section-title-content">
					<div class="grid-middle-noGutter">
						<div class="col-8_lg-7_md-12">
							<p class="section-title"><?php echo __('SPRAWDZ NASZE PRODUKTY', 'makaer'); ?></p>
						</div>
						<div class="col-4_lg-5_md-12 text-right">
							<a class="custom-button" href="<?php echo get_post_type_archive_link('produkt'); ?>"><?php echo __('WSZYSTKIE PRODUKTY', 'makaer'); ?></a>
						</div>
					</div>
				</div>
				<div class="grid">
					<div class="col-3_lg-4_md-5_sm-12">
						<div class="sidebar-left">
							<ul class="list-category">
								<?php wp_list_categories(array('title_li' => null, 'taxonomy'=>'kategoria-produktu', 'hide_empty' => false, 'include' => $ids, 'current_category' => $ids[0])); ?>
							</ul>
						</div>
					</div>
					<div class="col-9_lg-8_md-7_sm-12">
						<div class="grid-4_lg-3_md-2_xs-1" id="home_section_products_grid">
							<?php
								foreach($ids as $id)
								{
									$products_args = array (
										'post_type' => 'produkt',
										'posts_per_page' => 4,
										'orderby' => 'rand',
										'post_status' => 'publish',
										'tax_query' => array(
											array(
												'taxonomy' => 'kategoria-produktu',
												'field' => 'term_id',
												'terms' => $id
											)
										)
									);
									$products_args = new WP_Query($products_args);
									if($products_args -> have_posts())
									{
										while($products_args -> have_posts()): $products_args -> the_post();
										echo get_template_part('template-parts/content', 'products');
										endwhile; wp_reset_postdata();
									}
									else
									{
										echo '<div class="col-12 cat-id-'.$id.'"><p class="text-center" style="padding:15px 0;margin-bottom:0"><strong>'.__('Nie znaleziono żadnych produktów.', 'makaer').'</strong></p></div>';
									}
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	endif;
	endif;
	if(!empty($the_content)):
?>
<div class="section-name-text position-relative" data-name="<?php echo __('Marka', 'makaer'); ?> &#8213;">
	<div class="section-about position-relative" data-name="<?php echo __('of course', 'makaer'); ?>">
		<div class="container">
			<?php if(mobile_detect() == 'phone'): ?>
				<p class="section-heading"><span><?php echo __('Marka', 'makaer'); ?></span><span class="section-heading-line"></span></p>
			<?php endif; ?>
			<div class="grid-middle-center">
				<div class="col-6_lg-6_md-12">
					<div class="section-title-content">
						<p class="section-title"><?php echo __('BY MAKEAR <br/><span style="padding-left:110px">…OF COURSE</span>', 'makaer'); ?></p>
					</div>
				</div>
				<div class="col-4_lg-6_md-12">
					<?php echo apply_filters('the_content', $the_content); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	endif;
	if($new_post_args -> have_posts()):
?>
<div class="section-slider-post"<?php if(isset($home_post_img_section['ID']) && mobile_detect() != 'phone'): ?> style="background-image:url(<?php echo wp_get_attachment_image_url($home_post_img_section['ID'], 'full'); ?>);background-position:center;background-size:cover;background-repeat:no-repeat;"<?php endif; ?>>
	<div class="container">
		<div class="section-slider-post-content">
			<?php if(mobile_detect() == 'phone'): ?>
			<p class="section-heading"><span><?php echo __('Aktualności', 'makaer'); ?></span><span class="section-heading-line"></span></p>
			<?php endif; ?>
			<div class="swiper" id="slider_post">
				<div class="swiper-wrapper">
					<?php
						$count = 1;
						while($new_post_args -> have_posts()) : $new_post_args -> the_post();
					?>
					<div class="swiper-slide">
						<?php
							if(mobile_detect() == 'phone')
							{
								echo '<p style="margin-bottom:10px;">';
								the_post_thumbnail('thumbnail');
								echo '</p>';
							}
						?>
						<div class="stroke-text"><?php echo str_pad($count, 2, '0', STR_PAD_LEFT); ?></div>
						<div class="section-title-content" style="margin-bottom:15px;">
							<p class="section-subtitle"><?php the_title(); ?></p>
						</div>
						<?php the_excerpt(); ?>
						<p><a href="<?php the_permalink(); ?>" class="custom-button fill" style="padding-left:25px;padding-right:25px;margin-right:8px;"><?php echo __('CZYTAJ WIECEJ', 'makaer'); ?></a> <a href="<?php echo get_post_type_archive_link('post'); ?>" class="custom-button" style="padding-left:25px;padding-right:25px;"><?php echo __('WSZYSTKIE NEWSY', 'makaer'); ?></a></p>
					</div>
					<?php
						$count++;
						endwhile; wp_reset_postdata();
					?>
				</div>
			</div>
			<div class="custom-swiper-navigation">
				<div class="swiper-button-prev">
					<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64"> <g fill="rgba(0,0,0,0.25)" stroke="#af865b" stroke-width="2"> <rect width="64" height="64" stroke="none"/> <rect x="1" y="1" width="62" height="62" fill="none"/> </g> <g class="arrow" transform="translate(18.002 21)"> <path d="M-12323.381-7709.819h28" transform="translate(12323.381 7720.719)" fill="none" stroke="#fff" stroke-linecap="round" stroke-width="1.2"/> <path d="M-12305-7720.978l10.9,10.9-10.9,10.9" transform="translate(12322.096 7720.978)" fill="none" stroke="#fff" stroke-linecap="round" stroke-width="1.2"/> </g> </svg> 
				</div>
				<div class="swiper-button-next">
					<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 64 64"> <g fill="rgba(0,0,0,0.25)" stroke="#af865b" stroke-width="2"> <rect width="64" height="64" stroke="none"/> <rect x="1" y="1" width="62" height="62" fill="none"/> </g> <g class="arrow" transform="translate(18.002 21)"> <path d="M-12323.381-7709.819h28" transform="translate(12323.381 7720.719)" fill="none" stroke="#fff" stroke-linecap="round" stroke-width="1.2"/> <path d="M-12305-7720.978l10.9,10.9-10.9,10.9" transform="translate(12322.096 7720.978)" fill="none" stroke="#fff" stroke-linecap="round" stroke-width="1.2"/> </g> </svg> 
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	endif;
	if(!empty($home_top_text_section)):
?>
<div class="section-info section-name-text" data-name="<?php echo __('Dystrybucja', 'makaer'); ?> &#8213;">
	<div class="container">
		<?php if(mobile_detect() == 'phone'): ?>
		<p class="section-heading"><span><?php echo __('Dystrybucja', 'makaer'); ?></span><span class="section-heading-line"></span></p>
		<?php endif; ?>
		<div class="section-info-content">
			<div class="section-info-content-text">
				<?php echo apply_filters('the_content', $home_top_text_section); ?>
			</div>
		</div>
	</div>
</div>
<?php
	endif;
	if(!empty($home_middle_text_section)):
?>
<div class="section-column-bg"<?php if(isset($home_middle_img_section['ID'])): ?> style="background-image:url(<?php echo wp_get_attachment_image_url($home_middle_img_section['ID'], 'full'); ?>);background-position:center;background-size:cover;background-repeat:no-repeat;"<?php endif; ?>>
	<div class="section-column-bg-text">
		<div style="width:100%">
			<?php echo apply_filters('the_content', $home_middle_text_section); ?>
		</div>
	</div>
</div>
<?php
	endif;
	if(!empty($newsletter_content)):
?>
<div class="newsletter-widget">
	<div class="section-name-text position-relative" data-name="<?php echo __('NEWSLETTER', 'makaer'); ?> &#8213;">
		<div class="section-about position-relative" data-name="<?php echo __('Newsletter', 'makaer'); ?>">
			<div class="container">
				<?php if(mobile_detect() == 'phone'): ?>
				<p class="section-heading"><span><?php echo __('Newsletter', 'makaer'); ?></span><span class="section-heading-line"></span></p>
				<?php endif; ?>
				<div class="grid-middle-center">
					<div class="col-6_lg-6_md-12">
						<div class="section-title-content">
							<p class="section-title"><?php echo __('ZAPISZ SIĘ DO <br/><span style="padding-left:110px">NEWSLETTERA</span>', 'makaer'); ?></p>
						</div>
					</div>
					<div class="col-4_lg-6_md-12">
						<?php echo apply_filters('the_content', $newsletter_content); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	endif;
	if(!empty($home_bottom_text) || isset($home_bottom_img['ID'])):
?>
<div class="section-column-image section-name-text" data-name="<?php echo __('O nas', 'makaer'); ?> &#8213;">
	<div class="grid-2_md-1-noGutter-middle">
		<div class="col">
			<?php if(!empty($home_bottom_text)): ?>
			<div class="section-column-image-text">
				<?php if(mobile_detect() == 'phone'): ?>
				<p class="section-heading"><span><?php echo __('O nas', 'makaer'); ?></span><span class="section-heading-line"></span></p>
				<?php endif; ?>
				<div class="section-column-image-text-extra">
					<?php echo apply_filters('the_content', $home_bottom_text); ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
		<div class="col">
			<?php if(isset($home_bottom_img['ID'])): ?>
			<div class="section-column-image-img">
				<?php echo wp_get_attachment_image($home_bottom_img['ID'], 'full'); ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php
	endif;
	if(!empty($instagram_code)):
?>
<div class="instagram-widget">
	<div class="container">
		<?php echo do_shortcode($instagram_code); ?>
	</div>
</div>
<?php endif; get_footer(); ?>
