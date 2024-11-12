<?php
global $smof_data;
/**
 * social share list
 */
function cms_woo_share() {
    ?>
    <ul class="pull-right">
        <li class="prd-wishlist">
            <?php wp_amilia_add_to_wishlist_custom_btn(); ?>
        </li>
        <li class="entry-share">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" >
                <i aria-hidden="true" class="social_share"></i>
            </a>
            <ul class="social-menu dropdown-menu dropdown-menu-right" role="menu">
                <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();?>"><i aria-hidden="true" class="social_facebook"></i></a></li>
                <li><a target="_blank" href="https://twitter.com/home?status=<?php echo esc_url('Check out this article', 'wp-amilia');?>:%20<?php echo esc_url(get_the_title());?>%20-%20<?php the_permalink();?>"><i aria-hidden="true" class="social_twitter"></i></a></li>
                <li><a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink();?>"><i aria-hidden="true" class="social_googleplus"></i></a></li>
            </ul>
        </li>
    </ul>
    <?php
}
add_action('cms_product_social', 'cms_woo_share');

/**
 * show button Add to wishlist
 * @author Duong Tung
 */
function wp_amilia_add_to_wishlist_custom_btn() {
    if (class_exists( 'YITH_WCWL' )) {
        echo do_shortcode('[yith_wcwl_add_to_wishlist]');
    }
}

/**
 * For product Tab
 */
add_filter( 'woocommerce_product_tabs', 'cms_woo_rename_tabs', 98 );
function cms_woo_rename_tabs( $tabs ) {
    $tabs['reviews']['title'] = esc_html__( 'Ratings', 'wp-amilia' );
    if (!empty($tabs['additional_information'] )) {
        $tabs['additional_information']['title'] = esc_html__( 'Parameters', 'wp-amilia' );
    }

    return $tabs;
}

/**
 * Custom Product Recent review - Default Widget
 */
add_action( 'widgets_init', 'override_woocommerce_widgets', 15 );
function override_woocommerce_widgets() {
    global $wp_widget_factory;
    if ( class_exists( 'WC_Widget_Recent_Reviews' ) ) {
        $wp_widget_factory->unregister('WC_Widget_Recent_Reviews');
        include_once( 'widgets/cms-recent-review.php' );
        $wp_widget_factory->register( 'Custom_WC_Widget_Recent_Reviews' );
    } 
}
/**
 * for custom widget ul class
 */
//add_filter( 'woocommerce_before_widget_product_list', function() {return '<ul class="cms-product-list-widget">';} );


/* Add theme option product per page */

add_filter( 'loop_shop_per_page', function($cols){
 if(isset($smof_data['shop_number'])){
  $products_perpage = $smof_data['shop_number'];
 } else {
  $products_perpage = '12';
 }
 return $products_perpage;
}, 20 );

/* Filter number columns per row */
add_filter('loop_shop_columns', 'amilia_loop_columns');
if (!function_exists('amilia_loop_columns')) {
    function amilia_loop_columns() {
        global $smof_data;

        if(isset($smof_data['shop_number_columns'])){
            $col_perpage = $smof_data['shop_number_columns'];
        } else {
            $col_perpage = 3;
        }

        return $col_perpage;
    }
}
