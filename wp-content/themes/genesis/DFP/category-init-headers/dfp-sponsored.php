<?php
	//Write the proper DFP Init based upon category / homepage.
	if(is_front_page()){//Homepage
		echo "<!-- DFP Homepage INIT -->";
		include_once( 'wp-content/DFP/category-init-headers/dfp-init-homepage.php');
	}

	elseif(is_tag('features') ||  has_tag('features')){	// Features
		echo "<!-- DFP FEATURES INIT -->";
		include_once( '/wp-content/DFP/category-init-headers/dfp-init-features.php');
	}

	elseif ( 'shoes' == get_post_type()  || is_page('195551') ) {
		echo "<!-- DFP RELEASE DATES INIT -->";
		include_once( TEMPLATEPATH . '/DFP/category-init-headers/dfp-init-releaseDates.php');
	}

	elseif(is_tag('video')|| has_tag('video')){ // Video
		echo "<!-- DFP TV INIT -->";
		include_once( TEMPLATEPATH . '/DFP/category-init-headers/dfp-init-video.php');
	}
	else { //ROS for everything else

		echo "<!-- DFP ROS INIT -->";
		include_once( TEMPLATEPATH . '/DFP/category-init-headers/dfp-init-ros.php');
	}

?>	