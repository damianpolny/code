<?php

/* Template name: Producenci */

get_header();
if(have_posts()): while (have_posts()): the_post();
?>
	<div class="page-wraper">
		<div class="container">
			<div class="page-content">
				<?php the_content(); ?>
			</div>
			<?php
			if(taxonomy_exists('producent')):
			$producent = get_terms([
				'taxonomy' => 'producent',
				'hide_empty' => false,
			]);
			if(isset($producent[0])):
			?>
			<br/>
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
			<?php endif; endif; ?>
		</div>
	</div>
<?php endwhile; endif; get_footer(); ?>
