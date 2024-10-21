<?php
	/* Template name: About us */
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
	$id_page = get_the_ID();
	$the_content = get_the_content('', '', $id_page);
	$about_us_merge_text = get_field('about_us_merge_text', $id_page);
	$about_us_title_one = get_field('about_us_title_one', $id_page);
	$about_us_img_one = get_field('about_us_img_one', $id_page);
	$about_us_img_two = get_field('about_us_img_two', $id_page);
	$about_us_img_three = get_field('about_us_img_three', $id_page);
	$about_us_title_two = get_field('about_us_title_two', $id_page);
	$about_us_txt_one = get_field('about_us_txt_one', $id_page);
	$about_us_txt_two = get_field('about_us_txt_two', $id_page);
	$about_us_img_four = get_field('about_us_img_four', $id_page);
	$about_us_img_five = get_field('about_us_img_five', $id_page);
	$about_us_title_three = get_field('about_us_title_three', $id_page);
	$about_us_title_four = get_field('about_us_title_four', $id_page);
	$about_us_img_six = get_field('about_us_img_six', $id_page);
	$about_us_img_seven = get_field('about_us_img_seven', $id_page);
	$about_us_img_eight = get_field('about_us_img_eight', $id_page);
	if(has_post_thumbnail($id_page)):
?>
	<div class="hero-top-img">
		<?php echo get_the_post_thumbnail($id_page, 'full'); ?>
	</div>
	<?php endif; ?>
	<div class="page-wraper">
		<?php if(isset($about_us_merge_text[0])): ?>
		<div class="section-about-us merge-container fade-up">
			<div class="merge-text">
				<?php foreach($about_us_merge_text as $item): ?>
				<span><?php echo $item['add']; ?></span>
				<?php endforeach; foreach($about_us_merge_text as $item): ?>
				<span><?php echo $item['add']; ?></span>
				<?php endforeach; foreach($about_us_merge_text as $item): ?>
				<span><?php echo $item['add']; ?></span>
				<?php endforeach; ?>
			</div>
		</div>
		<?php endif; if(!empty($the_content) || is_numeric($about_us_img_one)): ?>
		<div class="section-about-us">
			<div class="container">
				<div class="section-columns">
					<div class="section-column">
						<div class="grid-2_md-1-middle">
							<div class="col">
								<?php if(!empty($the_content)): ?>
								<div class="section-column-text">
									<?php
										if(!empty($about_us_title_one)):
									?>
									<div class="section-title-content fade-up">
										<p class="section-title"><?php echo nl2br($about_us_title_one); ?></p>
									</div>
									<?php
										endif;
										echo '<div class="fade-up">'.apply_filters('the_content', $the_content).'</div>';
									?>
								</div>
								<?php endif; ?>
							</div>
							<?php
								if(is_numeric($about_us_img_one)):
							?>
							<div class="col">
								<div class="section-column-animate-content-img">
									<div class="section-column-img section-column-animate-img">
										<?php echo wp_get_attachment_image($about_us_img_one, 'medium'); ?>
									</div>
								</div>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php endif; if(isset($about_us_img_two[0])): ?>
		<div class="section-about-us">
			<div class="container">
				<div class="grid-3_sm-2_xs-1-middle fade-up">
					<?php foreach($about_us_img_two as $item): ?>
					<div class="col">
						<div class="item-gallery">
							<?php echo wp_get_attachment_image($item, 'thumbnail'); ?>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<?php endif; if(!empty($about_us_title_two) || (!empty($about_us_txt_one) && !empty($about_us_txt_two))): ?>
		<div class="section-about-us">
			<div class="container">
				<?php
					if(!empty($about_us_title_two)):
				?>
				<div class="section-title-content text-center fade-up">
					<p class="section-title"><?php echo nl2br($about_us_title_two); ?></p>
				</div>
				<?php
					endif;
					if(!empty($about_us_txt_one) && !empty($about_us_txt_two)):
				?>
				<div class="container-small fade-up" style="padding:0">
					<div class="grid-2_md-1">
						<div class="col">
							<?php
								echo apply_filters('the_content', $about_us_txt_one);
							?>
						</div>
						<div class="col">
							<?php
								echo apply_filters('the_content', $about_us_txt_two);
							?>
						</div>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<?php endif; if(is_numeric($about_us_img_three)): ?>
		<div class="section-about-us full-img fade-up">
			<div class="container">
				<div class="container-small" style="padding:0">
					<?php echo wp_get_attachment_image($about_us_img_three, 'large'); ?>
				</div>
			</div>
		</div>
		<?php endif; if(is_numeric($about_us_img_four) && is_numeric($about_us_img_five)): ?>
		<div class="section-about-us full-img fade-up">
			<div class="grid-2_xs-1-noGutter">
				<div class="col">
					<?php echo wp_get_attachment_image($about_us_img_four, 'full'); ?>
				</div>
				<div class="col">
					<?php echo wp_get_attachment_image($about_us_img_five, 'full'); ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<div class="section-about-us">
			<div class="container">
				<?php
					if(!empty($about_us_title_three) && !empty($about_us_title_four)):
				?>
				<div class="section-title-content fade-up">
					<div class="grid">
						<div class="col-9_md-12" data-push-left="off-3">
							<p class="section-title"><?php echo nl2br($about_us_title_three); ?></p>
						</div>
					</div>
					<div class="grid">
						<div class="col-7_md-12" data-push-left="off-5">
							<p class="section-title"><?php echo nl2br($about_us_title_four); ?></p>
						</div>
					</div>
				</div>
				<?php
					endif;
					if(is_numeric($about_us_img_six) && is_numeric($about_us_img_seven) && is_numeric($about_us_img_eight)):
				?>
				<div class="columns-img">
					<div class="grid-middle">
						<div class="col-8_sm-12">
							<div class="column-img-left">
								<div class="column-img-item fade-up">
									<?php echo wp_get_attachment_image($about_us_img_six, 'large'); ?>
								</div>
								<div class="column-img-item fade-up">
									<?php echo wp_get_attachment_image($about_us_img_seven, 'large'); ?>
								</div>
							</div>
						</div>
						<div class="col-4_sm-12">
							<div class="column-img-right">
								<div class="column-img-item fade-up">
									<?php echo wp_get_attachment_image($about_us_img_eight, 'large'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php 
	endwhile; endif;
	get_footer();
?>