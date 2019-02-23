<?php

add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', ['csco_css_styles']);
    wp_enqueue_script('jquery-dfp', get_stylesheet_directory_uri() . '/js/jquery.dfp.min.js', ['jquery'], false, true);
    wp_enqueue_script('parent-script', get_stylesheet_directory_uri() . '/js/scripts.js', ['jquery', 'jquery-dfp'], false, true);
});

add_action ( 'wp_head', function() {
    global $post;
	$ad_section_targeting = array();
	$targeting = [];

	if (is_front_page()) {
	    $ad_section_targeting[] = 'home';
	} else {
	    if (is_single()) {
	        $ad_section_targeting[] = 'article';
	    }

	    $ad_section_targeting[] = 'ros';
	}

	if (!empty($ad_section_targeting)) {
	    $targeting = array_merge($targeting, ['nicekicks_section' => $ad_section_targeting]);
	}

	if (is_single()) {
		$targeting = array_merge($targeting, ['postid' => $post->ID]);
	}
	?>
	<script>
	var dfp_ad_targeting = <?php echo json_encode(array_map(function($a) { return (string) $a; })); ?>;
	</script>
	<?php
});

add_action('csco_body_start', function() {
	render_ad_leaderboard();
});

function render_ad_leaderboard() {
	get_template_part('templates/ads/leaderboard');
}
