<?php
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
		<div class="container">
			<div class="grid">
				<div class="col-3_lg-4_md-5_sm-12">
					<div class="sidebar-left">
						<ul class="list-category">
							<li<?php if(is_post_type_archive('produkt')): ?> class="current-cat"<?php endif; ?>><a href="<?php echo get_post_type_archive_link('produkt'); ?>"><?php echo __('Wszystkie produkty', 'makaer'); ?></a></li>
							<?php wp_list_categories(array('title_li' => null, 'taxonomy'=>'kategoria-produktu', 'hide_empty' => false)); ?>
						</ul>
					</div>
				</div>
				<div class="col-9_lg-8_md-7_sm-12">
					<?php
						if(have_posts()):
					?>
					<div class="grid-4_lg-3_md-2_xs-1">
						<?php
							while(have_posts()): the_post();
							echo get_template_part('template-parts/content', 'products');
							endwhile;
						?>
					</div>
					<?php else: ?>
					<p class="text-center" style="padding:15px 0;"><strong><?php echo __('Nie znaleziono żadnych produktów.', 'makaer'); ?></strong></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>