<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     4.4.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
	<div class="col-xs-6  mt-0 mb-30 pull-left cms-product-price-wrap" itemprop="offers" itemscope itemtype="http://schema.org/Offer">

		<p class="price"><?php echo esc_html($product->get_price_html()); ?></p>

		<meta itemprop="price" content="<?php echo esc_attr($product->get_price()); ?>" />
		<meta itemprop="priceCurrency" content="<?php echo get_woocommerce_currency(); ?>" />
		<link itemprop="availability" href="http://schema.org/<?php echo esc_attr($product->is_in_stock() ? 'InStock' : 'OutOfStock'); ?>" />

	</div>
</div><!-- row -->
<hr class="mt-0 mb-30">