<center>
	<div id="pushdown2" style="z-index: 0;">

<?php 




$isTakeover = false;	// Is a takeover live? Set the OR logic below.


if($isTakeover ==true){ ?>

<!-- Seiko -->


<?php } elseif (is_single('21307') || is_single('362483')) { ?>

<?php }
elseif (is_single('365470')) { //Ink Master Blank out FEB 24 ?>
				<?php }

elseif (is_single('321708')) { //BOOST MOBILE Feb 27?>
	<script type="text/javascript" src="http://ad.doubleclick.net/N6256/adj/dimemag/;kw=homepage_takeover;sz=970x66;ord=[timestamp]?"></script>	
<?php }

 elseif (is_single('96')) { ?>
<!--Pushdown area test -->	
<?php } else { //MAIN CODE BLOCK OUTSIDE PRIMARY CONDIDTIONALS ?> 

<!--DFP Conditional Pushdown  Unit Switch -->
<?PHP	

	if(is_front_page() || is_home()){//Homepage
		echo 
		"<!-- Homepage_Pushdown -->
			<DIV id='Homepage_Pushdown'>
				<div id='div-gpt-ad-1389144319337-5'>
				<script type='text/javascript'>
				googletag.cmd.push(function() { googletag.display('div-gpt-ad-1389144319337-5'); });
				</script>
				</div>
			</DIV>
			";
	}

	
	// SPONSORED ADS
	elseif (is_category('sponsored01') || in_category('sponsored01')){		//Sponsored 01
		echo
			"<!-- Spons01_Pushdown -->
			<div id='div-gpt-ad-1393010301980-5'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1393010301980-5'); });
			</script>
			</div>
			";
	
		}
	
	elseif (is_category('sponsored02') || in_category('sponsored02')){		//Sponsored 02
		echo
			"<!-- Spons02_Pushdown -->
			<div id='div-gpt-ad-1393013102805-5'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1393013102805-5'); });
			</script>
			</div>
			";
	
		}
		
	elseif (is_category('sponsored03') || in_category('sponsored03')){		//Sponsored 03
		echo
			"<!-- Spons03_Pushdown -->
			<div id='div-gpt-ad-1393013374720-5'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1393013374720-5'); });
			</script>
			</div>

			";
	
		}
		
	elseif (is_category('sponsored04') || in_category('sponsored04')){		//Sponsored 04
		echo
			"<!-- Spons04_Pushdown -->
			<div id='div-gpt-ad-1393013573589-5'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1393013573589-5'); });
			</script>
			</div>

			";
	
		}
		
	elseif (is_category('sponsored05') || in_category('sponsored05')){		//Sponsored 05
		echo
			"<!-- Spons05_Pushdown -->
			<div id='div-gpt-ad-1393013761073-5'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1393013761073-5'); });
			</script>
			</div>

			";
	
		}
	
	
	
	 //Write the proper DFP Init based upon category / homepage.
		
	elseif(is_tag('features') ||  has_tag('features')){	// Features
		echo "<!-- Features_Pushdown -->
		<DIV id='Features_Pushdown'>
			<div id='div-gpt-ad-1389145635354-5'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1389145635354-5'); });
			</script>
			</div>
		</DIV>";
	}
	elseif(is_tag('video')|| has_tag('video')){		// Video
		echo "<!-- Video_Pushdown -->
		<DIV id='Video_Pushdown'>
			<div id='div-gpt-ad-1389145734129-5'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1389145734129-5'); });
			</script>
			</div>
		</DIV>";
		
	}
	elseif( 'shoes' == get_post_type()  || is_page('195551') ){	// Release Dates
			echo 
		"<!-- ReleaseDates_Pushdown -->
			<DIV id='ReleaseDates_Pushdown'>
				<div id='div-gpt-ad-1389145846200-5'>
				<script type='text/javascript'>
				googletag.cmd.push(function() { googletag.display('div-gpt-ad-1389145846200-5'); });
				</script>
				</div>
			</DIV>
			";
	}
	elseif (is_single('363247')) {
		echo '';
 }
	else{ //ROS for everything else
		echo
		"<!-- ROS_Pushdown -->
			<DIV id='ROS_Pushdown'>
				<div id='div-gpt-ad-1389145948202-5'>
				<script type='text/javascript'>
				googletag.cmd.push(function() { googletag.display('div-gpt-ad-1389145948202-5'); });
				</script>
				</div>
			</DIV>
			";
	}

	?>



<?php } ?>

</div>
</center>