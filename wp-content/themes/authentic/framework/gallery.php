<?php
/**
 * Galleries
 *
 * Filters default WordPress galleries.
 * Adds Slider, Grid and Justified gallery types.
 *
 * @package Authentic WordPress Theme
 * @subpackage Framework
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

/**
 * Gallery Shortcode Function
 *
 * @param string $output   The current output.
 * @param array  $atts     Attributses from the gallery shortcode.
 * @param int    $instance Numeric ID of the gallery shortcode instance.
 */
function csco_post_gallery( $output = '', $atts, $instance ) {

	// Return if Jetpack's Tiled Gallery or Carousel modules are enabled.
	if ( class_exists( 'Jetpack' ) && ( Jetpack::is_module_active( 'tiled-gallery' ) || Jetpack::is_module_active( 'carousel' ) ) ) {
		return '';
	}

	$post = get_post();

	$default = array(
		'id'         => $post ? $post->ID : 0,
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'columns'    => 3,
		'size'       => 'thumbnail',
		);

	$atts = array_merge( $default, $atts );

	$id = intval( $atts['id'] );

	if ( ! empty( $atts['include'] ) ) {
		$_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[ $val->ID ] = $_attachments[ $key ];
		}
	} elseif ( ! empty( $atts['exclude'] ) ) {
		$attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
	} else {
		$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
	}

	if ( empty( $attachments ) ) {
		return '';
	}

	$selector = "gallery-{$instance}";

	if ( isset( $atts['layout'] ) ) {

		$layout = $atts['layout'];

		// Justified Gallery.
		if ( 'justified' === $layout ) {

			$output = '<div class="gallery gallery-justified">';

			foreach ( $attachments as $id => $attachment ) {

				$attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';
				if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
					$image_output = wp_get_attachment_link( $id, $atts['size'], false, false, false, $attr );
				} elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
					$image_output = wp_get_attachment_image( $id, $atts['size'], false, $attr );
				} else {
					$image_output = wp_get_attachment_link( $id, $atts['size'], true, false, false, $attr );
				}

				$output .= '<figure>';
				$output .= $image_output;
				$output .= '</figure>';
			}

			$output .= '</div>';

		} // End if().

		// Slider Gallery.
		elseif ( 'slider' === $layout ) {

			$output = '<div class="gallery gallery-slider owl-container owl-simple">';
			$output .= '<div class="owl-carousel">';

			foreach ( $attachments as $id => $attachment ) {

				$attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';
				if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
					$image_output = wp_get_attachment_link( $id, $atts['size'], false, false, false, $attr );
				} elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
					$image_output = wp_get_attachment_image( $id, $atts['size'], false, $attr );
				} else {
					$image_output = wp_get_attachment_link( $id, $atts['size'], true, false, false, $attr );
				}

				$output .= "<div class='owl-slide'>";
				$output .= '<figure>';
				$output .= $image_output;
				$output .= '</figure>';
				$output .= '</div>';
			}

			$output .= '</div>';

			$output .= '<div class="owl-dots"></div>';

			$output .= '</div>';

		}
	} else {

		// Grid Gallery.
		$columns = $atts['columns'];

		// Callback for sizes not supported by Bootstrap grid.
		if ( 5 === $columns ) {
			$columns = 4;
		} elseif ( 7 === $columns ) {
			$columns = 6;
		} elseif ( 8 === $columns ) {
			$columns = 6;
		} elseif ( 9 === $columns ) {
			$columns = 12;
		} elseif ( ! $columns ) {
			$columns = 3;
		}

		$i = 0;

		$output = '<div class="gallery gallery-grid">';
		$output .= '<div class="row">';

		foreach ( $attachments as $id => $attachment ) {

			$attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';
			if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
				$image_output = wp_get_attachment_link( $id, $atts['size'], false, false, false, $attr );
			} elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
				$image_output = wp_get_attachment_image( $id, $atts['size'], false, $attr );
			} else {
				$image_output = wp_get_attachment_link( $id, $atts['size'], true, false, false, $attr );
			}

			$output .= "<div class='gallery-item col-md-" . 12 / $columns . "'>";
			$output .= '<figure>';
			$output .= $image_output;
			if ( trim( $attachment->post_excerpt ) ) {
				$output .= "
				<figcaption class='wp-caption-text gallery-caption' id='$selector-$id'>
					" . wptexturize( $attachment->post_excerpt ) . '
				</figcaption>';
			}
			$output .= '</figure>';
			$output .= '</div>';

			$current = ++$i;

			if ( $columns > 0 && 0 === $current % $columns && count( $attachments ) !== $current  ) {
				$output .= '</div><div class="row">';
			}

			if ( count( $attachments ) === $current  ) {
				$output .= '</div>';
			}
		}

		$output .= '</div>';

	}// End if().

	return $output;
}

add_filter( 'post_gallery', 'csco_post_gallery', 10, 3 );

/**
 * Add new sizes to sizes dropdown
 *
 * @param array $sizes Original array of WordPress media sizes.
 */
function csco_image_sizes_choose( $sizes ) {

	// Get custom image sizes.
	$image_sizes = csco_get_custom_image_sizes();

	// Add custom image sizes to the main array.
	foreach ( $image_sizes as $image_size ) {
		$sizes[ $image_size['slug'] ] = $image_size['name'];
	}

	return $sizes;
}

add_filter( 'image_size_names_choose', 'csco_image_sizes_choose' );

/**
 * Add Gallery Layout Dropdown
 */
function csco_print_media_templates() {

	// Return if Jetpack's Tiled Gallery or Carousel modules are enabled.
	if ( class_exists( 'Jetpack' ) && ( Jetpack::is_module_active( 'tiled-gallery' ) || Jetpack::is_module_active( 'carousel' ) ) ) {
		return '';
	}

	// Define your backbone template;
	// the "tmpl-" prefix is required,
	// and your input field should have a data-setting attribute
	// matching the shortcode name.
	$gallery_layouts = array(
		'grid'      => esc_html__( 'Grid','authentic' ),
		'justified' => esc_html__( 'Justified','authentic' ),
		'slider'    => esc_html__( 'Slider','authentic' ),
		);
	?>

	<script type="text/html" id="tmpl-custom-gallery-layouts">
		<label class="setting">
			<span><?php esc_html_e( 'Layout','authentic' ); ?></span>
			<select data-setting="layout">
				<?php
				foreach ( $gallery_layouts as $key => $value ) {
					echo '<option value="' . esc_html( $key ) . '">' . esc_html( $value ) . '</option>';
				}
				?>
			</select>
		</label>
	</script>

	<script>

		jQuery(document).ready(function () {

			// add your shortcode attribute and its default value to the
			// gallery settings list; $.extend should work as well...
			_.extend(wp.media.gallery.defaults, {
				layout: 'grid'
			});

			// join default gallery settings template with yours -- store in list
			if (!wp.media.gallery.templates) wp.media.gallery.templates = ['gallery-settings'];
			wp.media.gallery.templates.push('custom-gallery-layouts');

			// loop through list -- allowing for other templates/settings
			wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
				template: function (view) {
					var output = '';
					for (var i in wp.media.gallery.templates) {
						output += wp.media.template(wp.media.gallery.templates[i])(view);
					}
					return output;
				}
			});

		});

	</script>
<?php
}

add_action( 'print_media_templates', 'csco_print_media_templates' );
