<?php
	$is_front_page = is_front_page();
	$my_account = null;
	if(class_exists('WooCommerce') && !is_user_logged_in())
	{
		if(get_permalink(wc_get_page_id('myaccount')) == get_permalink())
		{
			$my_account = ' custom-myaccount';
		}
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
<body <?php body_class('woocommerce'.$my_account); ?>>
	<header class="header-fixed">
		<div class="header">
			<div class="container">
				<div class="header-content">
					<div class="grid-middle-noGutter">
						<div class="logo-top">
							<?php
								if(function_exists('the_custom_logo'))
								{
									the_custom_logo();
								}
							?>
						</div>
						<div class="menu-top" id="menu_top">
						<?php
							if(has_nav_menu('primary_menu'))
							{
								wp_nav_menu(array('theme_location' => 'primary_menu', 'depth' => 1));
							}
						?>
						</div>
						<div class="right-top">
							<?php if(class_exists('WooCommerce')): echo get_product_search_form(); ?>
							<ul class="icon-woo">
								<?php if(class_exists('WPCleverWoosw')): ?>
								<li><a href="<?php echo get_permalink(get_page_by_path('wishlist')); ?>"><span class="runovit_ico_heart"></span> <span class="count wishlist-count"><?php $a = new WPCleverWoosw(); echo $a->get_count(); ?></span></a></li>
								<?php endif; ?>
								<li><a href="<?php echo wc_get_cart_url(); ?>"><span class="runovit_ico_cart"></span> <span class="count cart-top"><?php echo WC()->cart->get_cart_contents_count(); ?></span></a></li>
								<li><a href="<?php echo wc_get_page_permalink('myaccount'); ?>"><span class="runovit_ico_user"></span></a></li>
								<li class="hide-desktop"><div class="menu-bar" id="menu_bar"><span></span><span></span><span></span></div></li>
							</ul>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="footer-fixed">
	<div class="header-separator"></div>
	<?php
		if(class_exists('WooCommerce') && !$is_front_page)
		{
			echo '<div class="container">';
			woocommerce_breadcrumb();
			echo '</div>';
		}
	?>
