<?php
/**
 * Post Meta Helper Functions
 *
 * These helper functions return post meta, if its enabled in WordPress Customizer.
 *
 * @package Authentic WordPress Theme
 * @subpackage Hooks
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

if ( ! function_exists( 'csco_post_meta' ) ) {
	/**
	 * Post Meta
	 *
	 * A wrapper function that returns all post meta types either
	 * in an ordered list <ul> or as a single element <span>.
	 *
	 * @param array $meta 	 contains post meta types.
	 * @param array $allowed contains allowed post meta types.
	 * @param bool  $compact if compact version shall be displayed.
	 */
	function csco_post_meta( $meta, $allowed = array(), $compact = false ) {
		// Check if there're any allowed post meta types.
		if ( empty( $allowed ) ) {
			// If there aren't any allowed post meta types given, get them from global settings.
			$allowed = get_theme_mod( 'post_meta', array( 'date', 'category', 'comments', 'views', 'reading_time', 'author' ) );
		}
		// Make sure that post meta type is not empty.
		if ( ! empty( $meta ) ) {
			// Check if provided post meta types is array.
			if ( is_array( $meta ) ) {
				// Remove disallowed post meta types from the array.
				$meta = array_intersect( $meta, $allowed );
				// Make sure again that post meta is not empty.
				if ( ! empty( $meta ) ) {
					// Loop through the array values.
					echo '<ul class="post-meta">';
					foreach ( $meta as $meta_function ) {
						$meta_function = "csco_meta_$meta_function";
						$meta_function( 'li', $compact );
					}
					echo '</ul>';
				}
			} else {
				// Check if the single value is in the array of allowed post meta types.
				if ( in_array( $meta, $allowed, true ) ) {
					$meta_function = "csco_meta_$meta";
					$meta_function( 'span', $compact );
				}
			}
		}
	}
}

if ( ! function_exists( 'csco_meta_category' ) ) {
	/**
	 * Post Сategory
	 *
	 * @param string $tag 	  element tag, i.e. div or span.
	 * @param bool   $compact if compact version shall be displayed.
	 * @param bool   $post_id Post ID.
	 */
	function csco_meta_category( $tag = 'span', $compact = false, $post_id = null ) {
		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}
		if ( ! empty( $tag ) ) { ?><<?php echo esc_html( $tag ); ?> class="meta-category"><?php }
		the_category( '', '', $post_id );
		if ( ! empty( $tag ) ) { ?></<?php echo esc_html( $tag ); ?>><?php }
	}
}

if ( ! function_exists( 'csco_meta_date' ) ) {
	/**
	 * Post Date
	 *
	 * @param string $tag 	  element tag, i.e. div or span.
	 * @param bool   $compact if compact version shall be displayed.
	 */
	function csco_meta_date( $tag = 'span', $compact = false ) {
		?>
		<<?php echo esc_html( $tag ); ?> class="meta-date">
			<time class="entry-date published updated" datetime="<?php the_date( 'c' ); ?>">
				<?php
				if ( false === $compact ) {
					echo get_the_date();
				} else {
					echo get_the_date( 'd.m.y' );
				} ?>
			</time>
		</<?php echo esc_html( $tag ); ?>>
	<?php }
}

if ( ! function_exists( 'csco_meta_author' ) ) {
	/**
	 * Post Autor
	 *
	 * @param string $tag 	  element tag, i.e. div or span.
	 * @param bool   $compact if compact version shall be displayed.
	 */
	function csco_meta_author( $tag = 'span', $compact = false ) {
		?>
		<<?php echo esc_html( $tag ); ?> class="meta-author vcard">

			<?php if ( false === $compact ) { ?><span><?php esc_html_e( 'by', 'authentic' ); ?></span> <?php } ?>

			<?php
			if ( function_exists( 'coauthors_posts_links' ) ) {
				coauthors_posts_links( null, null, null, null, true );
			} else {
				the_author_posts_link();
			} ?>

		</<?php echo esc_html( $tag ); ?>>
	<?php }
}

