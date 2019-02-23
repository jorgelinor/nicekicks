<?PHP
// This will allow us to rotate ads with each gallery click but still allow us to control editorial, takeover and
// any other overrides that may be in place.

//Still determine the category we are in

?>

<!-- Gallery DFP HEAD-->
    <script type='text/javascript'>
	var googletag = googletag || {};
	googletag.cmd = googletag.cmd || [];
	(function() {
	var gads = document.createElement('script');
	gads.async = true;
	gads.type = 'text/javascript';
	var useSSL = 'https:' == document.location.protocol;
	gads.src = (useSSL ? 'https:' : 'http:') + 
	'//www.googletagservices.com/tag/js/gpt.js';
	var node = document.getElementsByTagName('script')[0];
	node.parentNode.insertBefore(gads, node);
	})();
	</script>


<!-- Gallery DFP Conditional Header Switch-->
<?php
	//Write the proper DFP Init based upon category / homepage.
	if(is_home()){//Homepage
		echo "<!-- Gallery DFP Homepage INIT -->";
		include_once( TEMPLATEPATH . '/category-init-headers/dfp-init-homepage.php');
	}

	elseif(is_category('alcohol') || in_category('alcohol')){	// ALCOHOL
		echo "<!-- Gallery DFP ALCOHOL INIT -->";
		include_once( TEMPLATEPATH . '/category-init-headers/dfp-init-alcohol.php');
	}
	elseif(is_category('humor') || in_category('humor')){	// HUMOR
		echo "<!-- Gallery DFP HUMOR INIT -->";
		include_once( TEMPLATEPATH . '/category-init-headers/dfp-init-humor.php');
	}
	elseif(is_category('tv')|| in_category('tv')){ // TV
		echo "<!-- Gallery DFP TV INIT -->";
		include_once( TEMPLATEPATH . '/category-init-headers/dfp-init-tv.php');
	}
	elseif(is_category('music')|| in_category('music')){	// MUSIC 
		echo "<!-- Gallery DFP MUSIC INIT -->";
		include_once( TEMPLATEPATH . '/category-init-headers/dfp-init-music.php');
	}
	elseif(is_category('sports')|| in_category('sports')){	// SPORTS
		echo "<!-- Gallery DFP SPORTS INIT -->";
		include_once( TEMPLATEPATH . '/category-init-headers/dfp-init-sports.php');
	}
	else { //ROS for everything else
		include_once( TEMPLATEPATH . '/category-init-headers/dfp-init-ros.php');
	}

?>	


<?  //make it look like a new body style to reinforce the 'unique page' constitution 
	//this comment is hidden for a reason											?>
<style type="text/css">body { margin: 0; }</style>


<?PHP
// Finally source in the ad for the proper category
include('ad-300x250.php')

?>