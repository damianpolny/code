<?php

get_header();
$post_id_page_archive = get_option('page_for_posts', true);
if(is_category() || is_tag() || is_tax())
{
	$title = single_term_title('', false);
}
elseif(is_search())
{
	$title = __('Wyniki wyszukiwania', 'cn');
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
	$title = __('News', 'cn');
}
?>
		<div class="page-wraper">
			<div class="container-between">
				<div class="page-title-content text-center">
					<h1 class="page-title"><?php echo $title; ?></h1>
				</div>
				<?php if(have_posts()) { ?>
					<div class="grid-2_md-1">
					<?php
						while(have_posts()): the_post();
							echo get_template_part('template-part/post', 'content');
						endwhile;
					?>
					</div>
				<?php
					$pagination = get_the_posts_pagination(array(
						'mid_size' => 2,
					));
					if(!empty($pagination))
					{
						echo '<div class="pagination-content text-center">';
						echo $pagination;
						echo '</div>';
					}
				} else {
				?>
				<p><?php echo __('Brak wpisów do wyświetlenia.', 'cn'); ?></p>
				<?php } ?>
			</div>
		</div>
<?php get_footer(); ?>
