<?php
$developers_logo = rwmb_meta('developers_logo', ['object_type' => 'setting'], 'contigo_settings');
$is_front_page = is_front_page();
$is_page = is_page();
$get_template_directory_uri = get_template_directory_uri();
$hero_top = null;
if(!$is_front_page)
{
	$hero_top = $get_template_directory_uri.'/img/hero_bg.webp';
	if($is_page)
	{
		if(has_post_thumbnail())
		{
			$hero_top = get_the_post_thumbnail_url();
		}
	}
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title><?php wp_title(); ?></title>
		<?php if(!empty($hero_top)): ?>
		<link rel="preload" as="image" href="<?php echo $hero_top; ?>">
		<?php endif; ?>
		<?php wp_head(); ?>
	</head>
<body <?php body_class(); ?>>
	<div id="top"></div>
	<header class="header-fixed">
		<div class="header" id="top">
			<div class="container-fluid">
				<div class="header-content">
					<div class="grid-middle-noGutter">
						<div class="logo-top">
							<a href="">
							<?php
								if(isset($developers_logo['ID']))
								{
									echo wp_get_attachment_image($developers_logo['ID'], 'medium');
								}
							?>
							</a>
						</div>
						<div class="logo-brand">
							<?php
								if (function_exists('the_custom_logo')) {
									the_custom_logo();
								}
							?>
							<div class="menu-bar"><span></span><span></span><span></span></div>
						</div>
						<div class="menu-top">
						<?php
							if(has_nav_menu('primary_menu'))
							{
								wp_nav_menu(array('theme_location' => 'primary_menu', 'depth' => 0));
							}
						?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="header-separator"></div>
	<?php if(!$is_front_page): ?>
	<div class="hero-top position-relative" style="background-image:url(<?php echo $hero_top; ?>);background-position: center;background-size:cover;background-repeat:no-repeat;">
		<div class="container">
			<div class="page-title-content">
				<?php if($is_page): ?>
				<h1 class="page-title"><?php the_title(); ?></h1>
				<?php elseif(is_singular('mieszkanie') || is_post_type_archive('mieszkanie')): ?>
				<p class="page-title"><?php echo get_post_type_object('mieszkanie')->label; ?></p>
				<?php elseif(is_category() || is_tag() || is_tax()): ?>
				<h1 class="page-title"><?php single_term_title(); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
