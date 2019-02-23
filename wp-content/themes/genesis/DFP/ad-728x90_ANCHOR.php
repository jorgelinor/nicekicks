<center>
<div class="woven-ad-unit ad-728x90-footer" style="margin-top:15px;margin-bottom:15px;">

<?php 

$isTakeover = false;	// Is a takeover live? Set the OR logic below.
if(($isTakeover == true)){ ?>
	<!--Takeover-->
	<!-- begin ad tag -->
	<!-- end ad tag -->

<?php } elseif (is_single('21307')) {				//Rick and Morty  ?>
	<!--Rick and Morty-->
	<!-- begin ad tag -->
	<!-- end ad tag -->


<?php } elseif (is_page('355912')) { ?>
<!-- begin ad tag -->
<script type="text/javascript">
//<![CDATA[
ord=Math.random()*10000000000000000;
document.write('<script type="text/javascript" src="http://ad.doubleclick.net/adj/wd.nerve.home/;kw=pac_takeover;sz=728x90;ord=' + ord + '?"><\/script>');
//]]>
</script>
<noscript><a href="http://ad.doubleclick.net/jump/wd.nerve.home/;kw=pac_takeover;sz=728x90;ord=123456789?" target="_blank" ><img src="http://ad.doubleclick.net/ad/wd.nerve.home/;kw=pac_takeover;sz=728x90;ord=123456789?" border="0" alt="" /></a></noscript>
<!-- end ad tag -->
	

<?php } elseif (is_single('331605') || is_single('360474') || is_single('360272')) {// Blank Out ?>
<!--Removed-->


<?php } 

elseif (is_single('365470')) { 						//Ink Master Feb 24 - blankout ?>
				
<?php } 

elseif(is_single('321708')) { 						//BOOST MOBILE FEB 27 ?>	
<script type="text/javascript" src="http://ad.doubleclick.net/N6256/adj/dimemag/;kw=homepage_takeover;sz=728x90;ord=[timestamp]?"></script>

<?php } else { //MAIN CODE BLOCK OUTSIDE PRIMARY CONDIDTIONALS ?>

	<?php

			// Restore the $wp_query to the original main query
			wp_reset_query();

			// We need to get the top-level category so we know which template to load.
		 	$get_cat = $wp_query->query['product_cat'];

		 	// The post information from the parent
		 	$post = $wp_query->post;
		 	$postID = $post->ID;

		 	// Will show the 'top' category only
		 	$category = get_the_category( $postID );
			$catName = $category[0]->cat_name;
			echo "<!-- Cat Name: ".$catName."-->";



		?>
	
	<?PHP //Write the proper DFP Init based upon category / homepage.
	
		if(is_front_page() || is_home()){//Homepage
		echo 
		"<!-- Homepage_728x90_Anchor -->
			<DIV id='Homepage_728x90_Anchor'>
				<!-- Homepage_728x90_Anchor -->
				<div id='div-gpt-ad-1389144319337-3' style='width:728px; height:90px;'>
				<script type='text/javascript'>
				googletag.cmd.push(function() { googletag.display('div-gpt-ad-1389144319337-3'); });
				</script>
				</div>
			</DIV>
			";
	}

	
	// SPONSORED ADS
	elseif (is_category('sponsored01') || in_category('sponsored01')){		//Sponsored 01
		echo
			"<!-- Spons01_728x90_Anchor -->
			<div id='div-gpt-ad-1393010301980-3'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1393010301980-3'); });
			</script>
			</div>
			";
	
		}
		
	elseif (is_category('sponsored02') || in_category('sponsored02')){		//Sponsored 02
		echo
			"<!-- Spons02_728x90_Anchor -->
			<div id='div-gpt-ad-1393013102805-3'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1393013102805-3'); });
			</script>
			</div>
			";
	
		}
		
	elseif (is_category('sponsored03') || in_category('sponsored03')){		//Sponsored 03
		echo
			"<!-- Spons03_728x90_Anchor -->
			<div id='div-gpt-ad-1393013374720-3'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1393013374720-3'); });
			</script>
			</div>

			";
	
		}
		
		
	elseif (is_category('sponsored04') || in_category('sponsored04')){		//Sponsored 04
		echo
			"<!-- Spons04_728x90_Anchor -->
			<div id='div-gpt-ad-1393013573589-3'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1393013573589-3'); });
			</script>
			</div>

			";
	
		}
		
		
	elseif (is_category('sponsored05') || in_category('sponsored05')){		//Sponsored 05
		echo
			"<!-- Spons05_728x90_Anchor -->
			<div id='div-gpt-ad-1393013761073-3'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1393013761073-3'); });
			</script>
			</div>

			";
	
		}
		
	
	elseif(is_tag('features') ||  has_tag('features')){	// Features
		echo "<!-- Features_728x90_Anchor -->
		<DIV id='Features_728x90_Anchor'>
			<!-- Features_728x90_Anchor -->
			<div id='div-gpt-ad-1389145635354-3' style='width:728px; height:90px;'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1389145635354-3'); });
			</script>
			</div>
		</DIV>";
	}
	elseif(is_tag('video')|| has_tag('video')){		// Video
		echo "<!-- Video_728x90_Anchor -->
		<DIV id='Video_728x90_Anchor'>
			<!-- Video_728x90_Anchor -->
			<div id='div-gpt-ad-1389145734129-3' style='width:728px; height:90px;'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1389145734129-3'); });
			</script>
			</div>
		</DIV>";
		
	}
	elseif( 'shoes' == get_post_type()  || is_page('195551') ){	// Release Dates
			echo 
		"<!-- ReleaseDates_728x90_Anchor -->
			<DIV id='ReleaseDates_728x90_Anchor'>
				<!-- ReleaseDates_728x90_Anchor -->
				<div id='div-gpt-ad-1389145846200-3' style='width:728px; height:90px;'>
				<script type='text/javascript'>
				googletag.cmd.push(function() { googletag.display('div-gpt-ad-1389145846200-3'); });
				</script>
				</div>
			</DIV>
			";
	}

	else{ //ROS for everything else
		echo
		"<!-- ROS_728x90_Anchor -->
			<DIV id='ROS_728x90_Anchor'>
				<!-- ROS_728x90_Anchor -->
				<div id='div-gpt-ad-1389145948202-3'>
				<script type='text/javascript'>
				googletag.cmd.push(function() { googletag.display('div-gpt-ad-1389145948202-3'); });
				</script>
				</div>
			</DIV>
			";
	}

	?>

<?PHP }  // end MAIN CODE BLOCK OUTSIDE PRIMARY CONDIDTIONALS ?>
</div>
</center>