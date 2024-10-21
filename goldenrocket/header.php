<?php
	$custom_logo_id = get_theme_mod('custom_logo');
	$id_front_page = get_option('page_on_front');
	$is_front_page = is_front_page();
	$get_template_directory_uri = get_template_directory_uri();
	$home_bg = null;
	$bg_img = null;
	$page_offer_showreel = null;
	if($is_front_page || is_single() || is_post_type_archive('case-study') || is_tax('kategoria-case-study'))
	{
		$home_bg = 'home-bg';
		$bg_img = $get_template_directory_uri.'/img/bg_body_2.webp';
	}
	else
	{
		$home_bg = 'home-bg';
		$bg_img = $get_template_directory_uri.'/img/bg_body_1.webp';
	}
	if(is_post_type_archive('portfolio'))
	{
		$page_offer_showreel = rwmb_meta('page_offer_showreel', '', $id_front_page);
	}
	if(is_tax('kategoria-portfolio'))
	{
		$term_id = get_queried_object_id();
		$page_offer_showreel = rwmb_meta('portfolio_taxonomy_video', ['object_type' => 'term'], $term_id);
	}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title><?php if(!function_exists('yoast_breadcrumb')) { $is_front_page ? bloginfo('blogname') : wp_title(); } else {wp_title();} ?></title>
		<?php if(!empty($bg_img)): ?>
		<link rel="preload" as="image" href="<?php echo $bg_img ?>">
		<?php
			endif;
			if($is_front_page):
			$video_front_page = rwmb_meta('video_front_page', '', $id_front_page);
			foreach($video_front_page as $video):
			if(isset($video['video_file']) && isset($video['video_img'])):
			if(mobile_detect() == 'phone'):
		?>
		<link rel="preload" as="image" href="<?php echo wp_get_attachment_image_url($video['video_img'], 'logo_size'); ?>">
		<?php else: ?>
		<link rel="preload" as="image" href="<?php echo wp_get_attachment_image_url($video['video_img'], 'medium'); ?>">
		<?php endif; endif; endforeach; endif; wp_head(); if(!empty($bg_img)): ?>
		<style>
			body.home-bg {
				background: #000000 url(<?php echo $bg_img; ?>) center top / 100% 100% no-repeat;
				background-attachment: fixed;
			}
		</style>
		<?php endif; ?>
	</head>
<body <?php body_class($home_bg); ?>>
	<div class="preloader-page">
		<div class="preloader-page-content">
			<div class="preloader-page-loader text-center"><span></span><span></span><span></span><span></span><span></span></div>
		</div>
	</div>
	<header class="header-fixed" id="header_top">
		<div class="header">
			<div class="container-medium">
				<div class="header-content">
					<div class="grid-middle-noGutter">
						<div class="logo-top">
							<?php
								if(function_exists('the_custom_logo'))
								{
									the_custom_logo();
								}
							?>
							<div class="menu-bar" id="menu_bar"><span></span><span></span><span></span></div>
						</div>
						<div class="menu-top" id="menu_top">
						<?php
							if(has_nav_menu('primary_menu'))
							{
								wp_nav_menu(array('theme_location' => 'primary_menu', 'depth' => 2));
							}
						?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<?php 
		if(!$is_front_page && empty($page_offer_showreel)):
	?>
	<div class="separator-content"></div>
	<?php
		endif;
	?>
