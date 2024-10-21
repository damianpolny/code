<?php
	/* Template name: Marka */
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
	$id_page = get_the_ID();
	$title = get_the_title();
	$brand_extra_title = rwmb_meta('brand_extra_title', '', $id_page);
	$brand_section = rwmb_meta('brand_section', '', $id_page);
	$brand_slider = rwmb_meta('brand_slider', '', $id_page);
	$brand_bottom_section = rwmb_meta('brand_bottom_section', '', $id_page);
?>
	<div class="section-top-page" data-name="<?php echo $title; ?>">
		<div class="grid-2-noGutter-middle">
			<div class="col-7_md-12">
				<div class="section-top-page-text">
					<div class="section-title-content">
						<h1 class="section-abovetitle"><?php echo $title; ?></h1>
						<?php if(!empty($brand_extra_title)): ?>
						<p class="section-title"><?php echo $brand_extra_title; ?></p>
						<?php endif; ?>
					</div>
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
	<?php
		if(!empty($brand_section)):
	?>
	<div class="section-info">
		<div class="container">
			<div class="section-info-content">
				<div class="section-info-content-text">
					<div class="grid-2_md-1">
						<div class="col"></div>
						<div class="col">
							<?php echo apply_filters('the_content', $brand_section); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		endif;
		if(isset($brand_slider[0])):
	?>
	<div class="page-wraper page-wraper-big">
		<div class="section-stroke-name" data-name="Makear">
			<div class="container">
				<div class="section-title-content" style="margin-bottom:40px;">
					<p class="section-subtitle"><?php echo __('Tak wprowadzaliśmy <br/>nasze produkty', 'makaer'); ?></p>
				</div>
				<div class="swiper" id="slider_offer">
					<div class="swiper-wrapper">
						<?php
							foreach($brand_slider as $item):
						?>
						<div class="swiper-slide">
							<div class="box-product">
								<?php
									if(isset($item['brand_slider_img']))
									{
										echo wp_get_attachment_image($item['brand_slider_img'], 'product_size');
									}
									if(isset($item['brand_slider_name'])):
								?>
								<p class="box-product-name"><?php echo $item['brand_slider_name']; ?></p>
								<?php
									endif;
									if(isset($item['brand_slider_text'])):
								?>
								<?php echo apply_filters('the_excerpt', $item['brand_slider_text']); endif; ?>
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
		if(!empty($brand_bottom_section)):
	?>
	<div class="section-column-bg" style="background-image:url(<?php echo get_template_directory_uri(); ?>/img/acryl.webp);background-position:center;background-size:cover;background-repeat:no-repeat;">
		<div class="section-column-bg-text">
			<div style="width:100%">
				<?php echo apply_filters('the_content', $brand_bottom_section); ?>
			</div>
		</div>
	</div>
<?php
	endif;
?>
<div class="section-slogan">
	<div class="container">
		<p class="slogan-name"><?php echo __('BY MAKEAR... OF COURSE', 'makaer'); ?></p>
		<p><?php echo __('Marka MAKEAR miała być inna niż wszystkie znane marki. I taka właśnie jest.', 'makaer'); ?></p>
	</div>
</div>
<?php
	endwhile; endif;
	get_footer();
?>