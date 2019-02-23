<?php
/**
 * Functions
 *
 * @package      NiceKicks
 * @author       Bill Erickson <bill@billerickson.net>
 * @copyright    Copyright (c) 2011, Bill Erickson
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */

/**
 * Theme Setup
 *
 * This setup function attaches all of the site-wide functions 
 * to the correct hooks and filters. All the functions themselves
 * are defined below this setup function.
 *
 */
 

add_action('genesis_setup','child_theme_setup', 15);
function child_theme_setup() {
	
	// ** Backend **	
	
	// Image Sizes
	add_image_size( 'be_thumb', 275, 170, true );
	add_image_size( 'be_full', 620, 999 );
	add_image_size( 'be_rotator', 630, 340, true );
	add_image_size( 'be_related', 140, 90, true );
	add_image_size( 'be_top', 970, 440, true );
	
	// Sidebars
	unregister_sidebar( 'sidebar' );
	unregister_sidebar('sidebar-alt');
	genesis_register_sidebar( array( 'name' => 'Before Header', 'id' => 'before-header' ) );
	genesis_register_sidebar( array( 'name' => 'After Nav', 'id' => 'after-nav' ) );
	genesis_register_sidebar( array( 'name' => 'Sidebar Top', 'id' => 'sidebar-top' ) );
	genesis_register_sidebar( array( 'name' => 'Sidebar Left', 'id' => 'sidebar-left' ) );
	genesis_register_sidebar( array( 'name' => 'Sidebar Right', 'id' => 'sidebar-right' ) );
	genesis_register_sidebar( array( 'name' => 'Sidebar Bottom', 'id' => 'sidebar-bottom' ) );
	genesis_register_sidebar( array( 'name' => 'Home Before Posts', 'id' => 'home-before-posts' ) );
	genesis_register_sidebar( array( 'name' => 'Sandbox Sidebar', 'id' => 'sandbox-sidebar' ) );
	//add_theme_support( 'genesis-footer-widgets', 3 );

	add_theme_support( 'post-thumbnails' );

	// Remove Unused Page Layouts
	genesis_unregister_layout( 'content-sidebar-sidebar' );
	genesis_unregister_layout( 'sidebar-sidebar-content' );
	genesis_unregister_layout( 'sidebar-content-sidebar' );
		
	// Setup Theme Settings
	include_once( CHILD_DIR . '/lib/functions/admin.php');
	
	// Don't update theme
	add_filter( 'http_request_args', 'be_dont_update_theme', 5, 2 );
		
	// Rebuild Meta Description function
	remove_action( 'genesis_meta', 'genesis_seo_meta_description' );
	add_action( 'genesis_meta', 'be_seo_meta_description' );
	
	// Default Tag Meta Description
	add_filter( 'genesis_seo_meta_description', 'be_default_tag_description' );

	// Always show title/description on archives
	remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );
	add_action( 'genesis_before_loop', 'be_do_taxonomy_title_description', 15 );

	// ** Frontend **		
	
	// Scripts
	add_action( 'wp_enqueue_scripts', 'be_scripts' );
	
	// Feature and Video Template
	add_filter( 'template_include', 'be_feature_video_template' );
	
	// Sidebar
	remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
	add_action( 'genesis_sidebar', 'be_sidebar' );
	
	// Search Form
	add_filter( 'genesis_search_text', 'be_search_text' );
	add_filter( 'genesis_search_button_text', '__return_false' );
	
	// Above Header Widget Area
	add_action( 'genesis_before_header', 'be_before_header_widget_area' );
	
	// After Nav widget area
	add_action( 'genesis_after_header', 'be_after_nav_widget_area' );
	
	// Post Info
	add_filter( 'genesis_post_info', 'be_post_info' );
	
	// Remove Read More link
	add_filter( 'get_the_content_more_link', '__return_false', 99 );

	
	// Post Meta and Sharing
	remove_action( 'genesis_after_post_content', 'genesis_post_meta' );
	add_filter( 'genesis_post_meta', 'be_post_meta' );
	add_action( 'genesis_after_post_content', 'be_sharing', 15 );
	
	// Use Prev/Next for Multi-page posts
	remove_action( 'genesis_post_content', 'genesis_do_post_content' );
	add_action( 'genesis_post_content', 'be_nicekicks_content' );
	
	// Change Excerpt
	add_filter('excerpt_length', 'be_excerpt_length');
	add_filter( 'excerpt_more', '__return_false', 50 );		
	
	// Footer
	remove_action( 'genesis_footer', 'genesis_do_footer' );
	add_action( 'genesis_footer', 'be_footer' );
	
	// Rotator use Meta
	add_filter( 'genesis_slider_query_args', 'be_slider_args' );
	
	// Breadcrumbs
	add_filter('genesis_breadcrumb_args', 'be_custom_breadcrumb_args');
	add_filter( 'genesis_archive_crumb', 'be_breadcrumb_add_shoes', 10, 2 );
	add_filter( 'genesis_single_crumb', 'be_breadcrumb_for_shoes', 10, 2 );
	remove_action('genesis_before_loop', 'genesis_do_breadcrumbs' );
	add_action( 'genesis_before_footer', 'genesis_do_breadcrumbs' );
	
	// Image Override Customizations
	add_filter( 'image_override_post_types', 'be_image_override_post_types' );
	add_filter( 'image_override_sizes', 'be_image_override_sizes' );
	
	// Advertising
	// add_action( 'wp_head', 'be_advertising_head' );
	// add_action( 'genesis_header', 'be_advertising_after_body', 1 );
	// add_action( 'genesis_after_header', 'be_advertising_after_header', 20 );
	add_action( 'genesis_before_content_sidebar_wrap', 'be_advertising_content_wrapper_open', 99 );
	add_action( 'genesis_after_content_sidebar_wrap', 'be_advertising_content_wrapper_close', 1 );
	add_action( 'genesis_before_content_sidebar_wrap', 'be_advertising_before_content_sidebar_wrap' );
	// add_action( 'wp_footer', 'be_advertising_footer' );
	
	// Sharing code in Footer
	add_action( 'wp_footer', 'be_gplus_code' );
	
	
}

