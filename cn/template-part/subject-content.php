<?php
	$kurs = null;
	$poziom = null;
	$dzien = null;
	$kurs_checked = null;
	$year_check = null;
	$is_tax_kurs = is_tax('kurs');

	if(!$is_tax_kurs)
	{
		$kurs = get_terms([
			'taxonomy' => 'kurs',
			'hide_empty' => false,
		]);
		$poziom = get_terms([
			'taxonomy' => 'poziom',
			'hide_empty' => false,
		]);
		$dzien = get_terms([
			'taxonomy' => 'dzien',
			'hide_empty' => false,
		]);
		$typ = get_terms([
			'taxonomy' => 'typ',
			'hide_empty' => true,
		]);
	}

	if($is_tax_kurs)
	{
		$kurs_checked = get_queried_object()->slug;
	}

	if(isset($_GET['year_check']))
	{
		$year_check = $_GET['year_check'];
	}
	
	if(is_tax('kurs'))
	{
		$subject_id = get_queried_object_id();
		if(is_numeric($subject_id))
		{
			$page_info_subject = get_posts(array(
				'post_type' => 'page',
				'hierarchical' => 0,
				'orderby' => 'menu_order',
				'meta_query' => array(
					'relation' => 'AND',
					array(
						'key' => 'page_subject_term',
						'value' => $subject_id,
						'compare' => '='
					)
				)
			));
		}
	}
	
