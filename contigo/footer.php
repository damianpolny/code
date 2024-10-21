		<?php 
			$developers_logo = rwmb_meta('developers_logo', ['object_type' => 'setting'], 'contigo_settings');
			$footer_adress = rwmb_meta('footer_adress', ['object_type' => 'setting'], 'contigo_settings');
			$footer_email = rwmb_meta('footer_email', ['object_type' => 'setting'], 'contigo_settings');
			$footer_phone = rwmb_meta('footer_phone', ['object_type' => 'setting'], 'contigo_settings');
			$footer_text = rwmb_meta('footer_text', ['object_type' => 'setting'], 'contigo_settings');
			$api_google_maps = rwmb_meta('api_google_maps', ['object_type' => 'setting'], 'contigo_settings');
			$lat_google_maps = rwmb_meta('lat_google_maps', ['object_type' => 'setting'], 'contigo_settings');
			$lng_google_maps = rwmb_meta('lng_google_maps', ['object_type' => 'setting'], 'contigo_settings');
			$contact_page_form = null;
			$page_contact = get_pages(array(
				'post_type' => 'page',
				'meta_key' => '_wp_page_template',
				'hierarchical' => 0,
				'meta_value' => 'contact.php'
			));
			if(isset($page_contact[0]->ID) && !is_page_template('contact.php'))
			{
				$contact_page_form = rwmb_meta('contact_page_form', '', $page_contact[0]->ID);
			}
			if(!empty($contact_page_form)):
		?>
		<div class="page-wraper" style="padding-bottom:0">
			<div class="container">
				<div class="page-content">
					<div class="grid-center">
						<div class="col-7_lg-6_md-12">
							<div class="contact-form">
								<?php echo do_shortcode($contact_page_form); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<footer>
			<div class="footer">
				<div class="container-fluid">
					<div class="footer-top">
						<div class="grid-middle">
							<div class="col-3_lg-4_md-6">
								<?php
									if(isset($developers_logo['ID']))
									{
										echo wp_get_attachment_image($developers_logo['ID'], 'medium');
									}
								?>
							</div>
							<div class="col-9_lg-8_md-6-bottom text-right">
								<p><a href="#top" rel="nofollow">
									<img width="55" height="55" src="<?php echo get_template_directory_uri(); ?>/img/up.svg" alt="Contigo">
								</a></p>
							</div>
						</div>
					</div>
					<div class="footer-content">
						<div class="grid-3_md-1">
							<div class="col">
								<?php if(!empty($footer_adress)): ?>
								<div class="footer-adress">
									<?php echo apply_filters('the_content', $footer_adress); ?>
								</div>
								<?php endif; ?>
							</div>
							<div class="col">
								<p class="footer-title"><?php echo __('Dział sprzedaży', 'titlia'); ?></p>
								<?php if(!empty($footer_phone)): ?>
								<p class="footer-contact"><a href="tel:<?php echo preg_replace('/\s+/', '', $footer_phone); ?>">
									<svg viewBox="0 0 3.6597 3.6601" xmlns="http://www.w3.org/2000/svg"><defs><clipPath><path transform="translate(-419.6 -2859.8)" d="m0 0h595.28v3344.9h-595.28z"/></clipPath></defs><g transform="translate(-103.19 -146.58)"><path transform="matrix(.35278 0 0 -.35278 106.07 150.24)" d="m0 0c-1.989 0-4.045 0.916-5.641 2.512l-0.032 0.034c-1.644 1.642-2.559 3.753-2.51 5.789l3e-3 0.149 0.093 0.117c0.143 0.182 0.284 0.342 0.432 0.49 0.542 0.542 1.179 0.956 1.893 1.233 0.087 0.034 0.185 0.051 0.292 0.051 0.241 0 0.783-0.123 0.92-0.503 0.243-0.674 0.551-1.557 0.775-2.404 0.065-0.245-0.011-0.818-0.33-1.019l-0.79-0.501c7e-3 -5e-3 5e-3 -0.129 0.108-0.27 0.304-0.418 0.659-0.834 1.054-1.235 0.395-0.389 0.809-0.742 1.226-1.045 0.081-0.059 0.173-0.094 0.247-0.094 0.025 0 0.041 5e-3 0.044 7e-3l0.481 0.771c0.217 0.339 0.766 0.349 0.828 0.349 0.064 0 0.121-6e-3 0.173-0.018 1.04-0.232 1.66-0.431 2.454-0.791 0.352-0.16 0.575-0.799 0.418-1.2-0.276-0.713-0.69-1.35-1.231-1.892-0.151-0.15-0.316-0.296-0.493-0.434l-0.116-0.091zm-7.292 8.164c7e-3 -1.725 0.841-3.579 2.251-4.989l0.044-0.044c1.413-1.412 3.23-2.231 4.977-2.238 0.105 0.088 0.204 0.178 0.297 0.269 0.451 0.453 0.798 0.986 1.029 1.583-5e-3 3e-3 -0.023 0.058-0.042 0.102-0.691 0.308-1.259 0.486-2.193 0.695-0.023-3e-3 -0.068-0.012-0.105-0.022l-0.448-0.708c-0.28-0.453-1.021-0.524-1.552-0.135-0.451 0.327-0.899 0.709-1.331 1.134-0.43 0.438-0.814 0.887-1.144 1.34-0.219 0.3-0.308 0.656-0.246 0.977 0.049 0.248 0.186 0.453 0.386 0.577l0.707 0.448c0.01 0.041 0.019 0.096 0.017 0.123-0.196 0.734-0.475 1.54-0.704 2.18-0.038 0.014-0.087 0.026-0.121 0.026-0.567-0.222-1.1-0.57-1.554-1.022-0.09-0.091-0.179-0.188-0.268-0.296" fill="#358a36"/></g></svg> <?php echo $footer_phone; ?>
								</a></p>
								<?php
									endif;
									if(!empty($footer_email)):
								?>
								<p class="footer-contact"><a href="mailto:<?php echo antispambot($footer_email); ?>">
									<svg version="1.1" viewBox="0 0 4.7085 3.4357" xmlns="http://www.w3.org/2000/svg"><defs><clipPath ><path transform="translate(-215.56 -145.87)" d="m0 0h595.28v3344.9h-595.28z"/></clipPath><clipPath id="b"><path transform="translate(-215.56 -146.16)" d="m0 0h595.28v3344.9h-595.28z"/></clipPath><clipPath id="a"><path transform="translate(-210.26 -148.8)" d="m0 0h595.28v3344.9h-595.28z"/></clipPath></defs><g transform="translate(-102.66 -146.84)" fill="#358a36"><path transform="matrix(.35278 0 0 -.35278 106.88 150.28)" d="m0 0h-10.596c-0.759 0-1.376 0.621-1.376 1.384v6.972c0 0.763 0.617 1.383 1.376 1.383h10.596c0.758 0 1.375-0.62 1.375-1.383v-6.972c0-0.763-0.617-1.384-1.375-1.384m-10.596 8.566c-0.115 0-0.209-0.094-0.209-0.21v-6.972c0-0.116 0.094-0.21 0.209-0.21h10.596c0.115 0 0.208 0.094 0.208 0.21v6.972c0 0.116-0.093 0.21-0.208 0.21z" clip-path="url(#c)"/><path transform="matrix(.35278 0 0 -.35278 106.88 150.18)" d="m0 0h-10.596c-0.447 0-0.853 0.283-1.012 0.704-0.043 0.114-0.011 0.243 0.079 0.323l4.136 3.71c0.12 0.108 0.304 0.098 0.411-0.023 0.108-0.121 0.097-0.307-0.023-0.415l-3.958-3.549c0.094-0.102 0.226-0.163 0.367-0.163h10.596c0.141 0 0.273 0.061 0.366 0.163l-4.003 3.591c-0.121 0.107-0.131 0.293-0.024 0.414s0.291 0.132 0.412 0.023l4.182-3.751c0.09-0.08 0.121-0.209 0.078-0.322-0.158-0.422-0.564-0.705-1.011-0.705" clip-path="url(#b)"/><path transform="matrix(.35278 0 0 -.35278 105.01 149.25)" d="m0 0c-0.07 0-0.139 0.025-0.194 0.074l-6.037 5.415c-0.09 0.081-0.122 0.209-0.079 0.323 0.16 0.421 0.565 0.704 1.012 0.704h10.596c0.447 0 0.853-0.283 1.011-0.705 0.043-0.113 0.012-0.241-0.078-0.322l-6.037-5.415c-0.055-0.049-0.125-0.074-0.194-0.074m-5.664 5.766 5.664-5.08 5.664 5.081c-0.093 0.101-0.225 0.163-0.366 0.163h-10.596c-0.141 0-0.273-0.062-0.366-0.164"/></g></svg><?php echo antispambot($footer_email); ?>
								</a></p>
								<?php
									endif;
								?>
							</div>
							<div class="col">
							<?php
								if(has_nav_menu('footer_menu'))
								{
									echo '<strong style="display:block;font-size:17px;margin-bottom:5px;">'.__('MENU', 'contigo').'</strong>';
									wp_nav_menu(array('theme_location' => 'footer_menu'));
								}
							?>
							</div>
						</div>
					</div>
					<?php if(!empty($footer_text)): ?>
					<div class="footer-bottom">
						<?php echo apply_filters('the_content', $footer_text); ?>
					</div>
					<?php endif; ?>
					<div class="footer-copyright">
						<div class="grid-2_md-1-middle">
							<div class="col">
								<p><?php echo __('Copyright ARKOP 2024 | Code & design FABRI-KA', 'contigo'); ?></p>
							</div>
							<div class="col">
								<p class="text-right"><?php the_privacy_policy_link(); ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<?php
			wp_footer();
			if(!empty($api_google_maps) && !empty($lng_google_maps) && !empty($lat_google_maps) && (is_front_page() || is_page_template('contact.php'))):
		?>
		<script>
			if(document.getElementById('map_content'))
			{
				let map;

				function initMap()
				{
					
					var lat_lng = new window.google.maps.LatLng(<?php echo $lat_google_maps; ?>, <?php echo $lng_google_maps; ?>);

					map = new google.maps.Map(document.getElementById("map_content"), {
						center: lat_lng,
						zoom: 14,
						zoomControl: true,
						mapTypeControl: false,
						scaleControl: true,
						streetViewControl: true,
						rotateControl: false,
						fullscreenControl: true
					});

					var marker = new google.maps.Marker({
						position: lat_lng,
						icon: '<?php echo get_template_directory_uri(); ?>/img/pin.png',
						map: map
					});
					
					marker.setMap(map);
				
				}

				window.initMap = initMap;
				
			}
		</script>
		<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $api_google_maps; ?>&callback=initMap&v=weekly" defer></script>
		<?php endif; ?>
	</body>
</html>
