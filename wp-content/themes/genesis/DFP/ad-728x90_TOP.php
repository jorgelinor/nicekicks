<?PHP 

//ADDED SUPPORT FOR GALLERIES AND LISTICLES, 12.18.13
$galleryPostID = $_REQUEST['galleryPostID'];	// variable we'll receive from the script.js calls.

?>

<!--DFP Conditional 728x90 TOP Unit Switch-->
<center>
<div class="ad-728x90" style="margin-top:15px;margin-bottom:15px;">



<?PHP

//Logic for a request  coming from a gallery
if($galleryPostID){
	if($galleryPostID == '331605'){//Bacardi Cuba gallery post	?>
		<!-- Is Gallery -->
		<!-- begin ad tag -->

		<!-- end ad tag -->
<?php }


elseif($galleryPostID == '335112'){//MAW gallery post	?>
		<!-- Is Gallery -->
		<!-- begin ad tag -->

		<!-- end ad tag -->

<? } 






} elseif (!$galleryPostID) { // If not a gallery editorial execution ?>




<? //IS THIS IS A TAKEOVER?
$isTakeover = false; 
if (($isTakeover == true)){ ?>
<!-- Takeover 728x90 -->
<!--Seiko-->

<?php } 


elseif (is_single('321708')) { 						//BOOST MOBILE Feb 27 - blankout ?>
				
<?php } 

elseif(is_single('358859')) { 							//DraftKings ?>	

	<div id="cmn_ad_tag_head" class="fw_nicekicks" style="margin: 15px 0px;">
	<!-- begin ad tag -->
<script type="text/javascript">
//<![CDATA[
ord=Math.random()*10000000000000000;
document.write('<script type="text/javascript" src="http://ad.doubleclick.net/adj/wd.dailyfill.home/;kw=draftkingstest_nc;sz=728x90;ord=' + ord + '?"><\/script>');
//]]>
</script>
<noscript><a href="http://ad.doubleclick.net/jump/wd.dailyfill.home/;kw=draftkingstest_nc;sz=728x90;ord=123456789?" target="_blank" ><img src="http://ad.doubleclick.net/ad/wd.dailyfill.home/;kw=draftkingstest_nc;sz=728x90;ord=123456789?" border="0" alt="" /></a></noscript>
<!-- end ad tag --></div>



<?php } elseif(is_single('359936')) { 					// Draft Kings ?>	
	<!-- Draft Kings -->
	<!-- begin ad tag -->
	<script type="text/javascript">
	//<![CDATA[
	ord=Math.random()*10000000000000000;
	document.write('<script type="text/javascript" src="http://ad.doubleclick.net/adj/wd.nerve.home/;kw=draftkingstest_nc;sz=728x90;ord=' + ord + '?"><\/script>');
	//]]>
	</script>
	<noscript><a href="http://ad.doubleclick.net/jump/wd.nerve.home/;kw=draftkingstest_nc;sz=728x90;ord=123456789?" target="_blank" ><img src="http://ad.doubleclick.net/ad/wd.nerve.home/;kw=draftkingstest_nc;sz=728x90;ord=123456789?" border="0" alt="" /></a></noscript>
	<!-- end ad tag -->


<?php } elseif(is_single('360272')) { 					// Pac Sun ?>	
	<!-- Pac Sun -->
	<!-- begin ad tag -->
	<script type="text/javascript">
	//<![CDATA[
	ord=Math.random()*10000000000000000;
	document.write('<script type="text/javascript" src="http://ad.doubleclick.net/adj/wd.nerve.home/;kw=pacsun_editorial;sz=728x90;ord=' + ord + '?"><\/script>');
	//]]>
	</script>
	<noscript><a href="http://ad.doubleclick.net/jump/wd.nerve.home/;kw=pacsun_editorial;sz=728x90;ord=123456789?" target="_blank" ><img src="http://ad.doubleclick.net/ad/wd.nerve.home/;kw=pacsun_editorial;sz=728x90;ord=123456789?" border="0" alt="" /></a></noscript>
	<!-- end ad tag -->



<?php } elseif (is_single('360474')) {					//Draft Kings  ?>
	<!-- Draft Kings -->
	<!-- begin ad tag -->
	<script type="text/javascript">
	//<![CDATA[
	ord=Math.random()*10000000000000000;
	document.write('<script type="text/javascript" src="http://ad.doubleclick.net/adj/wd.nerve.home/;kw=draftkingstest_nc;sz=728x90;ord=' + ord + '?"><\/script>');
	//]]>
	</script>
	<noscript><a href="http://ad.doubleclick.net/jump/wd.nerve.home/;kw=draftkingstest_nc;sz=728x90;ord=123456789?" target="_blank" ><img src="http://ad.doubleclick.net/ad/wd.nerve.home/;kw=draftkingstest_nc;sz=728x90;ord=123456789?" border="0" alt="" /></a></noscript>
	<!-- end ad tag -->



<?php } elseif (is_single('361266')) {					//Draft Kings  ?>
	<!-- Draft Kings -->
	<!-- begin ad tag -->
	<script type="text/javascript">
	//<![CDATA[
	ord=Math.random()*10000000000000000;
	document.write('<script type="text/javascript" src="http://ad.doubleclick.net/adj/wd.nerve.home/;kw=draftkingstest_nc;sz=728x90;ord=' + ord + '?"><\/script>');
	//]]>
	</script>
	<noscript><a href="http://ad.doubleclick.net/jump/wd.nerve.home/;kw=draftkingstest_nc;sz=728x90;ord=123456789?" target="_blank" ><img src="http://ad.doubleclick.net/ad/wd.nerve.home/;kw=draftkingstest_nc;sz=728x90;ord=123456789?" border="0" alt="" /></a></noscript>
	<!-- end ad tag -->

<?php } 

elseif (is_single('365470')) { 							//Ink Master Feb 24 - Blankout ?>
				<?php }

elseif (is_single('362483')) {							//Draft Kings Feb 6  ?>
	<!-- begin ad tag -->
<script type="text/javascript">
//<![CDATA[
ord=Math.random()*10000000000000000;
document.write('<script type="text/javascript" src="http://ad.doubleclick.net/adj/wd.nerve.home/;kw=draftkingstest_nc;sz=728x90;ord=' + ord + '?"><\/script>');
//]]>
</script>
<noscript><a href="http://ad.doubleclick.net/jump/wd.nerve.home/;kw=draftkingstest_nc;sz=728x90;ord=123456789?" target="_blank" ><img src="http://ad.doubleclick.net/ad/wd.nerve.home/;kw=draftkingstest_nc;sz=728x90;ord=123456789?" border="0" alt="" /></a></noscript>
<!-- end ad tag -->
<?php }


elseif (is_single('96')) {								//Nike SB PAC SUN  ?>

<?php } elseif(is_single('324933')) { 					//Bacardi ?>	
	<!-- begin ad tag -->
	<!-- end ad tag -->

<?php } elseif(is_single( '335083' ) || is_single( '335112' )) { //MAW jan 13 2014?>	
	<!-- begin ad tag -->
<!-- end ad tag -->

<?php }  else {//if not takeover or individual post override ?>

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
		"<!-- Homepage_728x90_Top -->
			<DIV id='Homepage_728x90_Top'>
				<!-- Homepage_728x90_Top -->
				<div id='div-gpt-ad-1389144319337-4'>
				<script type='text/javascript'>
				googletag.cmd.push(function() { googletag.display('div-gpt-ad-1389144319337-4'); });
				</script>
				</div>
			</DIV>
			";
	}

	// SPONSORED ADS
	
	elseif (is_category('sponsored01') || in_category('sponsored01')){		//Sponsored01
		echo
			"<!-- Spons01_728x90_Top -->
			<div id='div-gpt-ad-1393010301980-4'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1393010301980-4'); });
			</script>
			</div>
			";
	
		}
		
	elseif (is_category('sponsored02') || in_category('sponsored02')){		//Sponsored02
		echo
			"<!-- Spons02_728x90_Top -->
			<div id='div-gpt-ad-1393013102805-4'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1393013102805-4'); });
			</script>
			</div>
			";
	
		}
		
	elseif (is_category('sponsored03') || in_category('sponsored03')){		//Sponsored03
		echo
			"<!-- Spons03_728x90_Top -->
			<div id='div-gpt-ad-1393013374720-4'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1393013374720-4'); });
			</script>
			</div>

			";
	
		}
		
		
	elseif (is_category('sponsored04') || in_category('sponsored04')){		//Sponsored04
		echo
			"<!-- Spons04_728x90_Top -->
			<div id='div-gpt-ad-1393013573589-4'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1393013573589-4'); });
			</script>
			</div>

			";
	
		}
		
		
	elseif (is_category('sponsored05') || in_category('sponsored05')){		//Sponsored05
		echo
			"<!-- Spons05_728x90_Top -->
			<div id='div-gpt-ad-1393013761073-4'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1393013761073-4'); });
			</script>
			</div>

			";
	
		}
		
		
else{
		
		
	
	if(is_tag('features') ||  has_tag('features')){	// Features
		echo "<!-- Features_728x90_Top -->
		<DIV id='Features_728x90_Top'>
			<!-- Features_728x90_Top -->
			<div id='div-gpt-ad-1389145635354-4'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1389145635354-4'); });
			</script>
			</div>
		</DIV>";
	}
	elseif(is_tag('video')|| has_tag('video')){		// Video
		echo "<!-- Video_728x90_Top -->
		<DIV id='Video_728x90_Top'>
			<!-- Video_728x90_Top -->
			<div id='div-gpt-ad-1389145734129-4'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1389145734129-4'); });
			</script>
			</div>
		</DIV>";
		
	}
	elseif( 'shoes' == get_post_type()  || is_page('195551') ){	// Release Dates
			echo 
		"<!-- ReleaseDates_728x90_Top -->
			<DIV id='ReleaseDates_728x90_Top'>
				<!-- ReleaseDates_728x90_Top -->
				<div id='div-gpt-ad-1389145846200-4'>
				<script type='text/javascript'>
				googletag.cmd.push(function() { googletag.display('div-gpt-ad-1389145846200-4'); });
				</script>
				</div>
			</DIV>
			";
	}

	else{ //ROS for everything else
		echo
		"<!-- ROS_728x90_Top -->
			<DIV id='ROS_728x90_Top'>
				<!-- ROS_728x90_Top -->
				<div id='div-gpt-ad-1389145948202-4'>
				<script type='text/javascript'>
				googletag.cmd.push(function() { googletag.display('div-gpt-ad-1389145948202-4'); });
				</script>
				</div>
			</DIV>
			";
	}

	?>
<? } ?>
<? } 
}//closing isGallery logic ?>
</div>
</center>