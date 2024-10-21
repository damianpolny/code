<?php

get_header();
$id_front_page = get_option('page_on_front');
$the_content = get_the_content('', '', $id_front_page);
$slider_front_page = rwmb_meta('slider_front_page', '', $id_front_page);
$home_box_featured = rwmb_meta('home_box_featured', '', $id_front_page);
$home_section_one = rwmb_meta('home_section_one', '', $id_front_page);
$home_section_img_one = rwmb_meta('home_section_img_one', '', $id_front_page);
$home_section_box = rwmb_meta('home_section_box', '', $id_front_page);
$home_section_two = rwmb_meta('home_section_two', '', $id_front_page);
$home_section_img_two = rwmb_meta('home_section_img_two', '', $id_front_page);
$home_box_offer = rwmb_meta('home_box_offer', '', $id_front_page);
$featured_product_args = null;
if(class_exists('WooCommerce'))
{
	$ids = wc_get_featured_product_ids();
	if(!empty($ids) && is_array($ids))
	{
		$featured_product_args = array (
			'post_type' => 'product',
			'posts_per_page' => 12,
			'orderby' => 'rand',
			'post_status' => 'publish',
			'ignore_sticky_posts' => true,
			'post__in' => wc_get_featured_product_ids(),
		);
	}
}
$featured_product = new WP_Query($featured_product_args);
?>
<div class="page-wraper" style="background-color: var(--green);">
	<div class="container">
		<div class="swiper" id="slider_homepage">
			<div class="swiper-wrapper">
				<div class="swiper-slide">
					<div class="slider-top-item">
						<div class="grid-2_md-1-middle">
							<div class="col-bottom">
								<p style="font-family:'Lora';font-size:50px;color:#a2a79d;">01</p>
								<h1 class="slider-top-name">RunoVit <span>leśne</span> grzyby i owoce</h1>
								<?php echo apply_filters('the_content', $the_content); ?>
								<ul class="list-link">
									<li>
										<a href="<?php echo get_term_link('grzyby-suszone', 'product_cat'); ?>" class="read-more"><?php echo __('Grzyby', 'runovit'); ?> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.274 26.548"> <path d="M287.518,460.284l-11.86,11.86L287.518,484" transform="translate(-274.658 -458.869)" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path> </svg></a>
									</li>
									<li>
										<a href="<?php echo get_term_link('owoce-suszone', 'product_cat'); ?>" class="read-more"><?php echo __('Owoce', 'runovit'); ?> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.274 26.548"> <path d="M287.518,460.284l-11.86,11.86L287.518,484" transform="translate(-274.658 -458.869)" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path> </svg></a>
									</li>
									<li>
										<a href="<?php echo get_term_link('przetwory', 'product_cat'); ?>" class="read-more"><?php echo __('Przetwory', 'runovit'); ?> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.274 26.548"> <path d="M287.518,460.284l-11.86,11.86L287.518,484" transform="translate(-274.658 -458.869)" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path> </svg></a>
									</li>
								</ul>
							</div>
							<div class="col">
								<div class="grid">
									<div class="col-7_sm-12">
										<?php
											if(has_post_thumbnail())
											{
												the_post_thumbnail('large');
											}
										?>
									</div>
									<div class="col-5_sm-12">
										<p style="margin-bottom:40px;"><img width="208" height="312" src="<?php echo get_template_directory_uri(); ?>/img/podgrzybek.webp" alt="RunoVit"></p>
										<p style="margin-bottom:10px;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="50.768" height="45.114" viewBox="0 0 50.768 45.114"> <defs> <clipPath id="clip-path"><rect width="50.768" height="45.114" fill="#eb9c07"/> </clipPath> </defs> <g clip-path="url(#clip-path)"><path d="M24.564,132.229a1.166,1.166,0,0,0-.884-1.389l-.94-.21c-1.1-.249-2.469-.56-3.793-.8a4.761,4.761,0,0,0-.607-.1l-.065-.008a2.338,2.338,0,0,1-.27-.045,1.423,1.423,0,0,0-.267-.044,5.846,5.846,0,0,0-.624-.067c-.132-.01-.27-.021-.4-.034a6.86,6.86,0,0,0-.7-.046h-.833a14.992,14.992,0,0,0-1.838.079,4.818,4.818,0,0,0-.631.054l-.032,0a1.711,1.711,0,0,1-.238.022,3.939,3.939,0,0,0-1.019.174c-1.147.195-2.216.442-3.251.682l-.042.01c-2.236.517-4.168.964-4.977.316-.542-.431-.817-1.514-.817-3.221,0-4.825,3.872-9.114,9.416-10.43a1.167,1.167,0,0,0,.334-2.132,1.136,1.136,0,0,0-.87-.133C4.609,116.472,0,121.692,0,127.6c0,2.523.539,4.126,1.7,5.045a4.17,4.17,0,0,0,2.7.819,20.334,20.334,0,0,0,4.283-.7l.067-.015c.983-.228,2-.464,3.209-.677l.034-.008a2.2,2.2,0,0,1,.506-.1,4.262,4.262,0,0,0,.527-.045l.024,0a3.255,3.255,0,0,1,.42-.036h.016a13.432,13.432,0,0,1,1.671-.072h.857c.138,0,.285.015.428.029l.04,0c.206.021.437.044.8.067l.015,0a2.421,2.421,0,0,0,.271.046c.147.03.3.054.5.078a3.018,3.018,0,0,1,.4.068c1.344.246,2.636.539,3.776.8l.948.212a1.155,1.155,0,0,0,1.388-.885" transform="translate(0 -104.875)" fill="#eb9c07"/> <path d="M107.606,323.423h0a1.18,1.18,0,0,0-1.259-1.059,1.166,1.166,0,0,0-1.06,1.26,34.406,34.406,0,0,0,1.54,7.613,4.517,4.517,0,0,1,.125,2.42,4.275,4.275,0,0,1-3.376,3.255,4.354,4.354,0,0,1-5.184-4.248,3.784,3.784,0,0,1,.19-1.171,55.532,55.532,0,0,0,1.6-7.9,1.164,1.164,0,0,0-1-1.3,1.13,1.13,0,0,0-.845.222,1.18,1.18,0,0,0-.463.786,52.973,52.973,0,0,1-1.513,7.519,5.975,5.975,0,0,0-.29,1.85,6.531,6.531,0,0,0,.12,1.23,6.7,6.7,0,0,0,6.563,5.42,6.766,6.766,0,0,0,1.268-.122,6.6,6.6,0,0,0,5.208-5.031,6.825,6.825,0,0,0-.186-3.659,32.138,32.138,0,0,1-1.431-7.086" transform="translate(-87.703 -294.233)" fill="#eb9c07"/> <path d="M162.767,0c-10.551,0-19.134,7.462-19.134,16.634,0,3.122.651,5.1,2.05,6.21a4.959,4.959,0,0,0,3.252.993,25.965,25.965,0,0,0,5.433-.89l.01,0c.8-.184,1.695-.39,2.621-.578a56.576,56.576,0,0,1-2.157,12.341,8.782,8.782,0,0,0-.27,2.164,8.256,8.256,0,0,0,8.255,8.243h.011a8.233,8.233,0,0,0,8.015-6.331,8,8,0,0,0-.27-4.645,36.9,36.9,0,0,1-2.127-11.788c.949.191,1.876.4,2.7.593l.009,0a25.946,25.946,0,0,0,5.432.89,4.968,4.968,0,0,0,3.256-.992c1.4-1.114,2.05-3.088,2.05-6.21C181.9,7.462,173.318,0,162.767,0m-5.681,35.321a58.7,58.7,0,0,0,2.27-13.363,23.028,23.028,0,0,1,6.768-.007A39.213,39.213,0,0,0,168.4,34.929a5.7,5.7,0,0,1,.193,3.31,5.913,5.913,0,0,1-5.754,4.546h-.009a5.935,5.935,0,0,1-5.926-5.917,6.5,6.5,0,0,1,.186-1.548m.951-15.537a1.152,1.152,0,0,0-.2.055c-1.419.246-2.78.559-3.989.838-2.975.685-5.544,1.276-6.713.346-.789-.627-1.172-2.063-1.172-4.389,0-7.888,7.539-14.305,16.806-14.305s16.806,6.417,16.806,14.305c0,2.326-.383,3.761-1.172,4.389-1.17.934-3.743.34-6.723-.348-1.2-.276-2.56-.589-3.978-.835a1.123,1.123,0,0,0-.2-.055,27.51,27.51,0,0,0-9.462,0" transform="translate(-131.133)" fill="#eb9c07"/> </g> </svg> </p>
										<p style="margin-bottom:10px;"><?php echo __('Już od wielu lat firma RunoVit dostarcza najwyższej jakości świeże, suszone oraz mrożone grzyby.', 'runovit'); ?></p>
										<div>
											<a href="<?php echo get_url_for_slug('o-nas'); ?>" class="read-more"><?php echo __('O nas', 'runovit'); ?> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.274 26.548"> <path d="M287.518,460.284l-11.86,11.86L287.518,484" transform="translate(-274.658 -458.869)" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path> </svg></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="swiper-slide">
					<div class="slider-top-item">
						<div class="grid-2_md-1-middle">
							<div class="col-bottom">
								<p style="font-family:'Lora';font-size:50px;color:#a2a79d;">02</p>
								<h1 class="slider-top-name">RunoVit <span>leśne</span> grzyby i owoce</h1>
								<?php echo apply_filters('the_content', $the_content); ?>
								<ul class="list-link">
									<li>
										<a href="<?php echo get_term_link('grzyby-suszone', 'product_cat'); ?>" class="read-more"><?php echo __('Grzyby', 'runovit'); ?> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.274 26.548"> <path d="M287.518,460.284l-11.86,11.86L287.518,484" transform="translate(-274.658 -458.869)" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path> </svg></a>
									</li>
									<li>
										<a href="<?php echo get_term_link('owoce-suszone', 'product_cat'); ?>" class="read-more"><?php echo __('Owoce', 'runovit'); ?> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.274 26.548"> <path d="M287.518,460.284l-11.86,11.86L287.518,484" transform="translate(-274.658 -458.869)" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path> </svg></a>
									</li>
									<li>
										<a href="<?php echo get_term_link('przetwory', 'product_cat'); ?>" class="read-more"><?php echo __('Przetwory', 'runovit'); ?> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.274 26.548"> <path d="M287.518,460.284l-11.86,11.86L287.518,484" transform="translate(-274.658 -458.869)" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path> </svg></a>
									</li>
								</ul>
							</div>
							<div class="col">
								<div class="grid">
									<div class="col-7_sm-12">
										<img width="335" height="616" src="<?php echo get_template_directory_uri(); ?>/img/owoce_suszone.webp" alt="RunoVit">
									</div>
									<div class="col-5_sm-12">
										<p style="margin-bottom:40px;"><img width="208" height="312" src="<?php echo get_template_directory_uri(); ?>/img/owoce.webp" alt="RunoVit"></p>
										<p style="margin-bottom:10px;"><svg xmlns="http://www.w3.org/2000/svg" width="50.615" height="45.114" viewBox="0 0 50.615 58.069"><g><path d="M83.2,1.226a1.134,1.134,0,0,0-.952-.952,35.265,35.265,0,0,0-7.58-.139C69.064.626,64.537,2.445,61.578,5.4a18.126,18.126,0,0,0-4.552,8.625,13.549,13.549,0,0,0-3.018-4.771c-5.8-5.784-16.41-4.261-16.859-4.193a1.134,1.134,0,0,0-.952.952c-.052.344-1.187,8.169,2.123,14.056a13.45,13.45,0,0,0,6.866,24.218q0,.165,0,.332a13.453,13.453,0,0,0,26.906,0q0-.1,0-.2a13.448,13.448,0,0,0,6.652-23.285c2.564-2.944,4.15-7.187,4.6-12.344A35.023,35.023,0,0,0,83.2,1.226ZM38.345,7.209c2.517-.217,9.944-.458,14.06,3.649,2.949,2.942,3.669,7.532,3.754,10.862a13.5,13.5,0,0,0-5.075-3.42L48,15.238a1.134,1.134,0,1,0-1.6,1.609l.6.6q-.343-.017-.69-.017a13.371,13.371,0,0,0-6.065,1.446c-2.283-4.14-2.085-9.582-1.9-11.663ZM35.13,30.878a11.185,11.185,0,0,1,22.369,0c0,.111,0,.222,0,.333A13.482,13.482,0,0,0,45.43,42.029a11.122,11.122,0,0,1-10.3-11.15ZM58.634,55.8A11.185,11.185,0,1,1,69.818,44.616,11.2,11.2,0,0,1,58.634,55.8ZM80.965,31.163a11.209,11.209,0,0,1-9.1,10.992,13.481,13.481,0,0,0-12.1-10.944q0-.166,0-.332a13.425,13.425,0,0,0-.485-3.585l.012-.03a11.187,11.187,0,0,1,21.67,3.9Zm-4.045-11.4a13.373,13.373,0,0,0-7.14-2.055,13.549,13.549,0,0,0-2.693.269l5.1-5.1a1.134,1.134,0,0,0-1.6-1.6l-12.1,12.1C58.3,19.486,58.561,11.611,63.18,7c5.314-5.3,14.962-4.855,17.876-4.582C81.321,5.245,81.748,14.385,76.92,19.766Z" transform="translate(-32.862 0)" fill="#eb9c07"/><path d="M96.277,220.978a3.92,3.92,0,1,1,3.92-3.92A3.924,3.924,0,0,1,96.277,220.978Zm0-5.571a1.651,1.651,0,1,0,1.651,1.651A1.653,1.653,0,0,0,96.277,215.407Z" transform="translate(-85.609 -188.966)" fill="#eb9c07"/><path d="M196.244,342.107a3.92,3.92,0,1,1,3.92-3.92A3.924,3.924,0,0,1,196.244,342.107Zm0-5.571a1.651,1.651,0,1,0,1.651,1.651A1.653,1.653,0,0,0,196.244,336.536Z" transform="translate(-174.239 -296.357)" fill="#eb9c07"/><path d="M371.267,248.052a3.92,3.92,0,1,1,3.92-3.92A3.924,3.924,0,0,1,371.267,248.052Zm0-5.571a1.651,1.651,0,1,0,1.651,1.651A1.653,1.653,0,0,0,371.267,242.481Z" transform="translate(-329.412 -212.969)" fill="#eb9c07"/><g transform="translate(41.032 7.306)"> <path d="M395.778,66.682a1.134,1.134,0,1,1,1.111-.913A1.146,1.146,0,0,1,395.778,66.682Z" transform="translate(-394.646 -64.416)" fill="#eb9c07"/></g></g></svg> </p>
										<p style="margin-bottom:10px;"><?php echo __('W naszej ofercie znajdziesz również owoce, między innymi jagody oraz borówka czerwona.', 'runovit'); ?><br/><br/></p>
										<div>
											<a href="<?php echo get_url_for_slug('o-nas'); ?>" class="read-more"><?php echo __('O nas', 'runovit'); ?> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.274 26.548"> <path d="M287.518,460.284l-11.86,11.86L287.518,484" transform="translate(-274.658 -458.869)" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path> </svg></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
		</div>
	</div>
