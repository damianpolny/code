		<?php
			$custom_logo_id = get_theme_mod('custom_logo');
			$id_front_page = get_option('page_on_front');
			$footer_slogan = rwmb_meta('footer_slogan', '', $id_front_page);
			$contact_box = rwmb_meta('contact_box', '', $id_front_page);
			$form_shortcode = rwmb_meta('form_shortcode', ['object_type' => 'setting'], 'goldenrocket_settings');
			$facebook_url = rwmb_meta('facebook_url', ['object_type' => 'setting'], 'goldenrocket_settings');
			$instagram_url = rwmb_meta('instagram_url', ['object_type' => 'setting'], 'goldenrocket_settings');
			$linkedin_url = rwmb_meta('linkedin_url', ['object_type' => 'setting'], 'goldenrocket_settings');
			$tiktok_url = rwmb_meta('tiktok_url', ['object_type' => 'setting'], 'goldenrocket_settings');
			$footer_adress = rwmb_meta('footer_adress', ['object_type' => 'setting'], 'goldenrocket_settings');
			$page_coordinates = rwmb_meta('page_coordinates', ['object_type' => 'setting'], 'goldenrocket_settings');
		?>
		<div class="form-section-separator"></div>
		<div class="form-section position-relative" id="contact">
			<div class="lazy lazy-content" data-bg="<?php echo get_template_directory_uri(); ?>/img/sky_stars_nebula.webp"></div>
			<div class="container">
				<div class="grid-center">
					<div class="col-9_lg-12">
						<?php if(!empty($form_shortcode)): ?>
						<div class="form-section-content fade-up">
							<div class="section-title-content">
								<p class="section-subtitle"><?php echo __('CZEKAMY NA POLECENIE', 'goldenrocket'); ?></p>
								<p class="section-title"><span id="contact_title_type"></span><span id="contact_title_type_cursor"> |</span></p>
							</div>
							<?php echo do_shortcode($form_shortcode); ?>
						</div>
						<?php
							endif;
							if(!empty($contact_box)):
						?>
						<div class="form-section-content">
							<div class="section-title-content fade-up">
								<p class="section-title"><?php echo __('Kontakt', 'goldenrocket'); ?></p>
							</div>
							<div class="grid-2_sm-1">
								<?php
									foreach($contact_box as $item):
								?>
								<div class="col">
									<div class="form-section-box fade-up">
										<?php echo apply_filters('the_content', $item); ?>
									</div>
								</div>
								<?php 
									endforeach;
								?>
							</div>
						</div>
						<?php
							endif;
						?>
					</div>
				</div>
			</div>
			<div class="container" style="z-index:5;">
				<div class="form-section-globe">
					<?php if(!empty($page_coordinates)): ?>
					<div class="form-section-globe-content fade-up">
						<p><span><?php echo __('Współrzędne geograficzne', 'goldenrocket'); ?></span></p>
						<?php echo apply_filters('the_content', $page_coordinates); ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<footer>
			<div class="footer">
				<div class="container-medium">
					<div class="footer-content">
						<div class="grid-4_md-2_xs-1">
							<div class="col">
								<?php if(is_numeric($custom_logo_id)): ?>
								<div class="footer-logo">
									<?php echo wp_get_attachment_image($custom_logo_id, 'medium'); ?>
								</div>
								<?php
									endif;
									if(!empty($footer_slogan))
									{
										echo '<p class="footer-slogan">'.$footer_slogan.'</p>';
									}
								?>
								<div class="footer-name"><?php echo __('ODWIEDŹ NAS NA', 'goldenrocket'); ?></div>
								<?php
									if(!empty($facebook_url) || !empty($instagram_url) || !empty($linkedin_url) || !empty($tiktok_url)):
								?>
								<ul class="icon-with-url">
									<?php if(!empty($facebook_url)): ?>
									<li><a href="<?php echo esc_url($facebook_url); ?>" rel="nofollow noopener"><i class="fa-brands fa-facebook-f"></i></a></li>
									<?php
										endif;
										if(!empty($instagram_url)):
									?>
									<li><a href="<?php echo esc_url($instagram_url); ?>" rel="nofollow noopener"><i class="fa-brands fa-instagram"></i></a></li>
									<?php
										endif;
										if(!empty($linkedin_url)):
									?>
									<li><a href="<?php echo esc_url($linkedin_url); ?>" rel="nofollow noopener"><i class="fa-brands fa-linkedin-in"></i></a></li>
									<?php
										endif;
										if(!empty($tiktok_url)):
									?>
									<li><a href="<?php echo esc_url($tiktok_url); ?>" rel="nofollow noopener"><i class="fa-brands fa-tiktok"></i></a></li>
									<?php
										endif;
									?>
								</ul>
								<?php
									endif;
								?>
							</div>
							<div class="col">
							<?php
								if(has_nav_menu('footer_menu_one')):
							?>
							<div class="footer-menu">
								<div class="footer-name"><?php echo wp_get_nav_menu_name('footer_menu_one'); ?></div>
								<?php wp_nav_menu(array('theme_location' => 'footer_menu_one')); ?>
							</div>
							<?php
								endif;
							?>
							</div>
							<div class="col">
							<?php
								if(has_nav_menu('footer_menu_two')):
							?>
							<div class="footer-menu">
								<div class="footer-name"><?php echo wp_get_nav_menu_name('footer_menu_two'); ?></div>
								<?php wp_nav_menu(array('theme_location' => 'footer_menu_two')); ?>
							</div>
							<?php
								endif;
							?>
							</div>
							<div class="col">
								<?php if(!empty($footer_adress)): ?>
								<div class="footer-name"><?php echo __('DANE KONTAKTOWE', 'goldenrocket'); ?></div>
								<div class="footer-adress">
									<strong class="name"><?php echo __('BIURO', 'goldenrocket'); ?></strong>
									<?php echo apply_filters('the_content', $footer_adress); ?>
								</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>
