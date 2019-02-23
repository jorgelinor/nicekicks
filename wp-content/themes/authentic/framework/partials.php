<?php
/**
 * These functions are used to load template parts (partials) or actions when used within action hooks,
 * and they probably should never be updated or modified.
 *
 * @package Authentic WordPress Theme
 * @subpackage Hooks
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

/**
 * Off-canvas
 */
function csco_offcanvas() {
	get_template_part( 'template-parts/offcanvas' );
}

/**
 * Header Layout
 */
function csco_header_layout() {
	if ( get_theme_mod( 'header', true ) ) {
		get_template_part( 'template-parts/header/header-layout' );
	}
}

/**
 * Primary Navigation
 */
function csco_navbar_primary() {
	get_template_part( 'template-parts/header/navbar-primary' );
}

/**
 * Secondary Navigation
 */
function csco_navbar_secondary() {
	if ( get_theme_mod( 'topbar', true ) ) {
		get_template_part( 'template-parts/header/topbar' );
	}
}

/**
 * Post Slider
 */
function csco_post_slider() {

	$page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

	if ( 1 !== $page ) {
		return;
	}

	$settings = csco_get_post_section_vars( 'slider' );

	if ( true === $settings['display']  ) {
		get_template_part( 'template-parts/sections/post-slider' );
	}
}

/**
 * Post Tiles
 */
function csco_post_tiles() {

	$page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

	if ( 1 !== $page ) {
		return;
	}

	$settings = csco_get_post_section_vars( 'tiles' );

	if ( true === $settings['display']  ) {
		get_template_part( 'template-parts/sections/post-tiles' );
	}
}

/**
 * Post Carousel
 */
function csco_post_carousel() {

	$page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

	if ( 1 !== $page ) {
		return;
	}

	// Prevent from displaying in header on single posts.
	if ( is_single() ) {
		return;
	}

	$settings = csco_get_post_section_vars( 'carousel' );

	if ( true === $settings['display']  ) {
		get_template_part( 'template-parts/sections/post-carousel' );
	}
}

/**
 * Post Carousel on Single Posts
 */
function csco_single_post_carousel() {
	$settings = csco_get_post_section_vars( 'carousel' );
	if ( true === $settings['display']  ) {
		get_template_part( 'template-parts/sections/post-carousel' );
	}
}

/**
 * Get Page Header Template
 */
function csco_get_page_header() {

	// Skip for home page.
	if ( is_home() ) {
		return;
	}

	// Get page header type: wide, large, simple, small or none.
	$type = csco_get_page_header_type();

	// Skip when page header type is set to 'none'.
	if ( 'none' === $type ) {
		return;
	}

	// Get current action name.
	$action = current_filter();

	// Skip if wide and large page headers are in page content.
	if ( 'csco_header_after' !== $action && ( 'wide' === $type || 'large' === $type ) ) {
		return;
	}

	// Skip if small and simple page headers are in site header.
	if ( 'csco_header_after' === $action && ( 'small' === $type || 'simple' === $type ) ) {
		return;
	}

	// Skip for page headers in main section on posts and pages.
	if ( is_singular() && 'csco_main_start' === $action ) {
		return;
	}

	// Skip for page headers in main section on 404 page.
	if ( is_404() && 'csco_main_start' === $action ) {
		return;
	}

	// See framework/template-tags.php for reference.
	csco_page_header( $type );

}

/**
 * Site Search
 */
function csco_site_search() {
	get_template_part( 'template-parts/site-search' );
}

/**
 * Get Post Media
 */
function csco_get_post_media() {

	if ( ! is_single() ) {
		return;
	}

	// Get post media location.
	$location = csco_get_field( 'csco_post_media_location', get_the_ID(), 'content' );

	// Get current action name.
	$action = current_filter();

	// Skip if post media isn't in post header.
	if ( 'csco_main_content_before' === $action && 'header' !== $location ) {
		return;
	}

	// Skip if post media isn't in post content.
	if ( 'csco_post_start' === $action && 'content' !== $location ) {
		return;
	}

	csco_get_post_media_template();

}

/**
 * Get Post Media Template
 */
