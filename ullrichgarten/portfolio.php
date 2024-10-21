<?php
	/* Template name: Portfolio */
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
	$id_page = get_the_ID();
	$subtitle_one = get_field('subtitle_one', $id_page);
	$portfolio_name_top = get_field('portfolio_name_top', $id_page);
	$section_left = get_field('section_left', $id_page);
	$section_right = get_field('section_right', $id_page);
	$portfolio_section_txt = get_field('portfolio_section_txt', $id_page);
	$portfolio_section_name = get_field('portfolio_section_name', $id_page);
	$section_left_bottom = get_field('section_left_bottom', $id_page);
	$section_right_bottom = get_field('section_right_bottom', $id_page);
	$section_bottom_architekt = get_field('section_bottom_architekt', $id_page);
	$section_bottom_umsetzung = get_field('section_bottom_umsetzung', $id_page);
	$section_bottom_txt = get_field('section_bottom_txt', $id_page);
	$get_post_parent = get_post_parent($id_page);
?>
	<div class="page-hero-top">
		<div class="page-hero-top-content">
			<div class="container">
				<div class="section-title-content text-center">
					<h1 class="section-title fade-left"><?php the_title(); ?></h1>
					<?php if(!empty($subtitle_one)): ?>
					<p class="fade-right"><?php echo $subtitle_one; ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="page-wraper" style="padding-top:40px;">
		<div class="section-portfolio" data-scrollbg="#FFFFFF">
			<div class="container fade-up">
				<?php the_content(); ?>
			</div>
		</div>
		<?php if(isset($section_left[0]) || isset($section_right[0])): ?>
		<div class="section-portfolio" data-scrollbg="#CAD8A9">
			<div class="container">
				<div class="columns-img">
					<div class="grid-middle">
						<div class="col-8_sm-12">
							<div class="column-img-left">
								<?php
									if(!empty($portfolio_name_top)):
								?>
								<div class="section-title-content fade-up">
									<p class="section-title"><?php echo nl2br($portfolio_name_top); ?></p>
								</div>
								<?php
									endif;
									if(isset($section_left[0])):
									foreach($section_left as $item):
								?>
								<div class="column-img-item fade-up">
									<?php echo wp_get_attachment_image($item, 'large'); ?>
								</div>
								<?php endforeach; endif; ?>
							</div>
						</div>
						<div class="col-4_sm-12">
							<div class="column-img-right fade-up">
								<?php
									if(isset($section_right[0])):
									foreach($section_right as $item):
								?>
								<div class="column-img-item">
									<?php echo wp_get_attachment_image($item, 'large'); ?>
								</div>
								<?php endforeach; endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
			endif;
			if(!empty($portfolio_section_txt) || !empty($portfolio_section_name)):
		?>
		<div class="section-portfolio text-center" data-scrollbg="#CAD8A9">
			<div class="container">
				<p class="fade-up"><?php echo nl2br($portfolio_section_txt); ?></p>
				<p class="fade-up"><?php echo nl2br($portfolio_section_name); ?></p>
			</div>
		</div>
		<?php endif; if(isset($section_left_bottom[0]) || isset($section_right_bottom[0])): ?>
		<div class="section-portfolio" data-scrollbg="#CAD8A9">
			<div class="container">
				<div class="columns-img">
					<div class="grid-middle">
						<div class="col-8_sm-12">
							<div class="column-img-left">
								<?php
									if(isset($section_left_bottom[0])):
									foreach($section_left_bottom as $item):
								?>
								<div class="column-img-item fade-up">
									<?php echo wp_get_attachment_image($item, 'large'); ?>
								</div>
								<?php endforeach; endif; if(!empty($section_bottom_architekt) && !empty($section_bottom_umsetzung) && !empty($section_bottom_txt)): ?>
								<div class="portfolio-table fade-up">
									<ul class="list-table">
										<li><span><?php echo __('Architekt:', 'ullrichgarten'); ?></span> <span><?php echo $section_bottom_architekt; ?></span></li>
										<li><span><?php echo __('Umsetzung:', 'ullrichgarten'); ?></span> <span><?php echo $section_bottom_umsetzung; ?></span></li>
									</ul>
									<p style="padding-top:8px;border-top:1px solid var(--fourth);"><?php echo $section_bottom_txt; ?></p>
								</div>
								<?php endif; ?>
							</div>
						</div>
						<div class="col-4_sm-12">
							<div class="column-img-right">
								<?php
									if(isset($section_right_bottom[0])):
									foreach($section_right_bottom as $item):
								?>
								<div class="column-img-item fade-up">
									<?php echo wp_get_attachment_image($item, 'large'); ?>
								</div>
								<?php endforeach; endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
			endif;
		?>
	</div>
	<?php if($get_post_parent > 0): ?>
	<p class="text-center fade-up"><a class="custom-button" href="<?php echo get_the_permalink($get_post_parent); ?>"><?php echo __('ALLE GÄRTEN ANSCHAUEN', 'ullrichgarten'); ?></a></p>
<?php
	endif;
	endwhile; endif;
	get_footer();
?>