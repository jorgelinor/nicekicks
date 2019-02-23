<!--DFP Conditional SKIN Unit Switch-->

<?PHP //Write the proper DFP Init based upon category / homepage.

//Begin Editorials


if (is_single('321708')) { // BOOST MOBILE  FEB 27   ?>

<script>
		var ad_background='#000000',//Background Color
		ad_creative='http://nicekicks.com/wp-content/themes/genesis/images/skins/BM_35_Dollar_NiceKicks_Skin_V2.jpg', //Background URL
		ad_click_url='http://ad.doubleclick.net/clk;279565767;106551807;w;pc=[TPAS_ID]', //Click URL
		ad_padding_top='0',//Top Padding.
		//<![CDATA[
		ord=Math.random()*10000000000000000;
		document.write('<img src="http://ad.doubleclick.net/ad/N7443.284182.WOVENDIGITAL/B7987812.26;sz=1x1;pc=[TPAS_ID];ord=[timestamp]?"/>');
		//]]>
		document.write('<img src="http://amch.questionmarket.com/adsc/d1138764/4/1139680/adscout.php?ord=[randnum]"/>');
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

<?php }

elseif (is_single('365470')) { // INK MASTER FEB 25   ?>

<script>
		var ad_background='#000000',//Background Color
		ad_creative='http://nicekicks.com/wp-content/themes/genesis/images/skins/InkMaster_NiceKicks_Skin_Tonight.jpg', //Background URL
		ad_click_url='http://ad.doubleclick.net/clk;279450039;106442816;g', //Click URL
		ad_padding_top='0',//Top Padding.
		//<![CDATA[
		ord=Math.random()*10000000000000000;
		document.write('<img src="http://ad.doubleclick.net/ad/N1068.284182.WOVENDIGITAL/B8009845.50;sz=1x1;ord=[timestamp]?"/>');
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

<?php }


elseif (is_single('363722')) { // INK MASTER == comment these...   ?>

<script>
		var ad_background='#000000',//Background Color
		ad_creative='http://assets.wovencube.com/hosted/PUMA_Lab_NiceKicks_Skin_sw3.jpg', //Background URL
		ad_click_url='http://ad.doubleclick.net/ddm/clk/279382134;106407083;d', //Click URL
		ad_padding_top='0',//Top Padding.
		//<![CDATA[
		ord=Math.random()*10000000000000000;
		document.write('<img src="http://ad.doubleclick.net/ad/N2434.284182.WOVENDIGITAL/B8007249.106407083;sz=1x1;kw=[url_encoded_publisher_data];ord=%%CACHEBUSTER%%?"/>');
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




<?php

} else {	//Begin main switches

	if(is_front_page() || is_home()){//Homepage ?>
		<?php
		echo 
		"<!-- Homepage_Skin -->
			<DIV id='Homepage_Skin'>
				<!-- Homepage_Skin -->
				<div id='div-gpt-ad-1389144319337-6' style='width:1px; height:1px;'>
				<script type='text/javascript'>
				googletag.cmd.push(function() { googletag.display('div-gpt-ad-1389144319337-6'); });
				</script>
				</div>
			</DIV>
			";
	}


	// SPONSORED ADS
	elseif (is_category('sponsored01') || in_category('sponsored01')){ 		//Sponsored 01
		echo
			"<!-- Spons01_Skin -->
			<div id='div-gpt-ad-1393010301980-6' >
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1393010301980-6'); });
			</script>
			</div>
			";
	
		}
		
	elseif (is_category('sponsored02') || in_category('sponsored02')){	//Sponsored 02
		echo
			"<!-- Spons02_Skin -->
			<div id='div-gpt-ad-1393013102805-6' >
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1393013102805-6'); });
			</script>
			</div>
			";
	
		}
		
		
	elseif (is_category('sponsored03') || in_category('sponsored03')){	//Sponsored 03
		echo
			"<!-- Spons03_Skin -->
			<div id='div-gpt-ad-1393013374720-6' >
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1393013374720-6'); });
			</script>
			</div>

			";
	
		}
		
	elseif (is_category('sponsored04') || in_category('sponsored04')){	//Sponsored 04
		echo
			"<!-- Spons04_Skin -->
			<div id='div-gpt-ad-1393013573589-6'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1393013573589-6'); });
			</script>
			</div>

			";
	
		}
		
	elseif (is_category('sponsored05') || in_category('sponsored05')){	//Sponsored 05
		echo
			"<!-- Spons05_Skin -->
			<div id='div-gpt-ad-1393013761073-6'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1393013761073-6'); });
			</script>
			</div>

			";
	
		}
		

	elseif(is_tag('features') ||  has_tag('features')){	// Features
		echo "<!-- Features_Skin -->
		<DIV id='Features_Skin'>
			<!-- Features_Skin -->
			<div id='div-gpt-ad-1389145635354-6' style='width:1px; height:1px;'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1389145635354-6'); });
			</script>
			</div>
		</DIV>";
	}
	elseif(is_tag('video')|| has_tag('video')){		// Video
		echo "<!-- Video_Skin -->
		<DIV id='Video_Skin'>
			<!-- Video_Skin -->
			<div id='div-gpt-ad-1389145734129-6' style='width:1px; height:1px;'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1389145734129-6'); });
			</script>
			</div>
		</DIV>";
		
	}
	elseif( 'shoes' == get_post_type()  || is_page('195551') ){	// Release Dates
			echo 
		"<!-- ReleaseDates_Skin -->
			<DIV id='ReleaseDates_Skin'>
				<!-- ReleaseDates_Skin -->
				<div id='div-gpt-ad-1389145846200-6' style='width:1px; height:1px;'>
				<script type='text/javascript'>
				googletag.cmd.push(function() { googletag.display('div-gpt-ad-1389145846200-6'); });
				</script>
				</div>
			</DIV>
			";
	}

	else{ //ROS for everything else
		echo
		"<!-- ROS_Skin -->
			<DIV id='ROS_Skin'>
				<!-- ROS_Skin -->
				<div id='div-gpt-ad-1389145948202-6' style='width:1px; height:1px;'>
				<script type='text/javascript'>
				googletag.cmd.push(function() { googletag.display('div-gpt-ad-1389145948202-6'); });
				</script>
				</div>
			</DIV>
			";
	}
	
}

	?>