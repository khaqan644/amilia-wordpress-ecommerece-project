<?php
vc_add_param("vc_column", array(
    'type' => 'checkbox',
    'heading' => esc_html__( 'Set background over left', 'wp-amilia' ),
    'param_name' => 'bg_column_overleft',
    'std' => false,
    'description' => '',
    "group" => esc_html__("Design Options", 'wp-amilia')
));

vc_add_param("vc_column", array(
    'type' => 'checkbox',
    'heading' => esc_html__( 'Equal Height', 'wp-amilia' ),
    'param_name' => 'equal_height',
    'std' => false,
    'description' => esc_html__( 'Set same height with next column - Not recommend', 'wp-amilia' ),
));

vc_add_param("vc_column", array(
    'type' => 'checkbox',
    'heading' => esc_html__( 'Equal height min 992', 'wp-amilia' ),
    'param_name' => 'equal_height_992',
    "dependency" => array(
        "element" => "equal_height",
        "value" => array(
            "true"
        )
    ),
    'description' => esc_html__( 'Set same height with next column, just apply on min width is 992px', 'wp-amilia' ),
));

vc_add_param("vc_column", array(
    "type" => "colorpicker",
    "class" => "",
    "heading" => esc_html__('Text Color', 'wp-amilia'),
    "param_name" => "column_text_color",
    "description" => 'Set color for text in this row'
));