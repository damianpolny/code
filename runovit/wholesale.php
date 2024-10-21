<?php
	/* Template name: Sprzedaż hurtowa */
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
	$id_page = get_the_ID();
	$id_front_page = get_option('page_on_front');
	$email_page = rwmb_meta('email_page', '', $id_front_page);
	$email_page_one = rwmb_meta('email_page_one', '', $id_front_page);
	$email_page_two = rwmb_meta('email_page_two', '', $id_front_page);
	$page_offer_type = rwmb_meta('page_offer_type', '', $id_page);
	$offer_section_title = rwmb_meta('offer_section_title', '', $id_page);
	$offer_data_title = rwmb_meta('offer_data_title', '', $id_page);
	$offer_section_box = rwmb_meta('offer_section_box', '', $id_page);
	$page_about_us = get_pages(array(
		'post_type' => 'page',
		'meta_key' => '_wp_page_template',
		'hierarchical' => 0,
		'meta_value' => 'about-us.php'
	));
	if(isset($page_about_us[0]->ID))
	{
		$id_page = $page_about_us[0]->ID;
		$about_us_left_offer_name = rwmb_meta('about_us_left_offer_name', '', $id_page);
		$about_us_left_offer_img = rwmb_meta('about_us_left_offer_img', '', $id_page);
		$about_us_left_offer_name_url = rwmb_meta('about_us_left_offer_name_url', '', $id_page);
		$about_us_left_offer_url = rwmb_meta('about_us_left_offer_url', '', $id_page);
		$about_us_left_offer_item = rwmb_meta('about_us_left_offer_item', '', $id_page);
		$about_us_right_offer_name = rwmb_meta('about_us_right_offer_name', '', $id_page);
		$about_us_right_offer_img = rwmb_meta('about_us_right_offer_img', '', $id_page);
		$about_us_right_offer_name_url = rwmb_meta('about_us_right_offer_name_url', '', $id_page);
		$about_us_right_offer_url = rwmb_meta('about_us_right_offer_url', '', $id_page);
		$about_us_right_offer_item = rwmb_meta('about_us_right_offer_item', '', $id_page);
	}