// ** Backend Functions ** //

/**
 * Don't Update Theme
 * If there is a theme in the repo with the same name, 
 * this prevents WP from prompting an update.
 *
 * @author Mark Jaquith
 * @link http://markjaquith.wordpress.com/2009/12/14/excluding-your-plugin-or-theme-from-update-checks/
 *
 * @param array $r, request arguments
 * @param string $url, request url
 * @return array request arguments
 */

function be_dont_update_theme( $r, $url ) {
	if ( 0 !== strpos( $url, 'http://api.wordpress.org/themes/update-check' ) )
		return $r; // Not a theme update request. Bail immediately.
	$themes = unserialize( $r['body']['themes'] );
	unset( $themes[ get_option( 'template' ) ] );
	unset( $themes[ get_option( 'stylesheet' ) ] );
	$r['body']['themes'] = serialize( $themes );
	return $r;
}

/**
 * Generates the meta description based on contextual criteria.
 *
 * Adds the 'genesis_seo_meta_description' filter
 * See Ticket #294, will remove when added to Genesis core
 */
function be_seo_meta_description() {

	global $wp_query, $post;

	$description = '';

	/** If we're on the home page */
	if ( is_front_page() )
		$description = genesis_get_seo_option( 'home_description' ) ? genesis_get_seo_option( 'home_description' ) : get_bloginfo( 'description' );

	/** If we're on a single post / page / attachment */
	if ( is_singular() ) {
		/** Description is set via custom field */
		if ( genesis_get_custom_field( '_genesis_description' ) )
			$description = genesis_get_custom_field( '_genesis_description' );
		/** All-in-One SEO Pack (latest, vestigial) */
		elseif ( genesis_get_custom_field( '_aioseop_description' ) )
			$description = genesis_get_custom_field( '_aioseop_description' );
		/** Headspace2 (vestigial) */
		elseif ( genesis_get_custom_field( '_headspace_description' ) )
			$description = genesis_get_custom_field( '_headspace_description' );
		/** Thesis (vestigial) */
		elseif ( genesis_get_custom_field( 'thesis_description' ) )
			$description = genesis_get_custom_field( 'thesis_description' );
		/** All-in-One SEO Pack (old, vestigial) */
		elseif ( genesis_get_custom_field( 'description' ) )
			$description = genesis_get_custom_field( 'description' );
	}

	if ( is_category() ) {
		//$term = get_term( get_query_var('cat'), 'category' );
		$term = $wp_query->get_queried_object();
		$description = ! empty( $term->meta['description'] ) ? $term->meta['description'] : '';
	}

	if ( is_tag() ) {
		//$term = get_term( get_query_var('tag_id'), 'post_tag' );
		$term = $wp_query->get_queried_object();
		$description = ! empty( $term->meta['description'] ) ? $term->meta['description'] : '';
	}

	if ( is_tax() ) {
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$description = ! empty( $term->meta['description'] ) ? wp_kses_stripslashes( wp_kses_decode_entities( $term->meta['description'] ) ) : '';
	}

	if ( is_author() ) {
		$user_description = get_the_author_meta( 'meta_description', (int) get_query_var( 'author' ) );
		$description = $user_description ? $user_description : '';
	}
	
	$description = apply_filters( 'genesis_seo_meta_description', $description );

	/** Add the description if one exists */
	if ( $description )
		echo '<meta name="description" content="' . esc_attr( $description ) . '" />' . "\n";

}

