<?php
	/* Template name: Dystrybucja */
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
	$id_page = get_the_ID();
	$distribution_extra_title = rwmb_meta('distribution_extra_title', '', $id_page);
	$distribution_box = rwmb_meta('distribution_box', '', $id_page);
	$distribution_bottom_img = rwmb_meta('distribution_bottom_img', '', $id_page);
	$distribution_bottom_text = rwmb_meta('distribution_bottom_text', '', $id_page);
	$distribution_form = rwmb_meta('distribution_form', '', $id_page);
	$distribution_form_txt = rwmb_meta('distribution_form_txt', '', $id_page);
	$distribution_info = rwmb_meta('distribution_info', '', $id_page);
?>
	<div class="section-top-page">
		<div class="grid-2_md-1-noGutter-middle">
			<div class="col">
				<div class="section-top-page-text">
					<div class="section-title-content">
						<h1 class="section-abovetitle"><?php the_title(); ?></h1>
						<?php if(!empty($distribution_extra_title)): ?>
						<p class="section-title"><?php echo $distribution_extra_title; ?></p>
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
	<?php if(isset($distribution_box[0])): ?>
	<div class="page-wraper page-wraper-custom-bg">
		<div class="container">
			<div class="section-title-content">
				<p class="section-subtitle"><?php echo __('Dlaczego wybrać Makear?', 'makaer'); ?></p>
			</div>
			<div class="box-icon-content-revert">
				<div class="box-icon-content">
					<div class="grid-3_md-2_xs-1-center">
						<?php $a = 0; $count = 1; foreach($distribution_box as $item): if($a >= 3): ?>
						</div></div><div class="box-icon-content"><div class="grid-3_md-2_xs-1-center">
						<?php $a = 0; endif; ?>
						<div class="col">
							<div class="box-icon">
								<div class="box-icon-stroke"><?php echo str_pad($count, 2, '0', STR_PAD_LEFT); ?></div>
								<?php echo $item; ?>
							</div>
						</div>
						<?php $a++; $count++; endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		endif;
		if(isset($distribution_info[0])):
	?>
	<div class="page-wraper page-wraper-big" style="background-color:var(--light_grey);">
		<div class="container container-name" data-name="Makear">
			<div class="grid-4_lg-3_md-2_sm-1">
				<div class="col-middle">
					<div class="section-title-content">
						<p class="section-title"><?php echo __('CO DOSTAJESZ W ZAMIAN', 'makaer'); ?></p>
					</div>
				</div>
				<?php
					foreach($distribution_info as $item):
				?>
				<div class="col">
					<div class="box-info">
						<?php echo apply_filters('the_excerpt', $item); ?>
					</div>
				</div>
				<?php
					endforeach;
				?>
			</div>
		</div>
	</div>
	<?php
		endif;
		if(!empty($distribution_form)):
	?>
	<div class="page-wraper position-relative page-wraper-form section-name-text" data-name="<?php echo __('Formularz kontaktowy', 'makaer'); ?> &#8213;">
		<div class="container">
			<div class="form-content">
				<div class="section-title-content text-center">
					<p class="section-subtitle" style="padding-bottom:6px;"><?php echo __('Skontaktuj się z nami!', 'makaer'); ?></p>
					<?php
						if(!empty($distribution_form_txt))
						{
							echo '<div class="text-center">';
							echo apply_filters('the_excerpt', $distribution_form_txt);
							echo '</div>';
						}
					?>
				</div>
				<?php
					echo do_shortcode($distribution_form);
				?>
			</div>
		</div>
	</div>
	<?php
		endif;
		if(!empty($distribution_bottom_text) || isset($distribution_bottom_img['ID'])):
	?>
	<div class="section-column-image section-column-image-reverse">
		<div class="grid-2_md-1-noGutter-middle">
			<div class="col">
				<?php if(!empty($distribution_bottom_text)): ?>
				<div class="section-column-image-text">
					<div class="section-column-image-text-extra">
						<?php echo apply_filters('the_content', $distribution_bottom_text); ?>
					</div>
				</div>
				<?php endif; ?>
			</div>
			<div class="col">
				<?php if(isset($distribution_bottom_img['ID'])): ?>
				<div class="section-column-image-img">
					<?php echo wp_get_attachment_image($distribution_bottom_img['ID'], 'full'); ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php
	endif;
	endwhile; endif;
	get_footer();
?>