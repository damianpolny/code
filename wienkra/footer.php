		<?php
			$id_front_page = get_option('page_on_front');
			$logo_footer = rwmb_meta('logo_footer', ['object_type' => 'setting'], 'wienkra_settings');
			$facebook_page = rwmb_meta('facebook_page', ['object_type' => 'setting'], 'wienkra_settings');
			$linkedin_page = rwmb_meta('linkedin_page', ['object_type' => 'setting'], 'wienkra_settings');
			$youtube_page = rwmb_meta('youtube_page', ['object_type' => 'setting'], 'wienkra_settings');
			$api_google_maps = rwmb_meta('api_google_maps', ['object_type' => 'setting'], 'wienkra_settings');
			$group_marker_google_maps = rwmb_meta('group_marker_google_maps', ['object_type' => 'setting'], 'wienkra_settings');
			$footer_text = rwmb_meta('footer_text', '', $id_front_page);
			$footer_data_contact = rwmb_meta('footer_data_contact', '', $id_front_page);
		?>
		<footer>
			<div class="footer">
				<div class="container">
					<div class="grid-noGutter">
						<div class="footer-left">
							<?php if(isset($logo_footer['ID'])): ?>
							<div class="footer-logo">
								<?php echo wp_get_attachment_image($logo_footer['ID'], 'medium'); ?>
							</div>
							<?php 
								endif;
								if(!empty($facebook_page) || !empty($linkedin_page) || !empty($youtube_page)):
							?>
							<ul class="icon-with-url">
								<?php if(!empty($facebook_page)): ?>
								<li><a href="<?php echo esc_url($facebook_page); ?>" rel="nofollow noopener" aria-label="Facebook"><span class="wienkra_icon_facebook"></span></a></li>
								<?php
									endif;
									if(!empty($youtube_page)):
								?>
								<li><a href="<?php echo esc_url($youtube_page); ?>" rel="nofollow noopener" aria-label="YouTube"><span class="wienkra_icon_youtube"></span></a></li>
								<?php
									endif;
									if(!empty($linkedin_page)):
								?>
								<li><a href="<?php echo esc_url($linkedin_page); ?>" rel="nofollow noopener" aria-label="Linkedin"><span class="wienkra_icon_linkedin"></span></a></li>
								<?php
									endif;
								?>
							</ul>
							<?php 
								endif;
							?>
						</div>
						<div class="footer-right">
							<div class="grid">
								<div class="col-5_lg-6_md-12">
									<?php if(!empty($footer_data_contact)): ?>
									<div class="footer-contact">
										<?php echo apply_filters("the_content", $footer_data_contact); ?>
									</div>
									<?php endif; ?>
								</div>
								<div class="col-7_lg-6_md-12">
									<div class="footer-search">
										<?php echo get_search_form(); ?>
									</div>
									<?php if(!empty($footer_text)): ?>
									<div class="footer-text">
										<?php echo apply_filters("the_content", $footer_text); ?>
									</div>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
					<?php
					if(has_nav_menu('footer_menu'))
					{
						echo '<div class="footer-menu">';
						wp_nav_menu( array('theme_location' => 'footer_menu', 'depth' => 1));
						echo '</div>';
					}
					?>
<p class="footer-copyright text-center">
    &copy; <?php echo date('Y'); ?> <?php _e("przez Wienkra. Wszelkie prawa zastrzeżone.", "wienkra"); ?>
</p>
				</div>
			</div>
		</footer>
		<?php 
			wp_footer();
			if(!empty($api_google_maps) && isset($group_marker_google_maps[0]) && is_page_template('contact-data.php')):
		?>
		<script>
			function initMap()
			{
				var locations = [
					<?php
						foreach($group_marker_google_maps as $single):
						if(isset($single['map_marker_name']) && isset($single['map_lat']) && isset($single['map_lng'])):
					?>
					['<?php echo $single['map_marker_name']; ?>', <?php echo $single['map_lat']; ?>, <?php echo $single['map_lng']; ?>],
					<?php
						endif;
						endforeach;
					?>
				];
				
				var marker, i;
				
				var map_pin = '<?php echo get_template_directory_uri(); ?>/img/pin.webp';
				
				var popup = new google.maps.InfoWindow();
				
				var bounds = new google.maps.LatLngBounds();
	
				const myLatLng = {lat:52.0688233,lng:19.4602607};
				const map = new google.maps.Map(document.getElementById("map-content"), {
					zoom: 6,
					center: myLatLng,
					zoomControl: true,
					mapTypeControl: false,
					scaleControl: true,
					streetViewControl: true,
					rotateControl: false,
					fullscreenControl: true
				});
								
				for (i = 0; i < locations.length; i++)
				{  
					marker = new google.maps.Marker({
						position: new google.maps.LatLng(locations[i][1], locations[i][2]),
						map: map,
						icon: map_pin
					});
					
					bounds.extend(marker.position);
					
					google.maps.event.addListener(marker, 'click', (function(marker, i) {
						return function() {
							popup.setContent(locations[i][0]);
							popup.open(map, marker);
						}
					})(marker, i));
				}
				
				map.fitBounds(bounds);

			}
			window.initMap = initMap;
		</script>
		<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $api_google_maps; ?>&callback=initMap&v=weekly" defer></script>
		<?php endif; ?>
	</body>
</html>
