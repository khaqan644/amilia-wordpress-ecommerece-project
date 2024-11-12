<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     9.0.0
 */

global $product; ?>
<li class="clearfix">
	<a class="cms-featured-wg" href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
		<?php echo ''.$product->get_image(); ?>
	</a>
	<div class="cms-wget_id()get-product-desc">
		<a class="product-title" href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>"><?php echo ''.$product->get_title(); ?>
		</a>
		<?php echo wp_kses_post($product->get_price_html()); ?>
		<?php /*if ( ! empty( $show_rating ) )*/ echo wc_get_rating_html( $product->get_average_rating() ); ?>
	</div>
</li>