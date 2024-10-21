<?php
	/* Template name: Deweloper */
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
	$id_page = get_the_ID();
	$the_content = get_the_content('', '', $id_page);
	$deweloper_page_img_one = rwmb_meta('deweloper_page_img_one', '', $id_page);
	$deweloper_page_icons = rwmb_meta('deweloper_page_icons', '', $id_page);
	$deweloper_page_text_one = rwmb_meta('deweloper_page_text_one', '', $id_page);
	$deweloper_page_img_two = rwmb_meta('deweloper_page_img_two', '', $id_page);
	$deweloper_page_img_bottom = rwmb_meta('deweloper_page_img_bottom', '', $id_page);
?>
		<div class="page-wraper" style="padding-bottom:0">
			<?php
				if(!empty($the_content)):
			?>
			<div class="section-column position-relative">
				<div class="container">
					<div class="grid-middle">
						<div class="col-5_lg-6_md-12">
							<div class="section-column-text">
								<?php echo apply_filters('the_content', $the_content); ?>
							</div>
						</div>
						<div class="col-7_lg-6_md-12">
							<?php
								if(isset($deweloper_page_img_one['ID']))
								{
									echo '<p class="text-right">';
									echo wp_get_attachment_image($deweloper_page_img_one['ID'], 'large');
									echo '</p>';
								}
							?>
						</div>
					</div>
				</div>
			</div>
			<?php
				endif;
				if(is_array($deweloper_page_icons) && !empty($deweloper_page_icons)):
			?>
			<div class="section-icon">
				<div class="container">
					<div class="grid-4_md-2">
						<?php
							foreach($deweloper_page_icons as $single):
							if(isset($single['ID'])):
						?>
						<div class="col">
							<div class="section-icon-single">
								<?php 
									echo wp_get_attachment_image($single['ID'], 'medium');
									$title = get_the_title($single['ID']);
									if(!empty($title))
									{
										echo apply_filters('the_content', $title);
									}
								?>
							</div>
						</div>
						<?php 
							endif;
							endforeach;
						?>
					</div>
				</div>
			</div>
			<?php
				endif;
				if(!empty($deweloper_page_text_one)):
			?>
			<div class="section-column section-column-reverse position-relative">
				<div class="container">
					<div class="grid-middle">
						<div class="col-5_lg-6_md-12">
							<div class="section-column-text">
								<?php echo apply_filters('the_content', $deweloper_page_text_one); ?>
							</div>
						</div>
						<div class="col-7_lg-6_md-12">
							<?php
								if(isset($deweloper_page_img_two['ID']))
								{
									echo '<p class="text-right">';
									echo wp_get_attachment_image($deweloper_page_img_two['ID'], 'large');
									echo '</p>';
								}
							?>
						</div>
					</div>
				</div>
			</div>
			<?php
				endif;
				if(isset($deweloper_page_img_bottom['ID'])):
			?>
			<div class="section-image-full-width" style="background-image:url(<?php echo wp_get_attachment_image_url($deweloper_page_img_bottom['ID'], 'full'); ?>);background-size:cover;background-position:center;background-attachment:fixed;background-repeat:no-repeat;">
				<?php echo wp_get_attachment_image($deweloper_page_img_bottom['ID'], 'full'); ?>
			</div>
			<?php
				endif;
			?>
		</div>
<?php 
	endwhile; endif;
	get_footer();
?>