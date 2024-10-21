<?php
	$page_catalog_file = null;
	$page_catalog = get_pages(array(
		'post_type' => 'page',
		'meta_key' => '_wp_page_template',
		'hierarchical' => 0,
		'meta_value' => 'catalog-page-data.php'
	));
	if(isset($page_catalog[0]->ID))
	{
		$page_catalog_file = rwmb_meta('page_catalog_file', '', $page_catalog[0]->ID);
	}
	if(!empty($page_catalog_file) && is_array($page_catalog_file)):
	foreach($page_catalog_file as $file):
?>
	<div class="section-name-text position-relative" data-name="<?php echo __('Katalog', 'makaer'); ?> &#8213;">
		<div class="section-file position-relative" data-name="<?php echo __('Katalog', 'makaer'); ?>">
			<div class="container">
				<div class="grid">
					<div class="col-2_md-12"></div>
					<div class="col-8_md-12">
						<div class="section-title-content" style="margin-bottom:15px">
							<p class="section-title"><?php echo __('POBIERZ KATALOG <br/>MAKEAR', 'makaer'); ?></p>
						</div>
						<p><?php echo get_the_title($file['ID']); ?></p>
						<p><a class="custom-button fill" href="<?php echo esc_url($file['url']); ?>"><?php echo __('POBIERZ', 'makaer'); ?></a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	endforeach;
	endif;
?>