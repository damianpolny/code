<?php
	/* Template name: Oferta */
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
	$offer_item = null;
	$id_page = get_the_ID();
	$id_front_page = get_option('page_on_front');
	$email_page = rwmb_meta('email_page', '', $id_front_page);
	$email_page_one = rwmb_meta('email_page_one', '', $id_front_page);
	$email_page_two = rwmb_meta('email_page_two', '', $id_front_page);
	$page_offer_type = rwmb_meta('page_offer_type', '', $id_page);
	$offer_section_title = rwmb_meta('offer_section_title', '', $id_page);
	$offer_data_title = rwmb_meta('offer_data_title', '', $id_page);
	$page_about_us = get_pages(array(
		'post_type' => 'page',
		'meta_key' => '_wp_page_template',
		'hierarchical' => 0,
		'meta_value' => 'about-us.php'
	));
	if(isset($page_about_us[0]->ID))
	{
		if($page_offer_type == 'grzyby')
		{
			$offer_item = rwmb_meta('about_us_left_offer_item', '', $page_about_us[0]->ID);
		}
		if($page_offer_type == 'owoce')
		{
			$offer_item = rwmb_meta('about_us_right_offer_item', '', $page_about_us[0]->ID);
		}
	}
?>
		<div class="page-wraper">
			<div class="container">
				<div class="page-title-content text-center">
					<h1 class="page-title"><?php the_title(); ?></h1>
				</div>
				<?php
					if(has_post_thumbnail())
					{
						echo '<div class="page-hero-img">';
						the_post_thumbnail('large');
						echo '</div>';
					}
					the_content();
				?>
				<div class="offer-page-content page-wraper" style="padding-bottom:0">
					<div class="grid-center">
						<div class="col-10_lg-12">
							<?php
								if(!empty($offer_section_title)):
							?>
							<div class="grid">
								<div class="col-5_lg-6_md-7_sm-12">
									<div class="section-title-content">
										<p class="section-title"><?php echo $offer_section_title; ?></p>
									</div>
								</div>
							</div>
							<?php endif; if(isset($offer_item[0])): ?>
							<div class="grid-5_lg-4_md-3_sm-2_xs-1 small-grid">
								<?php foreach($offer_item as $box): ?>
								<div class="col">
									<div class="box-text-item box-text-item-outline"<?php if($page_offer_type == 'owoce'): ?> style="border: 1px solid var(--second);"<?php endif; ?>>
										<?php echo apply_filters('the_content', $box); ?>
									</div>
								</div>
								<?php endforeach; ?>
							</div>
							<?php
								endif;
								if(!empty($offer_data_title) || (!empty($email_page) && !empty($email_page_one) && !empty($email_page_two))):
							?>
							<div class="offer-page-content-contact">
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
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php
	endwhile; endif;
	get_footer();
?>