<?php

/* Template name: Rozwiązania */

get_header();
$id_front_page = get_option('page_on_front');
$front_page_section_ten = rwmb_meta('front_page_section_ten', '', $id_front_page);
if(have_posts()): while (have_posts()): the_post();
?>
	<div class="page-wraper">
		<div class="container">
			<div class="page-content">
				<?php the_content(); ?>
			</div>
		</div>
		<?php
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
	</div>
<?php endif; endwhile; endif; get_footer(); ?>
