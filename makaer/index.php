<?php

get_header();
$post_id_page_archive = get_option('page_for_posts', true);
if(is_category() || is_tag() || is_tax())
{
	$title = single_term_title('', false);
}
elseif(is_search())
{
	$title = __('Wyniki wyszukiwania', 'makaer');
}
elseif(is_home() && is_numeric($post_id_page_archive))
{
	$title = get_the_title($post_id_page_archive);
}
elseif(is_post_type_archive())
{
	$title = post_type_archive_title('', false);
}
else
{
	$title = __('News', 'makaer');
}
?>
		<div class="hero-top position-relative" data-name="<?php echo $title; ?>">
			<div class="container">
				<div class="hero-top-content">
					<div class="page-title-content">
						<h1 class="page-title"><?php echo $title; ?></h1>
					</div>
				</div>
			</div>
		</div>
		<div class="page-wraper">
			<div class="container-full">
				<?php
					if(have_posts()):
				?>
				<div class="grid">
				<?php
					$count = 1;
					while(have_posts()): the_post();
						if($count == 1):
					?>
					<div class="col-6_lg-8_md-12">
						<div class="content-box-post">
							<a href="<?php the_permalink(); ?>">
								<?php
									if(has_post_thumbnail())
									{
										echo '<p class="content-box-img">';
										if(mobile_detect() == 'phone')
										{
											the_post_thumbnail('thumbnail');
										}
										else
										{
											the_post_thumbnail('thumbnail_wide');
										}
										echo '</p>';
									}
								?>
								<p class="content-box-post-name"><?php the_title(); ?></p>
							</a>
							<?php the_excerpt(); if(mobile_detect() == 'phone'): ?>
							<p><a class="custom-button fill display-block" href="<?php the_permalink(); ?>"><?php echo __('CZYTAJ WIECEJ', 'makaer'); ?></a></p>
							<?php endif; ?>
						</div>
					</div>
					<?php
						else:
							echo get_template_part('template-parts/content', 'post');
						endif;
					$count++;
					endwhile;
				?>
				</div>
				<?php
					else:
				?>
					<p><?php echo __('Brak wpisów spełniających podane kryteria.', 'makaer'); ?></p>
				<?php
					endif;
				?>
			</div>
		</div>
<?php get_footer(); ?>
