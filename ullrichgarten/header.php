<?php
	$body_class = null;
	$is_front_page = is_front_page();
	if($is_front_page)
	{
		$body_class = 'change-color-front-page';
	}
	else if(is_page_template('offer.php'))
	{
		$body_class = 'change-color-offer';
	}
	else if(is_page_template('portfolio.php'))
	{
		$body_class = 'change-color-portfolio';
	}
	else
	{
		$body_class = 'change-color-footer';
	}
	$id_front_page = get_option('page_on_front');
	$page_email = get_field('page_email', $id_front_page);
	$page_phone = get_field('page_phone', $id_front_page);
	$page_instagram = get_field('page_instagram', $id_front_page);
	$besichtigung_vor_ort_buchen = get_field('besichtigung_vor_ort_buchen', $id_front_page);
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title><?php if(!function_exists('yoast_breadcrumb')) { $is_front_page ? bloginfo('blogname') : wp_title(); } else {wp_title();} ?></title>
		<?php wp_head(); ?>
		<noscript><style>.preloader{display:none;}*{cursor:pointer}</style></noscript>
	</head>
<body <?php body_class($body_class); ?>>
	<div id="custom_cursor"></div>
	<div class="mobile-top-bar" id="mobile_menu">
		<div class="logo-top">
			<?php if($is_front_page): ?>
			<a href="<?php echo get_home_url(); ?>"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 69.745 69.745"> <g transform="translate(-184 -307.89)"> <g transform="translate(184 307.89)"> <path id="Pfad_1" d="M292.908,402.461l5.841-5.161v40.2h-5.364v-3.648c-8.587,7.68-21.954,2.217-21.935-6.493V420.5c2.746-3.952,4.518-9.765,4.73-15.593h1.166v20.926c.289,8.888,15.492,7.772,15.51-2.993l.052-20.382Z" transform="translate(-244.554 -369.801)" fill="#fff"/> </g> <path id="Pfad_2" d="M247.153,317.809l-.006-3.319-3.325.006a25.219,25.219,0,0,0-25.094,25.352l.009,3.325,3.319-.009a25.215,25.215,0,0,0,25.1-25.358h0Zm-2.817-.514a23.349,23.349,0,0,1-23.224,23.488,23.343,23.343,0,0,1,23.224-23.488Zm-28.631,26.333a26.589,26.589,0,0,0-26.447-26.748,26.584,26.584,0,0,0,26.447,26.748ZM188.96,371.6a26.587,26.587,0,0,0,26.745-26.45A26.578,26.578,0,0,0,188.96,371.6h0Z" transform="translate(-3.435 -4.57)" fill="#fff"/> </g> </svg></a>
			<?php
				else:
				if(function_exists('the_custom_logo'))
				{
					the_custom_logo();
				}
				endif;
			?>
		</div>
		<div class="menu-bar-top" id="menu_bar_top">
			<div class="menu-bar" id="menu_bar"><span></span><span></span></div>
		</div>
	</div>
	<div class="menu-top" id="menu_top">
		<div class="menu-top-content">
			<?php
				if(has_nav_menu('primary_menu'))
				{
					wp_nav_menu(array('theme_location' => 'primary_menu', 'depth' => 1));
				}
			?>
			<ul style="margin-top:-10px;margin-left:-40px;">
				<li style="color:var(--second);font-style:italic;"><?php echo __('KONTAKT', 'ullrichgarten'); ?></li>
			</ul>
			<div class="grid">
				<div class="col-11_lg-12" data-push-left="off-1">
					<?php if(!empty($besichtigung_vor_ort_buchen)): ?>
					<p><a class="custom-button" href="<?php echo esc_url($besichtigung_vor_ort_buchen); ?>"><?php echo __('BESICHTIGUNG VOR ORT BUCHEN', 'ullrichgarten'); ?></a></p>
					<?php endif; if(!empty($page_instagram)): ?>
					<p><a class="custom-button" href="tel:<?php echo $page_phone; ?>"><?php echo $page_phone; ?></a></p>
					<?php endif; if(!empty($page_instagram)): ?>
					<p><a class="custom-button" href="mailto:<?php echo antispambot($page_email); ?>"><?php echo antispambot($page_email); ?></a></p>
					<?php endif; if(!empty($page_instagram)): ?>
					<p><a class="custom-button" href="<?php echo esc_url($page_instagram); ?>"><?php echo __('INSTAGRAM', 'ullrichgarten'); ?></a></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<?php if($is_front_page): ?>
	<div class="preloader">
		<div class="preloader-content">
			<div class="container text-center">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 69.745 69.745"><g transform="translate(-184 -307.89)"><g transform="translate(184 307.89)"><path id="preloader_svg_1" d="M292.908,402.461l5.841-5.161v40.2h-5.364v-3.648c-8.587,7.68-21.954,2.217-21.935-6.493V420.5c2.746-3.952,4.518-9.765,4.73-15.593h1.166v20.926c.289,8.888,15.492,7.772,15.51-2.993l.052-20.382Z" transform="translate(-244.554 -369.801)" fill="none" stroke="#fff" stroke-width="0.5"/></g><path id="preloader_svg_2" d="M247.153,317.809l-.006-3.319-3.325.006a25.219,25.219,0,0,0-25.094,25.352l.009,3.325,3.319-.009a25.215,25.215,0,0,0,25.1-25.358h0Zm-2.817-.514a23.588,23.588,0,0,1-10.265,19.491,22.84,22.84,0,0,1-12.959,4,23.343,23.343,0,0,1,23.224-23.488Zm-28.631,26.333a26.589,26.589,0,0,0-26.447-26.748,26.584,26.584,0,0,0,26.447,26.748ZM188.96,371.6a26.587,26.587,0,0,0,26.745-26.45A26.578,26.578,0,0,0,188.96,371.6h0Z" transform="translate(-3.435 -4.57)" fill="none" stroke="#fff" stroke-width="0.5"/></g></svg>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<div id="smooth-wrapper">
		<div id="smooth-content">