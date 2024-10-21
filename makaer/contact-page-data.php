<?php
	/* Template name: Kontakt */
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
	$id_page = get_the_ID();
	$title = get_the_title();
	$contact_map_url = rwmb_meta('contact_map_url', '', $id_page);
	$contact_form = rwmb_meta('contact_form', '', $id_page);
	$contact_form_txt = rwmb_meta('contact_form_txt', '', $id_page);
	$email_page = rwmb_meta('email_page', ['object_type' => 'setting'], 'makaer_settings');
	$phone_page = rwmb_meta('phone_page', ['object_type' => 'setting'], 'makaer_settings');
	$adres_page = rwmb_meta('adres_page', ['object_type' => 'setting'], 'makaer_settings');
	$legal_data_page = rwmb_meta('legal_data_page', ['object_type' => 'setting'], 'makaer_settings');
?>
	<div class="hero-top position-relative" data-name="<?php echo $title; ?>">
		<div class="container">
			<div class="hero-top-content">
				<div class="page-title-content">
					<h1 class="page-title"><?php echo $title; ?></h1>
				</div>
			</div>
		</div>
	</div>
	<div class="page-wraper">
		<div class="container">
			<div class="grid-2_md-1-middle">
				<div class="col">
					<div class="page-content">
						<?php the_content(); ?>
						<div class="grid-2">
							<?php
								if(!empty($adres_page)):
							?>
							<div class="col">
								<div class="data-with-icon">				
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19.75 26.05"><g transform="translate(-7.5 0.5)"> <path d="M17.375,0A9.387,9.387,0,0,0,8,9.375c0,6.73,8.734,15.16,9.105,15.516a.387.387,0,0,0,.539,0c.371-.355,9.105-8.785,9.105-15.516A9.387,9.387,0,0,0,17.375,0Zm0,13.672a4.3,4.3,0,1,1,4.3-4.3A4.3,4.3,0,0,1,17.375,13.672Z" fill="none" stroke="#AF865B" stroke-width="1"/></g></svg> 
									<?php echo apply_filters('the_excerpt', $adres_page); ?>
								</div>
							</div>
							<?php
								endif;
								if(!empty($email_page)):
							?>
							<div class="col">
								<div class="data-with-icon">
									<span class="makaer_ico_mail"></span>
									<p><a rel="nofollow noopener" href="mailto:<?php echo antispambot($email_page); ?>"><?php echo antispambot($email_page); ?></a></p>
								</div>
							</div>
							<?php
								endif;
								if(!empty($legal_data_page)):
							?>
							<div class="col">
								<div class="data-with-icon">
									<span class="makaer_ico_info"></span>
									<?php echo apply_filters('the_excerpt', $legal_data_page); ?>
								</div>
							</div>
							<?php
								endif;
							?>
						</div>
						<?php
							if(!empty($phone_page)):
						?>
						<br/>
						<br/>
						<div class="grid-1">
							<div class="col">
								<p style="font-size:18px;line-height:28px;font-weight:700;margin-bottom:10px;"><?php echo __('Infolinia', 'makaer'); ?></p>
								<div class="data-with-icon" style="margin-bottom:5px;">
									<span class="makaer_ico_phone"></span>
									<p><a rel="nofollow noopener" href="tel:<?php echo preg_replace('/\s+/', '', $phone_page); ?>"><?php echo $phone_page; ?></a></p>
								</div>
								<p><?php echo __('pon - pt od 7:00 do 15:00', 'makaer'); ?></p>
							</div>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<?php if(!empty($contact_map_url)): ?>
				<div class="col">
					<div class="map-iframe">
						<iframe src="<?php echo esc_url($contact_map_url); ?>" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php if(!empty($contact_form)): ?>
	<div class="page-wraper position-relative page-wraper-form section-name-text" data-name="<?php echo __('Formularz kontaktowy', 'makaer'); ?> &#8213;">
		<div class="container">
			<div class="form-content">
				<div class="section-title-content text-center">
					<p class="section-subtitle" style="padding-bottom:6px;"><?php echo __('Skontaktuj się z nami!', 'makaer'); ?></p>
					<?php
						if(!empty($contact_form_txt))
						{
							echo '<div class="text-center">';
							echo apply_filters('the_excerpt', $contact_form_txt);
							echo '</div>';
						}
					?>
				</div>
				<?php
					echo do_shortcode($contact_form);
				?>
			</div>
		</div>
	</div>
<?php
	endif;
	endwhile; endif;
	get_footer();
?>