<?php
/**
 * Woven Libs
 **/
 
include_once 'mobile-detect/Mobile_Detect.php';
$woven_detect = new Mobile_Detect;

/**
 * Woven DFP Scripts
 **/
function woven_dfp_scripts() {
	woven_dfp_head();
	wp_enqueue_style( 'woven-dfp-css', get_stylesheet_directory_uri() . '/woven_lib/css/style.css' );
	// wp_enqueue_script( 'woven-dfp', get_stylesheet_directory_uri() . '/woven_lib/js/dfp.js', array( 'jquery' ), '20150617', true );
}
add_action( 'wp_enqueue_scripts', 'woven_dfp_scripts' );

/**
 * Woven DFP Head
 **/
function woven_dfp_head() {
	global $post, $wp, $woven_detect;;

	$current_url = home_url(	add_query_arg(	array(), $wp->request ) );

	$page_loc = '';
	$page_campaign = '';
	
	if ( is_home() ) {
		$page_loc = 'homepage';
		$page_format = 'digest';
	} else if ( is_single() && '' != get_post_meta( $post->ID, '_campaign_name', true ) ) {
		$page_loc = 'editorial';
		$page_format = 'article';
		$page_campaign = get_post_meta( $post->ID, '_campaign_name', true );
	} else if ( is_single() && '' != get_post_meta( $post->ID, 'campaign_name', true ) ) {
		$page_loc = 'editorial';
		$page_format = 'article';
		$page_campaign = get_post_meta( $post->ID, 'campaign_name', true );
	} else if ( is_single() ) {
		$page_loc = 'ros';
		$page_format = 'article';
	} else {
		$page_loc = 'ros';
		$page_format = 'digest';
	}

	$wvnconfig_site = array(
		'name'		=> 'NiceKicks',
		'domain'	=> 'nicekicks.com',
	);
	$wvnconfig_pagedata = array(
		'id'		=> is_single() ? $post->ID : '',
		'type'		=> $page_loc,
		'format'	=> $page_format,
		'url'		=> $current_url,
		'editorial'	=> is_single() ? $page_campaign : false,
	);
?>	
<script type="text/javascript">
	var WVNconfig = WVNconfig || {};
	WVNconfig.Site = <?php echo json_encode( $wvnconfig_site ); ?>;
	WVNconfig.PageData = <?php echo json_encode( $wvnconfig_pagedata ); ?>;
</script>

<?php
}
// add_action('wp_head','woven_dfp_head');

/**
 * Woven Footer
 **/
function woven_dfp_footer() {
	 //echo '<div class="adslot visible-mobile hidden-desktop hidden-tablet" id="woven-interstitial" style="min-width: 1px; min-height: 1px;" data-zone="1x1" data-cids="" data-size="[1, 1]"></div>';
    //echo '<div class="adslot visible-desktop visible-tablet" id="woven-skin" style="min-width: 1px; min-height: 1px;" data-zone="Skin" data-cids="" data-size="[1, 1]"></div>';
}
add_action('wp_footer', 'woven_dfp_footer', 100);

/**
 * Woven Platform Detection
 * Used to detect the type of platform the user is on as mobile, tablet or desktop
 * @param none
 * @return str $platform;
 **/
function woven_platform_detect() {
	global $woven_detect;

	if ( $woven_detect->isMobile() && !$woven_detect->isTablet() ) {
		$platform = 'mobile';
	} else if ( !$woven_detect->isMobile() && $woven_detect->isTablet() ) {
		$platform = 'tablet';
	} else if ( !$woven_detect->isMobile() && !$woven_detect->isTablet() ) {
		$platform = 'desktop';
	} else {
		return false;
	}

	return $platform;
}


/**
 * Woven DFP Init
 * Inserts the correct DFP init into the head using wp_head action
 * @param none
 * @return none
 **/
function woven_dfp_init() {
	if ( 'desktop' == woven_platform_detect() ) {
		get_template_part( 'woven_lib/dfp/inits/desktop' );
	}
	if ( 'tablet' == woven_platform_detect() ) {
		get_template_part( 'woven_lib/dfp/inits/desktop' );
	}
	if ( 'mobile' == woven_platform_detect() ) {
		get_template_part( 'woven_lib/dfp/inits/mobile' );	
	}
}
add_action('wp_head', 'woven_dfp_init');


/**
 * Woven Render Ad Unit
 * Inserts the correct DFP init into the head using WP enqueue
 * @param none
 * @return none
 **/
function woven_render_adunit( $position = 'atf', $size = '', $alt = '' ) {
	
	$alt_placement_str = '';
	$size = (int) $size;
	$position = strtolower( $position );
	
	$platform = woven_platform_detect();
	
	if ( '' != $alt ) {
		$alt_placement_str = '-' . (int) $alt;
	}
	
	if ( 'desktop' == woven_platform_detect() ) {
		$alt_placement_str = '';
	}
	
	if ( $platform && in_array($position, array('atf', 'btf')) && in_array($size, array(300, 320, 728, 1, 970, 600)) ) {
		get_template_part( 'woven_lib/dfp/tags/' . $platform . '/' . $position . '-' . $size . $alt_placement_str );
	}
}


/**
Development Notes:
- Home Page ATF 300: Newspaper/page-homepage-loop.php
- ATF 970:  Newspaper/parts/menu-header.php
- ATF 728:  Newspaper/parts/header-style-1.php
- ATF 300:  Newspaper/sidebar.php
- BTF 300:  Newspaper/sidebar.php
- BTF 728:	Newspaper/footer.php
- BTF 600:  Newspaper/loop-single.php
- BTF 600:  Newspaper/loop.php -- Home Page / Category Pages

Mobile
- ATF 320:  Newspaper/parts/menu-header.php
- 300_1:  Newspaper/sidebar.php
- 300_2:  Newspaper/sidebar.php
**/