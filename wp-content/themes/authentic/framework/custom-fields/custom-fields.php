<?php
/**
 * ACF Pro Custom Fields
 *
 * @package Authentic WordPress Theme
 * @subpackage Custom Fields
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

if ( function_exists( 'acf_add_local_field_group' ) ) {

	// Post Format: Gallery.
	acf_add_local_field_group( array(
		'key' => 'group_post_gallery',
		'title' => esc_html__( 'Gallery', 'authentic' ),
		'fields' => array(
			array(
				'key' => 'field_post_gallery',
				'label' => esc_html__( 'Images', 'authentic' ),
				'name' => 'csco_post_gallery',
				'type' => 'gallery',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
					),
				'min' => '',
				'max' => '',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
				),
			),
		'location' => apply_filters( 'csco_post_gallery_location', array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					),
				array(
					'param' => 'post_format',
					'operator' => '==',
					'value' => 'gallery',
					),
				),
			)
		),
		'menu_order' => 0,
		'position' => 'acf_after_title',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

	// Post Format: Video & Audio.
	acf_add_local_field_group( array(
		'key' => 'group_post_embed',
		'title' => esc_html__( 'Embed', 'authentic' ),
		'fields' => array(
			array(
				'key' => 'field_post_embed',
				'label' => esc_html__( 'Embed', 'authentic' ),
				'name' => 'csco_post_embed',
				'type' => 'oembed',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
					),
				'width' => '',
				'height' => '',
				),
			),
		'location' => apply_filters( 'csco_post_embed_location', array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					),
				array(
					'param' => 'post_format',
					'operator' => '==',
					'value' => 'audio',
					),
				),
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					),
				array(
					'param' => 'post_format',
					'operator' => '==',
					'value' => 'video',
					),
				),
			)
		),
		'menu_order' => 0,
		'position' => 'acf_after_title',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

	// Post: Media Options.
	acf_add_local_field_group( array(
		'key' => 'group_post_video_bg',
		'title' => esc_html__( 'Video Background', 'authentic' ),
		'fields' => array(
			array(
				'key' => 'field_post_video_bg_location',
				'label' => esc_html__( 'Location', 'authentic' ),
				'name' => 'csco_post_video_bg_location',
				'type' => 'checkbox',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
					),
				'choices' => array(
					'page-header' => esc_html__( 'Page Header', 'authentic' ),
					'slider'      => esc_html__( 'Post Slider', 'authentic' ),
					'tiles'       => esc_html__( 'Post Tiles', 'authentic' ),
					'archive'     => esc_html__( 'Post Archives', 'authentic' ),
					),
				'default_value' => array( 'slider', 'archive' ),
				'layout' => 'vertical',
				'toggle' => 0,
				),
				array(
					'key' => 'field_post_video_bg_start_time',
					'label' => esc_html__( 'Start Time', 'authentic' ),
					'name' => 'csco_post_video_bg_start_time',
					'type' => 'number',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '50',
						'class' => '',
						'id' => '',
					),
					'default_value' => 0,
					'placeholder' => '',
					'prepend' => '',
					'append' => 'sec',
					'min' => '',
					'max' => '',
					'step' => '',
				),
				array(
					'key' => 'field_post_video_bg_end_time',
					'label' => esc_html__( 'End Time', 'authentic' ),
					'name' => 'csco_post_video_bg_end_time',
					'type' => 'number',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '50',
						'class' => '',
						'id' => '',
					),
					'default_value' => 0,
					'placeholder' => '',
					'prepend' => '',
					'append' => 'sec',
					'min' => '',
					'max' => '',
					'step' => '',
				),
			),
		'location' => apply_filters( 'csco_post_video_bg_location', array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					),
				array(
					'param' => 'post_format',
					'operator' => '==',
					'value' => 'video',
					),
				),
			)
		),
		'menu_order' => 0,
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

	// Post: Media Options.
	acf_add_local_field_group( array(
		'key' => 'group_post_media_options',
		'title' => esc_html__( 'Media Options', 'authentic' ),
		'fields' => array(
			array(
				'key' => 'field_post_media_location',
				'label' => esc_html__( 'Media Location', 'authentic' ),
				'name' => 'csco_post_media_location',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
					),
				'choices' => array(
					'content' => esc_html__( 'Post Content', 'authentic' ),
					'header'  => esc_html__( 'Page Header', 'authentic' ),
					'none'    => esc_html__( 'None', 'authentic' ),
					),
				'default_value' => array(
					0 => 'content',
					),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'placeholder' => '',
				'disabled' => 0,
				'readonly' => 0,
				),
			),
		'location' => apply_filters( 'csco_post_media_options_location', array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					),
				array(
					'param' => 'post_format',
					'operator' => '!=',
					'value' => 'standard',
					),
				),
			)
		),
		'menu_order' => 0,
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

	// Post: Gallery Options.
	acf_add_local_field_group( array(
		'key' => 'group_post_gallery_options',
		'title' => esc_html__( 'Gallery Options', 'authentic' ),
		'fields' => array(
			array(
				'key' => 'field_post_gallery_type',
				'label' => esc_html__( 'Gallery Type', 'authentic' ),
				'name' => 'csco_post_gallery_type',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
					),
				'choices' => array(
					'slider'    => esc_html__( 'Slider', 'authentic' ),
					'justified' => esc_html__( 'Justified', 'authentic' ),
					),
				'default_value' => array(
					0 => 'slider',
					),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'placeholder' => '',
				'disabled' => 0,
				'readonly' => 0,
				),
			),
		'location' => apply_filters( 'csco_post_gallery_options_location', array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					),
				array(
					'param' => 'post_format',
					'operator' => '==',
					'value' => 'gallery',
					),
				),
			)
		),
		'menu_order' => 0,
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

	// Post & Page: Layout Options.
	acf_add_local_field_group( array(
		'key' => 'group_singular_layout_options',
		'title' => esc_html__( 'Layout Options', 'authentic' ),
		'fields' => array(
			array(
				'key' => 'field_singular_layout',
				'label' => esc_html__( 'Page Layout', 'authentic' ),
				'name' => 'csco_singular_layout',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
					),
				'choices' => array(
					'default'              => esc_html__( 'Default', 'authentic' ),
					'layout-sidebar-left'  => esc_html__( 'Left Sidebar', 'authentic' ),
					'layout-sidebar-right' => esc_html__( 'Right Sidebar', 'authentic' ),
					'layout-fullwidth'     => esc_html__( 'Fullwidth', 'authentic' ),
					),
				'default_value' => array(
					0 => 'default',
					),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'placeholder' => '',
				'disabled' => 0,
				'readonly' => 0,
				),
			array(
				'key' => 'field_page_header_type',
				'label' => esc_html__( 'Page Header', 'authentic' ),
				'name' => 'csco_page_header_type',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
					),
				'choices' => array(
					'default'  => esc_html__( 'Default', 'authentic' ),
					'none'     => esc_html__( 'None', 'authentic' ),
					'simple'   => esc_html__( 'Simple', 'authentic' ),
					'small'    => esc_html__( 'Small', 'authentic' ),
					'wide'     => esc_html__( 'Wide', 'authentic' ),
					'large'    => esc_html__( 'Large', 'authentic' ),
					),
				'default_value' => array(
					0 => 'default',
					),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'placeholder' => '',
				'disabled' => 0,
				'readonly' => 0,
				),
			),
		'location' => apply_filters( 'csco_singular_layout_options_location', array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					),
				),
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					),
				),
			)
		),
		'menu_order' => 0,
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

	// Category: Thumbnail.
	acf_add_local_field_group( array(
		'key' => 'group_category_thumbnail',
		'title' => esc_html__( 'Page Header', 'authentic' ),
		'fields' => array(
			array(
				'key' => 'field_category_thumbnail',
				'label' => esc_html__( 'Featured Image', 'authentic' ),
				'name' => 'csco_category_thumbnail',
				'type' => 'image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			),
			array(
				'key' => 'field_category_page_header_type',
				'label' => esc_html__( 'Page Header', 'authentic' ),
				'name' => 'csco_page_header_type',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'default'   => esc_html__( 'Default', 'authentic' ),
					'none'      => esc_html__( 'None', 'authentic' ),
					'simple'    => esc_html__( 'Simple', 'authentic' ),
					'small'     => esc_html__( 'Small', 'authentic' ),
					'wide'      => esc_html__( 'Wide', 'authentic' ),
					'large'     => esc_html__( 'Large', 'authentic' ),
				),
				'default_value' => array(
					0 => 'default',
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'return_format' => 'value',
				'placeholder' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'taxonomy',
					'operator' => '==',
					'value' => 'category',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'seamless',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

}// End if().