/** 
 * Default Tag Meta Description
 *
 * @param string $description
 * @return string
 */
function be_default_tag_description( $description ) {
	
	// If a description is already defined, or we're not on the tag archive, use current description
	if( !empty( $description ) || !is_tag() )
		return $description;
	
	// Setup default tag description
	global $wp_query;	
	$term = $wp_query->get_queried_object();
	$description = 'Nice Kicks has the latest information about ' . $term->name . '. More information about ' . $term->name . ' shoes including release dates, prices, and reviews';
	
	return $description;
}

/**
 * Add Title/Description to Category/Tag/Taxonomy archive pages.
 *
 * @since 1.3
 */
function be_do_taxonomy_title_description() {

	global $wp_query;

	if ( ! is_category() && ! is_tag() && ! is_tax() )
		return;

	if ( get_query_var( 'paged' ) >= 2 )
		return;

	$term = is_tax() ? get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ) : $wp_query->get_queried_object();
	if( is_category() )
		$taxonomy = 'category';
	if( is_tag() )
		$taxonomy = 'post_tag';
	else
		$taxonomy = get_query_var( 'taxonomy' );

	if ( ! $term || ! isset( $term->meta ) )
		return;

	$title = sprintf( '<h1>%s</h1>', esc_html( $term->name ) );
	$description = $term->meta['intro_text'];
	if( empty( $description ) )
		$description = $term->description;
	
	$image = get_option( $taxonomy . '_' . $term->term_id . '_archive_image' );
	if( !empty( $image ) )
		$image = wp_get_attachment_image( $image, 'be_full' );	
			
	if ( $title || $description ) {
		printf( '<div class="taxonomy-description">%s</div>', $title . $image . wpautop( $description ) );
	}

}

// ** Frontend Functions ** //

/**
 * Enqueue Scripts
 *
 */
function be_scripts() {
	wp_enqueue_style( 'flexslider', get_stylesheet_directory_uri() . '/lib/css/flexslider.css' );

	wp_register_script( 'flexslider', get_stylesheet_directory_uri() . '/lib/js/jquery.flexslider-min.js', array( 'jquery' ), '2.2.0', true );
	wp_register_script( 'be-home', get_stylesheet_directory_uri() . '/lib/js/home.js', array( 'jquery', 'flexslider' ), '1.0', true );
	wp_register_script( 'be-single', get_stylesheet_directory_uri() . '/lib/js/single.js', array( 'jquery', 'flexslider' ), '1.0', true );

}

/**
 * Feature and Video Template 
 *
 */
function be_feature_video_template( $template ) {
	if( is_tag( array( 'features', 'video' ) ) )
		$template = get_query_template( 'feature-and-video' );
	return $template;
}
 
/**
 * Setup Sidebar
 *
 */
function be_sidebar() {
	
 if (is_page('355912')) { 
	
	echo '<div class="sidebar-top">';
	dynamic_sidebar( 'sandbox-sidebar' );
	echo '</div>';
	}
else
{
	echo '<div class="sidebar-top">';
	dynamic_sidebar( 'sidebar-top' );
	echo '</div><div class="sidebar-left">';
	dynamic_sidebar( 'sidebar-left' );
	echo '</div><div class="sidebar-right">';
	dynamic_sidebar( 'sidebar-right' );
	echo '</div><div class="sidebar-bottom">';
	dynamic_sidebar( 'sidebar-bottom ');
	echo '</div>';
	}
}

