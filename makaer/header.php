<?php
	$id_front_page = get_option('page_on_front');
	$is_front_page = is_front_page();
	$page_catalog_file = null;
	$facebook_page = rwmb_meta('facebook_page', ['object_type' => 'setting'], 'makaer_settings');
	$instagram_page = rwmb_meta('instagram_page', ['object_type' => 'setting'], 'makaer_settings');
	$tiktok_page = rwmb_meta('tiktok_page', ['object_type' => 'setting'], 'makaer_settings');
	$pinterest_page = rwmb_meta('pinterest_page', ['object_type' => 'setting'], 'makaer_settings');
	$page_catalog = get_pages(array(
		'post_type' => 'page',
		'meta_key' => '_wp_page_template',
		'hierarchical' => 0,
		'meta_value' => 'catalog-page-data.php'
	));
	if(isset($page_catalog[0]->ID))
	{
		$page_catalog_file = rwmb_meta('page_catalog_file', '', $page_catalog[0]->ID);
	}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title><?php wp_title(); ?></title>
		<?php wp_head(); ?>
	</head>
<body <?php body_class(); ?>>
	<header class="header-fixed<?php if($is_front_page): ?> header-home<?php endif; ?>"<?php if($is_front_page): ?> id="header_home"<?php endif; ?>>
		<div class="header">
			<div class="container-full">
				<div class="header-content">
					<div class="grid-middle-noGutter">
						<div class="header-content-left">
							<?php
								if(has_nav_menu('lang_menu'))
								{
									wp_nav_menu(array('theme_location' => 'lang_menu', 'depth' => 2));
								}
							?>
						</div>
						<div class="logo-top">
							<?php
								if(function_exists('the_custom_logo'))
								{
									the_custom_logo();
								}
							?>
							<div class="menu-bar"><span></span><span></span><span></span></div>
						</div>
						<div class="header-content-right">
							<?php if(!empty($page_catalog_file)): foreach($page_catalog_file as $file): ?>
							<a class="button-file" href="<?php echo esc_url($file['url']); ?>"><?php echo __('POBIERZ KATALOG PDF', 'makaer'); ?></a>
							<?php
								endforeach;
								endif;
								if(!empty($facebook_page) || !empty($instagram_page) || !empty($tiktok_page) || !empty($pinterest_page)):
							?>
							<ul class="icon-with-url">
								<?php if(!empty($instagram_page)): ?>
								<li><a href="<?php echo esc_url($instagram_page); ?>" rel="nofollow noopener"><span style="font-size:17px;" class="makaer_ico_instagram"></span></a></li>
								<?php
									endif;
									if(!empty($facebook_page)):
								?>
								<li><a href="<?php echo esc_url($facebook_page); ?>" rel="nofollow noopener"><span style="font-size:17px;" class="makaer_ico_facebook"></span></a></li>
								<?php
									endif;
									if(!empty($tiktok_page)):
								?>
								<li><a href="<?php echo esc_url($tiktok_page); ?>" rel="nofollow noopener"><span class="makaer_ico_tiktok"></span></a></li>
								<?php
									endif;
									if(!empty($pinterest_page)):
								?>
								<li><a href="<?php echo esc_url($pinterest_page); ?>" rel="nofollow noopener"><span class="makaer_ico_pinteres"></span></a></li>
								<?php
									endif;
								?>
							</ul>
							<?php
								endif;
							?>
						</div>
					</div>
					<div class="menu-top">
						<?php
							if(has_nav_menu('primary_menu'))
							{
								wp_nav_menu(array('theme_location' => 'primary_menu', 'depth' => 3));
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</header>
	<?php if(!$is_front_page): ?>
	<div class="header-separator"></div>
	<?php
		if(function_exists('yoast_breadcrumb') && !is_404())
		{
			yoast_breadcrumb('<div class="container"><p class="breadcrumbs" id="breadcrumbs">','</p></div>');
		}
	?>
	<?php endif; ?>
