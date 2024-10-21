		<?php
			$page_catalog_file = null;
			$id_front_page = get_option('page_on_front');
			$facebook_page = rwmb_meta('facebook_page', ['object_type' => 'setting'], 'makaer_settings');
			$instagram_page = rwmb_meta('instagram_page', ['object_type' => 'setting'], 'makaer_settings');
			$tiktok_page = rwmb_meta('tiktok_page', ['object_type' => 'setting'], 'makaer_settings');
			$pinterest_page = rwmb_meta('pinterest_page', ['object_type' => 'setting'], 'makaer_settings');
			$email_page = rwmb_meta('email_page', ['object_type' => 'setting'], 'makaer_settings');
			$phone_page = rwmb_meta('phone_page', ['object_type' => 'setting'], 'makaer_settings');
			$adres_page = rwmb_meta('adres_page', ['object_type' => 'setting'], 'makaer_settings');
			$legal_data_page = rwmb_meta('legal_data_page', ['object_type' => 'setting'], 'makaer_settings');
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
		<div class="mobile-menu-bar">
			<ul>
				<li>
					<a href="<?php echo get_post_type_archive_link('produkt'); ?>">
						<span class="makaer_ico_4"></span>
						<?php echo __('Oferta', 'makaer'); ?>
					</a>
				</li>
				<li>
					<a href="<?php echo get_home_url(); ?>">
						<svg fill="#AF865B" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 486.196 486.196" xml:space="preserve"> <g> <path d="M481.708,220.456l-228.8-204.6c-0.4-0.4-0.8-0.7-1.3-1c-5-4.8-13-5-18.3-0.3l-228.8,204.6c-5.6,5-6,13.5-1.1,19.1 c2.7,3,6.4,4.5,10.1,4.5c3.2,0,6.4-1.1,9-3.4l41.2-36.9v7.2v106.8v124.6c0,18.7,15.2,34,34,34c0.3,0,0.5,0,0.8,0s0.5,0,0.8,0h70.6 c17.6,0,31.9-14.3,31.9-31.9v-121.3c0-2.7,2.2-4.9,4.9-4.9h72.9c2.7,0,4.9,2.2,4.9,4.9v121.3c0,17.6,14.3,31.9,31.9,31.9h72.2 c19,0,34-18.7,34-42.6v-111.2v-34v-83.5l41.2,36.9c2.6,2.3,5.8,3.4,9,3.4c3.7,0,7.4-1.5,10.1-4.5 C487.708,233.956,487.208,225.456,481.708,220.456z M395.508,287.156v34v111.1c0,9.7-4.8,15.6-7,15.6h-72.2c-2.7,0-4.9-2.2-4.9-4.9 v-121.1c0-17.6-14.3-31.9-31.9-31.9h-72.9c-17.6,0-31.9,14.3-31.9,31.9v121.3c0,2.7-2.2,4.9-4.9,4.9h-70.6c-0.3,0-0.5,0-0.8,0 s-0.5,0-0.8,0c-3.8,0-7-3.1-7-7v-124.7v-106.8v-31.3l151.8-135.6l153.1,136.9L395.508,287.156L395.508,287.156z"/> </g> </svg>
						<?php echo __('Strona główna', 'makaer'); ?>
					</a>
				</li>
				<li>
					<a href="<?php echo get_url_for_slug('kontakt'); ?>">
						<span class="makaer_ico_phone"></span>
						<?php echo __('Kontakt', 'makaer'); ?>
					</a>
				</li>
			</ul>
		</div>
		<footer>
			<div class="footer">
				<div class="container">
					<div class="footer-head">
						<div class="grid-middle-noGutter">
							<div class="footer-head-left">
								<?php
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
							<div class="footer-logo">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 166.523 19.546"> <defs> <clipPath id="clip-path"> <rect id="Rectangle_831" data-name="Rectangle 831" width="166.523" height="19.546" fill="#2E2E22"/> </clipPath> <clipPath id="clip-path-2"> <path id="Path_3067" data-name="Path 3067" d="M17.042.025,10.717,8.294,4.39.025H0v19.23H3.814V5.273l6.439,8.381h.754L17.591,5.3V19.255H21.4V.025Z" transform="translate(0 -0.025)" fill="#2E2E22"/> </clipPath> <clipPath id="clip-path-3"> <path id="Path_3068" data-name="Path 3068" d="M24.433,4.05l3.755,8.186H20.678ZM22.351.012,13.284,19.244h4.131l1.732-3.628H29.719l1.706,3.628h4.159L26.513.012Z" transform="translate(-13.284 -0.012)" fill="#2E2E22"/> </clipPath> <clipPath id="clip-path-4"> <path id="Path_3069" data-name="Path 3069" d="M38.438.012,30.755,8.147V.012H26.941V19.244h3.814V10.728l8.465,8.517h4.708v-.22l-9.735-9.7,8.983-9.2V.012Z" transform="translate(-26.941 -0.012)" fill="#2E2E22"/> </clipPath> <clipPath id="clip-path-5"> <path id="Path_3070" data-name="Path 3070" d="M38.353.012V19.244H53.491v-3.57H42.138V11.332H53.085V7.955H42.138V3.528H53.491V.012Z" transform="translate(-38.353 -0.012)" fill="#2E2E22"/> </clipPath> <clipPath id="clip-path-6"> <path id="Path_3071" data-name="Path 3071" d="M59.588,4.05l3.755,8.186H55.833ZM57.509.012l-9.07,19.232h4.129L54.3,15.616H64.875l1.706,3.628H70.74L61.668.012Z" transform="translate(-48.439 -0.012)" fill="#2E2E22"/> </clipPath> <clipPath id="clip-path-7"> <path id="Path_3072" data-name="Path 3072" d="M66.058,3.405h5.8c2.4,0,3.468,1.538,3.468,3.077S74.289,9.56,71.862,9.56h-5.8ZM62.244,0V19.258h3.814V12.829h3.667l5.9,6.429h4.535v-.246L74.03,12.443A5.77,5.77,0,0,0,79.144,6.4c0-3.326-2.514-6.347-7.282-6.375C68.655.026,65.449,0,62.244,0Z" transform="translate(-62.244)" fill="#2E2E22"/> </clipPath> <clipPath id="clip-path-8"> <path id="Path_3073" data-name="Path 3073" d="M70.642.239V1.358h2.177V6.774h1.3V1.358h2.179V.239Z" transform="translate(-70.642 -0.239)" fill="#2E2E22"/> </clipPath> <clipPath id="clip-path-9"> <path id="Path_3074" data-name="Path 3074" d="M79.419.244,77.271,3.052,75.122.244H73.63V6.777h1.293V2.026L77.115,4.87h.253l2.237-2.835V6.777h1.3V.244Z" transform="translate(-73.63 -0.244)" fill="#2E2E22"/> </clipPath> <clipPath id="clip-path-10"> <path id="Path_3075" data-name="Path 3075" d="M17.159.145,10.834,8.416,4.507.145H.117V19.377H3.928V5.395l6.442,8.376h.751l6.586-8.351V19.377h3.814V.145Z" transform="translate(-0.117 -0.145)" fill="#2E2E22"/> </clipPath> <clipPath id="clip-path-11"> <path id="Path_3076" data-name="Path 3076" d="M24.549,4.169,28.3,12.358H20.8ZM22.47.133,13.4,19.363h4.133l1.73-3.626H29.835l1.706,3.626H35.7L26.629.133Z" transform="translate(-13.4 -0.133)" fill="#2E2E22"/> </clipPath> <clipPath id="clip-path-12"> <path id="Path_3077" data-name="Path 3077" d="M38.554.133,30.868,8.266V.133H27.059v19.23h3.809V10.849l8.465,8.515h4.71v-.218l-9.737-9.7L43.289.241V.133Z" transform="translate(-27.059 -0.133)" fill="#2E2E22"/> </clipPath> <clipPath id="clip-path-13"> <path id="Path_3078" data-name="Path 3078" d="M38.47.133v19.23H53.606V15.791H42.253v-4.34H53.2V8.071H42.253V3.649H53.606V.133Z" transform="translate(-38.47 -0.133)" fill="#2E2E22"/> </clipPath> <clipPath id="clip-path-14"> <path id="Path_3079" data-name="Path 3079" d="M59.7,4.169l3.757,8.189H55.95ZM57.623.133l-9.067,19.23h4.129l1.732-3.626H64.989L66.7,19.363h4.159L61.783.133Z" transform="translate(-48.556 -0.133)" fill="#2E2E22"/> </clipPath> <clipPath id="clip-path-15"> <path id="Path_3080" data-name="Path 3080" d="M66.172,3.528h5.807c2.4,0,3.466,1.538,3.466,3.077S74.4,9.68,71.979,9.68H66.172Zm-3.811,15.85h3.811V12.949h3.669l5.893,6.429h4.535v-.246l-6.122-6.567a5.771,5.771,0,0,0,5.114-6.042c0-3.326-2.516-6.349-7.282-6.375C68.772.148,65.566.12,62.361.12Z" transform="translate(-62.361 -0.12)" fill="#2E2E22"/> </clipPath> <clipPath id="clip-path-16"> <path id="Path_3081" data-name="Path 3081" d="M70.758.359V1.48h2.179V6.9H74.23V1.48h2.181V.359Z" transform="translate(-70.758 -0.359)" fill="#2E2E22"/> </clipPath> <clipPath id="clip-path-17"> <path id="Path_3082" data-name="Path 3082" d="M79.536.363,77.388,3.175,75.237.363h-1.49V6.9H75.04V2.149l2.19,2.844h.257l2.235-2.835V6.9h1.3V.363Z" transform="translate(-73.747 -0.363)" fill="#2E2E22"/> </clipPath> </defs> <g id="Group_3291" data-name="Group 3291" clip-path="url(#clip-path)"> <g id="Group_3239" data-name="Group 3239" transform="translate(0 0.055)"> <g id="Group_3238" data-name="Group 3238" clip-path="url(#clip-path-2)"> <rect id="Rectangle_805" data-name="Rectangle 805" width="20.908" height="22.898" transform="translate(-1.559 19.103) rotate(-85.333)" fill="#2E2E22"/> </g> </g> <g id="Group_3241" data-name="Group 3241" transform="translate(28.686 0.026)"> <g id="Group_3240" data-name="Group 3240" clip-path="url(#clip-path-3)"> <rect id="Rectangle_806" data-name="Rectangle 806" width="20.983" height="23.791" transform="translate(-1.56 19.106) rotate(-85.333)" fill="#2E2E22"/> </g> </g> <g id="Group_3243" data-name="Group 3243" transform="translate(58.177 0.027)"> <g id="Group_3242" data-name="Group 3242" clip-path="url(#clip-path-4)"> <rect id="Rectangle_807" data-name="Rectangle 807" width="20.55" height="18.495" transform="translate(-1.56 19.105) rotate(-85.333)" fill="#2E2E22"/> </g> </g> <g id="Group_3245" data-name="Group 3245" transform="translate(82.821 0.027)"> <g id="Group_3244" data-name="Group 3244" clip-path="url(#clip-path-5)"> <rect id="Rectangle_808" data-name="Rectangle 808" width="20.4" height="16.652" transform="translate(-1.56 19.105) rotate(-85.333)" fill="#2E2E22"/> </g> </g> <g id="Group_3247" data-name="Group 3247" transform="translate(104.601 0.026)"> <g id="Group_3246" data-name="Group 3246" clip-path="url(#clip-path-6)"> <rect id="Rectangle_809" data-name="Rectangle 809" width="20.983" height="23.791" transform="translate(-1.56 19.106) rotate(-85.333)" fill="#2E2E22"/> </g> </g> <g id="Group_3249" data-name="Group 3249" transform="translate(134.412)"> <g id="Group_3248" data-name="Group 3248" clip-path="url(#clip-path-7)"> <rect id="Rectangle_810" data-name="Rectangle 810" width="20.651" height="19.418" transform="matrix(0.081, -0.997, 0.997, 0.081, -1.562, 19.131)" fill="#2E2E22"/> </g> </g> <g id="Group_3251" data-name="Group 3251" transform="translate(152.547 0.517)"> <g id="Group_3250" data-name="Group 3250" clip-path="url(#clip-path-8)"> <rect id="Rectangle_811" data-name="Rectangle 811" width="6.973" height="6.164" transform="matrix(0.081, -0.997, 0.997, 0.081, -0.53, 6.491)" fill="#2E2E22"/> </g> </g> <g id="Group_3253" data-name="Group 3253" transform="translate(159 0.528)"> <g id="Group_3252" data-name="Group 3252" clip-path="url(#clip-path-9)"> <rect id="Rectangle_812" data-name="Rectangle 812" width="7.102" height="7.78" transform="matrix(0.081, -0.997, 0.997, 0.081, -0.53, 6.489)" fill="#2E2E22"/> </g> </g> <g id="Group_3255" data-name="Group 3255" transform="translate(0.253 0.314)"> <g id="Group_3254" data-name="Group 3254" clip-path="url(#clip-path-10)"> <rect id="Rectangle_813" data-name="Rectangle 813" width="21.055" height="23.026" transform="translate(-1.7 19.081) rotate(-84.91)" fill="#2E2E22"/> </g> </g> <g id="Group_3257" data-name="Group 3257" transform="translate(28.936 0.287)"> <g id="Group_3256" data-name="Group 3256" clip-path="url(#clip-path-11)"> <rect id="Rectangle_814" data-name="Rectangle 814" width="21.133" height="23.919" transform="translate(-1.699 19.079) rotate(-84.91)" fill="#2E2E22"/> </g> </g> <g id="Group_3259" data-name="Group 3259" transform="translate(58.432 0.288)"> <g id="Group_3258" data-name="Group 3258" clip-path="url(#clip-path-12)"> <rect id="Rectangle_815" data-name="Rectangle 815" width="20.661" height="18.623" transform="translate(-1.699 19.078) rotate(-84.91)" fill="#2E2E22"/> </g> </g> <g id="Group_3261" data-name="Group 3261" transform="translate(83.074 0.288)"> <g id="Group_3260" data-name="Group 3260" clip-path="url(#clip-path-13)"> <rect id="Rectangle_816" data-name="Rectangle 816" width="20.497" height="16.782" transform="translate(-1.699 19.078) rotate(-84.91)" fill="#2E2E22"/> </g> </g> <g id="Group_3263" data-name="Group 3263" transform="translate(104.854 0.287)"> <g id="Group_3262" data-name="Group 3262" clip-path="url(#clip-path-14)"> <rect id="Rectangle_817" data-name="Rectangle 817" width="21.132" height="23.917" transform="translate(-1.699 19.079) rotate(-84.91)" fill="#2E2E22"/> </g> </g> <g id="Group_3265" data-name="Group 3265" transform="translate(134.665 0.259)"> <g id="Group_3264" data-name="Group 3264" clip-path="url(#clip-path-15)"> <rect id="Rectangle_818" data-name="Rectangle 818" width="20.771" height="19.546" transform="translate(-1.702 19.107) rotate(-84.91)" fill="#2E2E22"/> </g> </g> <g id="Group_3267" data-name="Group 3267" transform="translate(152.798 0.776)"> <g id="Group_3266" data-name="Group 3266" clip-path="url(#clip-path-16)"> <rect id="Rectangle_819" data-name="Rectangle 819" width="7.012" height="6.211" transform="translate(-0.578 6.485) rotate(-84.91)" fill="#2E2E22"/> </g> </g> <g id="Group_3269" data-name="Group 3269" transform="translate(159.252 0.785)"> <g id="Group_3268" data-name="Group 3268" clip-path="url(#clip-path-17)"> <rect id="Rectangle_820" data-name="Rectangle 820" width="7.156" height="7.822" transform="translate(-0.578 6.485) rotate(-84.91)" fill="#2E2E22"/> </g> </g> </g> </svg> 
							</div>
							<div class="footer-head-right">
							<?php if(!empty($page_catalog_file)): foreach($page_catalog_file as $file): ?>
								<a class="button-file" href="<?php echo esc_url($file['url']); ?>"><?php echo __('POBIERZ KATALOG PDF', 'makaer'); ?></a>
							<?php
								endforeach;
								endif;
							?>
							</div>
						</div>
					</div>
					<div class="footer-content">
						<div class="grid-5-lg-4_md-3_sm-2">
							<div class="col">
								<div class="footer-menu">
									<?php
										if(has_nav_menu('footer_menu_1'))
										{
											wp_nav_menu(array('theme_location' => 'footer_menu_1'));
										}
									?>
								</div>
							</div>
							<div class="col">
								<p class="footer-title"><?php echo __('Produkty', 'makaer'); ?></p>
								<div class="footer-menu-list">
									<?php
										if(has_nav_menu('footer_menu_2'))
										{
											wp_nav_menu(array('theme_location' => 'footer_menu_2'));
										}
									?>
								</div>
							</div>
							<div class="col">
								<div class="footer-menu-list">
									<?php
										if(has_nav_menu('footer_menu_3'))
										{
											wp_nav_menu(array('theme_location' => 'footer_menu_3'));
										}
									?>
								</div>
							</div>
							<div class="col">
								<?php if(!empty($phone_page)): ?>
								<p class="footer-title"><?php echo __('Infolinia', 'makaer'); ?></p>
								<div class="data-with-icon">
									<span class="makaer_ico_phone"></span>
									<p><a rel="nofollow noopener" style="color:var(--second);font-size:18px;" href="tel:<?php echo preg_replace('/\s+/', '', $phone_page); ?>"><?php echo $phone_page; ?></a></p>
								</div>
								<p><?php echo __('pon - pt od 7:00 do 15:00', 'makaer'); ?></p>
								<?php endif; ?>
							</div>
							<div class="col">
								<p class="footer-title"><?php echo __('Makaer s.c.', 'makaer'); ?></p>
								<?php if(!empty($email_page)): ?>
								<div class="data-with-icon">
									<span class="makaer_ico_mail"></span>
									<p><a rel="nofollow noopener" href="mailto:<?php echo antispambot($email_page); ?>"><?php echo antispambot($email_page); ?></a></p>
								</div>
								<?php
									endif;
									if(!empty($adres_page)):
								?>
								<div class="data-with-icon">				
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19.75 26.05"><g transform="translate(-7.5 0.5)"> <path d="M17.375,0A9.387,9.387,0,0,0,8,9.375c0,6.73,8.734,15.16,9.105,15.516a.387.387,0,0,0,.539,0c.371-.355,9.105-8.785,9.105-15.516A9.387,9.387,0,0,0,17.375,0Zm0,13.672a4.3,4.3,0,1,1,4.3-4.3A4.3,4.3,0,0,1,17.375,13.672Z" fill="none" stroke="#AF865B" stroke-width="1"/></g></svg> 
									<?php echo apply_filters('the_excerpt', $adres_page); ?>
								</div>
								<?php
									endif;
									if(!empty($legal_data_page)):
								?>
								<div class="data-with-icon">
									<span class="makaer_ico_info"></span>
									<?php echo apply_filters('the_excerpt', $legal_data_page); ?>
								</div>
								<?php
									endif;
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container-full">
				<div class="footer-copyright">
					<?php the_privacy_policy_link(); ?>
				</div>
			</div>
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>
