<?php

get_header(); ?>
	<div class="page-wraper">
		<div class="container">
			<div class="page-content">
				<div class="grid-middle-spaceBetween">
					<div class="col-6_lg-6_md-12">
						<p><img width="" height="" src="<?php echo get_template_directory_uri(); ?>/img/404.webp" alt="404"></p>
					</div>
					<div class="col-5_lg-6_md-12 font-size-20">
						<div class="section-title-content" style="margin-bottom:10px;">
							<p style="margin-bottom:15px;"><?php echo __('Błąd 404', 'runovit'); ?></p>
							<p class="section-title"><?php echo __('UPS! Tutaj lepiej nie zaglądać...', 'runovit'); ?></p>
						</div>
						<p><?php echo __('Strona, której szukasz nie istnieje. Mogła ona zostać usunięta lub przeniesiona. Wróć na stronę główną i sprawdź naszą ofertę!', 'runovit'); ?></p>
						<p><a class="button button-fill" href="<?php echo get_home_url(); ?>"><?php echo __('Strona główna', 'runovit'); ?></a><?php if(class_exists('WooCommerce')): ?> <a style="margin-left:8px;" class="button button-fill-yellow" href="<?php echo get_permalink(wc_get_page_id('shop')); ?>"><?php echo __('Wszystkie produkty', 'runovit'); ?></a><?php endif; ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>
