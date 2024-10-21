<?php

get_header();
$id_front_page = get_option('page_on_front');
$post_id_page_archive = get_option('page_for_posts', true);
$slider_front_page = rwmb_meta('slider_front_page', '', $id_front_page);
$front_page_section_one = rwmb_meta('front_page_section_one', '', $id_front_page);
$front_page_img_one = rwmb_meta('front_page_img_one', '', $id_front_page);
$front_page_section_two = rwmb_meta('front_page_section_two', '', $id_front_page);
$front_page_section_title_two = rwmb_meta('front_page_section_title_two', '', $id_front_page);
$front_page_img_two = rwmb_meta('front_page_img_two', '', $id_front_page);
$front_page_section_three = rwmb_meta('front_page_section_three', '', $id_front_page);
$front_page_img_three = rwmb_meta('front_page_img_three', '', $id_front_page);
$front_page_section_four = rwmb_meta('front_page_section_four', '', $id_front_page);
$front_page_img_four = rwmb_meta('front_page_img_four', '', $id_front_page);
$front_page_section_five = rwmb_meta('front_page_section_five', '', $id_front_page);
$front_page_section_title_three = rwmb_meta('front_page_section_title_three', '', $id_front_page);
$front_page_img_five = rwmb_meta('front_page_img_five', '', $id_front_page);
$front_page_section_title_six = rwmb_meta('front_page_section_title_six', '', $id_front_page);
$front_page_section_ten = rwmb_meta('front_page_section_ten', '', $id_front_page);
$front_page_section_six = rwmb_meta('front_page_section_six', '', $id_front_page);
$logos_slider_w = rwmb_meta('logos_slider_w', '', $id_front_page);
$front_page_section_title_four = rwmb_meta('front_page_section_title_four', '', $id_front_page);
$front_page_img_six = rwmb_meta('front_page_img_six', '', $id_front_page);
$front_page_section_seven = rwmb_meta('front_page_section_seven', '', $id_front_page);
$front_page_section_eight = rwmb_meta('front_page_section_eight', '', $id_front_page);
$front_page_section_title_five = rwmb_meta('front_page_section_title_five', '', $id_front_page);
$front_page_section_nine = rwmb_meta('front_page_section_nine', '', $id_front_page);
$front_page_section_eleven = rwmb_meta('front_page_section_eleven', '', $id_front_page);
$front_page_img_seven = rwmb_meta('front_page_img_seven', '', $id_front_page);
$front_page_section_twelve = rwmb_meta('front_page_section_twelve', '', $id_front_page);
$front_page_img_eight = rwmb_meta('front_page_img_eight', '', $id_front_page);
$args_post = array('post_type' => 'post', 'posts_per_page' => 3, 'order' => 'DESC', 'orderby' => 'date', 'post_status' => 'publish');
$front_page_post = new WP_Query($args_post);
$front_page_form_shortcode = rwmb_meta('front_page_form_shortcode', '', $id_front_page);
if(is_array($slider_front_page) && !empty($slider_front_page)):
?>
<div class="slider-front-page-content">
	<div class="swiper slider-front-page" id="slider_front_page">
		<div class="swiper-wrapper">
		<?php foreach ($slider_front_page as $single): if(isset($single['slider_front_page_img'])): ?>
			<div class="swiper-slide">
				<div class="grid-2_md-1-noGutter-middle">
					<div class="col">
						<?php 
							if(isset($single['slider_front_page_text'])):
							if(isset($single['slider_front_page_logo'])):
						?>
						<div class="slider-front-page-logo">
							<?php echo wp_get_attachment_image($single['slider_front_page_logo'], "medium"); ?>
						</div>
						<?php endif; ?>
						<div class="slider-front-page-text">
							<?php 
								echo apply_filters("the_content", $single['slider_front_page_text']);
								if(isset($single['slider_front_page_url'])):
							?>
							<div class="slider-front-page-button">
								<a class="custom-read-more" href="<?php echo esc_url($single['slider_front_page_url']); ?>">
								<?php if(isset($single['slider_front_page_button'])) { echo $single['slider_front_page_button']; } else { echo __('czytaj więcej', 'wienkra'); } ?>
								</a>
							</div>
							<?php endif; ?>
						</div>
						<?php endif; ?>
					</div>
					<div class="col">
						<div class="slider-front-page-img">
							<?php echo wp_get_attachment_image($single['slider_front_page_img'], "large"); ?>
						</div>
					</div>
				</div>
			</div>
		<?php endif; endforeach; ?>
		</div>
		<div class="slider-front-page-pagination">
			<div class="container">
				<ul>
				<?php $count = 1; foreach ($slider_front_page as $single): ?>
					<li<?php if($count == 1): ?> class="active"<?php endif; ?> data-number="<?php echo $count - 1; ?>">
						<span class="pagination-count"><?php echo $count; ?></span>
						<?php if(isset($single['slider_front_page_name'])): ?>
						<span><?php echo $single['slider_front_page_name']; ?></span>
						<?php endif; ?>
					</li>
				<?php $count++; endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</div>
