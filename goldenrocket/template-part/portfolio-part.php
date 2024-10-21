<?php
$id_front_page = get_option('page_on_front');
$page_offer_title = null;
$page_offer_showreel = null;
$portfolio_taxonomy_pdf = null;
$gallery_taxonomy_pdf = null;
if(is_post_type_archive())
{
	$page_offer_showreel = rwmb_meta('page_offer_showreel', '', $id_front_page);
	$page_offer_title = rwmb_meta('page_offer_title', '', $id_front_page);
	$page_offer_txt = rwmb_meta('page_offer_txt', '', $id_front_page);
}
if(is_tax())
{
	$term_id = get_queried_object_id();
	$page_offer_showreel = rwmb_meta('portfolio_taxonomy_video', ['object_type' => 'term'], $term_id);
	$portfolio_taxonomy_pdf = rwmb_meta('portfolio_taxonomy_pdf', ['object_type' => 'term'], $term_id);
	$gallery_taxonomy_pdf = rwmb_meta('gallery_taxonomy_pdf', ['object_type' => 'term'], $term_id);
}
if(!empty($page_offer_title))
{
	$title = $page_offer_title;
}
else
{
	if(is_category() || is_tag() || is_tax())
	{
		$title = single_term_title('', false);
	}
	elseif(is_search())
	{
		$title = __('Wyniki wyszukiwania', ' goldenrocket');
	}
	elseif(is_post_type_archive())
	{
		$title = post_type_archive_title('', false);
	}
	else
	{
		$title = __('Oferta', 'goldenrocket');
	}
}
$category = get_terms(array(
	'taxonomy' => 'kategoria-portfolio',
	'hide_empty' => false
));
if(is_array($page_offer_showreel) && !empty($page_offer_showreel)):
?>
		<div class="showreel-content">
		<?php
			foreach($page_offer_showreel as $item)
			{
				echo '<div class="showreel-video"><video id="showreel_player_loop" muted autoplay preload="none" data-plyr-config=\'{"volume":0, "enabled":true,"storage":{"enabled":false},"muted":true}\'><source src="'.$item['src'].'" type="video/mp4">Your browser does not support the video tag.</video></div>';
			}
		?>
		</div>
		<?php endif; if(!empty($portfolio_taxonomy_pdf)): ?>
		<div class="showreel-content">
			<?php echo do_shortcode($portfolio_taxonomy_pdf); ?>
		</div>
		<?php endif; ?>
		<div class="page-wraper">
			<div class="container">
				<div class="bar-title fade-up">
					<span></span><strong><?php echo __('Portfolio', 'goldenrocket'); ?></strong><span></span>
				</div>
				<div class="page-title-content fade-up">
					<h1 class="page-title"><?php echo $title; ?></h1>
				</div>
				<?php
					if(!empty($page_offer_txt)):
				?>
				<div class="section-text-content fade-up">
					<div class="container-small">
						<?php echo apply_filters('the_content', $page_offer_txt); ?>
					</div>
				</div>
				<?php
					endif;
					if(!empty($gallery_taxonomy_pdf)):
				?>
					<div class="tax-gallery">
						<?php echo do_shortcode($gallery_taxonomy_pdf); ?>
					</div>
					<?php elseif(!empty($category) && is_post_type_archive()): ?>
					<div class="grid-2_sm-1">
						<?php
							$count = 0;
							foreach($category as $item_tax):
							$offer_video = rwmb_meta('portfolio_taxonomy_video', ['object_type' => 'term'], $item_tax->term_id);
							$offer_img = rwmb_meta('portfolio_taxonomy_img', ['object_type' => 'term'], $item_tax->term_id);
							if(is_array($offer_video) && !empty($offer_video)):
							foreach($offer_video as $item):
							if(isset($offer_img['ID'])): 
						?>
						<div class="col fade-up">
							<a href="<?php echo get_term_link($item_tax); ?>">
								<div class="video-hover" data-number="<?php echo $count; ?>" style="--bg-image: url(<?php echo wp_get_attachment_image_url($offer_img['ID'], 'medium'); ?>);margin-bottom:30px;">
									<?php if(mobile_detect() == 'phone'): ?>
										<?php echo wp_get_attachment_image($offer_img['ID'], 'medium'); ?>
									<?php else: ?>
									<video class="player-hover" controls playsinline preload="none" data-plyr-config='{"volume":0, "enabled":true,"storage":{"enabled":false},"muted":true}'>
										<source src="<?php echo $item['src']; ?>" type="video/mp4" />
									</video>
									<?php endif; ?>
								</div>
							</a>
						</div>
						<?php
							$count++;
							endif;
							endforeach;
							endif;
							endforeach;
						?>
					</div>
				<?php elseif(have_posts()): ?>
					<div class="grid-2_sm-1">
						<?php
							$count = 0;
							while(have_posts()): the_post();
							$id_post = get_the_ID();
							if(has_post_thumbnail()):
						?>
						<div class="col fade-up">
							<div class="video-hover" data-number="<?php echo $count; ?>" style="--bg-image: url(<?php echo get_the_post_thumbnail_url('', 'medium'); ?>);margin-bottom:30px;">
								<a class="read-more-button" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								<?php echo get_the_post_thumbnail('', 'medium'); ?>
							</div>
						</div>
						<?php
							$count++;
							endif;
							endwhile;
						?>
					</div>
				<?php else: ?>
				<p class="text-center fade-up"><?php echo __('Brak treści do wyświetlenia.', 'goldenrocket'); ?></p>
				<?php endif; ?>
			</div>
		</div>
