<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     4.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );

?>
<div class="product_meta mb-30">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'wp-amilia' ); ?> <span class="sku" itemprop="sku"><?php echo esc_html(($product->get_sku() ) ? $sku : esc_html__( 'N/A', 'wp-amilia' )); ?></span>.</span>

	<?php endif; ?>

	<?php echo wc_get_product_category_list( ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', $cat_count, 'wp-amilia' ) . ' ', '.</span>' ); ?>

	<?php echo wc_get_product_tag_list( ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $tag_count, 'wp-amilia' ) . ' ', '.</span>' ); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
