<?php
	/* Template name: O nas */
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
	$id_page = get_the_ID();
	$id_front_page = get_option('page_on_front');
	$about_us_icon = rwmb_meta('about_us_icon', '', $id_page);
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
	$home_section_two = rwmb_meta('home_section_two', '', $id_front_page);
	$home_section_img_two = rwmb_meta('home_section_img_two', '', $id_front_page);
?>
		<div class="page-wraper">
			<div class="container">
				<?php
					if(has_post_thumbnail())
					{
						echo '<div class="page-hero-img">';
						the_post_thumbnail('large');
						echo '</div>';
					}
				?>
				<div class="section-with-icon">
					<?php
						if(isset($about_us_icon['ID'])):
					?>
					<div class="section-with-icon-icon">
						<?php echo wp_get_attachment_image($about_us_icon['ID'], 'medium'); ?>
					</div>
					<?php endif; ?>
					<div class="section-with-icon-text">
						<div>
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php if((!empty($about_us_left_offer_name) && isset($about_us_left_offer_img['ID'])) || (!empty($about_us_right_offer_name) && isset($about_us_right_offer_img['ID']))): ?>
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
			if(!empty($home_section_two) || isset($home_section_img_two['ID'])):
		?>
		<div class="page-wraper" style="background-color:#FFFBF5;">
			<div class="section-medium-text">
				<div class="section-medium-text-img"<?php if(isset($home_section_img_two['ID'])): ?> style="background-image: url(<?php echo wp_get_attachment_image_url($home_section_img_two['ID'], 'full'); ?>);background-position:center;background-size:cover;background-repeat:no-repeat;"<?php endif; ?>></div>
				<?php if(!empty($home_section_two)): ?>
				<div class="container">
					<div class="section-medium-text-content">
						<?php
							echo apply_filters('the_content', $home_section_two);
							if(is_active_sidebar('newsletter_widget'))
							{
								dynamic_sidebar('newsletter_widget');
							}
						?>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
<?php
	endif;
	endwhile; endif;
	get_footer();
?>