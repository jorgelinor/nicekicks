<?php
/**
* Test Template
* Template Name: Sandbox
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



<script>
		var ad_background='#000000',//Background Color
		ad_creative='http://nicekicks.com/wp-content/themes/nicekicks/images/ads/skins/PUMA_Lab_Dime-Mag_Skin.jpg', //Background URL
		ad_click_url='http://ad.doubleclick.net/ddm/clk/279382134;106406059;f', //Click URL
		ad_padding_top='0',//Top Padding.
		//<![CDATA[
		ord=Math.random()*10000000000000000;
		document.write('<img src="http://ad.doubleclick.net/ad/N2434.284182.WOVENDIGITAL/B8007249.106406059;sz=1x1;kw=[url_encoded_publisher_data];ord=[timestamp]?"/>');
		//]]>
		document.write('<style>');
		document.write('body{background:'+ad_background+' url('+ad_creative+')center top no-repeat!important; padding-top:'+ad_padding_top+'px!important;}');
		//document.write('#header, #wrap{position:relative;z-index:10;}');
		document.write('#bglink_left{margin-left:-700px;display: block;height: 100%;width: 200px;position: fixed;left: 50%;top: 0;z-index: 1000;text-indent:-5000em;}');
		document.write('#bglink_right{margin-left: 500px;display: block;height: 100%;width: 200px;position: fixed;left: 50%;top: 0;z-index: 1000;text-indent:-5000em;}');
		//document.write('#bglink_top{display: block;height: 150px;width: 100%;position: absolute;top: 0;z-index: 0;text-indent:-5000em;}');
			document.write('#container{margin-top:0px;}');
		document.write('</style>');
		//document.write('<a href="'+ad_click_url+'" target="_blank" id="bglink_top"></a>');
		document.write('<a href="'+ad_click_url+'" target="_blank" id="bglink_left"></a>');
		document.write('<a href="'+ad_click_url+'" target="_blank" id="bglink_right"></a>');
</script>

<!--Adidas -->

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

	get_footer();

?>