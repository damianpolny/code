<?php

get_header();
$title = null;
$is_home = is_home();
$post_id_page_archive = get_option('page_for_posts', true);
if(is_category() || is_tag() || is_tax())
{
	$title = single_term_title('', false);
}
elseif(is_search())
{
	$title = __('Wyniki wyszukiwania', ' goldenrocket');
}
elseif($is_home && is_numeric($post_id_page_archive))
{
	$title = get_the_title($post_id_page_archive);
}
elseif(is_post_type_archive())
{
	$title = post_type_archive_title('', false);
}
else
{
	$title = __('Post', 'goldenrocket');
}
?>
		<div class="page-wraper">
			<div class="container">
				<?php if($is_home): ?>
				<div class="bar-title fade-up">
					<span></span><strong><?php echo $title; ?></strong><span></span>
				</div>
				<?php endif; if($is_home): ?>
				<div class="page-title-content fade-up">
					<h1 class="page-title"><?php echo __('GOLDENSPACE', ' goldenrocket'); ?></h1>
				</div>
				<?php elseif(!empty($title)): ?>
				<div class="page-title-content fade-up">
					<h1 class="page-title"><?php echo $title; ?></h1>
				</div>
				<?php endif; if(have_posts()): ?>
					<div class="grid-3_md-2_sm-1">
					<?php
						while(have_posts()): the_post();
							echo get_template_part('template-part/post', 'content');
						endwhile;
					?>
					</div>
				<?php else: ?>
				<p class="text-center fade-up"><?php echo __('Brak treści do wyświetlenia.', 'goldenrocket'); ?></p>
				<?php endif; ?>
			</div>
		</div>
<?php get_footer(); ?>