<?php
	endif;
	if(isset($front_page_img_one['ID']) || !empty($front_page_section_one)):
?>
<div class="section-front-page">
	<div class="section-column section-column-reverse">
		<div class="grid-2_md-1-noGutter-middle">
					<div class="col">
				<?php 
					if(!empty($front_page_section_one)):
				?>
				<div class="section-column-text">
					<?php echo apply_filters("the_content", $front_page_section_one); ?>
				</div>
				<?php endif; ?>
			</div>
			<div class="col">
				<?php 
					if(isset($front_page_img_one['ID'])):
				?>
				<div class="section-column-img">
					<p><?php echo wp_get_attachment_image($front_page_img_one['ID'], 'medium'); ?></p>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php
	endif;
	if(isset($front_page_img_two['ID']) || !empty($front_page_section_two)):
?>
<div class="section-front-page">
	<?php if(!empty($front_page_section_title_two)): ?>
	<div class="section-title-bar">
		<div class="container">
			<div class="section-title-content color-page">
				<p class="section-title"><?php echo $front_page_section_title_two; ?></p>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<div class="section-column">
		<div class="grid-2_md-1-noGutter">
			<div class="col">
				<?php 
					if(!empty($front_page_section_two)):
				?>
				<div class="section-column-text">
					<?php echo apply_filters("the_content", $front_page_section_two); ?>
				</div>
				<?php endif; ?>
			</div>
			<div class="col">
				<?php 
					if(isset($front_page_img_two['ID'])):
				?>
				<div class="section-column-img">
					<p><?php echo wp_get_attachment_image($front_page_img_two['ID'], 'medium'); ?></p>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php
	endif;
	if(isset($front_page_img_three['ID']) || !empty($front_page_section_three)):
?>
<div class="section-dark-bg">
	<div class="section-column section-column-ornament">
		<div class="grid-2_md-1-noGutter">
			<div class="col">
				<?php 
					if(!empty($front_page_section_three)):
				?>
				<div class="section-column-text">
					<?php echo apply_filters("the_content", $front_page_section_three); ?>
				</div>
				<?php endif; ?>
			</div>
			<div class="col">
				<?php 
					if(isset($front_page_img_three['ID'])):
				?>
				<div class="section-column-img section-column-img-bg" style="background-image: url(<?php echo wp_get_attachment_image_url($front_page_img_three['ID'], 'medium'); ?>)">
					<?php echo wp_get_attachment_image($front_page_img_three['ID'], 'medium'); ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php
	endif;
	if(isset($front_page_img_four['ID']) || !empty($front_page_section_four)):
?>
<div class="section-front-page section-front-page-top">
	<div class="section-column">
		<div class="grid-2_md-1-noGutter">
			<div class="col">
				<?php 
					if(!empty($front_page_section_four)):
				?>
				<div class="section-column-text">
					<?php echo apply_filters("the_content", $front_page_section_four); ?>
				</div>
				<?php endif; ?>
			</div>
			<div class="col">
				<?php 
					if(isset($front_page_img_four['ID'])):
				?>
				<div class="section-column-img">
					<p><?php echo wp_get_attachment_image($front_page_img_four['ID'], 'medium'); ?></p>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php
	endif;
	if(isset($front_page_img_five['ID']) || !empty($front_page_section_five)):