if ( ! function_exists( 'csco_meta_comments' ) ) {
	/**
	 * Post Comments
	 *
	 * @param string $tag 	  element tag, i.e. div or span.
	 * @param bool   $compact if compact version shall be displayed.
	 */
	function csco_meta_comments( $tag = 'span', $compact = false ) {
		?>
		<<?php echo esc_html( $tag ); ?> class="meta-comments">
			<?php if ( true === $compact ) { ?><i class="icon icon-speech-bubble"></i><?php } ?>
			<?php
			if ( false === $compact ) {
				comments_popup_link( esc_html__( 'No comments', 'authentic' ), esc_html__( 'One comment', 'authentic' ), '% ' . esc_html__( 'comments','authentic' ), 'comments-link', '' );
			} else {
				comments_popup_link( '0', '1', '%', 'comments-link', '' );
			} ?>
		</<?php echo esc_html( $tag ); ?>>
		<?php }
}

if ( ! function_exists( 'csco_calculate_post_reading_time' ) ) {
	/**
	 * Calculate Post Reading Time in Minutes
	 *
	 * @param int $post_id The post ID.
	 */
	function csco_calculate_post_reading_time( $post_id = '' ) {
		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}
		$post_content = get_post_field( 'post_content', $post_id );
		$strip_shortcodes = strip_shortcodes( $post_content );
		$strip_tags = strip_tags( $strip_shortcodes );
		$locale = csco_get_locale();
		if ( 'ru_RU' === $locale ) {
			$word_count = count( preg_split( '/\s+/', $strip_tags ) );
		} else {
			$word_count = str_word_count( $strip_tags );
		}
		$reading_time = intval( ceil( $word_count / 250 ) );
		return $reading_time;
	}
}

/**
 * Update Post Reading Time on Post Save
 *
 * @param int  $post_id The post ID.
 * @param post $post    The post object.
 * @param bool $update  Whether this is an existing post being updated or not.
 */
function csco_update_post_reading_time( $post_id, $post, $update ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}
	$reading_time = csco_calculate_post_reading_time( $post_id );
	update_post_meta( $post_id, '_csco_reading_time', $reading_time );
}

add_action( 'save_post', 'csco_update_post_reading_time', 10, 3 );

/**
 * Get Post Reading Time from Post Meta
 *
 * @param int $post_id The post ID.
 */
function csco_get_post_reading_time( $post_id = '' ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}
	// Get existing post meta.
	$reading_time = get_post_meta( $post_id, '_csco_reading_time', true );
	// Calculate and save reading time, if there's no existing post meta.
	if ( ! $reading_time ) {
		$reading_time = csco_calculate_post_reading_time( $post_id );
		update_post_meta( $post_id, '_csco_reading_time', $reading_time );
	}
	return $reading_time;
}

if ( ! function_exists( 'csco_meta_reading_time' ) ) {
	/**
	 * Post Reading Time
	 *
	 * @param string $tag 	  element tag, i.e. div or span.
	 * @param bool   $compact if compact version shall be displayed.
	 */
	function csco_meta_reading_time( $tag = 'span', $compact = false ) {
	?>
		<<?php echo esc_html( $tag ); ?> class="meta-reading-time">
			<?php if ( true === $compact ) { ?><i class="icon icon-clock"></i><?php } ?>
			<?php
			$reading_time = csco_get_post_reading_time();
			if ( false === $compact ) {
				echo esc_html( sprintf( _n( '%s minute read', '%s minute read', $reading_time, 'authentic' ), $reading_time ) );
			} else {
				echo intval( $reading_time );
			} ?>
		</<?php echo esc_html( $tag ); ?>>
	<?php }
}

if ( ! function_exists( 'csco_meta_views' ) ) {
	/**
	 * Post Views
	 *
	 * @param string $tag 	  element tag, i.e. div or span.
	 * @param bool   $compact if compact version shall be displayed.
	 */
	function csco_meta_views( $tag = 'span', $compact = false ) {
		if ( function_exists( 'pvc_get_post_views' ) ) { ?>
			<<?php echo esc_html( $tag ); ?> class="meta-views">
				<?php if ( true === $compact ) { ?><i class="icon icon-eye"></i><?php } ?>
				<?php $post_views = intval( pvc_get_post_views() ); ?>
				<?php echo esc_html( csco_round_number( $post_views ) ); ?>
				<?php
				if ( false === $compact ) {
					echo esc_html( _n( 'view', 'views', $post_views, 'authentic' ) );
				} ?>
			</<?php echo esc_html( $tag ); ?>>
		<?php }
	}
}
