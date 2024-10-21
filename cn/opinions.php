<?php
	/* Template name: Opinie */
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
	$id_front_page = get_option('page_on_front');
	$id_page = get_the_ID();
	$section_images = rwmb_meta('section_images', '', $id_front_page);
	$section_info_video = rwmb_meta('section_info_video', '', $id_front_page);
	$section_info_procent = rwmb_meta('section_info_procent', '', $id_front_page);
	$section_info_title = rwmb_meta('section_info_title', '', $id_front_page);
	$opinions_content = rwmb_meta('opinions_content', '', $id_page);
	if(isset(reset($section_info_video)['src']) && mobile_detect() != 'phone'):
?>
	<div class="page-section-content" style="padding-bottom:50px">
		<div class="container-medium">
			<div class="section-info">
				<video loop muted autoplay>
					<source src="<?php echo reset($section_info_video)['src']; ?>" type="video/mp4">
					Your browser does not support the video tag.
				</video>
				<div class="section-info-content xs-hidden">
					<div class="section-info-text">
						<div class="grid-center-middle">
							<div class="col-4_lg-6_sm-12">
							<?php
								if(!empty($section_info_procent)):
							?>
								<p class="section-info-percent"><?php echo $section_info_procent; ?><span>%</span></p>
							<?php
								endif;
							?>
							</div>
							<div class="col-5_lg-6_sm-12">
							<?php
								if(!empty($section_info_title)):
							?>
								<p class="section-info-title"><?php echo $section_info_title; ?></p>
							<?php
								endif;
							?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		else:
	?>
	<div style="height:35px"></div>
	<?php
		endif;
	?>
	<div class="container">
		<div class="page-title-content big-margin text-center">
			<h1 class="page-title"><?php the_title(); ?></h1>
		</div>
		<?php if(isset($opinions_content[0]['opinions_content_year']) && isset($opinions_content[0]['opinions_content_year'])): ?>
		<div class="subject-filter-content" id="opinion_filters">
			<div class="subject-filter">
				<div class="subject-filter-header">
					<div class="grid-5_lg-3_md-2_xs-1-center grid-medium">
						<div class="col subject-filter-list-col">
							<div class="subject-filter-list-name">
								<?php echo __('ROK', 'cn'); ?>
								<svg viewBox="0 0 19.998933 19.997457" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg"> <defs id="defs1" /> <g id="plus" transform="matrix(0.978,-0.208,0.208,0.978,-0.11540444,2.1201315)"> <rect id="background" width="20" height="20" fill="none" x="0" y="0" /> <g id="Dribbble-Light-Preview" transform="rotate(12.088691,10.016932,1.6725644)"> <g id="icons" transform="rotate(-0.16653957,9.9992846,10.000001)"> <path id="arrow_left-_350_" data-name="arrow_left-[#350]" d="m 94,6499 -1.435,-1.393 7.607,-7.607 H 84 v -2 h 16.172 L 92.586,6480.414 94,6479 l 10,10 -10,10" transform="translate(-84,-6479)" fill-rule="evenodd" /> </g> </g> </g> </svg>
							</div>
							<ul class="subject-filter-list">
								<?php
									$count = 1;
									foreach($opinions_content as $item):
									if(isset($item['opinions_content_year']) && isset($item['opinions_content_img'])):
								?>
								<li>
									<input type="radio" id="year_<?php echo $item['opinions_content_year']; ?>" name="rok" value="<?php echo $item['opinions_content_year']; ?>"<?php if($count == 1): ?> checked<?php endif; ?>>
									<label for="year_<?php echo $item['opinions_content_year']; ?>">
										<?php echo $item['opinions_content_year']; ?>
										<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22ZM10.2426 14.4142L17.3137 7.34315L18.7279 8.75736L10.2426 17.2426L6 13L7.41421 11.5858L10.2426 14.4142Z"/></svg>
									</label>
								</li>
								<?php
									$count++;
									endif;
									endforeach;
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="text-center">
				<div class="filter-reset">
					<?php echo __('RESETUJ USTAWIENIA', 'cn'); ?>
					<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM15.7123 16.773L12 13.0607L8.28769 16.773L7.22703 15.7123L10.9393 12L7.22703 8.28769L8.28769 7.22703L12 10.9393L15.7123 7.22703L16.773 8.28769L13.0607 12L16.773 15.7123L15.7123 16.773Z" fill="#000000"/></svg>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<div style="max-width:836px;width:100%;margin:0 auto">
			<?php
				$count = 1;
				if(isset($opinions_content[0]['opinions_content_year']) && isset($opinions_content[0]['opinions_content_year'])):
				foreach($opinions_content as $item):
				if(isset($item['opinions_content_year']) && isset($item['opinions_content_img'])):
			?>
			<p class="opinion-content-img text-center" id="year_img_<?php echo $item['opinions_content_year']; ?>"<?php if($count != 1): ?>  style="display:none;"<?php endif; ?>>
				<img data-lazy-src="<?php echo str_replace('-scaled', '', wp_get_attachment_image_url($item['opinions_content_img'], 'full')); ?>" alt="<?php echo $item['opinions_content_year']; ?>">
				<?php
					if(isset($item['opinions_content_imgs']))
					{
						foreach($item['opinions_content_imgs'] as $img):
				?>
					<img data-lazy-src="<?php echo str_replace('-scaled', '', wp_get_attachment_image_url($img, 'full')); ?>" alt="<?php echo $item['opinions_content_year']; ?>">
				<?php
						endforeach;
					}
				?>
			</p>
			<?php
				$count++;
				endif;
				endforeach;
				endif;
			?>
			<?php the_content(); ?>
		</div>
	</div>
	<?php
		if(isset($section_images['ID'])):
	?>
	<div class="page-wraper">
		<div class="page-section-content">
			<div class="container">
					<?php echo wp_get_attachment_image($section_images['ID'], 'large'); ?>
			</div>
		</div>
	</div>
<?php
	endif;
	endwhile; endif;
	get_footer();
?>