?>
<div class="section-front-page">
	<?php if(!empty($front_page_section_title_three)): ?>
	<div class="section-title-bar">
		<div class="container">
			<div class="section-title-content color-page">
				<p class="section-title"><?php echo $front_page_section_title_three; ?></p>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<div class="section-column">
		<div class="grid-2_md-1-noGutter-middle">
			<div class="col">
				<?php 
					if(!empty($front_page_section_five)):
				?>
				<div class="section-column-text">
					<?php echo apply_filters("the_content", $front_page_section_five); ?>
				</div>
				<?php endif; ?>
			</div>
			<div class="col">
				<?php 
					if(isset($front_page_img_five['ID'])):
				?>
				<div class="section-column-img">
					<p><?php echo wp_get_attachment_image($front_page_img_five['ID'], 'medium'); ?></p>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php
	endif;
	if(isset($front_page_img_six['ID']) || !empty($front_page_section_six)):
	if(!empty($front_page_section_title_four)):
?>
<div class="section-title-bar no-margin">
	<div class="container">
		<div class="section-title-content color-page">
			<p class="section-title"><?php echo $front_page_section_title_four; ?></p>
		</div>
	</div>
</div>
<?php 
	endif;
	if(isset($logos_slider_w[0]['logos_slider_w_img'])):
?>
<div class="logos-slider">
	<div class="container position-relative">
		<div class="swiper slider-logos" id="slider_logos">
			<div class="swiper-wrapper">
			<?php foreach ($logos_slider_w as $single): if(isset($single['logos_slider_w_img'])): ?>
				<div class="swiper-slide">
					<?php
						if(isset($single['logos_slider_w_url']))
						{
							echo '<a href="'.esc_url($single['logos_slider_w_url']).'">';
						}
						echo wp_get_attachment_image($single['logos_slider_w_img'], 'logos_img');
						if(isset($single['logos_slider_w_url']))
						{
							echo '</a>';
						}
					?>
				</div>
			<?php endif; endforeach; ?>
			</div>
		</div>
		<div class="swiper-button-next swiper-button-logos-next"></div>
		<div class="swiper-button-prev swiper-button-logos-prev"></div>
	</div>
</div>
<?php endif; ?>
<div class="section-column section-column-reverse section-column-middle">
		<div class="grid-2_md-1-noGutter">
		<div class="col">
			<?php 
				if(!empty($front_page_section_six)):
			?>
			<div class="section-column-text">
				<?php echo apply_filters("the_content", $front_page_section_six); ?>
			</div>
			<?php endif; ?>
		</div>
		<div class="col">
			<?php 
				if(isset($front_page_img_six['ID'])):
			?>
			<div class="section-column-img section-column-img-bg" style="background-image: url(<?php echo wp_get_attachment_image_url($front_page_img_six['ID'], 'medium'); ?>)">
				<?php echo wp_get_attachment_image($front_page_img_six['ID'], 'medium'); ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php
	endif;
	if(!empty($front_page_section_seven) || !empty($front_page_section_eight)):
?>
<div class="section-columns-text">
	<div class="container">
		<div class="grid-2_md-1">
			<div class="col">
				<?php if(!empty($front_page_section_seven)): ?>
				<div class="section-columns-text-content">
					<?php echo apply_filters("the_content", $front_page_section_seven); ?>
				</div>
				<?php endif; ?>
			</div>
			<div class="col">
				<?php if(!empty($front_page_section_eight)): ?>
				<div class="section-columns-text-content">
					<?php echo apply_filters("the_content", $front_page_section_eight); ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php
	endif;
	if(!empty($front_page_section_title_five)):
?>
<div class="section-title-bar">
	<div class="container">
		<div class="section-title-content color-page">
			<p class="section-title"><?php echo $front_page_section_title_five; ?></p>
			<?php if(!empty($front_page_section_nine)): ?>
			<p class="section-title-text"><?php echo $front_page_section_nine; ?></p>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php
	endif;
	if(isset($front_page_section_ten[0]['front_page_section_ten_name'])):
