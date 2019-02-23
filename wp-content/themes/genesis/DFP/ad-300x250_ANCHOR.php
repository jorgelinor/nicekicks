

<?php 

//ADDED SUPPORT FOR GALLERIES AND LISTICLES, 12.18.13
$galleryPostID = $_REQUEST['galleryPostID'];	// variable we'll receive from the script.js calls.

//if a request is coming from a gallery
if($galleryPostID){

	if($galleryPostID == '331605'){//Bacardi Cuba gallery post	?>
		<!-- Is Gallery -->
		<!-- begin ad tag -->
		<script type="text/javascript">
		//<![CDATA[
		ord=Math.random()*10000000000000000;
		document.write('<script type="text/javascript" src="http://ad.doubleclick.net/adj/wd.guyism.home/;kw=bacardi_editorial_flags;sz=300x250;ord=' + ord + '?"><\/script>');
		//]]>
		</script>
		<noscript><a href="http://ad.doubleclick.net/jump/wd.guyism.home/;kw=bacardi_editorial_flags;sz=300x250;ord=123456789?" target="_blank" ><img src="http://ad.doubleclick.net/ad/wd.guyism.home/;kw=bacardi_editorial_flags;sz=300x250;ord=123456789?" border="0" alt="" /></a></noscript>
		<!-- end ad tag -->
<? } 


elseif($galleryPostID == '335112'){//MAW gallery post	?>
		<!-- Is Gallery -->
		<!-- begin ad tag -->
		<script type="text/javascript">
			//<![CDATA[
		ord=Math.random()*10000000000000000;
		document.write('<script type="text/javascript" src="http://ad.doubleclick.net/adj/wd.guyism.home/;kw=maw_editorials;sz=300x250;ord=' + ord + '?"><\/script>');
			//]]>
		</script>
		<noscript><a href="http://ad.doubleclick.net/jump/wd.guyism.home/;kw=maw_editorials;sz=300x250;ord=123456789?" target="_blank" ><img src="http://ad.doubleclick.net/ad/wd.guyism.home/;kw=maw_editorials;sz=300x250;ord=123456789?" border="0" alt="" /></a></noscript>
<!-- end ad tag -->
<? } 





 } else { // If there's no specific inbound GALLERY EDITORIAL placement, move on to the below.


$isTakeover = false;	// Is a takeover live? Set the OR logic below.

if (($isTakeover == true)){ ?>
		

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
	
		<!--DFP Conditional 300x250 TOP Unit Switch-->

<?php 
		
		if (is_category('Sponsored01') || in_category('Sponsored01')){		//SPONSORED01
		echo
			"<!-- Spons01_300x250_Anchor -->
			<div id='div-gpt-ad-1393010301980-0'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1393010301980-0'); });
			</script>
			</div>
			";
	
		}
		
		if (is_category('Sponsored02') || in_category('Sponsored02')){		//SPONSORED02
		echo
			"<!-- Spons02_300x250_Anchor -->
			<div id='div-gpt-ad-1393013102805-0'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1393013102805-0'); });
			</script>
			</div>
			";
	
		}
		
		if (is_category('Sponsored03') || in_category('Sponsored03')){		//SPONSORED03
		echo
			"<!-- Spons03_300x250_Anchor -->
			<div id='div-gpt-ad-1393013374720-0'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1393013374720-0'); });
			</script>
			</div>

			";
	
		}
		
		if (is_category('Sponsored04') || in_category('Sponsored04')){		//SPONSORED04
		echo
			"<!-- Spons04_300x250_Anchor -->
			<div id='div-gpt-ad-1393013573589-0' >
				<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1393013573589-0'); });
			</script>
			</div>

			";
	
		}
		
		if (is_category('Sponsored05') || in_category('Sponsored05')){		//SPONSORED05
		echo
			"<!-- Spons05_300x250_Anchor -->
			<div id='div-gpt-ad-1393013761073-0'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1393013761073-0'); });
			</script>
			</div>

			";
	
		}
		
		//Write the proper DFP Init based upon category / homepage.
		elseif(is_home()){													//Homepage
			echo 
			"<!-- Homepage_300x250_Top -->
				<DIV id='Homepage_300x250_Top'>
					<div id='div-gpt-ad-1381293038859-1'>
					<script type='text/javascript'>
					googletag.cmd.push(function() { googletag.display('div-gpt-ad-1381293038859-1'); });
					</script>
					</div>
				</DIV>
				";
		}

		elseif (is_category('alcohol') || in_category('alcohol')){			//ALCOHOL
			echo "<!-- Alcohol_300x250_Top -->
			<DIV id='Alcohol_300x250_Top'>
				<div id='div-gpt-ad-1381293369797-1'>
				<script type='text/javascript'>
				googletag.cmd.push(function() { googletag.display('div-gpt-ad-1381293369797-1'); });
				</script>
				</div>
			</DIV>";

		}
		elseif(is_category('humor') || in_category('humor')){				//HUMOR
			echo "<!-- Humor_300x250_Top -->
			<DIV id='Humor_300x250_Top'>
				<div id='div-gpt-ad-1381293940517-1'>
				<script type='text/javascript'>
				googletag.cmd.push(function() { googletag.display('div-gpt-ad-1381293940517-1'); });
				</script>
				</div>
			</DIV>";

		}

		elseif(is_category('music') || in_category('music')){				//MUSIC
				echo 
			"<!-- Music_300x250_Top -->
				<DIV id='Music_300x250_Top'>
					<div id='div-gpt-ad-1381293778657-1'>
					<script type='text/javascript'>
					googletag.cmd.push(function() { googletag.display('div-gpt-ad-1381293778657-1'); });
					</script>
					</div>
				</DIV>";
			
		}
		elseif(is_category('sports') || in_category('sports')){//Homepage
			echo 
			"<!-- Sports_300x250_Top -->
				<DIV id='Sports_300x250_Top'>
					<div id='div-gpt-ad-1381294089780-1'>
					<script type='text/javascript'>
					googletag.cmd.push(function() { googletag.display('div-gpt-ad-1381294089780-1'); });
					</script>
					</div>
				</DIV>
				";

		}
		elseif(is_category('tv') || in_category('tv')){
			echo 
			"<!-- TV_300x250_Top -->
				<DIV id='TV_300x250_Top'>
					<div id='div-gpt-ad-1381294232238-1'>
					<script type='text/javascript'>
					googletag.cmd.push(function() { googletag.display('div-gpt-ad-1381294232238-1'); });
					</script>
					</div>
				</DIV>
				";


		}
		

		//ROS
		else{ //ROS for everything else
			echo
			"<!-- ROS_300x250_Top -->
				<DIV id='ROS_300x250_Top'>
					<div id='div-gpt-ad-1381294357256-1'>
					<script type='text/javascript'>
					googletag.cmd.push(function() { googletag.display('div-gpt-ad-1381294357256-1'); });
					</script>
					</div>
				</DIV>
				";

		}
	//end DFP 300x250 TOP unit switch
	
	?>	

<? } ?>
<? } // closing bracket for if $galleryPostID ?>

