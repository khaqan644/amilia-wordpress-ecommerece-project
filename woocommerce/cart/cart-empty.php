<?php
/**
 * Empty cart page
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="cart-empty-wrap">
	<?php wc_print_notices(); ?>
	<p class="cart-empty"><?php esc_html_e( 'Your cart is currently empty.', 'wp-amilia' ) ?></p>
	<?php do_action( 'woocommerce_cart_is_empty' ); ?>
	<p class="return-to-shop"><a class="cms-button gray wc-backward" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>"><?php esc_html_e( 'Return To Shop', 'wp-amilia' ) ?></a></p>
</div>