/**
 * Search text 
 *
 */
function be_search_text( $text ){
	return 'Search';
}

/**
 * Before Header Widget Area
 *
 */
function be_before_header_widget_area() {
	echo '<div class="before-header">';
	dynamic_sidebar( 'before-header' );
	

	?>
	
	<!-- Mobile_1x1 -->
<div id='div-gpt-ad-1389207917766-0' style='width:1px; height:1px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1389207917766-0'); });
</script>
</div>
<!--.end Mobile_1x1 -->

<?php 
	
	
	echo '</div>';
}
/**
 * After Nav Widget Area
 *
 */
function be_after_nav_widget_area() {
	echo '<div class="after-nav">';
	dynamic_sidebar( 'after-nav' ); ?>
	
<?php	
	if (is_single('358859')) { ?>
	
	<div id="cmn_ad_tag_head" class="fw_nicekicks" style="margin: 15px 0px;">
	<!-- begin ad tag -->
<script type="text/javascript">
//<![CDATA[
ord=Math.random()*10000000000000000;
document.write('<script type="text/javascript" src="http://ad.doubleclick.net/adj/wd.dailyfill.home/;kw=draftkingstest_nc;sz=728x90;ord=' + ord + '?"><\/script>');
//]]>
</script>
<noscript><a href="http://ad.doubleclick.net/jump/wd.dailyfill.home/;kw=draftkingstest_nc;sz=728x90;ord=123456789?" target="_blank" ><img src="http://ad.doubleclick.net/ad/wd.dailyfill.home/;kw=draftkingstest_nc;sz=728x90;ord=123456789?" border="0" alt="" /></a></noscript>
<!-- end ad tag --></div>
	
	
<?php	}
	
	 if (is_page( '35591' )) { ?>

			<?php function add_ads() { ?>

				<div class="takeover-mobile">
<div class='celtra-ad-v3'><img src='data:image/png,celtra' style='display: none' onerror=" (function(img) { var params = {'placementId':'8cb47dde','clickUrl':'%%CLICK_URL_UNESC%%','clickEvent':'advertiser','externalAdServer':'DFPPremium'}; var req = document.createElement('script'); req.id = params.scriptId = 'celtra-script-' + (window.celtraScriptIndex = (window.celtraScriptIndex||0)+1); params.clientTimestamp = new Date/1000; req.src = (window.location.protocol == 'https:' ? 'https' : 'http') + '://ads.celtra.com/7797cb4c/web.js?'; for (var k in params) { req.src += '&amp;' + encodeURIComponent(k) + '=' + encodeURIComponent(params[k]); } img.parentNode.insertBefore(req, img.nextSibling); })(this); "/> </div>
</div>


			<?php } ?>

<div class="mobile-takeover">
<?php add_ads(); ?>
</div>

<?php }		

// End Code section ///////////////		
	
	echo '</div>';
}

/**
 * Post Info
 *
 */
function be_post_info( $post_info ) {
	$num_comments = get_comments_number();
	if( is_single() )
		$post_info = '<span class="time">' . human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) . ' ago</span> - [post_author before="by "] - <span class="post_comments">' . $num_comments . ' comments</span>';
	else
		$post_info = '<span class="time">' . human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) . ' ago</span> - <span class="post_comments">' . $num_comments . ' comments</span>';
	
	return $post_info;
}

/**
 * Post Meta
 *
 */
function be_post_meta( $post_meta ) {
	$post_meta = '[post_tags before="" sep=" "]';
	return $post_meta;
}

/**
 * Sharing
 *
 */
function be_sharing( $title = false, $permalink = false, $return = false ) {
	$title = empty( $title ) ? get_the_title() : esc_html( $title );
	$permalink = empty( $permalink ) ? get_permalink() : esc_url( $permalink );
	$output = '<div class="sharing test"><a href="https://twitter.com/share" class="twitter-share-button" data-url="' . $permalink . '" data-text="' . $title . '" data-count="horizontal">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script><iframe src="//www.facebook.com/plugins/like.php?href=' . $permalink . '&amp;send=false&amp;layout=button_count&amp;width=105&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=161312980615369" scrolling="no" frameborder="0" style="top: 0; border:none; overflow:hidden; width:105px; height:21px;" allowTransparency="true"></iframe> <div class="g-plusone" data-size="medium" data-href="' . $permalink . '"></div></div>';
	
	
	if( $return )
		return $output;
	else
		echo $output;
	
}