function csco_get_post_media_template() {

	// Get formats of current post.
	$format = get_post_format();

	// Reset format to image for standard posts with thumbnails.
	if ( false === $format && has_post_thumbnail() ) {
		$format = 'image';
	}

	get_template_part( 'template-parts/media/format', $format );
}

/**
 * Share Buttons Before Content
 */
function csco_share_buttons_top() {
	if ( is_single() && function_exists( 'bsb_display_shares' ) ) {
		bsb_display_shares( 'before-post' );
	}
}

/**
 * Share Buttons Left Sidebar
 */
function csco_share_buttons_left() {
	if ( is_single() && function_exists( 'bsb_display_shares' ) ) { ?>
		<div class="post-sidebar">
			<div class="sticky">
				<?php	bsb_display_shares( 'post-sidebar' ); ?>
			</div>
		</div>
	<?php }
}

/**
 * Share Buttons After Content
 */
function csco_share_buttons_bottom() {
	if ( is_single() && function_exists( 'bsb_display_shares' ) ) {
		bsb_display_shares( 'after-post' );
	}
}

/**
 * Post Author
 */
function csco_single_post_author() {
	if ( ! is_single() || ! get_theme_mod( 'post_author', true ) ) {
		return;
	}
	$type = get_theme_mod( 'post_author_type', 'default' );
	if ( ( 'csco_post_end' === current_filter() && 'default' === $type ) ||
	     ( 'csco_post_content_after' === current_filter() && 'compact' === $type ) ) {
		get_template_part( 'template-parts/post/post-author' );
	}
}

/**
 * Post Category in Single Posts
 */
function csco_single_post_category() {
	if ( is_single() ) {
		csco_post_meta( 'category' );
	}
}

/**
 * Post Meta in Single Posts
 */
function csco_single_post_meta() {
	if ( is_single() ) {
		csco_post_meta( array( 'date', 'views', 'reading_time' ) );
	}
}

/**
 * Hentry missing tags fix for wide and large headers
 */
function csco_single_hentry_fix() {
	$page_header_type = csco_get_page_header_type();
	if ( is_singular( array( 'post', 'page' ) ) && in_array( $page_header_type, array( 'large', 'wide' ), true ) ) { ?>
		<span class="hidden-xs-up">
			<span class="entry-title"><?php the_title(); ?></span>
			<?php csco_meta_date(); ?>
		</span>
	<?php }
}

/**
 * Post Pagination
 */
function csco_single_post_pagination() {
	if ( is_single() && get_theme_mod( 'post_pagination', true ) ) {
		get_template_part( 'template-parts/post/post-pagination' );
	}
}

/**
 * Post Subscribe
 */
function csco_single_subscribe() {

	if ( ! get_theme_mod( 'post_subscribe', false ) ) {
		return;
	}

	$title    = get_theme_mod( 'post_subscribe_title', esc_html__( 'Subscribe', 'authentic' ) );
	$message  = get_theme_mod( 'post_subscribe_message', esc_html__( 'Subscribe now to our newsletter', 'authentic' ) ); ?>

	<section class="post-subscribe">

		<?php
		if ( shortcode_exists( 'basic_mailchimp' ) ) {

			do_action( 'csco_subscribe_before' );
			echo do_shortcode( '[basic_mailchimp title="' . esc_html( $title ) . '" text="' . esc_html( $message ) . '"]' );
			do_action( 'csco_subscribe_after' );

		} else { ?>

			<div class="alert alert-warning">
				<?php esc_html_e( 'Please install and activate Basic MailChimp plugin from Appearance → Install Plugins.' ); ?>
			</div>

		<?php } ?>

	</section>

<?php }

/**
 * Category Descriptions
 */
function csco_category_description() {
	if ( is_category() && category_description() ) {
		echo wp_kses_post( apply_filters( 'csco_category_description', '<div class="taxonomy-description">' . category_description() . '</div>' ) );
	}
}

/**
 * Tag Descriptions
 */
function csco_tag_description() {
	if ( is_tag() && tag_description() ) {
		echo wp_kses_post( apply_filters( 'csco_tag_description', '<div class="taxonomy-description">' . tag_description() . '</div>' ) );
	}
}

/**
 * Post Comments
 */
function csco_single_post_comments() {
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
}
