<?php
/**
 * Order Customer Details
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<header><h4 class="blog-page-title mt-40 mb-25"><?php esc_html_e( 'CUSTOMER DETAILS', 'wp-amilia' ); ?></h4></header>

<table class="shop_table shop_table_responsive customer_details">
	<?php if ( $order->customer_note ) : ?>
		<tr>
			<th><?php esc_html_e( 'Note:', 'wp-amilia' ); ?></th>
			<td><?php echo wptexturize( $order->customer_note ); ?></td>
		</tr>
	<?php endif; ?>

	<?php if ( $order->billing_email ) : ?>
		<tr>
			<th><?php esc_html_e( 'Email:', 'wp-amilia' ); ?></th>
			<td><?php echo esc_html( $order->billing_email ); ?></td>
		</tr>
	<?php endif; ?>

	<?php if ( $order->billing_phone ) : ?>
		<tr>
			<th><?php esc_html_e( 'Telephone:', 'wp-amilia' ); ?></th>
			<td><?php echo esc_html( $order->billing_phone ); ?></td>
		</tr>
	<?php endif; ?>

	<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>
</table>

<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() ) : ?>

<div class="col2-set addresses">
	<div class="col-1">

<?php endif; ?>

<header class="title">
	<h4 class="blog-page-title mt-40 mb-25"><?php esc_html_e( 'BILLING ADDRESS', 'wp-amilia' ); ?></h4>
</header>
<address>
	<?php echo esc_attr(( $address = $order->get_formatted_billing_address() ) ? $address : esc_html__( 'N/A', 'wp-amilia' )); ?>
</address>

<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() ) : ?>

	</div><!-- /.col-1 -->
	<div class="col-2">
		<header class="title">
			<h4 class="blog-page-title mt-40 mb-25"><?php esc_html_e( 'SHIPPING ADDRESS', 'wp-amilia' ); ?></h4>
		</header>
		<address>
			<?php echo esc_attr(( $address = $order->get_formatted_shipping_address() ) ? $address : esc_html__( 'N/A', 'wp-amilia' )); ?>
		</address>
	</div><!-- /.col-2 -->
</div><!-- /.col2-set -->

<?php endif; ?>
