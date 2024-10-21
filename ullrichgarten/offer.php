<?php
	/* Template name: Offer */
	get_header(); 
	if(have_posts()): while(have_posts()): the_post();
	$id_page = get_the_ID();
	$subtitle_one = get_field('subtitle_one', $id_page);
	$subtitle_two = get_field('subtitle_two', $id_page);
	$section_left = get_field('section_left', $id_page);
	$section_right = get_field('section_right', $id_page);
	$offer_section_txt = get_field('offer_section_txt', $id_page);
	$offer_section_name = get_field('offer_section_name', $id_page);
	$section_left_bottom = get_field('section_left_bottom', $id_page);
?>
	<div class="page-hero-top">
		<div class="page-hero-top-content">
			<div class="container">
				<div class="section-title-content">
					<?php if(!empty($subtitle_one) && !empty($subtitle_two)): ?>
					<div class="grid">
						<div class="col-9_md-12" data-push-left="off-3">
							<p class="section-title fade-left"><?php echo nl2br($subtitle_one); ?></p>
						</div>
					</div>
					<div class="grid">
						<div class="col-7_md-12" data-push-left="off-5">
							<p class="section-title fade-right"><?php echo nl2br($subtitle_two); ?></p>
						</div>
					</div>
					<?php elseif(!empty($subtitle_one) && empty($subtitle_two)): ?>
					<p class="section-title fade-left"><?php echo $subtitle_one; ?></p>
					<?php elseif(empty($subtitle_one) && !empty($subtitle_two)): ?>
					<p class="section-title fade-left"><?php echo $subtitle_two; ?></p>
					<?php else: ?>
					<h1 class="section-title fade-left"><?php the_title(); ?></h1>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="page-wraper">
		<div class="container">
			<?php
				if(isset($section_left[0]) || isset($section_right[0])):
			?>
			<div class="offer-section" data-scrollbg="#CAD8A9">
				<div class="columns-img">
					<div class="grid-middle">
						<div class="col-8_sm-12">
							<div class="column-img-left">
								<?php
									if(isset($section_left[0])):
									foreach($section_left as $item):
									if(isset($item['section_left_img'])):
								?>
								<div class="column-img-item fade-up">
									<?php
										if(isset($item['section_left_url']))
										{
											echo '<a href="'.esc_url($item['section_left_url']).'">';
										}
										echo '<p>'.wp_get_attachment_image($item['section_left_img'], 'large').'</p>';
										$title = get_the_title($item['section_left_img']);
										$content = get_the_content('', '', $item['section_left_img']);
										if(!empty($title)):
									?>
									<p style="color:var(--default);margin-bottom:0;"><?php echo $title; ?></p>
									<?php endif; if(!empty($content)): ?>
									<p style="color:var(--fourth);margin-bottom:0;"><?php echo $content; ?></p>
									<?php
										endif;
										if(isset($item['section_left_url']))
										{
											echo '</a>';
										}
									?>
								</div>
								<?php endif; endforeach; endif; ?>
							</div>
						</div>
						<div class="col-4_sm-12">
							<div class="column-img-right">
								<?php
									if(isset($section_right[0])):
									foreach($section_right as $item):
									if(isset($item['section_right_img'])):
								?>
								<div class="column-img-item fade-up">
									<?php
										if(isset($item['section_right_url']))
										{
											echo '<a href="'.esc_url($item['section_right_url']).'">';
										}
										echo '<p>'.wp_get_attachment_image($item['section_right_img'], 'large').'</p>';
										$title = get_the_title($item['section_left_img']);
										$content = get_the_content('', '', $item['section_left_img']);
										if(!empty($title)):
									?>
										<p style="color:var(--default);margin-bottom:0;"><?php echo $title; ?></p>
										<?php endif; if(!empty($content)): ?>
										<p style="color:var(--fourth);margin-bottom:0;"><?php echo $content; ?></p>
									<?php
										endif;
										if(isset($item['section_right_url']))
										{
											echo '</a>';
										}
									?>
								</div>
								<?php endif; endforeach; endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
				endif;
				if(!empty($offer_section_txt) || !empty($offer_section_name)):
			?>
			<div class="offer-section text-center" data-scrollbg="#ffffff">
				<p class="fade-up"><?php echo nl2br($offer_section_txt); ?></p>
				<p class="fade-up"><?php echo nl2br($offer_section_name); ?></p>
			</div>
			<?php
				endif;
				if(isset($section_left_bottom[0])):
			?>
			<div class="offer-section">
				<div class="columns-img">
					<div class="grid-middle">
						<div class="col-8_sm-12">
							<div class="column-img-left">
								<?php
									if(isset($section_left_bottom[0])):
									foreach($section_left_bottom as $item):
									if(isset($item['section_left_bottom_img'])):
								?>
								<div class="column-img-item fade-up">
									<?php
										if(isset($item['section_left_bottom_url']))
										{
											echo '<a href="'.esc_url($item['section_left_bottom_url']).'">';
										}
										echo '<p>'.wp_get_attachment_image($item['section_left_bottom_img'], 'large').'</p>';
										$title = get_the_title($item['section_left_bottom_img']);
										$content = get_the_content('', '', $item['section_left_bottom_img']);
										if(!empty($title)):
									?>
									<p style="color:var(--default);margin-bottom:0;"><?php echo $title; ?></p>
									<?php endif; if(!empty($content)): ?>
									<p style="color:var(--fourth);margin-bottom:0;"><?php echo $content; ?></p>
									<?php
										endif;
										if(isset($item['section_left_bottom_url']))
										{
											echo '</a>';
										}
									?>
								</div>
								<?php endif; endforeach; endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
				endif;
			?>
		</div>
	</div>
<?php 
	endwhile; endif;
	get_footer();
?>