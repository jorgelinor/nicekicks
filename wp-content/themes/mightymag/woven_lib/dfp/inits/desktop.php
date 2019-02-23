<?php
/**
 * Woven DFP
 * Author:  Jerry Thompson
 * Date:	6/12/14
 **/

global $post;
?>

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


<?php if ( is_home() || is_front_page() ) { ?>

<script type='text/javascript'>
googletag.cmd.push(function() {
googletag.defineSlot('/6036473/Homepage_300x250_Anchor', [[300, 250], [300, 600]], 'wvn_zone_btf300').addService(googletag.pubads());
googletag.defineSlot('/6036473/Homepage_300x250_Top', [[300, 250], [300, 600], [300, 1050]], 'wvn_zone_atf300').addService(googletag.pubads());
googletag.defineSlot('/6036473/Homepage_600x300', [600, 300], 'wvn_zone_600').addService(googletag.pubads());
googletag.defineSlot('/6036473/Homepage_728x90_Anchor', [728, 90], 'wvn_zone_btf728').addService(googletag.pubads());
googletag.defineSlot('/6036473/Homepage_728x90_Top', [[728, 90], [728, 270]], 'wvn_zone_atf728').addService(googletag.pubads());
googletag.defineSlot('/6036473/Homepage_Pushdown', [[970, 1], [970, 66], [970, 500]], 'wvn_zone_970').addService(googletag.pubads());
googletag.defineSlot('/6036473/Homepage_Skin', [1, 1], 'wvn_zone_skin').addService(googletag.pubads());
googletag.defineSlot('/6036473/Homepage_Native', [2, 2], 'wvn_zone_native').addService(googletag.pubads());
googletag.pubads().collapseEmptyDivs();
googletag.pubads().enableSingleRequest();
googletag.enableServices();
});
</script>

<?php } else { ?>

<script type='text/javascript'>
<?php
	// Prepopulate DFP tags for post level targeting
	if ( is_single() ) { 
	
		$posttags = get_the_tags();
		$posttag_dfp = '';
		
		if ( $posttags ) {
			foreach( $posttags as $tag ) {
				$posttag_dfp .= '"' . $tag->name . '", ';
			}
			$posttag_dfp = strtoupper( substr($posttag_dfp, 0, strlen($posttag_dfp) - 2) );
		} else {
			$posttag_dfp = '';
		}
	
		if ( '' != get_post_meta($post->ID, '_matureflag', true) ) {
			$mature_flag = 1;
		} else {
			$mature_flag = 0;
		}
	} // endif is_single()
	
	if ( is_single() && '' != get_post_meta($post->ID, '_campaign_name', true) ) {
?>	

googletag.cmd.push(function() {
	googletag.defineSlot('/6036473/EDIT_300x250_Anchor', [[300, 250], [300, 600]], 'wvn_zone_btf300').addService(googletag.pubads());
	googletag.defineSlot('/6036473/EDIT_300x250_Top', [[300, 250], [300, 600], [300, 1050]], 'wvn_zone_atf300').addService(googletag.pubads());
	googletag.defineSlot('/6036473/EDIT_600x300', [600, 300], 'wvn_zone_600').addService(googletag.pubads());
	googletag.defineSlot('/6036473/EDIT_728x90_Anchor', [[728, 90], [728, 270]], 'wvn_zone_btf728').addService(googletag.pubads());
	googletag.defineSlot('/6036473/EDIT_728x90_Top', [[728, 90], [728, 270]], 'wvn_zone_atf728').addService(googletag.pubads());
	googletag.defineSlot('/6036473/EDIT_Pushdown', [[970, 1], [970, 66], [970, 500]], 'wvn_zone_970').addService(googletag.pubads());
	googletag.defineSlot('/6036473/EDIT_Skin', [1, 1], 'wvn_zone_skin').addService(googletag.pubads());

<?php } else { ?>

googletag.cmd.push(function() {
	googletag.defineSlot('/6036473/ROS_300x250_Anchor', [[300, 250], [300, 600]], 'wvn_zone_btf300').addService(googletag.pubads());
	googletag.defineSlot('/6036473/ROS_300x250_Top', [[300, 250], [300, 600], [300, 1050]], 'wvn_zone_atf300').addService(googletag.pubads());
	googletag.defineSlot('/6036473/ROS_600x300', [600, 300], 'wvn_zone_600').addService(googletag.pubads());
	googletag.defineSlot('/6036473/ROS_728x90_Anchor', [[728, 90], [728, 270]], 'wvn_zone_btf728').addService(googletag.pubads());
	googletag.defineSlot('/6036473/ROS_728x90_Top', [[728, 90], [728, 270]], 'wvn_zone_atf728').addService(googletag.pubads());
	googletag.defineSlot('/6036473/ROS_Pushdown', [[970, 1], [970, 66], [970, 500]], 'wvn_zone_970').addService(googletag.pubads());
	googletag.defineSlot('/6036473/ROS_Skin', [1, 1], 'wvn_zone_skin').addService(googletag.pubads());

<?php } ?>

<?php 
if ( is_single() ) { 
	echo 'googletag.pubads().setTargeting("cflag", ' . esc_attr( $mature_flag ) . ');';
	
	if ( '' != $posttag_dfp ) { 
		echo 'googletag.pubads().setTargeting("post_tags", [' . $posttag_dfp . ']);';
	}
	
	if ( '' != get_post_meta($post->ID, '_campaign_name', true) ) { 
		echo 'googletag.pubads().setTargeting("campaign", "' . esc_attr( strtolower( get_post_meta($post->ID, '_campaign_name', true) ) ) . '");';
	}
}
?>
	googletag.pubads().collapseEmptyDivs();
	googletag.pubads().enableSingleRequest();
	googletag.enableServices();
});
</script>

<?php } ?>

<style type="text/css">
	.main-navigation ul { z-index: 9999 !important; }
	#wvn_branding_ad { max-width: 880px; margin: 0 auto; }
		#wvn_branding_ad #mgm-top-ad { margin: 0; }
		#wvn_branding_ad #mgm-branding { float: left; width: 110px; text-align: center; margin-right: 30px; }
	#mgm-middle-ad { background: transparent !important; padding: 10px 0 !important; }
	#wvn_skin { width: 0; height: 0; }
	#wvn_zone_atf728 { float: right; max-width: 728px; height: auto; margin: 15px auto 0; text-align: center; }
		#wvn_zone_atf728 > div > div { margin: 0 auto; }
	#wvn_zone_btf728 { min-width: 728px; width: 728px; height: auto; margin: 0 auto; text-align: center; }
	#wvn_zone_atf300 { width: 300px; margin:0 auto; }
	#wvn_zone_btf300 { width: 300px; margin:0 auto; }
	#wvn_600 { width: 600px; height: auto; margin: 10px 0 20px !important; }
	#wvn_970 { position: relative; width: 100%; height: auto; margin: 10px auto 0; background: #fff; }
		#wvn_970 #wvn_zone_970 { width: 970px; padding: 0; margin: 0 auto; height: auto; }
	.wvn_600x300_masonary { width: 600px !important; height: auto !important; }
	
	@media (max-width: 900px) {
		#wvn_branding_ad #mgm-branding { float: none; width: 110px; margin: 0 auto; }
		#wvn_600, #wvn_970, #wvn_skin { display: none !important; }
		#wvn_zone_atf728 { margin: -10px auto 20px; float: none; text-align: center; }
	}
	
	@media (max-width: 900px) {
		#wvn_zone_atf728, #wvn_atf_728, #wvn_btf_728 { display: block; min-height: 0; }
	}
	
	#mgm-loop-wrap article.post, .hentry { min-height: 200px; }
	
	body.home .td-grid-wrap { padding: 30px 13px 0; }
	
	body.home .wvn_native { }
		body.home .wvn_native p.promoted-by { font-weight: bold; }
			body.home .wvn_native p.promoted-by span { font-style: italic; }

	@media (min-width: 1200px) {
		body.home #mgm-loop-wrap article.post { width: 360px; margin-right: 30px !important; }
			body.home #mgm-loop-wrap article.post:nth-child(2n) { margin-right: 0 !important; }
			body.home #mgm-loop-wrap article.post:nth-last-child(2) { margin-right: 30px !important; }
			body.home #mgm-loop-wrap article.post:last-child { margin-right: 0 !important; }
	}
</style>