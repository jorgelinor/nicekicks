<?php
/**
 * The Template for displaying all single posts.
 *
 * @package MightyMag
 * @since MightyMag 1.0
 */

get_header(); 

$mgm_full_width = get_post_meta(get_the_ID(), 'mgm_full_width_switch', true); ?>

<div class="row">
	
	<div id="primary" class="content-area <?php if ($mgm_full_width) { echo 'col-md-12'; } else { echo 'col-md-8'; } ?>">
		<div id="content" class="site-content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
		
			<?php mgm_set_post_views(get_the_ID()); //Get Post Views ?>

			<?php // mgm_content_nav( 'nav-above' ); //uncomment this if you want to display the upper navigation ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php // Load Facebook or WP Comments
			$mgm_comment_type = get_post_meta(get_the_ID(), 'mgm_comment_type', true);
			
			$url = (!empty($_SERVER['HTTPS'])) ? "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] : "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
			?>
			
			<?php if ($mgm_comment_type == 'fb') { ?>
					
				<div class="fb-comments" data-width="100%" data-href="<?php echo $url; ?>" data-num-posts="4"></div>
				
			<?php } elseif ($mgm_comment_type == 'none') { 
				
						echo '';
			
				  } else {
				
					if ( comments_open() || '0' != get_comments_number() )
					comments_template( '', true );
				  }
			?>

		<?php endwhile; // end of the loop. ?>

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->
	
	<?php if (!$mgm_full_width) { ?>
	<div class="col-md-4"><?php get_sidebar(); ?></div>
	<?php } ?>
	
</div><!-- .row (single)-->
<?php get_footer(); ?>