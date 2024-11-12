<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$form = '<form role="search" method="get" id="product-searchform" class="searchform" action="' . esc_url( home_url( '/'  ) ) . '">
	<div>
		<input type="text" value="' . get_search_query() . '" name="s" id="s-product" placeholder="' . esc_html__( 'Search', 'wp-amilia' ) . '" />
		<button type="submit" id="cms-searchsubmit" value="'. esc_attr__( 'Search', 'wp-amilia' ) .'" /><i class="icon_search"></i></button>
		<input type="hidden" name="post_type" value="product" />
	</div>
</form>';
echo balancetags($form);