?>
<div class="page-wraper">
	<div class="container">
		<div class="page-title-content text-center">
			<?php if(is_category() || is_tag() || is_tax()): ?>
			<h1 class="page-title"><?php single_term_title(); ?></h1>
			<?php elseif(is_search()): ?>
			<p class="page-title"><?php echo __('Wyniki wyszukiwania', 'cn'); ?></p>
			<?php elseif(is_post_type_archive()): ?>
			<h1 class="page-title"><?php echo post_type_archive_title('', false); ?></h1>
			<?php endif; ?>			
		</div>
		<?php if(isset($page_info_subject[0]->ID)): ?>
		<p class="content-custom-button-next" style="margin-top:-20px;margin-bottom:55px;"><a class="custom-button-next" href="<?php echo get_permalink($page_info_subject[0]->ID); ?>"><span><?php echo __('opis', 'cn'); ?></span></a></p>
		<?php endif; ?>
		<div class="page-content">
			<?php
				if(!empty($kurs) || !empty($poziom) || !empty($dzien) || !empty($typ)):
			?>
			<div class="subject-filter-content" id="subject_filter">
				<form id="form_filter">
					<div class="subject-filter">
						<div class="subject-filter-header">
							<div class="grid-5_lg-3_md-2_xs-1 grid-medium">
								<?php if(!empty($kurs)): ?>
								<div class="col subject-filter-list-col">
									<div class="subject-filter-list-name<?php foreach($kurs as $item): if($kurs_checked == $item->slug): ?> active<?php endif; endforeach; ?>">
										<?php echo __('Przedmiot', 'cn'); ?>
										<svg viewBox="0 0 19.998933 19.997457" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg"> <defs id="defs1" /> <g id="plus" transform="matrix(0.978,-0.208,0.208,0.978,-0.11540444,2.1201315)"> <rect id="background" width="20" height="20" fill="none" x="0" y="0" /> <g id="Dribbble-Light-Preview" transform="rotate(12.088691,10.016932,1.6725644)"> <g id="icons" transform="rotate(-0.16653957,9.9992846,10.000001)"> <path id="arrow_left-_350_" data-name="arrow_left-[#350]" d="m 94,6499 -1.435,-1.393 7.607,-7.607 H 84 v -2 h 16.172 L 92.586,6480.414 94,6479 l 10,10 -10,10" transform="translate(-84,-6479)" fill-rule="evenodd" /> </g> </g> </g> </svg>
									</div>
									<ul class="subject-filter-list subject-filter-list-subject">
										<?php
											foreach($kurs as $item):
											$level_slug = array();
											$subject_ids = get_posts(
												array(
													'post_type' => 'kurs',
													'posts_per_page' => -1,
													'tax_query' => array(
														array(
															'taxonomy' => $item->taxonomy,
															'field' => 'slug',
															'terms' => $item->slug
														)
													),
													'fields' => 'ids'
												)
											);
											$level = wp_get_object_terms($subject_ids, 'poziom');
											if(isset($level[0]))
											{
												foreach($level as $item_a)
												{
													$level_slug[] = '#list-'.$item_a->slug;
												}
											}
										?>
										<li<?php if(isset($level_slug[0])): ?> data-slug="<?php echo implode(',', $level_slug); ?>"<?php endif; ?>>
											<input type="radio" id="<?php echo $item->slug; ?>" name="kurs" value="<?php echo $item->slug; ?>"<?php if($kurs_checked == $item->slug): ?> checked<?php endif; ?>>
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
									<ul class="subject-filter-list subject-filter-list-level">
										<?php
											foreach($poziom as $item):
											$short_name_level = rwmb_meta('short_name_level', ['object_type' => 'term'], $item->term_id);
											if(!empty($short_name_level)):
										?>
										<li id="list-<?php echo $item->slug; ?>">
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
									if(!empty($dzien)):
								?>
								<div class="col subject-filter-list-col">
									<div class="subject-filter-list-name">
										<?php echo __('Dzień', 'cn'); ?>
										<svg viewBox="0 0 19.998933 19.997457" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg"> <defs id="defs1" /> <g id="plus" transform="matrix(0.978,-0.208,0.208,0.978,-0.11540444,2.1201315)"> <rect id="background" width="20" height="20" fill="none" x="0" y="0" /> <g id="Dribbble-Light-Preview" transform="rotate(12.088691,10.016932,1.6725644)"> <g id="icons" transform="rotate(-0.16653957,9.9992846,10.000001)"> <path id="arrow_left-_350_" data-name="arrow_left-[#350]" d="m 94,6499 -1.435,-1.393 7.607,-7.607 H 84 v -2 h 16.172 L 92.586,6480.414 94,6479 l 10,10 -10,10" transform="translate(-84,-6479)" fill-rule="evenodd" /> </g> </g> </g> </svg>
									</div>
									<ul class="subject-filter-list">
										<?php foreach($dzien as $item): ?>
										<li>
											<input type="checkbox" id="<?php echo $item->slug; ?>" name="dzien[]" value="<?php echo $item->slug; ?>">
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
								?>
								<div class="col subject-filter-list-col">
									<div class="subject-filter-list-name">
										<?php echo __('Godzina', 'cn'); ?>
										<svg viewBox="0 0 19.998933 19.997457" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg"> <defs id="defs1" /> <g id="plus" transform="matrix(0.978,-0.208,0.208,0.978,-0.11540444,2.1201315)"> <rect id="background" width="20" height="20" fill="none" x="0" y="0" /> <g id="Dribbble-Light-Preview" transform="rotate(12.088691,10.016932,1.6725644)"> <g id="icons" transform="rotate(-0.16653957,9.9992846,10.000001)"> <path id="arrow_left-_350_" data-name="arrow_left-[#350]" d="m 94,6499 -1.435,-1.393 7.607,-7.607 H 84 v -2 h 16.172 L 92.586,6480.414 94,6479 l 10,10 -10,10" transform="translate(-84,-6479)" fill-rule="evenodd" /> </g> </g> </g> </svg>
									</div>
									<ul class="subject-filter-list">
										<li>
											<input type="checkbox" id="morning" name="hours[]" value="9_12">
											<label for="morning">
												9:00 - 12:00
												<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22ZM10.2426 14.4142L17.3137 7.34315L18.7279 8.75736L10.2426 17.2426L6 13L7.41421 11.5858L10.2426 14.4142Z"/></svg>
											</label>
										</li>
										<li>
											<input type="checkbox" id="afternoon" name="hours[]" value="1630_1930">
											<label for="afternoon">
												16:30 - 19:30
												<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22ZM10.2426 14.4142L17.3137 7.34315L18.7279 8.75736L10.2426 17.2426L6 13L7.41421 11.5858L10.2426 14.4142Z"/></svg>
											</label>
										</li>
										<li>
											<input type="checkbox" id="south" name="hours[]" value="1215_1515">
											<label for="south">
												12:15 - 15:15
												<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22ZM10.2426 14.4142L17.3137 7.34315L18.7279 8.75736L10.2426 17.2426L6 13L7.41421 11.5858L10.2426 14.4142Z"/></svg>
											</label>
										</li>
									</ul>
								</div>
								<?php
									if(!empty($typ)):
								?>
								<div class="col subject-filter-list-col">
									<div class="subject-filter-list-name">
										<?php echo __('Rodzaj kursu', 'cn'); ?>
										<svg viewBox="0 0 19.998933 19.997457" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg"> <defs id="defs1" /> <g id="plus" transform="matrix(0.978,-0.208,0.208,0.978,-0.11540444,2.1201315)"> <rect id="background" width="20" height="20" fill="none" x="0" y="0" /> <g id="Dribbble-Light-Preview" transform="rotate(12.088691,10.016932,1.6725644)"> <g id="icons" transform="rotate(-0.16653957,9.9992846,10.000001)"> <path id="arrow_left-_350_" data-name="arrow_left-[#350]" d="m 94,6499 -1.435,-1.393 7.607,-7.607 H 84 v -2 h 16.172 L 92.586,6480.414 94,6479 l 10,10 -10,10" transform="translate(-84,-6479)" fill-rule="evenodd" /> </g> </g> </g> </svg>
									</div>
									<ul class="subject-filter-list">
										<?php foreach($typ as $item): ?>
										<li>
											<input type="radio" id="<?php echo $item->slug; ?>" name="typ" value="<?php echo $item->slug; ?>">
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
								?>
							</div>
						</div>
					</div>
				</form>
				<div class="text-center">
					<div class="filter-reset">
						<?php echo __('RESETUJ USTAWIENIA', 'cn'); ?>
						<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM15.7123 16.773L12 13.0607L8.28769 16.773L7.22703 15.7123L10.9393 12L7.22703 8.28769L8.28769 7.22703L12 10.9393L15.7123 7.22703L16.773 8.28769L13.0607 12L16.773 15.7123L15.7123 16.773Z" fill="#000000"/></svg>
					</div>
				</div>
			</div>
			<?php
				endif;
				if(have_posts()):
			?>
			<div class="grid-4_lg-3_md-2_xs-1 grid-list-subject">
				<?php while(have_posts()): the_post(); ?>
				<div class="col">
					<?php echo get_template_part('template-part/subject', 'slider'); ?>
				</div>
				<?php endwhile; ?>
			</div>
			<?php
				else:
					echo __('Brak kursów spełniających podane kryteria.', 'cn');
				endif;
			?>
		</div>
	</div>
</div>