function be_nicekicks_content() {
	if ( is_singular() ) {
		the_content();

		if ( is_single() && 'open' == get_option( 'default_ping_status' ) ) {
			echo '<!--';
			trackback_rdf();
			echo '-->' . "\n";
		}

		if ( is_page() && apply_filters( 'genesis_edit_post_link', true ) )
			edit_post_link( __( '(Edit)', 'genesis' ), '', '' );
	}
	elseif ( 'excerpts' == genesis_get_option( 'content_archive' ) ) {
		the_excerpt();
	}
	else {
		if ( genesis_get_option( 'content_archive_limit' ) )
			the_content_limit( (int) genesis_get_option( 'content_archive_limit' ), __( '[Read more…]', 'genesis' ) );
		else
			the_content( __( '[Read more…]', 'genesis' ) );
	}
	
	wp_link_pages( array( 
		'before' => '<p class="pages">Pages:', 
		'after' => '</p>', 
	) );
	wp_link_pages( array( 
		'before' => '<p class="pages">', 
		'after' => '</p>', 
		'next_or_number' => 'next', 
		'nextpagelink' => ' Next &raquo;', 
		'previouspagelink' => '&laquo; Previous |',
	) );
}


/**
 * Excerpt Length
 *
 */
function be_excerpt_length($length) {
	return 30;
}

/**
 * Change Excerpt More text
 * @author Bill Erickson
 * @link http://www.billerickson.net/code/change-excerpt-more-text
 *
 * @param string original more text
 * @return string modified more text
 */
function be_excerpt_more( $more ) {
	return '';
}

/**
 * Footer
 *
 */
function be_footer() {
	echo '<div class="left"><p>' . wp_kses_post( genesis_get_option( 'footer_left' ) ) . '</p></div>';
	echo '<div class="right"><p>' . wp_kses_post( genesis_get_option( 'footer_right' ) ) . '</p></div>';
}

/**
 * Genesis Slider Arguments
 *
 */
function be_slider_args( $args ) {
	$meta = array(
		array(
			'key' => 'be_rotator_include',
			'value' => 'on'
		)
	);
	$args['meta_query'] = $meta;
	return $args;
}

/**
 * Customize Breadcrumb Arguments
 * @author Bill Erickson
 * @link http://www.billerickson.net/code/genesis-breadcrumb-arguments
 *
 * @param array original arguments
 * @return array modified arguments
 */
function be_custom_breadcrumb_args( $args ) {
	$args['labels']['prefix']        = '';
	$args['labels']['author']        = '';
    $args['labels']['category']      = ''; 
    $args['labels']['tag']           = '';
    $args['labels']['date']          = '';
    $args['labels']['search']        = '';
    $args['labels']['tax']           = '';
    $args['labels']['post_type']     = '';
    $args['labels']['404']           = '';
    return $args;
}

/**
 * Add News to Archives
 *
 */
function be_breadcrumb_add_shoes( $crumb, $args ) {
	if( is_tax( 'brand' ) )
		$crumb = '<a href="' . get_bloginfo( 'url' ) . '/shoes" title="View All Shoes">Shoes</a> ' . $args['sep'] . $crumb;
	return $crumb;
}

/**
 * Breadcrumb for Shoes
 *
 */
