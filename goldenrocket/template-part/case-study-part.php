<?php
$title = null;
$id_front_page = get_option('page_on_front');
$page_case_study_title = null;
$page_case_study_txt = null;
if(is_post_type_archive())
{
	$page_case_study_title = rwmb_meta('page_case_study_title', '', $id_front_page);
	$page_case_study_txt = rwmb_meta('page_case_study_txt', '', $id_front_page);
}
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
	$title = __('Case Study', 'goldenrocket');
}
?>
<div class="page-wraper page-wraper-case-study position-relative">
	<h1 class="bg-stroke-text position-absolute fade-up">
		<?php echo $title; ?>
	</h1>
	<?php if(!empty($page_case_study_title)): ?>
	<div class="section-title-content text-left big-margin fade-up">
		<div class="section-title-line line-top">
			<span class="line"></span><?php echo __('Case Study', 'goldenrocket'); ?>
		</div>
		<div class="container-small">
			<h1 class="section-title"><?php echo $page_case_study_title; ?></h1>
		</div>
	</div>
	<?php
		endif;
		if(!empty($page_case_study_txt)):
	?>
	<div class="section-text-content fade-up">
		<div class="container-small">
			<?php echo apply_filters('the_content', $page_case_study_txt); ?>
		</div>
	</div>
	<?php endif; ?>
	<div class="container">
		<?php if(have_posts()): ?>
		<div class="grid-2_sm-1">
		<?php
			while(have_posts()): the_post();
				echo get_template_part('template-part/case-study', 'content');
			endwhile;
		?>
		</div>
		<?php else: ?>
		<p class="text-center"><?php echo __('Brak treści do wyświetlenia.', 'goldenrocket'); ?></p>
		<?php endif; ?>
	</div>
</div>