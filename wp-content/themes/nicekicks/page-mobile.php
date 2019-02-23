<?php
/**
* Test Template
* Template Name: Mobile Test
* 
*
* 
*/


do_action( 'genesis_doctype' );
do_action( 'genesis_title' );
do_action( 'genesis_meta' );

wp_head(); //* we need this for plugins
?>

<style>

body.page-template-page-sandbox-php
{
padding-left: 0px;
}


</style>


<style>/*
    .mainHeader { padding:0px 0 0!important;}
    .container{margin-top: 0px!important;}*/
</style>
<!--end Adidas Takeover Lite -->

</head>
<?php
genesis_markup( array(
	'html5'   => '<body %s>',
	'xhtml'   => sprintf( '<body class="%s">', implode( ' ', get_body_class() ) ),
	'context' => 'body',
) );
do_action( 'genesis_before' );

genesis_markup( array(
	'html5'   => '<div %s>',
	'xhtml'   => '<div id="wrap">',
	'context' => 'site-container',
) );

do_action( 'genesis_before_header' );
do_action( 'genesis_header' );
do_action( 'genesis_after_header' );

genesis_markup( array(
	'html5'   => '<div %s>',
	'xhtml'   => '<div id="inner">',
	'context' => 'site-inner',
) );
genesis_structural_wrap( 'site-inner' );

	do_action( 'genesis_before_content_sidebar_wrap' );
	genesis_markup( array(
		'html5'   => '<div %s>',
		'xhtml'   => '<div id="content-sidebar-wrap">',
		'context' => 'content-sidebar-wrap',
	) );

		do_action( 'genesis_before_content' );
		genesis_markup( array(
			'html5'   => '<main %s>',
			'xhtml'   => '<div id="content" class="hfeed">',
			'context' => 'content',
		) );
			do_action( 'genesis_before_loop' );
		
		
		genesis_standard_loop();
	

		
		
			do_action( 'genesis_after_loop' );
		genesis_markup( array(
			'html5' => '</main>', //* end .content
			'xhtml' => '</div>', //* end #content
		) );
		do_action( 'genesis_after_content' );

	echo '</div>'; //* end .content-sidebar-wrap or #content-sidebar-wrap
	do_action( 'genesis_after_content_sidebar_wrap' );

?>
<div class="celtra-ad-v3"> <img src="data:image/png,celtra" style="display: none" onerror=" (function(img) { var params = {'placementId':'8cb47dde','clickUrl':'%%CLICK_URL_UNESC%%','clickEvent':'advertiser','externalAdServer':'DFPPremium'}; var req = document.createElement('script'); req.id = params.scriptId = 'celtra-script-' + (window.celtraScriptIndex = (window.celtraScriptIndex||0)+1); params.clientTimestamp = new Date/1000; req.src = (window.location.protocol == 'https:' ? 'https' : 'http') + '://ads.celtra.com/7797cb4c/web.js?'; for (var k in params) { req.src += '&amp;' + encodeURIComponent(k) + '=' + encodeURIComponent(params[k]); } img.parentNode.insertBefore(req, img.nextSibling); })(this); "/> </div>
<?php

	get_footer();

?>