</div>
<?php 
	if($featured_product -> have_posts()):
?>
<div class="page-wraper page-wraper-big">
	<div class="container home-featured-product">
		<div class="grid-noGutter">
			<div class="shop-left">
				<?php if(isset($home_box_featured[0])): ?>
				<div class="widget-shop">
					<?php
						$count = 1;
						foreach($home_box_featured as $item):
						if(isset($item['home_box_featured_name']) && isset($item['home_box_featured_category'])):
					?>
					<div class="widget woocommerce widget_product_categories<?php if($count == 1): ?> first<?php endif; ?>">
						<div class="section-title-content<?php if(isset($item['home_box_featured_icon'])): ?> section-title-icon<?php endif; ?>" style="border-bottom:0;">
							<?php if(isset($item['home_box_featured_icon'])): ?>
							<span class="<?php echo $item['home_box_featured_icon']; ?>"></span>
							<?php endif; ?>
							<p class="section-title section-title-small"><?php echo $item['home_box_featured_name']; ?></p>
						</div>
						<ul class="product-categories">
							<?php wp_list_categories(array('title_li' => null, 'taxonomy'=>'product_cat', 'hide_empty' => false, 'include' => $item['home_box_featured_category'])); ?>
						</ul>
					</div>
					<?php
						$count++;
						endif;
						endforeach;
					?>
				</div>
				<?php endif; ?>
			</div>
			<div class="shop-right">
				<div class="section-title-content">
					<p class="section-title"><?php echo __('Polecane produkty', 'runovit'); ?>:</p>
				</div>
				<?php
					woocommerce_product_loop_start();
					while($featured_product -> have_posts()) : $featured_product -> the_post();
						wc_get_template_part('content', 'product');
					endwhile; wp_reset_postdata();
					woocommerce_product_loop_end();
				?>
			</div>
		</div>
	</div>
