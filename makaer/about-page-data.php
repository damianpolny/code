<?php
	/* Template name: O nas */
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
	$id_page = get_the_ID();
	$gallery_img = rwmb_meta('gallery_img', '', $id_page);
	$about_us_extra_title = rwmb_meta('about_us_extra_title', '', $id_page);
	$our_values = rwmb_meta('our_values', '', $id_page);
	$about_us_text = rwmb_meta('about_us_text', '', $id_page);
	$about_us_img = rwmb_meta('about_us_img', '', $id_page);
	$about_us_section_text = rwmb_meta('about_us_section_text', '', $id_page);
?>
	<div class="section-top-page">
		<div class="grid-2_md-1-noGutter-middle">
			<div class="col">
				<div class="section-top-page-text">
					<div class="section-title-content">
						<h1 class="section-abovetitle"><?php the_title(); ?></h1>
						<?php if(!empty($about_us_extra_title)): ?>
						<p class="section-title"><?php echo $about_us_extra_title; ?></p>
						<?php endif; ?>
					</div>
					<?php the_content(); ?>
				</div>
			</div>
			<div class="col">
			<?php
				if(has_post_thumbnail())
				{
					the_post_thumbnail('large');
				}
			?>
			</div>
		</div>
	</div>
	<?php if(isset($our_values[0])): ?>
	<div class="page-wraper page-wraper-big">
		<div class="container">
			<div class="section-title-content text-center">
				<p class="section-subtitle"><?php echo __('Nasze wartości', 'makaer'); ?></p>
			</div>
			<div class="box-icon-content">
				<div class="grid-3_md-2_xs-1-center">
					<?php foreach($our_values as $item): if(isset($item['our_values_name'])): ?>
					<div class="col">
						<div class="box-icon">
							<?php
								if(isset($item['our_values_icon']))
								{
									echo wp_get_attachment_image($item['our_values_icon'], 'medium');
								}
								echo $item['our_values_name'];
							?>
						</div>
					</div>
					<?php endif; endforeach; ?>
				</div>
			</div>
		</div>
	</div>
	<?php
		endif;
		if(!empty($about_us_text) || isset($about_us_img['ID'])):
	?>
	<div class="section-column-image section-column-image-reverse">
		<div class="grid-2_sm-1-noGutter-middle">
			<div class="col">
				<?php if(!empty($about_us_text)): ?>
				<div class="section-column-image-text">
					<div class="section-column-image-text-extra">
						<?php echo apply_filters('the_content', $about_us_text); ?>
					</div>
				</div>
				<?php endif; ?>
			</div>
			<div class="col">
				<?php if(isset($about_us_img['ID'])): ?>
				<div class="section-column-image-img">
					<?php echo wp_get_attachment_image($about_us_img['ID'], 'full'); ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php
		endif;
		if(!empty($about_us_section_text)):
	?>
	<div class="section-info">
		<div class="container">
			<div class="section-info-content">
				<div class="section-info-content-text">
					<div class="grid-2_md-1">
						<div class="col">
							<?php echo apply_filters('the_content', $about_us_section_text); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endif; if(!empty($gallery_img) && is_array($gallery_img)): ?>
	<div class="section-gallery">
		<div class="container">
			<div class="section-title-content text-center">
				<p class="section-abovetitle"><?php echo __('Zobacz jak wyglądają nasze realizacje', 'makaer'); ?></p>
				<p class="section-subtitle"><?php echo __('Galeria produktów', 'makaer'); ?></p>
			</div>
			<div id="gallery_mansory">
				<?php
					foreach($gallery_img as $item)
					{
						echo '<div><a data-fslightbox="gallery_page" href="'.wp_get_attachment_image_url($item['ID'], 'full').'">'.wp_get_attachment_image($item['ID'], 'medium').'</a></div>';
					}
				?>
			</div>
			<p class="text-center" style="padding-top:30px;"><a class="custom-button" href="<?php echo get_post_type_archive_link('produkt'); ?>"><?php echo __('Zobacz ofertę', 'makaer'); ?></a></p>
		</div>
	</div>
<?php
	endif;
	echo get_template_part('template-parts/content', 'catalog');
	endwhile; endif;
	get_footer();
?>