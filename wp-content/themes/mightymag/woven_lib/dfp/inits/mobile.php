<?php
/**
 * Woven DFP - Mobile
 * Author:  Jerry Thompson
 * Date:	7/21/14
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
	googletag.defineSlot('/6036473/Mobile_1x1', [1, 1], 'wvn_zone_mobile_skin').addService(googletag.pubads());
	googletag.defineSlot('/6036473/Mobile_320x50', [320, 50], 'wvn_zone_mobile_320').addService(googletag.pubads());
	googletag.defineSlot('/6036473/Mobile_300x250_1', [300, 250], 'wvn_zone_mobile_300_1').addService(googletag.pubads());
	googletag.defineSlot('/6036473/Mobile_300x250_2', [300, 250], 'wvn_zone_mobile_300_2').addService(googletag.pubads());
	googletag.defineSlot('/6036473/Mobile_300x250_3', [300, 250], 'wvn_zone_mobile_300_3').addService(googletag.pubads());
	googletag.defineSlot('/6036473/Mobile_300x250_4', [300, 250], 'wvn_zone_mobile_300_4').addService(googletag.pubads());
	googletag.defineSlot('/6036473/Mobile_Homepage_Native', [2, 2], 'wvn_zone_native').addService(googletag.pubads());
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
	googletag.defineSlot('/6036473/Mobile_1x1', [1, 1], 'wvn_zone_mobile_skin').addService(googletag.pubads());
	googletag.defineSlot('/6036473/Mobile_320x50', [320, 50], 'wvn_zone_mobile_320').addService(googletag.pubads());
	googletag.defineSlot('/6036473/Mobile_300x250_1', [300, 250], 'wvn_zone_mobile_300_1').addService(googletag.pubads());
	googletag.defineSlot('/6036473/Mobile_300x250_2', [300, 250], 'wvn_zone_mobile_300_2').addService(googletag.pubads());
	googletag.defineSlot('/6036473/Mobile_300x250_3', [300, 250], 'wvn_zone_mobile_300_3').addService(googletag.pubads());
	googletag.defineSlot('/6036473/Mobile_300x250_4', [300, 250], 'wvn_zone_mobile_300_4').addService(googletag.pubads());

<?php } else { ?>

googletag.cmd.push(function() {
	googletag.defineSlot('/6036473/Mobile_1x1', [1, 1], 'wvn_zone_mobile_skin').addService(googletag.pubads());
	googletag.defineSlot('/6036473/Mobile_320x50', [320, 50], 'wvn_zone_mobile_320').addService(googletag.pubads());
	googletag.defineSlot('/6036473/Mobile_300x250_1', [300, 250], 'wvn_zone_mobile_300_1').addService(googletag.pubads());
	googletag.defineSlot('/6036473/Mobile_300x250_2', [300, 250], 'wvn_zone_mobile_300_2').addService(googletag.pubads());
	googletag.defineSlot('/6036473/Mobile_300x250_3', [300, 250], 'wvn_zone_mobile_300_3').addService(googletag.pubads());
	googletag.defineSlot('/6036473/Mobile_300x250_4', [300, 250], 'wvn_zone_mobile_300_4').addService(googletag.pubads());

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
	/* Smartphones (portrait and landscape) ----------- */
	.td-grid-wrap { padding-top: 5px; }
	#wvn_mobile_skin { width: 0; height: 0; }
	#wvn_mobile_300_1, #wvn_mobile_300_2, #wvn_mobile_300_3, #wvn_mobile_300_4 { width: 300px; margin: 10px auto 10px; }
	#wvn_mobile_atf_320 { width: 320px; margin: 5px auto; }
	
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