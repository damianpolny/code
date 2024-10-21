<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $upsells ) : ?>

	<section class="up-sells upsells products">
		
		<div class="grid-noGutter">
		
			<?php
				$heading = apply_filters('woocommerce_product_upsells_products_heading', __('You may also like&hellip;', 'woocommerce'));
				if($heading):
			?>
		
			<div class="shop-left">
			
				<div class="widget-shop">
				
					<div class="widget_product_categories">
						
						<p style="margin-bottom:10px"><span class="runovit_ico_filter" style="display:inline-block;width:50px;height:50px;font-size:30px;line-height:46px;text-align:center;border-radius:50%;border:1px solid;overflow:hidden;"></span></p>
						
						<div class="section-title-content" style="padding-bottom:0;margin-bottom:0;border-bottom:0;">
						
							<p class="section-title"><?php echo __('Sprawdź inne warianty tego produktu:', 'runovit'); ?></p>
							
						</div>
						
					</div>
					
				</div>
				
			</div>
			
			<?php endif; ?>
		
			<div class="shop-right">
			
				<?php woocommerce_product_loop_start(); ?>

					<?php foreach ( $upsells as $upsell ) : ?>

						<?php
						$post_object = get_post( $upsell->get_id() );

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
