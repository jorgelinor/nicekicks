<!--DFP Conditional 600x300  Unit Switch -->
<div class="woven-ad-unit ad-600-300">
<?php
$takeover = false;

if ($takeover == true) { ?>

<?php }
else
{ 

	if (is_single('365470')) { //Ink Master Feb 24 ?>
		<script type="text/javascript" src="http://ad.doubleclick.net/N6256/adj/nicekicks/;kw=ink_voting2_editoria_nk;sz=600x300;ord=[timestamp]?"></script>		
		<?php }

	elseif (is_single('321708')) { //BOOST MOBILE Blank out Feb 27 ?>
		<?php }


// Write the proper DFP Init based upon category / homepage.
	else
	{

	if(is_front_page() || is_home()) { //Homepage
		echo 
		"<!-- Homepage_600x300 -->
			<div id='div-gpt-ad-1389144319337-2' style='width:600px; height:300px;'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1389144319337-2'); });
			</script>
			</div>
			";
	}


	// SPONSORED ADS
	elseif (is_category('sponsored01') || in_category('sponsored01')){
		echo
			"<!-- Spons01_600x300 -->
			<div id='div-gpt-ad-1393010301980-2'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1393010301980-2'); });
			</script>
			</div>
			";
	
		}
	
		elseif (is_category('sponsored02') || in_category('sponsored02')){ 		// SPONSORED02
			echo
			"<!-- Spons02_600x300 -->
			<div id='div-gpt-ad-1393006248609-2'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1393006248609-2'); });
			</script>
			</div>
			";
	
		}
		
		elseif (is_category('sponsored03') || in_category('sponsored03')){ 		// SPONSORED03
			echo
			"<!-- Spons03_600x300 -->
			<div id='div-gpt-ad-1393013374720-2' >
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1393013374720-2'); });
			</script>
			</div>

			";
	
		}
		
		elseif (is_category('sponsored04') || in_category('sponsored04')){ 		// SPONSORED04
			echo
			"<!-- Spons04_600x300 -->
			<div id='div-gpt-ad-1393013573589-2'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1393013573589-2'); });
			</script>
			</div>

			";
	
		}
		
		elseif (is_category('sponsored05') || in_category('sponsored05')){ 		// SPONSORED05
			echo
			"<!-- Spons05_600x300 -->
			<div id='div-gpt-ad-1393013761073-2'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1393013761073-2'); });
			</script>
			</div>

		";
	
		}
	
	elseif(is_tag('features') ||  has_tag('features')){	// Features
		echo "<!-- Features_600x300 -->
			<div id='div-gpt-ad-1389145635354-2' style='width:600px; height:300px;'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1389145635354-2'); });
			</script>
			</div>";
	}
	elseif(is_tag('video')|| has_tag('video')){		// Video
		echo "<!-- Video_600x300 -->
			<div id='div-gpt-ad-1389145734129-2' style='width:600px; height:300px;'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1389145734129-2'); });
			</script>
			</div>";
		
	}
	elseif( 'shoes' == get_post_type()  || is_page('195551') ){	// Release Dates
			echo 
			"<!-- ReleaseDates_600x300 -->
			<div id='div-gpt-ad-1389145846200-2' style='width:600px; height:300px;'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1389145846200-2'); });
			</script>
			</div>";
	}
	 
	else{ //ROS for everything else
		echo
		"<!-- ROS_600x300 -->
			<DIV id='ROS_600x300'>
				<div id='div-gpt-ad-1381294357256-2' style='width:600px; height:300px;'>
				<script type='text/javascript'>
				googletag.cmd.push(function() { googletag.display('div-gpt-ad-1381294357256-2'); });
				</script>
				</div>
			</DIV>
			";
	}

}
}
?>
</div>