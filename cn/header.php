<?php
	$is_front_page = is_front_page();
	$id_front_page = get_option('page_on_front');
	$phone_page = rwmb_meta('phone_page', ['object_type' => 'setting'], 'cn_settings');
	$email_page = rwmb_meta('email_page', ['object_type' => 'setting'], 'cn_settings');
	$facebook_url_page = rwmb_meta('facebook_url_page', ['object_type' => 'setting'], 'cn_settings');
	$instagram_url_page = rwmb_meta('instagram_url_page', ['object_type' => 'setting'], 'cn_settings');
	$popup_cn_enable = rwmb_meta('popup_cn_enable', '', $id_front_page);
	$popup_cn_url = rwmb_meta('popup_cn_url', '', $id_front_page);
	$popup_cn_image = rwmb_meta('popup_cn_image', '', $id_front_page);
	$popup_cn_title = rwmb_meta('popup_cn_title', '', $id_front_page);
	$popup_cn_number = rwmb_meta('popup_cn_number', '', $id_front_page);
	$popup_cn_text = rwmb_meta('popup_cn_text', '', $id_front_page);
	$popup_image = null;
	if(isset($popup_cn_image['ID']))
	{
		$popup_image = wp_get_attachment_image_url($popup_cn_image['ID'], 'medium');
	}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title><?php wp_title(); ?></title>
		<?php if($popup_cn_enable && $is_front_page && !empty($popup_image) && !empty($popup_cn_title)): ?>
		<link rel="preload" as="image" href="<?php echo $popup_image; ?>">
		<?php endif; ?>
		<link rel="preconnect" href="https://use.typekit.net">
		<link rel="stylesheet" href="https://use.typekit.net/ogm1nfc.css">
		<script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="a39f79a6-bfb7-46b8-bff7-ce9b1d0870aa" data-blockingmode="auto" type="text/javascript"></script>
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-P633F2K2');</script>
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-G9M0N28VJK"></script>
		<script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-G9M0N28VJK'); </script>
		<?php wp_head(); ?>
		<script type="text/javascript" >(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) })(window,document,'script','//www.google-analytics.com/analytics.js','ga'); ga('create', 'UA-43518843-1', 'collegium-novum.pl'); ga('send', 'pageview');</script>
		<script>!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
			n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
			n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
			t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
				document,'script','https://connect.facebook.net/en_US/fbevents.js');
				fbq('init', '599229326938430'); // Insert your pixel ID here.
				fbq('track', 'PageView');</script>
		<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=599229326938430&ev=PageView&noscript=1"/></noscript>
		<script>!function(f,b,e,v,n,t,s)
		{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};
		if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
		n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];
		s.parentNode.insertBefore(t,s)}(window, document,'script',
		'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '303197281546522');
		fbq('track', 'PageView');
		</script>
		<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=303197281546522&ev=PageView&noscript=1"/></noscript>
		<script async src="https://www.googletagmanager.com/gtag/js?id=GT-5MG9BR5M"></script>
		<script>
		  gtag('js', new Date());
		  gtag('config', 'GT-5MG9BR5M');
		</script>
	</head>
<body <?php body_class(); ?>>
	<header class="header-fixed">
		<div class="header-navbar">
			<div class="container-menu">
				<ul>
					<?php
						if(!empty($phone_page)):
					?>
					<li>
						<a class="phone-effect not-hover-effect" href="tel:<?php echo preg_replace('/\s+/', '', $phone_page); ?>">
							<svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 100 100"> <path d="M68.72,83.14c-2.91,0-6.98-1.05-13.03-4.44-7.51-4-14.39-9.14-20.38-15.26-6.18-5.87-11.35-12.75-15.32-20.39-5.44-9.87-4.49-15.12-3.44-17.37,1.26-2.52,3.17-4.54,5.55-5.92,1.31-.85,2.7-1.59,4.14-2.2.15-.06.29-.12.41-.18,2.74-1.23,4.16-.26,6.55,2.1l.12.13c3.01,3.4,5.55,7.19,7.57,11.26,1.88,4.02,2.38,5.58-.37,9.32-.19.26-.38.51-.57.75-1.06,1.39-1.27,1.77-1.19,2.33,1.43,3.8,3.75,7.28,6.7,10.06l.11.11c2.75,2.91,6.18,5.17,9.93,6.54.58.09.98-.13,2.42-1.23.22-.17.44-.34.68-.51,3.9-2.89,5.36-2.39,9.37-.37,4.03,2.04,7.82,4.57,11.25,7.51l.15.14c2.36,2.38,3.33,3.8,2.11,6.53-.05.12-.12.26-.18.41-.61,1.46-1.36,2.85-2.21,4.16-1.38,2.39-3.41,4.29-5.88,5.51-1.16.54-2.58.99-4.49.99ZM28.56,22.19c-.1.04-.21.09-.32.14-1.17.49-2.31,1.1-3.38,1.8l-.14.09c-1.53.87-2.75,2.15-3.53,3.72-.26.55-1.43,4.02,3.35,12.7,3.73,7.19,8.56,13.61,14.38,19.15,5.7,5.8,12.15,10.63,19.24,14.41,9.07,5.07,11.8,3.8,12.83,3.32,1.52-.75,2.81-1.97,3.68-3.5l.09-.14c.7-1.07,1.31-2.2,1.8-3.38.04-.11.09-.21.13-.31-.18-.21-.47-.51-.9-.95-3.1-2.65-6.51-4.92-10.14-6.76-1.05-.53-2.15-1.08-2.47-1.11-.23.07-1.19.79-1.51,1.02-.21.16-.42.32-.62.47-1.72,1.31-3.67,2.81-6.76,2.15l-.33-.09c-4.57-1.63-8.74-4.35-12.08-7.86-3.56-3.37-6.33-7.58-8.03-12.18l-.1-.35c-.66-3.05.88-5.06,2.11-6.68.17-.22.34-.44.51-.68.75-1.03.9-1.36.92-1.46,0-.33-.6-1.63-1.04-2.58-1.77-3.58-4.05-6.97-6.73-10.02-.45-.44-.75-.73-.97-.91Z"/> </svg>
							<?php echo $phone_page; ?>
						</a>
					</li>
					<?php
						endif;
						if(!empty($email_page)):
						$email_page = antispambot($email_page);
					?>
					<li><a href="mailto:<?php echo $email_page; ?>"><?php echo $email_page; ?></a></li>
					<?php
						endif;
					?>
					<li>
						<a class="cart-top not-hover-effect" href="<?php echo get_url_for_slug('formularz-zgloszeniowy'); ?>">
							<?php
								if(class_exists("Favorites")):
							?>
							<div class="cart-top-count"><?php echo count(get_user_favorites()); ?></div>
							<?php endif; ?>
							<svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 100 100"> <g> <path d="M38.25,92.54c-4.44,0-8.05-3.61-8.05-8.05s3.61-8.05,8.05-8.05h0c2.15,0,4.16.84,5.69,2.35,1.52,1.52,2.36,3.54,2.36,5.69h0c0,4.45-3.61,8.06-8.05,8.06ZM38.26,82.81h0c-.93,0-1.68.76-1.68,1.68s.75,1.68,1.68,1.68,1.68-.75,1.68-1.68c0-.45-.18-.88-.5-1.19s-.74-.49-1.18-.49Z"/> <path d="M74.54,92.54c-4.44,0-8.05-3.61-8.05-8.05s3.61-8.05,8.04-8.05h0c2.15,0,4.16.84,5.69,2.35,1.52,1.52,2.36,3.54,2.36,5.69h0c0,4.45-3.61,8.06-8.05,8.06ZM74.54,82.81h0c-.93,0-1.68.76-1.68,1.68s.75,1.68,1.68,1.68,1.68-.75,1.68-1.68c0-.45-.18-.88-.5-1.19s-.74-.49-1.18-.49Z"/> <path d="M40.27,72.51c-5.15,0-9.65-3.68-10.66-8.83l-5.48-27.36c-.02-.08-.03-.16-.05-.24l-2.55-12.74h-9.5c-2.43,0-4.4-1.97-4.4-4.4s1.97-4.4,4.4-4.4h13.11c2.1,0,3.9,1.48,4.31,3.53l2.57,12.85h52.11c1.31,0,2.56.58,3.39,1.6.83,1.01,1.18,2.34.93,3.63l-5.24,27.5c-1.04,5.25-5.69,8.89-10.96,8.86h-31.77c-.07,0-.14,0-.21,0ZM33.79,39.73l4.45,22.23c.21,1.04,1.14,1.77,2.16,1.75h31.94c1.06.01,2.04-.71,2.24-1.74l4.24-22.24h-45.03Z"/> </g> </svg>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="header">
			<div class="container-menu">
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
						<div class="menu-top">
						<?php
							if(has_nav_menu('primary_menu'))
							{
								wp_nav_menu( array('theme_location' => 'primary_menu', 'depth' => 2));
							}
						?>
						</div>
						<div class="social-top">
							<ul>
								<li class="menu-bar-content">
									<div class="menu-bar"><span></span><span></span><span></span></div>
								</li>
								<li>
									<a href="<?php echo get_post_type_archive_link('post'); ?>" rel="nofollow noopener">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.125 20.125"> <g transform="translate(-24 -24)"> <path d="M24,144h8.386v1.677H24Z" transform="translate(0 -103.229)"/> <path d="M24,108h8.386v1.677H24Z" transform="translate(0 -72.26)"/> <path d="M42.448,32.386H25.677A1.677,1.677,0,0,1,24,30.708V25.677A1.677,1.677,0,0,1,25.677,24H42.448a1.677,1.677,0,0,1,1.677,1.677v5.031A1.677,1.677,0,0,1,42.448,32.386ZM25.677,25.677v5.031H42.448V25.677Z" transform="translate(0 0)"/> <path d="M114.708,116.386h-5.031A1.677,1.677,0,0,1,108,114.708v-5.031A1.677,1.677,0,0,1,109.677,108h5.031a1.677,1.677,0,0,1,1.677,1.677v5.031A1.677,1.677,0,0,1,114.708,116.386Zm-5.031-6.708v5.031h5.031v-5.031Z" transform="translate(-72.26 -72.26)"/> </g> </svg> 
									</a>
								</li>
								<?php
									if(!empty($facebook_url_page)):
								?>
								<li>
									<a href="<?php echo esc_url($facebook_url_page); ?>" rel="nofollow noopener">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="329 7238.996 9.999 20.004"><path d="M335.821 7259v-9h2.732l.446-4h-3.179v-1.948c0-1.03.026-2.052 1.466-2.052h1.458v-2.86a16.153 16.153 0 0 0-2.519-.14c-2.646 0-4.3 1.657-4.3 4.7v2.3H329v4h2.923v9h3.898Z" /></svg>
									</a>
								</li>
								<?php
									endif;
									if(!empty($instagram_url_page)):
								?>
								<li>
									<a href="<?php echo esc_url($instagram_url_page); ?>" rel="nofollow noopener">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="284.001 7278.995 19.999 20"><path d="M289.87 7279.12a5.511 5.511 0 0 0-5.788 5.774c-.046 1.005-.313 8.6.463 10.594a5.04 5.04 0 0 0 2.91 2.9c.773.29 1.59.445 2.415.462 8.861.399 12.145.182 13.531-3.365a7.24 7.24 0 0 0 .462-2.41c.4-8.883-.066-10.809-1.61-12.352-1.225-1.222-2.666-2.053-12.382-1.606m.082 17.945a5.527 5.527 0 0 1-1.848-.34 3.255 3.255 0 0 1-1.889-1.884c-.59-1.514-.4-8.7-.342-9.866a4.247 4.247 0 0 1 1.087-2.985c1-.993 2.281-1.479 11.034-1.084 1.1-.038 2.172.35 2.992 1.084 1 .993 1.49 2.288 1.087 11.008a5.477 5.477 0 0 1-.342 1.843c-.9 2.308-2.972 2.628-11.778 2.224m8.138-13.378a1.195 1.195 0 1 0 2.39.008 1.195 1.195 0 0 0-2.39-.008m-9.227 5.3a5.11 5.11 0 1 0 5.11-5.1 5.101 5.101 0 0 0-5.11 5.1m1.793 0a3.316 3.316 0 1 1 6.632-.013 3.316 3.316 0 0 1-6.632.013"/></svg>
									</a>
								</li>
								<?php
									endif;
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="header-separator"></div>
	<?php
		if(function_exists('yoast_breadcrumb') && !$is_front_page && !is_page(21))
		{
			yoast_breadcrumb('<div class="container-medium"><p class="breadcrumbs" id="breadcrumbs">','</p></div>');
		}
		if($popup_cn_enable && $is_front_page && !empty($popup_image) && !empty($popup_cn_title)):
	?>
	<div class="cn-popup">
		<?php if(!empty($popup_cn_url)): ?>
		<a href="<?php echo esc_url($popup_cn_url); ?>" class="cn-popup-circle">
		<?php else: ?>
		<div class="cn-popup-circle">
		<?php endif; ?>
			<div class="cn-popup-bg" style="background-image:url(<?php echo $popup_image; ?>);background-position:center;background-size:cover;background-repeat:no-repeat;">
				<div class="cn-popup-text">
					<div style="width:100%;">
						<div class="cn-popup-title">
							<?php
								echo apply_filters('the_content', $popup_cn_title);
							?>
						</div>
						<?php
							if(!empty($popup_cn_number))
							{
								echo '<div class="cn-popup-number"><p>'.$popup_cn_number.'</p></div>';
							}
							if(!empty($popup_cn_text))
							{
								echo apply_filters('the_content', $popup_cn_text);
							}
						?>
					</div>
				</div>
			</div>
		<?php if(!empty($popup_cn_url)): ?>
		</a>
		<?php else: ?>
		</div>
		<?php endif; ?>
		<div class="cn-popup-close">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128.203 127.062"> <g> <g id="path_bg_close" data-name="Path 4474" fill="#0560f2"> <path d="M 64.10139465332031 118.0617980957031 C 33.71836853027344 118.0617980957031 8.999994277954102 93.59934997558594 8.999994277954102 63.53089904785156 C 8.999994277954102 33.46244812011719 33.71836853027344 8.999999046325684 64.10139465332031 8.999999046325684 C 94.48442077636719 8.999999046325684 119.2027969360352 33.46244812011719 119.2027969360352 63.53089904785156 C 119.2027969360352 93.59934997558594 94.48442077636719 118.0617980957031 64.10139465332031 118.0617980957031 Z" stroke="none"/> <path d="M 64.10139465332031 18 C 38.68099212646484 18 17.99999237060547 38.42506408691406 17.99999237060547 63.53089904785156 C 17.99999237060547 88.63673400878906 38.68099212646484 109.0617980957031 64.10139465332031 109.0617980957031 C 89.52178955078125 109.0617980957031 110.2027969360352 88.63673400878906 110.2027969360352 63.53089904785156 C 110.2027969360352 38.42506408691406 89.52178955078125 18 64.10139465332031 18 M 64.10139465332031 0 C 99.50359344482422 0 128.2027893066406 28.44376373291016 128.2027893066406 63.53089904785156 C 128.2027893066406 98.61803436279297 99.50359344482422 127.0617980957031 64.10139465332031 127.0617980957031 C 28.69915771484375 127.0617980957031 0 98.61803436279297 0 63.53089904785156 C 0 28.44376373291016 28.69915771484375 0 64.10139465332031 0 Z" stroke="none" fill="#fff"/> </g> </g> <g transform="translate(35.241 31.94)"> <rect width="58" height="58" fill="none"/> <path d="M48,4.834,43.166,0,24,19.166,4.834,0,0,4.834,19.166,24,0,43.166,4.834,48,24,28.834,43.166,48,48,43.166,28.834,24Z" transform="translate(5 5)" fill="#fff"/> </g> </svg>
		</div>
	</div>
	<?php endif; ?>
