<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $equal_height
 * @var $columns_placement
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$el_class = $full_height = $full_width = $equal_height = $flex_row = $columns_placement = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = '';
$output = $after_output = $row_data = $html_overlay_row = $video_style = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'wpb_composer_front_js' );
$uqid = uniqid();
$el_class = $this->getExtraClass( $el_class );

$css_classes = array(
	'vc_row',
	'vc_row-fluid',
	'cshero_'. $uqid,
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);

if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') ) || $video_bg || $parallax) {
	$css_classes[]='vc_row-has-fill';
}

if (!empty($atts['gap'])) {
	$css_classes[] = 'vc_column-gap-'.$atts['gap'];
}

$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
if ( ! empty( $full_width ) ) {
	$wrapper_attributes[] = 'data-vc-full-width="true"';
	$wrapper_attributes[] = 'data-vc-full-width-init="false"';
	if ( 'stretch_row_content' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
	} elseif ( 'stretch_row_content_no_spaces' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
		$css_classes[] = 'vc_row-no-padding';
	}
	$after_output .= '<div class="vc_row-full-width"></div>';
}

if ( ! empty( $full_height ) ) {
	$css_classes[] = ' vc_row-o-full-height';
	if ( ! empty( $columns_placement ) ) {
		$flex_row = true;
		$css_classes[] = ' vc_row-o-columns-' . $columns_placement;
	}
}

if ( ! empty( $equal_height ) ) {
	$flex_row = true;
	$css_classes[] = ' vc_row-o-equal-height';
}

if ( ! empty( $content_placement ) ) {
	$flex_row = true;
	$css_classes[] = ' vc_row-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
	$css_classes[] = ' vc_row-flex';
}

$has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

if ( $has_video_bg ) {
	$parallax = $video_bg_parallax;
	$parallax_image = $video_bg_url;
	$css_classes[] = ' vc_video-bg-container';
	wp_enqueue_script( 'vc_youtube_iframe_api_js' );
}

if ( ! empty( $parallax ) ) {
	wp_enqueue_script( 'vc_jquery_skrollr_js' );
	$wrapper_attributes[] = 'data-vc-parallax="1.5"'; // parallax speed
	$css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
	if ( false !== strpos( $parallax, 'fade' ) ) {
		$css_classes[] = 'js-vc_parallax-o-fade';
		$wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
	} elseif ( false !== strpos( $parallax, 'fixed' ) ) {
		$css_classes[] = 'js-vc_parallax-o-fixed';
	}
}

if ( ! empty( $parallax_image ) ) {
	if ( $has_video_bg ) {
		$parallax_image_src = $parallax_image;
	} else {
		$parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
		$parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
		if ( ! empty( $parallax_image_src[0] ) ) {
			$parallax_image_src = $parallax_image_src[0];
		}
	}
	$wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
}
if ( ! $parallax && $has_video_bg ) {
	$wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
}

/* My custom */
/* Overlay Row */
if($overlay_row == 'yes') {
    $html_overlay_row = '<div class="cms-overlay-color" style="background-color: '.$overlay_color.'; "></div>';
    $css_classes[] = 'row-overlay-color';
}
/* End Overlay Row */

/* Row Full Width */
if ( ! empty( $full_width ) ) {
    $css_classes[] = 'cms-row-full-width';
}

/* BG Style Image */
switch ($bg_style) {
    case 'img_parallax':
        $css_classes[] = 'cms_parallax';
        $row_data = 'data-speed = "'.$bd_p_speed.'" ';
        $row_style = 'background-repeat: inherit; background-position: 50% 0; background-attachment:fixed; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;';
        break;
    case 'img_fixed':
        $row_style = 'background-attachment:fixed;background-repeat: no-repeat;';
        break;
    case 'hvideo':
        $css_classes[] = 'row-bg-video';
        $video_style = '<div class="cms-bg-video">'.do_shortcode('[video autoplay="on" loop="on" preload="none" height="100%" width="100%" mp4="'.$bg_video_mp4.'" webm="'.$bg_video_webm.'"]').'</div>';
        break;
}

if ($bg_style == 'img_fixed') {
    $css_classes[] = 'background-image-fixed';
}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
?>
<div <?php echo implode( ' ', $wrapper_attributes ); ?> 
	<?php if($data_offset) echo ' data-offset=" '.esc_attr($data_offset).' " '; ?> 
	<?php echo ''.$row_data; ?>>

    <?php echo ''.$html_overlay_row; ?>
    <?php echo ''.$video_style; ?>

    <?php if(!$full_width): ?><div class="container"><div class="row"><?php endif ; ?>
    <?php if($full_width): ?><div class="no-container"><div class="row"><?php endif ; ?>
	
	<?php echo wpb_js_remove_wpautop( $content ); ?>

    </div></div> <!-- for full or not full width -->
</div>
<?php echo ''.$after_output; ?>
