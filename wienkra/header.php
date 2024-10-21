<?php
$is_front_page = is_front_page();
$post_id_page_archive = get_option('page_for_posts', true);
if(!$is_front_page)
{
	$hero_bg = get_template_directory_uri().'/img/hero_bg.svg';
}
$email_page = rwmb_meta('email_page', ['object_type' => 'setting'], 'wienkra_settings');
$phone_page = rwmb_meta('phone_page', ['object_type' => 'setting'], 'wienkra_settings');
$button_head_name = rwmb_meta('button_head_name', ['object_type' => 'setting'], 'wienkra_settings');
$button_head_url = rwmb_meta('button_head_url', ['object_type' => 'setting'], 'wienkra_settings');
$search_product = false;
if(isset($_GET['post_type']))
{
	if($_GET['post_type'] == 'produkt')
	{
		$search_product = true;
	}
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title><?php wp_title(); ?></title>
		<?php wp_head(); ?>
	</head>
<body <?php body_class(); ?>>
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NS46F45P" height="0" width="0" style "display:none;visibility:hidden"></iframe></noscript>
	<header>
		<div class="header">
			<div class="container">
				<div class="header-content">
					<div class="grid-middle-noGutter">
						<div class="logo-top">
							<?php
								if (function_exists('the_custom_logo')) {
									the_custom_logo();
								}
							?>
							<div class="menu-bar"><span></span><span></span><span></span></div>
						</div>
						<div class="search-top">
							<?php echo get_search_form(); ?>
						</div>
						<div class="data-top">
							<?php if(!empty($email_page)): ?>
							<p class="email-with-icon"><span class="wienkra_icon_mail"></span><a rel="nofollow" href="mailto:<?php echo antispambot($email_page); ?>"><?php echo __('E-mail', 'wienkra'); ?>: <?php echo antispambot($email_page); ?></a></p>
							<?php 
								endif;
								if(!empty($phone_page)):
							?>
							<p class="phone-with-icon"><span class="wienkra_icon_phone"></span><a rel="nofollow" href="tel:<?php echo preg_replace('/\s+/', '', $phone_page); ?>"><?php echo __('Tel.', 'wienkra'); ?>: <?php echo $phone_page; ?></a></p>
							<?php 
								endif;
								if(!empty($button_head_name) && !empty($button_head_url)):
							?>
							<a rel="nofollow" class="custom-button" href="<?php echo esc_url($button_head_url); ?>"><?php echo $button_head_name; ?></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="menu-top">
			<div class="container">
			<?php
				if(has_nav_menu('primary_menu'))
				{
					wp_nav_menu( array('theme_location' => 'primary_menu', 'depth' => 1));
				}
			?>
			</div>
		</div>
	</header>
	<?php if(!$is_front_page): ?>
	<div class="hero-page-top position-relative" style="background-image: url(<?php echo $hero_bg; ?>)">
		<div class="container">
			<div class="page-title-content">
				<?php
					if($search_product || is_singular('produkt'))
					{
						echo '<p class="page-title">'.__('Produkty', 'wienkra').'</p>';
					}
					elseif(is_page() || is_single())
					{
						if(!empty(get_query_var('course_slug')))
						{
							echo '<p class="page-title">'.get_the_title().'</p>';
						}
						else
						{
							echo '<h1 class="page-title">'.get_the_title().'</h1>';
						}
					}
					elseif(is_category() || is_tag() || is_tax())
					{
						echo '<h1 class="page-title">'.single_term_title('', false).'</h1>';
					}
					elseif(is_search())
					{
						echo '<p class="page-title">'.__('Wyniki wyszukiwania', 'wienkra').'</p>';
					}
					elseif(is_home() && is_numeric($post_id_page_archive))
					{
						echo '<h1 class="page-title">'.get_the_title($post_id_page_archive).'</h1>';
					}
					elseif(is_post_type_archive())
					{
						echo '<h1 class="page-title">'.post_type_archive_title('', false).'</h1>';
					}
					elseif(is_404())
					{
						echo '<p class="page-title">'.__('Błąd 404', 'wienkra').'</p>';
					}
					else
					{
						echo '<p class="page-title">'.__('Post', 'wienkra').'</p>';
					}
				?>
			</div>
			<?php
				if(function_exists('yoast_breadcrumb'))
				{
					yoast_breadcrumb('<p class="breadcrumbs" id="breadcrumbs">','</p>');
				}
			?>
		</div>
	</div>
	<?php endif; ?>