function be_breadcrumb_for_shoes( $crumb, $args ) {
	if( !( 'shoes' == get_post_type() ) )
		return $crumb;

	$breadcrumb = new Genesis_Breadcrumb;
	$crumb = $breadcrumb->get_breadcrumb_link( get_bloginfo( 'url' ) . '/shoes', 'View All Shoes', 'Shoes' ) . $breadcrumb->args['sep'];

	global $post;
	$categories = get_the_terms( $post->ID, 'brand' );

	if ( 1 == count( $categories ) ) { // if in single category, show it, and any parent categories
		foreach( $categories as $category )
			$crumb .= $breadcrumb->get_term_parents( $category->term_id, 'brand', true ) . $breadcrumb->args['sep'];
	}
	if ( count( $categories ) > 1 ) {
		if ( ! $breadcrumb->args['heirarchial_categories'] ) { // Don't show parent categories (unless the post happen to be explicitely in them)
			foreach ( $categories as $category ) {
				$crumbs[] = $breadcrumb->get_breadcrumb_link(
								get_category_link( $category->term_id ), sprintf( __( 'View all posts in %s', 'genesis' ), $category->name ), $category->name
				);
			}
			$crumb .= join( $breadcrumb->args['list_sep'], $crumbs ) . $breadcrumb->args['sep'];
		} else { // Show parent categories - see if one is marked as primary and try to use that.
			$primary_category_id = get_post_meta( $post->ID, '_category_permalink', true ); // Support for sCategory Permalink plugin
			if ( $primary_category_id ) {
				$crumb .= $breadcrumb->get_term_parents( $primary_category_id, 'brand', true ) . $breadcrumb->args['sep'];
			} else {
				$first = true;
				foreach( $categories as $category ) {
					if( $first )
						$crumb .= $breadcrumb->get_term_parents( $category->term_id, 'brand', true ) . $breadcrum->args['sep'];				
					$first = false;
				}

			}
		}
	}
	$crumb .= single_post_title( '', false );

	return $crumb;	
}

/**
 * Shoe Loop
 *
 * @param array $args
 */
function be_shoe_loop( $args, $month = false, $echo = true ) {
	$output = '';
	$loop = new WP_Query( $args );
	$count = 1;
	$current_month = '';
	if( $loop->have_posts() ):
		$output .= '<div class="upcoming-releases">';
		while( $loop->have_posts() ): $loop->the_post(); global $post;
		
			if( $month ) {
				$intro_date = esc_attr( get_post_meta( $post->ID, 'be_shoe_release_date', true ) );
				$month = date( 'M, Y', $intro_date );
				if( $month !== $current_month ) {
					$current_month = $month;
					$output .= '<h3>' . $current_month . '</h3>';
					$count = 1;
				}
			}
		
			if( $count % 4 == 1 )
				$classes = 'release first';
			else
				$classes = 'release';
			$output .= '<div class="' . $classes . '">';
			$output .= '<p class="image"><a href="' . get_permalink() . '">' . get_the_post_thumbnail( $post->ID, 'be_related' ) . '</a></p>';
			$date = esc_attr( get_post_meta( $post->ID, 'be_shoe_release_date', true ) );
			$format = esc_attr( get_post_meta( $post->ID, 'be_shoe_release_date_format', true ) );
			$format = ( 'day' == $format ) ? 'day' : 'month';
			$date = ( 'day' == $format ) ? date( 'M j, Y', $date ) : date( 'M, Y', $date );
			$price = esc_attr( get_post_meta( $post->ID, 'be_shoe_price', true ) );

			$output .= '<p classs="info"><a href="' . get_permalink() . '">' . get_the_title() . '</a><br />' . $date;
			if( !empty( $price ) ) 
				$output .= '<br />MSRP: $' . number_format( $price );
			$output .= '</p>';
			$output .= '</div><!-- .release -->';
			$count++;
		endwhile; wp_reset_query();
		$output .= '</div><!-- .upcoming-releases-->';
	endif;
	
	if( $echo )
		echo $output;
	else
		return $output;
}

/**
 * Limit Image Override to 'post' post type
 * @author Bill Erickson
 * @link https://gist.github.com/1337821
 *
 * @param array $post_types
 * @return array modified post types
 */
function be_image_override_post_types( $post_types ) {
	$post_types = array( 'post' );
	return $post_types;
}

/**
 * Image Override - Limit Image Sizes
 * @author Bill Erickson
 * @link https://gist.github.com/1337831
 *
 * @param array $sizes
 * @return array modified sizes
 */
function be_image_override_sizes( $sizes ) {
	$sizes = array( 'slider' );
	return $sizes;
} 


/**
 * Advertising in <head>
 *
 */
