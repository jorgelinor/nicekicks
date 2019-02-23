<!-- DFP INIT NICEKICKS -->
<?php
	//Write the proper DFP Init based upon category / homepage.
	
	if(is_front_page() || is_home()){									//Homepage
		echo "<!-- DFP Homepage INIT -->
		<script type='text/javascript'>
googletag.cmd.push(function() {
googletag.defineSlot('/6036473/Homepage_300x250_Anchor', [[300, 250], [300, 600]], 'div-gpt-ad-1389144319337-0').addService(googletag.pubads());
googletag.defineSlot('/6036473/Homepage_300x250_Top', [[300, 250], [300, 600], [300, 1050]], 'div-gpt-ad-1389144319337-1').addService(googletag.pubads());
googletag.defineSlot('/6036473/Homepage_600x300', [600, 300], 'div-gpt-ad-1389144319337-2').addService(googletag.pubads());
googletag.defineSlot('/6036473/Homepage_728x90_Anchor', [728, 90], 'div-gpt-ad-1389144319337-3').addService(googletag.pubads());
googletag.defineSlot('/6036473/Homepage_728x90_Top', [[728, 90], [728, 270]], 'div-gpt-ad-1389144319337-4').addService(googletag.pubads());
googletag.defineSlot('/6036473/Homepage_Pushdown', [[970, 1], [970, 66], [970, 500]], 'div-gpt-ad-1389144319337-5').addService(googletag.pubads());
googletag.defineSlot('/6036473/Homepage_Skin', [1, 1], 'div-gpt-ad-1389144319337-6').addService(googletag.pubads());
googletag.pubads().collapseEmptyDivs();
googletag.enableServices();
});
</script>
";
	}
	
	elseif(is_category('sponsored01') ||  in_category('sponsored01')){				// SPONSORED 01
		echo "<!-- DFP SPONSORED01 INIT -->
		<script type='text/javascript'>
		googletag.cmd.push(function() {
		googletag.defineSlot('/6036473/Spons01_300x250_Anchor', [300, 250], 'div-gpt-ad-1393010301980-0').addService(googletag.pubads());
		googletag.defineSlot('/6036473/Spons01_300x250_Top', [[300, 250], [300, 600]], 'div-gpt-ad-1393010301980-1').addService(googletag.pubads());
		googletag.defineSlot('/6036473/Spons01_600x300', [600, 300], 'div-gpt-ad-1393010301980-2').addService(googletag.pubads());
		googletag.defineSlot('/6036473/Spons01_728x90_Anchor', [728, 90], 'div-gpt-ad-1393010301980-3').addService(googletag.pubads());
		googletag.defineSlot('/6036473/Spons01_728x90_Top', [728, 90], 'div-gpt-ad-1393010301980-4').addService(googletag.pubads());
		googletag.defineSlot('/6036473/Spons01_Pushdown', [[970, 1], [970, 66], [970, 500]], 'div-gpt-ad-1393010301980-5').addService(googletag.pubads());
		googletag.defineSlot('/6036473/Spons01_Skin', [1, 1], 'div-gpt-ad-1393010301980-6').addService(googletag.pubads());
		googletag.pubads().collapseEmptyDivs();
googletag.enableServices();
		});
		</script>
		";
	}
	
	elseif(is_category('sponsored02') ||  in_category('sponsored02')){				// SPONSORED 02
		echo "<!-- DFP SPONSORED01 INIT -->
			<script type='text/javascript'>
			googletag.cmd.push(function() {
			googletag.defineSlot('/6036473/Spons02_300x250_Anchor', [300, 250], 'div-gpt-ad-1393013102805-0').addService(googletag.pubads());
			googletag.defineSlot('/6036473/Spons02_300x250_Top', [[300, 250], [300, 600]], 'div-gpt-ad-1393013102805-1').addService(googletag.pubads());
			googletag.defineSlot('/6036473/Spons02_600x300', [600, 300], 'div-gpt-ad-1393013102805-2').addService(googletag.pubads());
			googletag.defineSlot('/6036473/Spons02_728x90_Anchor', [728, 90], 'div-gpt-ad-1393013102805-3').addService(googletag.pubads());
			googletag.defineSlot('/6036473/Spons02_728x90_Top', [728, 90], 'div-gpt-ad-1393013102805-4').addService(googletag.pubads());
			googletag.defineSlot('/6036473/Spons02_Pushdown', [[970, 1], [970, 66], [970, 500]], 'div-gpt-ad-1393013102805-5').addService(googletag.pubads());
			googletag.defineSlot('/6036473/Spons02_Skin', [1, 1], 'div-gpt-ad-1393013102805-6').addService(googletag.pubads());
			googletag.pubads().collapseEmptyDivs();
googletag.enableServices();
			});
			</script>";
	}
	
	elseif(is_category('sponsored03') ||  in_category('sponsored03')){				// SPONSORED 03
		echo "<!-- DFP SPONSORED03 INIT -->
		<script type='text/javascript'>
		googletag.cmd.push(function() {
		googletag.defineSlot('/6036473/Spons03_300x250_Anchor', [300, 250], 'div-gpt-ad-1393013374720-0').addService(googletag.pubads());
		googletag.defineSlot('/6036473/Spons03_300x250_Top', [[300, 250], [300, 600]], 'div-gpt-ad-1393013374720-1').addService(googletag.pubads());
		googletag.defineSlot('/6036473/Spons03_600x300', [600, 300], 'div-gpt-ad-1393013374720-2').addService(googletag.pubads());
		googletag.defineSlot('/6036473/Spons03_728x90_Anchor', [728, 90], 'div-gpt-ad-1393013374720-3').addService(googletag.pubads());
		googletag.defineSlot('/6036473/Spons03_728x90_Top', [728, 90], 'div-gpt-ad-1393013374720-4').addService(googletag.pubads());
		googletag.defineSlot('/6036473/Spons03_Pushdown', [[970, 1], [970, 66], [970, 500]], 'div-gpt-ad-1393013374720-5').addService(googletag.pubads());
		googletag.defineSlot('/6036473/Spons03_Skin', [1, 1], 'div-gpt-ad-1393013374720-6').addService(googletag.pubads());
		googletag.pubads().collapseEmptyDivs();
googletag.enableServices();
		});
		</script>";
	}
	
	elseif(is_category('sponsored04') ||  in_category('sponsored04')){				// SPONSORED 04
		echo "<!-- DFP SPONSORED04 INIT -->
			<script type='text/javascript'>
		googletag.cmd.push(function() {
		googletag.defineSlot('/6036473/Spons04_300x250_Anchor', [300, 250], 'div-gpt-ad-1393013573589-0').addService(googletag.pubads());
		googletag.defineSlot('/6036473/Spons04_300x250_Top', [[300, 250], [300, 600]], 'div-gpt-ad-1393013573589-1').addService(googletag.pubads());
		googletag.defineSlot('/6036473/Spons04_600x300', [600, 300], 'div-gpt-ad-1393013573589-2').addService(googletag.pubads());
		googletag.defineSlot('/6036473/Spons04_728x90_Anchor', [728, 90], 'div-gpt-ad-1393013573589-3').addService(googletag.pubads());
		googletag.defineSlot('/6036473/Spons04_728x90_Top', [728, 90], 'div-gpt-ad-1393013573589-4').addService(googletag.pubads());
		googletag.defineSlot('/6036473/Spons04_Pushdown', [[970, 1], [970, 66], [970, 500]], 'div-gpt-ad-1393013573589-5').addService(googletag.pubads());
		googletag.defineSlot('/6036473/Spons04_Skin', [1, 1], 'div-gpt-ad-1393013573589-6').addService(googletag.pubads());
		googletag.pubads().collapseEmptyDivs();
googletag.enableServices();
		});
		</script>";
	}
	
	elseif(is_category('sponsored05') ||  in_category('sponsored05')){				// SPONSORED 05
		echo "<!-- DFP SPONSORED05 INIT -->
			<script type='text/javascript'>
			googletag.cmd.push(function() {
			googletag.defineSlot('/6036473/Spons05_300x250_Anchor', [300, 250], 'div-gpt-ad-1393013761073-0').addService(googletag.pubads());
			googletag.defineSlot('/6036473/Spons05_300x250_Top', [[300, 250], [300, 600]], 'div-gpt-ad-1393013761073-1').addService(googletag.pubads());
			googletag.defineSlot('/6036473/Spons05_600x300', [600, 300], 'div-gpt-ad-1393013761073-2').addService(googletag.pubads());
			googletag.defineSlot('/6036473/Spons05_728x90_Anchor', [728, 90], 'div-gpt-ad-1393013761073-3').addService(googletag.pubads());
			googletag.defineSlot('/6036473/Spons05_728x90_Top', [728, 90], 'div-gpt-ad-1393013761073-4').addService(googletag.pubads());
			googletag.defineSlot('/6036473/Spons05_Pushdown', [[970, 1], [970, 66], [970, 500]], 'div-gpt-ad-1393013761073-5').addService(googletag.pubads());
			googletag.defineSlot('/6036473/Spons05_Skin', [1, 1], 'div-gpt-ad-1393013761073-6').addService(googletag.pubads());
			googletag.pubads().collapseEmptyDivs();
googletag.enableServices();
			});
			</script>";
	}
	
	
	

	elseif(is_tag('features') ||  has_tag('features')){			// Features
		echo "<!-- DFP ALCOHOL INIT -->
		<!-- DFP UNIT INITIALIZE @ FEATURES -->
<script type='text/javascript'>
googletag.cmd.push(function() {
googletag.defineSlot('/6036473/Features_300x250_Anchor', [[300, 250], [300, 600], [300, 1050]], 'div-gpt-ad-1389145635354-0').addService(googletag.pubads());
googletag.defineSlot('/6036473/Features_300x250_Top', [[300, 250], [300, 600], [300, 1050]], 'div-gpt-ad-1389145635354-1').addService(googletag.pubads());
googletag.defineSlot('/6036473/Features_600x300', [600, 300], 'div-gpt-ad-1389145635354-2').addService(googletag.pubads());
googletag.defineSlot('/6036473/Features_728x90_Anchor', [728, 90], 'div-gpt-ad-1389145635354-3').addService(googletag.pubads());
googletag.defineSlot('/6036473/Features_728x90_Top', [[728, 90], [728, 270]], 'div-gpt-ad-1389145635354-4').addService(googletag.pubads());
googletag.defineSlot('/6036473/Features_Pushdown', [[970, 1], [970, 66], [970, 500]], 'div-gpt-ad-1389145635354-5').addService(googletag.pubads());
googletag.defineSlot('/6036473/Features_Skin', [1, 1], 'div-gpt-ad-1389145635354-6').addService(googletag.pubads());
googletag.pubads().collapseEmptyDivs();
googletag.enableServices();
});
</script>
		";
	}

	elseif ( 'shoes' == get_post_type()  || is_page('195551') ) {
		echo "<!-- DFP RELEASE DATES INIT -->
		<!-- DFP UNIT INITIALIZE @ RELEASE DATES\FEATURES -->
<script type='text/javascript'>
googletag.cmd.push(function() {
googletag.defineSlot('/6036473/ReleaseDates_300x250_Anchor', [[300, 250], [300, 600]], 'div-gpt-ad-1389145846200-0').addService(googletag.pubads());
googletag.defineSlot('/6036473/ReleaseDates_300x250_Top', [[300, 250], [300, 600], [300, 1050]], 'div-gpt-ad-1389145846200-1').addService(googletag.pubads());
googletag.defineSlot('/6036473/ReleaseDates_600x300', [600, 300], 'div-gpt-ad-1389145846200-2').addService(googletag.pubads());
googletag.defineSlot('/6036473/ReleaseDates_728x90_Anchor', [728, 90], 'div-gpt-ad-1389145846200-3').addService(googletag.pubads());
googletag.defineSlot('/6036473/ReleaseDates_728x90_Top', [[728, 90], [728, 270]], 'div-gpt-ad-1389145846200-4').addService(googletag.pubads());
googletag.defineSlot('/6036473/ReleaseDates_Pushdown', [[970, 1], [970, 66], [970, 500]], 'div-gpt-ad-1389145846200-5').addService(googletag.pubads());
googletag.defineSlot('/6036473/ReleaseDates_Skin', [1, 1], 'div-gpt-ad-1389145846200-6').addService(googletag.pubads());
googletag.pubads().collapseEmptyDivs();
googletag.enableServices();
});
</script>
		";
		}

	elseif(is_tag('video')|| has_tag('video')){ // Video
		echo "<!-- DFP TV INIT -->
		<!-- DFP UNIT INITIALIZE @ Video -->
<script type='text/javascript'>
googletag.cmd.push(function() {
googletag.defineSlot('/6036473/Video_300x250_Anchor', [[300, 250], [300, 600]], 'div-gpt-ad-1389145734129-0').addService(googletag.pubads());
googletag.defineSlot('/6036473/Video_300x250_Top', [[300, 250], [300, 600], [300, 1050]], 'div-gpt-ad-1389145734129-1').addService(googletag.pubads());
googletag.defineSlot('/6036473/Video_600x300', [600, 300], 'div-gpt-ad-1389145734129-2').addService(googletag.pubads());
googletag.defineSlot('/6036473/Video_728x90_Anchor', [728, 90], 'div-gpt-ad-1389145734129-3').addService(googletag.pubads());
googletag.defineSlot('/6036473/Video_728x90_Top', [[728, 90], [728, 270]], 'div-gpt-ad-1389145734129-4').addService(googletag.pubads());
googletag.defineSlot('/6036473/Video_Pushdown', [[970, 1], [970, 66], [970, 500]], 'div-gpt-ad-1389145734129-5').addService(googletag.pubads());
googletag.defineSlot('/6036473/Video_Skin', [1, 1], 'div-gpt-ad-1389145734129-6').addService(googletag.pubads());
googletag.pubads().collapseEmptyDivs();
googletag.enableServices();
});
</script>
		";
		}
	else { //ROS for everything else

		echo "<!-- DFP ROS INIT -->
		<!-- DFP UNIT INITIALIZE @ Other ROS -->
<script type='text/javascript'>
googletag.cmd.push(function() {
googletag.defineSlot('/6036473/ROS_300x250_Anchor', [[300, 250], [300, 600]], 'div-gpt-ad-1389145948202-0').addService(googletag.pubads());
googletag.defineSlot('/6036473/ROS_300x250_Top', [[300, 250], [300, 600], [300, 1050]], 'div-gpt-ad-1389145948202-1').addService(googletag.pubads());
googletag.defineSlot('/6036473/ROS_600x300', [600, 300], 'div-gpt-ad-1389145948202-2').addService(googletag.pubads());
googletag.defineSlot('/6036473/ROS_728x90_Anchor', [[728, 90], [728, 270]], 'div-gpt-ad-1389145948202-3').addService(googletag.pubads());
googletag.defineSlot('/6036473/ROS_728x90_Top', [[728, 90], [728, 270]], 'div-gpt-ad-1389145948202-4').addService(googletag.pubads());
googletag.defineSlot('/6036473/ROS_Pushdown', [[970, 1], [970, 66], [970, 500]], 'div-gpt-ad-1389145948202-5').addService(googletag.pubads());
googletag.defineSlot('/6036473/ROS_Skin', [1, 1], 'div-gpt-ad-1389145948202-6').addService(googletag.pubads());
googletag.pubads().collapseEmptyDivs();
googletag.enableServices();
});
</script>
		";
		}

?>	

