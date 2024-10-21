<?php

get_header();
if(have_posts()): while (have_posts()): the_post();
$id_page = get_the_ID();
$the_title = get_the_title();
$gallery_product = rwmb_meta('gallery_product', '', $id_page);
$args_product = null;
$typ = wp_get_post_terms($id_page, 'typ');
$producent = wp_get_post_terms($id_page, 'producent');
if(isset($typ[0]->term_id) && isset($producent[0]->term_id))
{
	$args_product = array('post_type' => 'produkt', 'posts_per_page' => 3, 'orderby' => 'rand', 'post_status' => 'publish', 'tax_query' => array('relation' => 'AND', array('taxonomy' => 'typ', 'field' => 'term_id', 'terms' => $typ[0]->term_id), array('taxonomy' => 'producent', 'field' => 'term_id', 'terms' => $producent[0]->term_id)));
}
elseif(isset($typ[0]->term_id) && !isset($producent[0]->term_id))
{
	$args_product = array('post_type' => 'produkt', 'posts_per_page' => 3, 'orderby' => 'rand', 'post_status' => 'publish', 'tax_query' => array('relation' => 'AND', array('taxonomy' => 'typ', 'field' => 'term_id', 'terms' => $typ[0]->term_id)));
}
elseif(!isset($typ[0]->term_id) && isset($producent[0]->term_id))
{
	$args_product = array('post_type' => 'produkt', 'posts_per_page' => 3, 'orderby' => 'rand', 'post_status' => 'publish', 'tax_query' => array('relation' => 'AND', array('taxonomy' => 'producent', 'field' => 'term_id', 'terms' => $producent[0]->term_id)));
}
$product_list = new WP_Query($args_product);
?>
	<div class="page-wraper">
		<div class="container">
			<div class="page-content">
				<div class="grid">
					<div class="col-4_lg-12">
						<?php
							if (has_post_thumbnail())
							{
								echo '<p>';
								the_post_thumbnail('medium', ['class' => 'attachment-medium size-medium product-page-image']);
								echo '</p>';
							}
						?>
					</div>
					<div class="col-8_lg-12">
						<h1 class="product-page-name"><?php echo $the_title; ?></h1>
						<?php
							the_content();
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		if(has_term('', 'funkcja', $id_page)):
		$funkcja = get_the_terms($id_page, 'funkcja');
		if(isset($funkcja[0])):
	?>
	<div class="page-wraper" style="padding-top: 0;">
		<div class="section-title-bar">
			<div class="container">
				<div class="section-title-content color-page">
					<p class="section-title"><?php echo __('Funkcje', 'wienkra').' '.$the_title; ?></p>
				</div>
			</div>
		</div>
		<div class="section-function-product">
			<div class="container">
				<div class="grid-10_lg-8_md-6_sm-4_xs-1">
					<?php
						foreach($funkcja as $single):
						$function_icon = rwmb_meta("function_icon", ['object_type' => 'term'], $single->term_id);
					?>
					<div class="col">
						<p>
							<a href="<?php echo get_term_link($single);?>">
							<?php
								if(isset($function_icon['ID']))
								{
									echo wp_get_attachment_image($function_icon['ID'], "logos_img");
								}
								echo $single->name;
							?>
							</a>
						</p>
					</div>
					<?php
						endforeach;
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
	endif;
	endif;
	if(is_array($gallery_product) && !empty($gallery_product)):
	?>
	<div class="page-wraper" style="padding-top: 0;">
		<div class="section-title-bar">
			<div class="container">
				<div class="section-title-content color-page">
					<p class="section-title"><?php echo __('Galeria', 'wienkra'); ?></p>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="section-gallery-product">
				<div class="grid-4_lg-3_sm-2">
					<?php foreach($gallery_product as $single): ?>
					<div class="col">
						<a href="<?php echo wp_get_attachment_image_url($single['ID'], "full"); ?>" class="glightbox" data-gallery="gallery_product"><?php echo wp_get_attachment_image($single['ID'], "thumbnail"); ?></a>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
	<?php
		endif;
		if($product_list -> have_posts()):
	?>
	<div class="page-wraper" style="padding-top: 0;">
		<div class="section-title-bar">
			<div class="container">
				<div class="section-title-content color-page">
					<p class="section-title"><?php echo __('Sprawdź podobne produkty', 'wienkra'); ?></p>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="grid-3_md-2_sm-1">
			<?php
				while($product_list -> have_posts()): $product_list -> the_post();
				$url = get_the_permalink();
			?>
			<div class="col">
				<div class="list-product">
					<a href="<?php echo $url; ?>" rel="nofollow">
					<?php
						if (has_post_thumbnail())
						{
							the_post_thumbnail('thumbnail');
						}
					?>
					</a>
					<h2 class="list-product-name"><?php the_title(); ?></h2>
					<?php echo apply_filters('the_excerpt' ,wp_trim_words(get_the_excerpt(), 15)); ?>
					<div><a class="custom-read-more" href="<?php echo $url; ?>"><?php echo __("Czytaj więcej", "wienkra"); ?></a></div>
				</div>
			</div>
			<?php
				endwhile; wp_reset_postdata();
			?>
			</div>
		</div>
	</div>
<?php endif; endwhile; endif; get_footer(); ?>