function be_advertising_head() {
	include( get_stylesheet_directory() . '/lib/functions/cmn_config.php'); 
	?>
	<!-- cmnUNT | Begin head script -->
	<script type="text/javascript">
	    cmnunt_site         = 'cmn_nicekicks';
	    cmnunt_silo         = 's_sne';
	    cmnunt_subsilo      = '<?php echo $cmnParams['subsilo']; ?>';
	    cmnunt_tier         = '<?php echo $cmnParams['tier']; ?>';
	    cmnunt_zone           = '<?php echo $cmnParams['zone']; ?>';
	    cmnunt_kw           = '<?php echo $cmnKW; ?>';
	    cmnunt_exclude      = '<?php echo $cmnParams['exclude']; ?>';
	</script>
	<script type="text/javascript" src="http://cdn.complexmedianetwork.com/js/cmnUNT.js"></script>
	<!-- cmnUNT | End head script -->
	<?php
}

/**
 * Advertising right after <body>
 *
 */
function be_advertising_after_body() {
	?>
	<div id="cmn_wrap">
	<?php
}

/**
 * Advertising after header
 *
 */
function be_advertising_after_header() {
	?>
	<?php if (is_page('355912')) { 
	 }
	else
	{ ?>
	
	<div id="cmn_ad_tag_head" class="fw_nicekicks">
	<!-- cmnUNT | Begin ad tag --><script type="text/javascript">cmnUNT('3x3', tile_num++);</script>
	<!-- cmnUNT | End ad tag --> </div>
	<?php
	
	}
}

/**
 * Advertising right before #content-sidebar-wrap
 *
 */
function be_advertising_content_wrapper_open() {
	?>
	
    <?php 
}

/**
 * Advertising right after #content-sidebar-wrap
 *
 */
function be_advertising_content_wrapper_close() {
	?>
	</div><!-- #cmn_wrap -->
	<?php
}

/**
 * Advertising before #content-sidebar-wrap
 *
 */
function be_advertising_before_content_sidebar_wrap() {
	?>
	<?php
}

/**
 * Advertising in the footer
 *
 */
function be_advertising_footer() {
	?>
	<script type="text/javascript">               
	    cmnTB();
    	cmnUNT('tover', tile_num++);
	</script>
	<?php
}

add_filter('xmlrpc_methods', 'xml_add_method');

function xml_add_method( $methods ) {
    $methods['wp.getAppPosts'] = 'wp_getAppPosts';
    return $methods;
}

function wp_getAppPosts( $args ) {
    		//$this->escape($args);
		$cat_id	= (int) $args[0];
		$offset	= (int) $args[1];
		
		$recentPosts = new WP_Query("showposts=10&cat=$cat_id&offset=$offset" ); 

		$i = 0;
		while ( $recentPosts->have_posts() ) : $recentPosts->the_post();
			$recentPosts->posts[$i]->post_author = get_the_author();
			$i++;
		endwhile;
		
		return $recentPosts->posts;
}


function wp_getPushPosts() {
    //$this->escape($args);
    return 'HI';
    
		$recentPosts = new WP_Query("showposts=3" ); 

		$i = 0;
		while ( $recentPosts->have_posts() ) : $recentPosts->the_post();
			$recentPosts->posts[$i]->post_author = get_the_author();
			$i++;
		endwhile;
		
		return $recentPosts->posts;
}



/** Added by Matt */

register_post_type('video', array(	'label' => 'Video','description' => 'Nice Kicks Videos','public' => true,'show_ui' => true,'show_in_menu' => false,'capability_type' => 'post','hierarchical' => false,'rewrite' => array('slug' => ''),'query_var' => true,'has_archive' => true,'supports' => array('title','editor','excerpt','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes',),'taxonomies' => array('category','post_tag','brand',),'labels' => array (
  'name' => 'Video',
  'singular_name' => 'Video',
  'menu_name' => 'Video',
  'add_new' => 'Add Video',
  'add_new_item' => 'Add New Video',
  'edit' => 'Edit',
  'edit_item' => 'Edit Video',
  'new_item' => 'New Video',
  'view' => 'View Video',
  'view_item' => 'View Video',
  'search_items' => 'Search Video',
  'not_found' => 'No Video Found',
  'not_found_in_trash' => 'No Video Found in Trash',
  'parent' => 'Parent Video',
),) );

add_action( 'init', 'create_my_post_types' );

function create_my_post_types() {
	register_post_type( 'video',
		array(
			'labels' => array(
				'name' => __( 'Videos' ),
				'singular_name' => __( 'Video' )
			),
			'public' => true,
		)
	);
}

include( get_stylesheet_directory() . '/lib/functions/1-fragment-cache.php'); 

function be_gplus_code() {
	?>
	<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
	<?php
}


