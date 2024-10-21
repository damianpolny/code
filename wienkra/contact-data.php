<?php

/* Template name: Kontakt */

get_header();
if(have_posts()): while (have_posts()): the_post();
$id_page = get_the_ID();
$the_content = get_the_content();
$section_contact_map = rwmb_meta('section_contact_map', '', $id_page);
$section_contact_img = rwmb_meta('section_contact_img', '', $id_page);
$section_contact_desc = rwmb_meta('section_contact_desc', '', $id_page);
$args_representative = array('post_type' => 'przedstawiciel', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'date', 'post_status' => 'publish');
$representative_post = new WP_Query($args_representative);
?>
	<div class="page-wraper">
		<?php if(!empty($the_content)): ?>
		<div class="container">
			<div class="page-content" style="padding-bottom: 20px;">
				<?php echo apply_filters("the_content", $the_content); ?>
			</div>
		</div>
		<?php
			endif;
			if(!empty($section_contact_map)):
		?>
		<div class="section-group" style="padding-bottom: 20px;">
			<div class="container">
				<div class="grid-middle">
					<div class="col-5_md-12">
						<div class="section-group-left">
							<?php echo apply_filters("the_content", $section_contact_map); ?>
						</div>
					</div>
					<div class="col-7_md-12">
						<div class="section-group-right map-provinces-sales-representative">
							<div id="map_provinces_sales_representative">
								<ul class="poland">
									<li class="pl1"><a href="#dolnoslaskie">Dolnośląskie</a></li>
									<li class="pl2"><a href="#kujawsko-pomorskie">Kujawsko-pomorskie</a></li>
									<li class="pl3"><a href="#lubelskie">Lubelskie</a></li>
									<li class="pl4"><a href="#lubuskie">Lubuskie</a></li>
									<li class="pl5"><a href="#lodzkie">Łódzkie</a></li>
									<li class="pl6"><a href="#malopolskie">Małopolskie</a></li>
									<li class="pl7"><a href="#mazowieckie">Mazowieckie</a></li>
									<li class="pl8"><a href="#opolskie">Opolskie</a></li>
									<li class="pl9"><a href="#podkarpackie">Podkarpackie</a></li>
									<li class="pl10"><a href="#podlaskie">Podlaskie</a></li>
									<li class="pl11"><a href="#pomorskie">Pomorskie</a></li>
									<li class="pl12"><a href="#slaskie">Śląskie</a></li>
									<li class="pl13"><a href="#swietokrzyskie">Świętokrzyskie</a></li>
									<li class="pl14"><a href="#warminsko-mazurskie">Warmińsko-mazurskie</a></li>
									<li class="pl15"><a href="#wielkopolskie">Wielkopolskie</a></li>
									<li class="pl16"><a href="#zachodniopomorskie">Zachodniopomorskie</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
			endif;
			if($representative_post -> have_posts()):
			$dzial = get_terms([
				'taxonomy' => 'dzial',
				'hide_empty' => false,
			]);
			$archive_link = get_post_type_archive_link('przedstawiciel');
		?>
		<div class="container">
			<?php if(isset($dzial[0])): ?>
			<div class="terms-inline-button">
				<ul>
					<li><a class="active" href="<?php echo $archive_link; ?>" data-id="0"><?php echo __('Wszyscy', 'wienkra'); ?></a></li>
					<?php foreach($dzial as $single): ?>
					<li><a href="<?php echo get_term_link($single); ?>" data-id="<?php echo $single->term_id; ?>"><?php echo $single->name; ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>
			<div class="representative-contact-page">
				<div class="grid-5_lg-3_md-2_sm-1">
					<?php
						while ($representative_post -> have_posts()) : $representative_post -> the_post();
						echo get_template_part('template-parts/list', 'representative');
						endwhile; wp_reset_postdata();
					?>
				</div>
			</div>
		</div>
		<?php
			endif;
			if(!empty($section_contact_desc) || isset($section_contact_img['ID'])):
		?>
		<div class="section-form-contact">
			<div class="container">
				<div class="section-title-content color-page">
					<p class="section-title"><?php echo __('Masz pytania? Porozmawiajmy', 'wienkra'); ?></p>
				</div>
				<div class="custom-hr-line"></div>
			</div>
			<div class="section-column">
				<div class="grid-noGutter-middle">
					<div class="col-7_lg-6_md-12">
						<?php
							if(!empty($section_contact_desc)):
						?>
						<div class="section-column-text">
							<?php echo apply_filters("the_content", $section_contact_desc); ?>
						</div>
						<?php endif; ?>
					</div>
					<div class="col-5_lg-6_md-12">
						<?php
							if(isset($section_contact_img['ID'])):
						?>
						<div class="section-column-img">
							<p><?php echo wp_get_attachment_image($section_contact_img['ID'], 'medium'); ?></p>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>
	</div>
	<div id="map-content"></div>
<?php endwhile; endif; get_footer(); ?>
