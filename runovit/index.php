<?php

get_header();
$post_id_page_archive = get_option('page_for_posts', true);
if(is_category() || is_tag() || is_tax())
{
	$title = single_term_title('', false);
}
elseif(is_search())
{
	$title = __('Wyniki wyszukiwania', 'runovit');
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
	$title = __('News', 'runovit');
}
?>
		<div class="page-wraper page-wraper-top">
			<div class="container">
				<div class="grid-center">
					<div class="col-10_lg-12">
						<div class="section-title-content section-title-icon" style="margin-bottom:20px;">
							<span class="runovit_ico_info"></span>
							<h1 class="section-title"><?php echo $title; ?></h1>
						</div>
						<?php if(is_home()): ?>
						<div class="grid">
							<div class="col-5_lg-6_md-7_sm-12">
								<p><?php echo __('Sprawdź najnowsze wiadomości z życia firmy, nowinki i ciekawostki branżowe i wiele innych!', 'runovit'); ?></p>
							</div>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="page-wraper">
			<div class="container">
				<div class="grid-center">
					<div class="col-10_lg-12">
						<?php
							if(have_posts()):
						?>
						<div class="grid-3_md-2_xs-1">
							<?php
								while(have_posts()): the_post();
									echo get_template_part('template-parts/content', 'post');						
								endwhile;
							?>
						</div>
						<?php
							$pagination = get_the_posts_pagination(array(
								'mid_size' => 2,
								'class' => 'woocommerce-pagination',
								'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.274 26.548"> <path d="M287.518,460.284l-11.86,11.86L287.518,484" transform="translate(-274.658 -458.869)" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>',
								'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.274 26.548"> <path d="M287.518,460.284l-11.86,11.86L287.518,484" transform="translate(-274.658 -458.869)" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>'
							));
							if(!empty($pagination))
							{
								$search_paging_ul_1 = str_replace('<div class="nav-links">', '<ul class="page-numbers">', $pagination); 
								$search_paging_ul_2 = str_replace('</div>', '</ul>', $search_paging_ul_1);
								$search_paging_li_1 = str_replace('<a ', '<li><a ', $search_paging_ul_2);
								$search_paging_li_2 = str_replace('</a>', '</a></li>', $search_paging_li_1);
								$search_paging_sp_1 = str_replace('<span ', '<li><span ', $search_paging_li_2);
								$pagination = str_replace('</span>', '</span></li>', $search_paging_sp_1);
								echo $pagination;
							}
						?>
						<?php
							else:
						?>
						<p><?php echo __('Brak wpisów spełniających podane kryteria', 'runovit'); ?></p>
						<?php
							endif;
						?>
					</div>
				</div>
			</div>
		</div>
<?php get_footer(); ?>
