<?php
	/* Template name: Kontakt */
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
	$id_front_page = get_option('page_on_front');
	$id_page = get_the_ID();
	$contact_form = rwmb_meta('contact_form', '', $id_page);
	$url_map = rwmb_meta('url_map', '', $id_page);
	$email_page = rwmb_meta('email_page', '', $id_front_page);
	$email_page_one = rwmb_meta('email_page_one', '', $id_front_page);
	$email_page_two = rwmb_meta('email_page_two', '', $id_front_page);
	$adress_page = rwmb_meta('adress_page', '', $id_front_page);
	$nip_page = rwmb_meta('nip_page', '', $id_front_page);
?>
		<div class="page-wraper">
			<div class="container">
				<div class="section-contact">
					<div class="grid-2_md-1">
						<div class="col">
							<?php if(!empty($contact_form)): ?>
							<div class="section-title-content">
								<p class="section-title" style="font-size:40px;line-height:50px;"><?php echo __('Napisz do nas!', 'runovit'); ?></p>
							</div>
							<?php echo do_shortcode($contact_form); endif; ?>
						</div>
						<div class="col">
							<div class="section-contact-text">
								<?php
									the_content();
									if(!empty($email_page_one)):
								?>
								<div class="data-with-icon">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23 23"> <g transform="translate(-280.153 -5571.153)"> <ellipse cx="11.5" cy="11.423" rx="11.5" ry="11.423" transform="translate(280.153 5571.153)" fill="#fff"/> <path id="Path_3766" data-name="Path 3766" d="M23,7A11.331,11.331,0,0,1,11.5,18.153,11.331,11.331,0,0,1,0,7Z" transform="translate(280.153 5576)" fill="#d80027"/> </g> </svg>
									<p><a rel="nofollow noopener" href="tel:<?php echo preg_replace('/\s+/', '', $email_page_one); ?>"><?php echo $email_page_one; ?></a></p>
								</div>
								<?php
									endif;
									if(!empty($email_page_two)):
								?>
								<div class="data-with-icon">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23 23"> <g transform="translate(-4472.202 235.923)"> <ellipse cx="11.5" cy="11.423" rx="11.5" ry="11.423" transform="translate(4472.202 -235.923)" fill="#fff"/> <g transform="translate(4472.252 -236.107)"> <g transform="translate(-0.05 0.183)"> <path d="M11.5,0A11.5,11.5,0,1,1,0,11.5,11.5,11.5,0,0,1,11.5,0" transform="translate(0 0)" fill="#f0f0f0"/> <path d="M10.8,100.142a11.458,11.458,0,0,0-1.981,4H14.8Z" transform="translate(-8.423 -95.643)" fill="#09356b"/> <path d="M375.988,104.144a11.457,11.457,0,0,0-1.981-4l-4,4Z" transform="translate(-353.384 -95.644)" fill="#09356b"/> <path d="M8.819,322.784a11.457,11.457,0,0,0,1.981,4l4-4Z" transform="translate(-8.423 -308.284)" fill="#09356b"/> <path d="M326.784,10.8a11.459,11.459,0,0,0-4-1.981V14.8Z" transform="translate(-308.282 -8.423)" fill="#09356b"/> <path d="M100.142,374.006a11.459,11.459,0,0,0,4,1.981v-5.982Z" transform="translate(-95.643 -353.384)" fill="#09356b"/> <path d="M104.143,8.819a11.459,11.459,0,0,0-4,1.981l4,4Z" transform="translate(-95.643 -8.423)" fill="#09356b"/> <path d="M322.783,375.988a11.459,11.459,0,0,0,4-1.981l-4-4Z" transform="translate(-308.283 -353.384)" fill="#09356b"/> <path d="M370.005,322.784l4,4a11.456,11.456,0,0,0,1.981-4Z" transform="translate(-353.384 -308.284)" fill="#09356b"/> <path d="M22.9,10H13V.1a11.606,11.606,0,0,0-3,0V10H.1a11.606,11.606,0,0,0,0,3H10v9.9a11.606,11.606,0,0,0,3,0V13h9.9a11.606,11.606,0,0,0,0-3" transform="translate(0 0)" fill="#d80027"/> <path d="M322.783,322.783l5.132,5.132q.354-.354.676-.738l-4.393-4.393h-1.414Z" transform="translate(-308.283 -308.283)" fill="#d80027"/> <path d="M80.112,322.784h0l-5.132,5.132q.354.354.738.676l4.393-4.394Z" transform="translate(-71.612 -308.284)" fill="#d80027"/> <path d="M65.741,80.112h0L60.609,74.98q-.354.354-.676.738l4.394,4.393h1.414Z" transform="translate(-57.241 -71.612)" fill="#d80027"/> <path d="M322.783,65.742l5.132-5.132q-.354-.354-.738-.676l-4.393,4.393Z" transform="translate(-308.283 -57.242)" fill="#d80027"/> </g> </g> </g> </svg> 
									<p><a rel="nofollow noopener" href="tel:<?php echo preg_replace('/\s+/', '', $email_page_two); ?>"><?php echo $email_page_two; ?></a></p>
								</div>
								<?php
									endif;
									if(!empty($email_page)):
								?>
								<div class="data-with-icon">
									<span class="extra_cart_ico_extra_mail"></span>
									<p><a rel="nofollow noopener" href="mailto:<?php echo antispambot($email_page); ?>"><?php echo antispambot($email_page); ?></a></p>
								</div>
								<?php endif; ?>
								<div>
									<a href="<?php echo get_url_for_slug('o-nas/sprzedaz-hurtowa'); ?>" class="read-more"><?php echo __('Sprzedaż hurtowa', 'runovit'); ?> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.274 26.548"> <path d="M287.518,460.284l-11.86,11.86L287.518,484" transform="translate(-274.658 -458.869)" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path> </svg></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
					if(!empty($url_map)):
				?>
				<div class="map-content">
					<?php if(!empty($adress_page) || !empty($nip_page)): ?>
					<div class="map-content-text">
						<div class="section-title-content">
							<p class="section-title"><?php echo __('Runovit Leśne Grzyby i Owoce', 'runovit'); ?></p>
						</div>
						<?php if(!empty($adress_page)): ?>
						<div class="data-with-icon">
							<span class="runovit_ico_pin"></span>
							<p><?php echo $adress_page; ?></p>
						</div>
						<?php
							endif;
							if(!empty($nip_page)):
						?>
						<div class="data-with-icon">
							<span class="runovit_ico_info"></span>
							<p><?php echo $nip_page; ?></p>
						</div>
						<?php
							endif;
						?>
					</div>
					<?php endif; ?>
					<iframe src="<?php echo esc_url($url_map); ?>" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
				<?php
					endif;
				?>
			</div>
		</div>
<?php 
	endwhile; endif;
	get_footer();
?>