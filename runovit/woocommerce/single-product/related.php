<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

	<section class="related products">
		
		<div class="grid-noGutter">
		
			<?php
				$heading = apply_filters('woocommerce_product_related_products_heading', __('Related products', 'woocommerce'));
				if($heading):
			?>
			
			<div class="shop-left">
			
				<div class="widget-shop">
				
					<div class="widget_product_categories">
						
						<p style="margin-bottom:10px"><span class="runovit_ico_filter" style="display:inline-block;width:50px;height:50px;font-size:30px;line-height:46px;text-align:center;border-radius:50%;border:1px solid;overflow:hidden;"></span></p>
						
						<div class="section-title-content" style="padding-bottom:0;margin-bottom:0;border-bottom:0;">
						
							<p class="section-title"><?php echo esc_html($heading); ?></p>
							
						</div>
						
					</div>
					
				</div>
				
			</div>
			
			<?php endif; ?>
		
			<div class="shop-right">
			
				<?php woocommerce_product_loop_start(); ?>

					<?php foreach ( $related_products as $related_product ) : ?>

							<?php
							$post_object = get_post( $related_product->get_id() );

							setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

							wc_get_template_part( 'content', 'product' );
							?>

					<?php endforeach; ?>

				<?php woocommerce_product_loop_end(); ?>
				
			</div>
			
		</div>

	</section>
	<?php
endif;

wp_reset_postdata();