?>
		<div class="page-wraper">
			<div class="container">
				<div class="page-title-content text-center">
					<h1 class="page-title"><?php the_title(); ?></h1>
				</div>
				<div class="grid-2_md-1-middle">
					<div class="col">
						<?php
							if(has_post_thumbnail())
							{
								echo '<p>';
								the_post_thumbnail('large');
								echo '</p>';
							}
						?>
					</div>
					<div class="col">
						<div class="grid-center">
							<div class="col-8_lg-10_md-12">
								<?php the_content(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="page-wraper">
			<div class="container">
				<div class="grid-noGutter undergrowth-bg">
					<div class="shop-left">
						<?php if(!empty($offer_section_title)): ?>
						<div class="section-title-content">
							<p class="section-title"><?php echo $offer_section_title; ?></p>
						</div>
						<?php endif; ?>
					</div>
					<?php if(isset($offer_section_box[0])): ?>
					<div class="shop-right shop-right-padding-left">
						<div class="grid-3_md-2_xs-1 small-grid">
							<?php foreach($offer_section_box as $item): ?>
							<div class="col">
								<div class="box-text-item">
									<?php echo apply_filters('the_content', $item); ?>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
					<?php endif; ?>
				</div>
				<?php
					if(!empty($offer_data_title) || (!empty($email_page) && !empty($email_page_one) && !empty($email_page_two))):
				?>
				<div class="offer-page-content page-wraper" style="padding-top:0;padding-bottom:0">
					<div class="grid-center">
						<div class="col-10_lg-12">
							<div class="offer-page-content-contact" style="border: 1px solid var(--second);">
								<?php
									if(!empty($offer_data_title)):
								?>
								<div class="section-title-content text-center">
									<p class="section-title"><?php echo $offer_data_title; ?></p>
								</div>
								<?php
									endif;
									if(!empty($email_page) && !empty($email_page_one) && !empty($email_page_two)):
								?>
								<div class="grid-middle-noGutter-spaceBetween">
									<div class="data-with-icon">
										<span class="runovit_ico_mail"></span>
										<p><a rel="nofollow noopener" class="default-color" href="mailto:<?php echo antispambot($email_page); ?>"><?php echo antispambot($email_page); ?></a></p>
									</div>
									<div class="data-with-icon">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23 23"> <g transform="translate(-280.153 -5571.153)"> <ellipse cx="11.5" cy="11.423" rx="11.5" ry="11.423" transform="translate(280.153 5571.153)" fill="#fff"/> <path id="Path_3766" data-name="Path 3766" d="M23,7A11.331,11.331,0,0,1,11.5,18.153,11.331,11.331,0,0,1,0,7Z" transform="translate(280.153 5576)" fill="#d80027"/> </g> </svg>
										<p><a rel="nofollow noopener" class="default-color" href="tel:<?php echo preg_replace('/\s+/', '', $email_page_one); ?>"><?php echo $email_page_one; ?></a></p>
									</div>
									<div class="data-with-icon">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23 23"> <g transform="translate(-4472.202 235.923)"> <ellipse cx="11.5" cy="11.423" rx="11.5" ry="11.423" transform="translate(4472.202 -235.923)" fill="#fff"/> <g transform="translate(4472.252 -236.107)"> <g transform="translate(-0.05 0.183)"> <path d="M11.5,0A11.5,11.5,0,1,1,0,11.5,11.5,11.5,0,0,1,11.5,0" transform="translate(0 0)" fill="#f0f0f0"/> <path d="M10.8,100.142a11.458,11.458,0,0,0-1.981,4H14.8Z" transform="translate(-8.423 -95.643)" fill="#09356b"/> <path d="M375.988,104.144a11.457,11.457,0,0,0-1.981-4l-4,4Z" transform="translate(-353.384 -95.644)" fill="#09356b"/> <path d="M8.819,322.784a11.457,11.457,0,0,0,1.981,4l4-4Z" transform="translate(-8.423 -308.284)" fill="#09356b"/> <path d="M326.784,10.8a11.459,11.459,0,0,0-4-1.981V14.8Z" transform="translate(-308.282 -8.423)" fill="#09356b"/> <path d="M100.142,374.006a11.459,11.459,0,0,0,4,1.981v-5.982Z" transform="translate(-95.643 -353.384)" fill="#09356b"/> <path d="M104.143,8.819a11.459,11.459,0,0,0-4,1.981l4,4Z" transform="translate(-95.643 -8.423)" fill="#09356b"/> <path d="M322.783,375.988a11.459,11.459,0,0,0,4-1.981l-4-4Z" transform="translate(-308.283 -353.384)" fill="#09356b"/> <path d="M370.005,322.784l4,4a11.456,11.456,0,0,0,1.981-4Z" transform="translate(-353.384 -308.284)" fill="#09356b"/> <path d="M22.9,10H13V.1a11.606,11.606,0,0,0-3,0V10H.1a11.606,11.606,0,0,0,0,3H10v9.9a11.606,11.606,0,0,0,3,0V13h9.9a11.606,11.606,0,0,0,0-3" transform="translate(0 0)" fill="#d80027"/> <path d="M322.783,322.783l5.132,5.132q.354-.354.676-.738l-4.393-4.393h-1.414Z" transform="translate(-308.283 -308.283)" fill="#d80027"/> <path d="M80.112,322.784h0l-5.132,5.132q.354.354.738.676l4.393-4.394Z" transform="translate(-71.612 -308.284)" fill="#d80027"/> <path d="M65.741,80.112h0L60.609,74.98q-.354.354-.676.738l4.394,4.393h1.414Z" transform="translate(-57.241 -71.612)" fill="#d80027"/> <path d="M322.783,65.742l5.132-5.132q-.354-.354-.738-.676l-4.393,4.393Z" transform="translate(-308.283 -57.242)" fill="#d80027"/> </g> </g> </g> </svg> 
										<p><a rel="nofollow noopener" class="default-color" href="tel:<?php echo preg_replace('/\s+/', '', $email_page_two); ?>"><?php echo $email_page_two; ?></a></p>
									</div>
								</div>
							<?php
								endif;
							?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php endif; if((!empty($about_us_left_offer_name) && isset($about_us_left_offer_img['ID'])) || (!empty($about_us_right_offer_name) && isset($about_us_right_offer_img['ID']))): ?>
		<div class="page-wraper" style="background-color:#FFFBF5;">
			<div class="about-us-page-offer">
				<div class="container">
					<div class="grid">
						<div class="col-7_lg-6_md-12">
							<?php if((!empty($about_us_left_offer_name) && isset($about_us_left_offer_img['ID']))): ?>
							<div class="about-us-page-offer-left">
								<div class="grid">
									<div class="col-6_lg-12">
										<div class="section-title-content">
											<p class="section-title"><?php echo $about_us_left_offer_name; ?></p>
										</div>
									</div>
								</div>
								<?php if(isset($about_us_left_offer_item[0])): ?>
								<div class="grid-3_md-2_xs-1 small-grid">
									<?php foreach($about_us_left_offer_item as $box): ?>
									<div class="col">
										<div class="box-text-item box-text-item-outline">
											<?php echo apply_filters('the_content', $box); ?>
										</div>
									</div>
									<?php endforeach; ?>
								</div>
								<?php endif; ?>
								<p style="margin-top:25px"><?php echo wp_get_attachment_image($about_us_left_offer_img['ID'], 'large'); ?></p>
								<?php if(isset($about_us_left_offer_url[0]) && !empty($about_us_left_offer_name_url)): ?>
								<div class="grid-2_sm-1">
									<div class="col">
										<div class="section-title-content" style="margin-bottom:15px;">
											<p class="section-title" style="font-size:21px;line-height:30px"><?php echo $about_us_left_offer_name_url; ?></p>
										</div>
									</div>
									<div class="col">
										<?php
											foreach($about_us_left_offer_url as $url):
											if(isset($url['about_us_left_offer_url_name']) && isset($url['about_us_left_offer_url_url'])):
										?>
										<div style="display:inline-block;padding:0 5px 7px 0">
											<a class="button button-fill" href="<?php echo esc_url($url['about_us_left_offer_url_url']); ?>"><?php echo $url['about_us_left_offer_url_name']; ?></a>
										</div>
										<?php
											endif;
											endforeach;
										?>
									</div>
								</div>
								<?php endif; ?>
							</div>
							<?php endif; ?>
						</div>
						<div class="col-5_lg-6_md-12">
							<?php if(!empty($about_us_right_offer_name) && isset($about_us_right_offer_img['ID'])): ?>
							<div class="about-us-page-offer-right">
								<p><?php echo wp_get_attachment_image($about_us_right_offer_img['ID'], 'large'); ?></p>
								<div class="section-title-content">
									<p class="section-title"><?php echo $about_us_right_offer_name; ?></p>
								</div>
								<?php if(isset($about_us_right_offer_item[0])): ?>
								<div class="grid-2_xs-1 small-grid">
									<?php foreach($about_us_right_offer_item as $box): ?>
									<div class="col">
										<div class="box-text-item box-text-item-outline" style="border: 1px solid var(--second);">
											<?php echo apply_filters('the_content', $box); ?>
										</div>
									</div>
									<?php endforeach; ?>
								</div>
								<?php endif; ?>
								<?php if(isset($about_us_right_offer_url[0]) && !empty($about_us_right_offer_name_url)): ?>
								<div class="grid-1">
									<div class="col">
										<div class="section-title-content" style="margin-bottom:15px;padding-top:25px;">
											<p class="section-title" style="font-size:21px;line-height:30px"><?php echo $about_us_right_offer_name_url; ?></p>
										</div>
									</div>
									<div class="col">
										<?php
											foreach($about_us_right_offer_url as $url):
											if(isset($url['about_us_right_offer_url_name']) && isset($url['about_us_right_offer_url_url'])):
										?>
										<div style="display:inline-block;padding:0 5px 7px 0">
											<a class="button button-fill-yellow" href="<?php echo esc_url($url['about_us_right_offer_url_url']); ?>"><?php echo $url['about_us_right_offer_url_name']; ?></a>
										</div>
										<?php
											endif;
											endforeach;
										?>
									</div>
								</div>
								<?php endif; ?>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php
	endif;
	endwhile; endif;
	get_footer();
?>