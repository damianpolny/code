<?php

get_header();
if(taxonomy_exists('producent')):
$producent = get_terms([
	'taxonomy' => 'producent',
	'hide_empty' => false,
]);
if(isset($producent[0])):
?>
<div class="page-wraper" style="padding-bottom:0">
	<div class="container">
		<ul class="product-brand-list">
			<?php foreach($producent as $single): ?>
			<li>
				<a href="<?php echo get_term_link($single);?>">
				<?php
					$brand_logo = rwmb_meta("brand_logo", ['object_type' => 'term'], $single->term_id);
					if(isset($brand_logo['ID']))
					{
						echo wp_get_attachment_image($brand_logo['ID'], "logos_img");
					}
					else
					{
						echo $single->name;
					}
				?>
				</a>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
<?php
endif; endif;
echo get_template_part('template-parts/archive-content', 'product');
get_footer(); ?>