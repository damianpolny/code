<?php
	/* Template name: Komentarze */
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
	
	$kurs = null;
	$poziom = null;
	$rok = null;
	
	$comments_post = get_posts(array(
		'fields' => 'ids',
		'post_type' => 'komentarz',
		'posts_per_page' => -1,
	));
	
	$kurs = wp_get_object_terms($comments_post, 'kurs', array('ids'));
	$poziom = wp_get_object_terms($comments_post, 'poziom', array('ids'));
	$rok = wp_get_object_terms($comments_post, 'rok', array('ids'));
		
	$id_front_page = get_option('page_on_front');
	$id_page = get_the_ID();
	$section_comments_video = rwmb_meta('section_comments_video', '', $id_front_page);
	$section_comment_title = rwmb_meta('section_comment_title', '', $id_front_page);
	$section_comment_text = rwmb_meta('section_comment_text', '', $id_front_page);
	$section_images = rwmb_meta('section_images', '', $id_front_page);
	if(isset(reset($section_comments_video)['src']) && mobile_detect() != 'phone'):
?>
	<div class="page-section-content" style="padding-bottom:30px">
		<div class="container-medium">
			<div class="section-info section-info-second">
				<video loop muted autoplay>
					<source src="<?php echo reset($section_comments_video)['src']; ?>" type="video/mp4">
					Your browser does not support the video tag.
				</video>
				<div class="section-info-content xs-hidden">
					<div class="section-info-text">
						<div class="grid-middle">
							<div class="col-5_lg-6_sm-12">
							<?php
								if(!empty($section_comment_title)):
							?>
								<p class="section-info-title" style="margin-bottom:10px;"><?php echo $section_comment_title; ?></p>
							<?php
								endif;
								if(!empty($section_comment_text))
								{
									echo '<div style="font-size:22px;line-height:1.4;text-shadow:0px 3px 6px rgb(0 0 0 / 20%);">';
									echo apply_filters('the_content', $section_comment_text);
									echo '</div>';
								}
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
		<?php
			if(!empty($kurs) || !empty($poziom) || !empty($rok)):
		?>
		<div class="subject-filter-content" id="comments_filters">
			<div class="subject-filter">
				<form id="form_comments_filters">
					<div class="subject-filter-header">
						<div class="grid-4_lg-3_md-2_xs-1-center">
							<?php if(!empty($kurs)): ?>
							<div class="col subject-filter-list-col">
								<div class="subject-filter-list-name">
									<?php echo __('Przedmiot', 'cn'); ?>
									<svg viewBox="0 0 19.998933 19.997457" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg"> <defs id="defs1" /> <g id="plus" transform="matrix(0.978,-0.208,0.208,0.978,-0.11540444,2.1201315)"> <rect id="background" width="20" height="20" fill="none" x="0" y="0" /> <g id="Dribbble-Light-Preview" transform="rotate(12.088691,10.016932,1.6725644)"> <g id="icons" transform="rotate(-0.16653957,9.9992846,10.000001)"> <path id="arrow_left-_350_" data-name="arrow_left-[#350]" d="m 94,6499 -1.435,-1.393 7.607,-7.607 H 84 v -2 h 16.172 L 92.586,6480.414 94,6479 l 10,10 -10,10" transform="translate(-84,-6479)" fill-rule="evenodd" /> </g> </g> </g> </svg>
								</div>
								<ul class="subject-filter-list">
									<?php foreach($kurs as $item): ?>
									<li>
										<input type="radio" id="<?php echo $item->slug; ?>" name="kurs" value="<?php echo $item->slug; ?>">
										<label for="<?php echo $item->slug; ?>">
											<?php echo $item->name; ?>
											<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22ZM10.2426 14.4142L17.3137 7.34315L18.7279 8.75736L10.2426 17.2426L6 13L7.41421 11.5858L10.2426 14.4142Z"/></svg>
										</label>
									</li>
									<?php endforeach; ?>
								</ul>
							</div>
							<?php
								endif;
								if(!empty($poziom)):
							?>
							<div class="col subject-filter-list-col">
								<div class="subject-filter-list-name">
									<?php echo __('Poziom', 'cn'); ?>
									<svg viewBox="0 0 19.998933 19.997457" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg"> <defs id="defs1" /> <g id="plus" transform="matrix(0.978,-0.208,0.208,0.978,-0.11540444,2.1201315)"> <rect id="background" width="20" height="20" fill="none" x="0" y="0" /> <g id="Dribbble-Light-Preview" transform="rotate(12.088691,10.016932,1.6725644)"> <g id="icons" transform="rotate(-0.16653957,9.9992846,10.000001)"> <path id="arrow_left-_350_" data-name="arrow_left-[#350]" d="m 94,6499 -1.435,-1.393 7.607,-7.607 H 84 v -2 h 16.172 L 92.586,6480.414 94,6479 l 10,10 -10,10" transform="translate(-84,-6479)" fill-rule="evenodd" /> </g> </g> </g> </svg>
								</div>
								<ul class="subject-filter-list">
									<?php
										foreach($poziom as $item):
										$short_name_level = rwmb_meta('short_name_level', ['object_type' => 'term'], $item->term_id);
										if(!empty($short_name_level)):
									?>
									<li>
										<input type="radio" id="<?php echo $item->slug; ?>" name="poziom" value="<?php echo $item->slug; ?>">
										<label for="<?php echo $item->slug; ?>">
											<?php echo $short_name_level; ?>
											<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22ZM10.2426 14.4142L17.3137 7.34315L18.7279 8.75736L10.2426 17.2426L6 13L7.41421 11.5858L10.2426 14.4142Z"/></svg>
										</label>
									</li>
									<?php endif; endforeach; ?>
								</ul>
							</div>
							<?php
								endif;
								if(!empty($rok)):
							?>
							<div class="col subject-filter-list-col">
								<div class="subject-filter-list-name">
									<?php echo __('Rok', 'cn'); ?>
									<svg viewBox="0 0 19.998933 19.997457" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg"> <defs id="defs1" /> <g id="plus" transform="matrix(0.978,-0.208,0.208,0.978,-0.11540444,2.1201315)"> <rect id="background" width="20" height="20" fill="none" x="0" y="0" /> <g id="Dribbble-Light-Preview" transform="rotate(12.088691,10.016932,1.6725644)"> <g id="icons" transform="rotate(-0.16653957,9.9992846,10.000001)"> <path id="arrow_left-_350_" data-name="arrow_left-[#350]" d="m 94,6499 -1.435,-1.393 7.607,-7.607 H 84 v -2 h 16.172 L 92.586,6480.414 94,6479 l 10,10 -10,10" transform="translate(-84,-6479)" fill-rule="evenodd" /> </g> </g> </g> </svg>
								</div>
								<ul class="subject-filter-list">
									<?php
										foreach($rok as $item):
									?>
									<li>
										<input type="radio" id="<?php echo $item->slug; ?>" name="rok" value="<?php echo $item->slug; ?>">
										<label for="<?php echo $item->slug; ?>">
											<?php echo $item->name; ?>
											<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22ZM10.2426 14.4142L17.3137 7.34315L18.7279 8.75736L10.2426 17.2426L6 13L7.41421 11.5858L10.2426 14.4142Z"/></svg>
										</label>
									</li>
									<?php endforeach; ?>
								</ul>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</form>
			</div>
			<div class="text-center">
				<div class="filter-reset">
					<?php echo __('RESETUJ USTAWIENIA', 'cn'); ?>
					<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM15.7123 16.773L12 13.0607L8.28769 16.773L7.22703 15.7123L10.9393 12L7.22703 8.28769L8.28769 7.22703L12 10.9393L15.7123 7.22703L16.773 8.28769L13.0607 12L16.773 15.7123L15.7123 16.773Z" fill="#000000"/></svg>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<div style="max-width:836px;width:100%;margin:0 auto" id="comments_the_content">
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