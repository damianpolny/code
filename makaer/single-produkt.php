<?php
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
	$id_page = get_the_ID();
	$the_content = get_the_content('', '', $id_page);
	$top_img = rwmb_meta('top_img', '', $id_page);
	$features_img = rwmb_meta('features_img', '', $id_page);
	$features_product = rwmb_meta('features_product', '', $id_page);
	$parameters_product = rwmb_meta('parameters_product', '', $id_page);
	$method_of_use_product = rwmb_meta('method_of_use_product', '', $id_page);
	$img_method_of_use_product = rwmb_meta('img_method_of_use_product', '', $id_page);
	$section_colors = rwmb_meta('section_colors', '', $id_page);
	$video_method_of_use_product = rwmb_meta('video_method_of_use_product', '', $id_page);
	$gallery_img = rwmb_meta('gallery_img', '', $id_page);
?>
	<div class="section-top-page">
		<div class="grid-2_md-1-noGutter-middle">
			<div class="col">
				<div class="section-top-page-text">
					<div class="section-title-content">
						<p class="section-abovetitle"><?php echo strip_tags(get_the_term_list($id_page, 'kategoria-produktu', '', ', ')); ?></p>
						<h1 class="section-title"><?php the_title(); ?></h1>
					</div>
					<?php the_excerpt(); ?>
				</div>
			</div>
			<div class="col">
			<?php
				if(isset($top_img['ID']))
				{
					echo wp_get_attachment_image($top_img['ID'], 'large', '', array('class' => 'attachment-large size-large wp-post-image'));
				}
				elseif(has_post_thumbnail())
				{
					the_post_thumbnail('large');
				}
			?>
			</div>
		</div>
	</div>
	<?php if(isset($features_img['ID']) || isset($features_product['ID']) || isset($parameters_product[0])): ?>
	<div class="page-wraper page-wraper-big">
		<div class="features-section">
			<div class="grid-middle-noGutter">
				<div class="col-7_lg-6_md-12">
					<?php if(isset($features_img['ID'])): ?>
					<div class="features-section-img">
						<p><?php echo wp_get_attachment_image($features_img['ID'], 'large'); ?></p>
					</div>
					<?php endif; ?>
				</div>
				<div class="col-5_lg-6_md-12">
					<div class="features-section-content">
						<?php if(isset($features_product[0])): ?>
						<p class="section-heading">
							<span><?php echo __('Cechy', 'makaer'); ?></span><span class="section-heading-line"></span>
						</p>
						<div class="grid-2">
							<?php
								foreach($features_product as $item):
								if(isset($item['features_product_name']) && isset($item['features_product_subname'])):
							?>
							<div class="col">
								<div class="features-item<?php if(isset($item['features_product_icon'])): ?> features-item-with-icon<?php endif; ?>">
									<?php if(isset($item['features_product_icon'])): ?>
									<span class="<?php echo $item['features_product_icon']; ?>"></span>
									<?php endif; ?>
									<p class="features-item-name"><strong><?php echo $item['features_product_name']; ?></strong></p>
									<?php echo apply_filters('the_excerpt', $item['features_product_subname']); if(isset($item['features_product_count'])): ?>
									<span class="features-item-circle<?php if($item['features_product_count'] > 0): ?> active<?php endif; ?>"></span>
									<span class="features-item-circle<?php if($item['features_product_count'] > 1): ?> active<?php endif; ?>"></span>
									<span class="features-item-circle<?php if($item['features_product_count'] > 2): ?> active<?php endif; ?>"></span>
									<span class="features-item-circle<?php if($item['features_product_count'] > 3): ?> active<?php endif; ?>"></span>
									<?php endif; ?>
								</div>
							</div>
							<?php
								endif;
								endforeach;
							?>
						</div>
						<?php endif; if(isset($parameters_product[0])): ?>
						<p class="section-heading">
							<span><?php echo __('Parametry', 'makaer'); ?></span><span class="section-heading-line"></span>
						</p>
						<div class="grid-2">
							<?php
								foreach($parameters_product as $item):
								if(isset($item['parameters_product_name']) && isset($item['parameters_product_subname'])):
							?>
							<div class="col">
								<div class="features-item<?php if(isset($item['parameters_product_icon'])): ?> features-item-with-icon<?php endif; ?>">
									<?php if(isset($item['parameters_product_icon'])): ?>
									<span class="<?php echo $item['parameters_product_icon']; ?>"></span>
									<?php endif; ?>
									<p class="features-item-name"><strong><?php echo $item['parameters_product_name']; ?></strong></p>
									<?php echo apply_filters('the_excerpt', $item['parameters_product_subname']); ?>
								</div>
							</div>
							<?php
								endif;
								endforeach;
							?>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		endif;
		if(!empty($the_content)):
	?>
	<div class="page-wraper page-wraper-big" style="background-color:var(--light_grey)">
		<div class="container">
			<div class="page-content">
				<p class="section-heading">
					<span><?php echo __('Opis', 'makaer'); ?></span><span class="section-heading-line"></span>
				</p>
				<div class="section-text-inside">
					<?php echo apply_filters('the_excerpt', $the_content); ?>
				</div>
			</div>
		</div>
	</div>
	<?php
		endif;
		if(!empty($method_of_use_product) || isset($img_method_of_use_product['ID'])):
	?>
	<div class="page-wraper page-wraper-big" style="background-color:var(--light)">
		<div class="container">
			<div class="grid-middle">
				<div class="col-4_lg-5_md-12">
					<?php if(!empty($method_of_use_product)): ?>
					<p class="section-heading">
						<span><?php echo __('Sposób użycia', 'makaer'); ?></span><span class="section-heading-line"></span>
					</p>
					<div class="section-text-inside">
						<?php echo apply_filters('the_excerpt', $method_of_use_product); ?>
					</div>
					<?php endif; ?>
				</div>
				<?php if(is_array($video_method_of_use_product) && !empty($video_method_of_use_product)): ?>
				<div class="col-8_lg-7_md-12">
					<p>
						<?php
							foreach($video_method_of_use_product as $item):
						?>
						<video controls<?php if(isset($img_method_of_use_product['ID'])): ?> poster="<?php echo wp_get_attachment_image_url($img_method_of_use_product['ID'], 'large'); ?>"<?php endif; ?>>
							<source src="<?php echo $item['src'] ?>" type="video/mp4">
							Your browser does not support the video tag.
						</video>
						<?php
							endforeach;
						?>
					</p>
				</div>
				<?php elseif(isset($img_method_of_use_product['ID'])): ?>
				<div class="col-8_lg-7_md-12">
					<p><?php echo wp_get_attachment_image($img_method_of_use_product['ID'], 'large'); ?></p>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php
		endif;
		if(isset($section_colors[0])):
	?>
	<div class="page-wraper page-wraper-big" id="home_section_products">
		<div class="container">
			<p class="section-heading">
				<span><?php echo __('Dostępne kolory', 'makaer'); ?></span><span class="section-heading-line"></span>
			</p>
			<div class="section-products grid">
				<div class="col-3_lg-4_md-5_sm-12">
					<div class="sidebar-left">
						<ul class="list-category">
							<?php
								$count = 1;
								foreach($section_colors as $item):
								if(isset($item['section_colors_name']) && isset($item['section_colors_gallery']) && isset($item['section_colors_id'])):
							?>
							<li class="cat-item cat-item-<?php echo $item['section_colors_id']; if($count == 1): ?> current-cat<?php endif; ?>">
								<a aria-current="page" href="#"><?php echo $item['section_colors_name']; ?></a>
							</li>
							<?php
								$count++;
								endif;
								endforeach;
							?>
						</ul>
					</div>
				</div>
				<div class="col-9_lg-8_md-7_sm-12">
					<div class="grid-4_lg-3_md-2" id="home_section_products_grid">
					<?php
						foreach($section_colors as $item):
						if(isset($item['section_colors_name']) && isset($item['section_colors_gallery']) && isset($item['section_colors_id'])):
						foreach($item['section_colors_gallery'] as $img):
					?>
						<div class="col cat-id-<?php echo $item['section_colors_id']; ?>">
							<div class="box-product">
								<a data-fslightbox="gallery_color" href="<?php echo wp_get_attachment_image_url($img, 'full'); ?>">
									<?php echo wp_get_attachment_image($img, 'product_size'); ?>
								</a>
							</div>
						</div>
					<?php
						endforeach;
						endif;
						endforeach;
					?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		endif;
		if(!empty($gallery_img) && is_array($gallery_img)):
	?>
	<div class="section-gallery">
		<div class="container">
			<p class="section-heading">
				<span><?php echo __('Prezentacja produktu', 'makaer'); ?></span><span class="section-heading-line"></span>
			</p>
			<div id="gallery_mansory">
				<?php
					foreach($gallery_img as $item)
					{
						echo '<div><a data-fslightbox="gallery_page" href="'.wp_get_attachment_image_url($item['ID'], 'full').'">'.wp_get_attachment_image($item['ID'], 'medium').'</a></div>';
					}
				?>
			</div>
		</div>
	</div>
<?php
	endif;
	echo get_template_part('template-parts/content', 'catalog');
	endwhile; endif;
	get_footer();
?>