?>
<div class="front-page-box-img">
	<div class="container">
		<?php if(!empty($front_page_section_title_six)): ?>
			<div class="section-title-content color-page">
			<p class="section-title"><?php echo $front_page_section_title_six; ?></p>
		</div>
		<?php endif; ?>
		<div class="grid-3_md-2_sm-1">
			<?php
				foreach($front_page_section_ten as $single):
				if(isset($single['front_page_section_ten_name'])):
			?>
			<div class="col">
				<?php if(isset($single['front_page_section_ten_url'])): ?>
				<a href="<?php echo esc_url($single['front_page_section_ten_url']); ?>" class="front-page-box-img-single">
				<?php else: ?>
				<div class="front-page-box-img-single">
					<?php
						endif;
						if(isset($single['front_page_section_ten_img']))
						{
							 echo wp_get_attachment_image($single['front_page_section_ten_img'], 'thumbnail');
						}
					?>	
					<p class="front-page-box-img-name"><?php echo $single['front_page_section_ten_name']; ?><span class="wienkra_icon_right"></span></p>
				<?php if(isset($single['front_page_section_ten_url'])): ?>
				</a>
				<?php else: ?>
				</div>
				<?php endif; ?>
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
	if(isset($front_page_img_seven['ID']) || !empty($front_page_section_eleven)):
?>
<div class="section-column section-column-middle">
		<div class="grid-2_md-1-noGutter">
		<div class="col">
			<?php 
				if(!empty($front_page_section_eleven)):
			?>
			<div class="section-column-text">
				<?php echo apply_filters("the_content", $front_page_section_eleven); ?>
			</div>
			<?php endif; ?>
		</div>
		<div class="col">
			<?php 
				if(isset($front_page_img_seven['ID'])):
			?>
			<div class="section-column-img section-column-img-bg" style="background-image: url(<?php echo wp_get_attachment_image_url($front_page_img_seven['ID'], 'medium'); ?>)">
				<?php echo wp_get_attachment_image($front_page_img_seven['ID'], 'medium'); ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php
	endif;
	if(isset($front_page_img_eight['ID']) || !empty($front_page_section_twelve)):
?>
<div class="section-dark-bg">
	<div class="section-column section-column-reverse section-column-middle">
			<div class="grid-2_md-1-noGutter">
			<div class="col">
				<?php 
					if(!empty($front_page_section_twelve)):
				?>
				<div class="section-column-text">
					<?php echo apply_filters("the_content", $front_page_section_twelve); ?>
				</div>
				<?php endif; ?>
			</div>
			<div class="col">
				<?php 
					if(isset($front_page_img_eight['ID'])):
				?>
				<div class="section-column-img section-column-img-bg" style="background-image: url(<?php echo wp_get_attachment_image_url($front_page_img_eight['ID'], 'medium'); ?>)">
					<?php echo wp_get_attachment_image($front_page_img_eight['ID'], 'medium'); ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php
	endif;
	if($front_page_post -> have_posts()):
?>
<div class="front-page-post">
	<div class="container">
		<?php if(is_numeric($post_id_page_archive)): ?>
		<div class="section-title-content color-page">
			<p class="section-title"><?php echo get_the_title($post_id_page_archive); ?></p>
		</div>
		<div class="custom-hr-line"></div>
		<p><a class="custom-read-more" href="<?php echo get_post_type_archive_link('post'); ?>"><?php echo __("Wszystkie aktualności", "wienkra"); ?></a></p>
		<?php endif; ?>
		<div class="front-page-post-content">
			<div class="grid-3_md-2_sm-1">
			<?php
				while ($front_page_post -> have_posts()) : $front_page_post -> the_post();
				echo get_template_part('template-parts/list', 'post');
				endwhile; wp_reset_postdata();
			?>
			</div>
		</div>
	</div>
</div>
<?php
	endif;
	if(!empty($front_page_form_shortcode)):
?>
<div class="front-page-form">
	<div class="section-title-bar">
		<div class="container">
			<div class="section-title-content color-page">
				<p class="section-title"><?php echo __("Skontaktuj się z nami", "wienkra"); ?></p>
				<p class="section-title-text"><?php echo __("Wypełnij poniższy formularz", "wienkra"); ?></p>
			</div>
		</div>
	</div>
	<div class="container">
		<?php echo apply_filters("the_content", $front_page_form_shortcode); ?>
	</div>
</div>
<?php endif; get_footer(); ?>