</div>
<?php
	endif;
	if(!empty($home_section_one) || isset($home_section_img_one['ID'])):
?>
<div class="page-wraper page-wraper-big">
	<div class="section-medium-text">
		<div class="section-medium-text-img"<?php if(isset($home_section_img_one['ID'])): ?> style="background-image: url(<?php echo wp_get_attachment_image_url($home_section_img_one['ID'], 'full'); ?>);background-position:center;background-size:cover;background-repeat:no-repeat;"<?php endif; ?>></div>
		<?php if(!empty($home_section_one)): ?>
		<div class="container">
			<div class="section-medium-text-content">
				<?php echo apply_filters('the_content', $home_section_one); ?>
			</div>
		</div>
		<?php endif; ?>
	</div>
</div>
<?php
	endif;
	if(!empty($home_section_two) || isset($home_section_img_two['ID']) || isset($home_section_box[0])):
?>
<div class="page-wraper page-wraper-small" style="background-color:#FFFBF5;">
	<?php
		if(isset($home_section_box[0])):
	?>
	<div class="page-wraper page-wraper-big" style="padding-top:0;">
		<div class="container">
			<div class="grid-noGutter undergrowth-bg">
				<div class="shop-left">
					<div class="section-title-content">
						<p style="margin-bottom:10px;"><?php echo __('Dlaczego warto nam zaufać?', 'runovit'); ?></p>
						<p class="section-title"><?php echo __('Nasze produkty posiadają atesty bezpieczeństwa i są objęte stałym nadzorem grzyboznawców', 'runovit'); ?></p>
					</div>
				</div>
				<div class="shop-right shop-right-padding-left">
					<div class="grid-3_md-2_xs-1 small-grid">
						<?php foreach($home_section_box as $item): ?>
						<div class="col">
							<div class="box-text-item">
								<?php echo apply_filters('the_content', $item); ?>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		endif;
		if(isset($home_box_offer[0])):
	?>
	<div class="page-wraper page-wraper-big" style="padding-top:25px">
		<div class="container">
			<?php
				$a = 1;
				foreach($home_box_offer as $item):
				if(isset($item['home_box_offer_name']) && isset($item['home_box_offer_item'][0])):
			?>
			<div style="padding-top:25px;">
				<div class="grid-noGutter">
					<div class="shop-left">
						<div class="section-title-content">
							<p class="section-title"><?php echo $item['home_box_offer_name']; ?></p>
						</div>
						<?php
							if(isset($item['home_box_offer_url'][0])):
							foreach($item['home_box_offer_url'] as $url):
							if(isset($url['home_box_offer_url_name']) && isset($url['home_box_offer_url_url'])):
						?>
						<div style="display:inline-block;padding:0 5px 7px 0">
							<a class="button <?php if($a == 2): ?>button-fill-yellow<?php else: ?>button-fill<?php endif; ?>" href="<?php echo esc_url($url['home_box_offer_url_url']); ?>"><?php echo $url['home_box_offer_url_name']; ?></a>
						</div>
						<?php
							endif;
							endforeach;
							endif;
						?>
					</div>
					<div class="shop-right">
						<div class="grid-4_lg-3_md-2_xs-1 small-grid">
							<?php foreach($item['home_box_offer_item'] as $box): ?>
							<div class="col">
								<div class="box-text-item box-text-item-outline"<?php if($a == 2): ?> style="border: 1px solid var(--second);"<?php endif; ?>>
									<?php echo apply_filters('the_content', $box); ?>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
			<?php
				$a++;
				endif;
				endforeach;
			?>
		</div>
	</div>
	<?php
		endif;
		if(!empty($home_section_two) || isset($home_section_img_two['ID'])):
	?>
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
	<?php
		endif;
	?>
</div>
<?php endif; get_footer(); ?>
