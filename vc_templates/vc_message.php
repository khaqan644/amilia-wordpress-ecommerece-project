<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $message_box_style
 * @var $style
 * @var $color
 * @var $message_box_color
 * @var $css_animation
 * @var $icon_type
 * @var $icon_fontawesome
 * // Todo add $icon_... defaults
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Message
 */
// Todo add $icon_typicons and etc

$atts = $this->convertAttributesToMessageBox2( $atts );
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$elementClass = array(
	'base' => apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_message_box', $this->settings['base'], $atts ),
	'style' => 'alert vc_message_box-' . $message_box_style,
	'shape' => 'vc_message_box-' . $style,
	'color' => ( strlen( $color ) > 0 && strpos( 'alert', $color ) === false ) ? 'vc_color-' . $color : 'vc_color-' . $message_box_color,
	'extra' => $this->getExtraClass( $el_class ),
	'css_animation' => $this->getCSSAnimation( $css_animation ),
);
$elementClass = preg_replace( array( '/\s+/', '/^\s|\s$/' ), array( ' ', '' ), implode( ' ', $elementClass ) );
$hide_icon = (!empty($message_hide_icon)) ? ' hide-icon ' : ' ';

// Pick up icons
$iconClass = isset( ${"icon_" . $icon_type} ) ? ${"icon_" . $icon_type} : $defaultIconClass;
switch ( $color ) {
	case 'info':
		$icon_type = 'fontawesome';
		$iconClass = 'fa fa-info-circle';
		break;
	case 'alert-info':
		$icon_type = 'pixelicons';
		$iconClass = 'vc_pixel_icon vc_pixel_icon-info';
		break;
	case 'success':
		$icon_type = 'fontawesome';
		$iconClass = 'fa fa-check';
		break;
	case 'alert-success':
		$icon_type = 'pixelicons';
		$iconClass = 'vc_pixel_icon vc_pixel_icon-tick';
		break;
	case 'warning':
		$icon_type = 'fontawesome';
		$iconClass = 'fa fa-exclamation-triangle';
		break;
	case 'alert-warning':
		$icon_type = 'pixelicons';
		$iconClass = 'vc_pixel_icon vc_pixel_icon-alert';
		break;
	case 'danger':
		$icon_type = 'fontawesome';
		$iconClass = 'fa fa-times';
		break;
	case 'alert-danger':
		$icon_type = 'pixelicons';
		$iconClass = 'vc_pixel_icon vc_pixel_icon-explanation';
		break;
	case 'alert-custom':
	default:
		break;
}

// Enqueue needed font for icon element
if ( 'pixelicons' !== $icon_type ) {
	vc_icon_element_fonts_enqueue( $icon_type );
}
?>
<div class="<?php echo esc_attr( $elementClass. $hide_icon ); ?>">
	
	<div class="vc_message_box-icon"><i class="<?php echo esc_attr( $iconClass ); ?>"></i>
	</div><?php echo wpb_js_remove_wpautop( $content, true );
?></div><?php echo ''.$this->endBlockComment( $this->getShortcode() ); ?>