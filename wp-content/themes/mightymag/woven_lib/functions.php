<?php
/**
 * Woven Libs
 **/
 
include_once 'mobile-detect/Mobile_Detect.php';
$woven_detect = new Mobile_Detect;


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
	} else if ( $woven_detect->isTablet() ) {
		// $platform = 'tablet';
		$platform = 'desktop';
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
		// get_template_part( 'woven_lib/dfp/inits/tablet' );	
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
	
	if ( $platform && in_array($position, array('atf', 'btf')) && in_array($size, array(300, 320, 728, 1, 2, 970, 600)) ) {
		get_template_part( 'woven_lib/dfp/tags/' . $platform . '/' . $position . '-' . $size . $alt_placement_str );
	}
}

/**
 * Widgetized the ad units
 **/
/* -------------- CREATE WIDGET - ATF ADS 300x250 ----------- */
class woven_widget_300x250_top extends WP_Widget {
	function woven_widget_300x250_top() {
		parent::WP_Widget( false, 'Woven - ATF 300x250' );
	}

	function form( $instance ) {
		// outputs the options form on admin
		$sb_title = esc_attr($instance['sb_title']);
	}

	function update($new_instance, $old_instance ) {
		// processes widget options to be saved
		return $new_instance;
	}

	function widget( $args, $instance ) {
?>
<aside class="widget clearfix widget_text">
	<div class="textwidget ad-unit dfp-300-top">
		<p align="center">
		<?php
			/*** WOVEN ***/
			if ( function_exists('woven_render_adunit') ) {
				if ( 'desktop' == woven_platform_detect() || 'tablet' == woven_platform_detect() ) {
					woven_render_adunit( 'atf', 300 );
				}
				if ( 'mobile' == woven_platform_detect() ) {
					woven_render_adunit( 'atf', 300, 1 );
				}
			}
		?>
		</p>
	</div>
</div>
<?php
	}
}
register_widget( 'woven_widget_300x250_top' );

/* -------------- CREATE WIDGET - ATF ADS 300x250 ----------- */
class woven_widget_300x250_bottom extends WP_Widget {
	function woven_widget_300x250_bottom() {
		parent::WP_Widget( false, 'Woven - BTF 300x250' );
	}

	function form( $instance ) {
		// outputs the options form on admin
		$sb_title = esc_attr($instance['sb_title']);
	}

	function update($new_instance, $old_instance ) {
		// processes widget options to be saved
		return $new_instance;
	}

	function widget( $args, $instance ) {
?>
<aside class="widget clearfix widget_text">
	<div class="textwidget ad-unit dfp-300-bot">
		<p align="center">
		<?php
			/*** WOVEN ***/
			if ( function_exists('woven_render_adunit') ) {
				if ( 'desktop' == woven_platform_detect() || 'tablet' == woven_platform_detect() ) {
					woven_render_adunit( 'btf', 300 );
				}
				if ( 'mobile' == woven_platform_detect() ) {
					woven_render_adunit( 'atf', 300, 2 );
				}
			}
		?>
		</p>
	</div>
</div>
<?php
	}
}
register_widget( 'woven_widget_300x250_bottom' );



/**
Development Notes:
- Skin:		header.php
- Native:	footer.php
- Home Page ATF 300: 
- ATF 970:  header.php
- ATF 728:  header.php
- ATF 300:  [widget]
- BTF 300:  [widget]
- BTF 728:	footer.php
- BTF 600:  content-single.php
- BTF 600 HP: index.php -- admin/functions-extended/fn-js.php

Mobile
- ATF 320:  header.php
- 300_1:  	[widget]
- 300_2:  	[widget]
**/