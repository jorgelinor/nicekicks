<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package MightyMag
 * @since MightyMag 1.0
 */

get_header();

$blog_sidebar = of_get_option('mgm_blog_sidebar', true);

?>

<?php if ( of_get_option('tabs_activate')) { get_template_part( 'partials/part', 'tabs' ); } // Get Home Tabs if enabled ?>

<div class="row">
		
		<div id="primary" class="content-area col-md-<?php if ( $blog_sidebar ) { echo '8';} else { echo '12';}?>">
			<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>
				
				<div id="mgm-loop-wrap">
				
				<?php /* Start the Loop */ ?>
				<?php $count = 1; ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php 
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>
					
					<?php
						if ( 6 == $count ) {
							if ( function_exists('woven_render_adunit') ) {
								if ( 'desktop' == woven_platform_detect() || 'tablet' == woven_platform_detect() ) {
									woven_render_adunit( 'btf', 600 );
								}
							}
						}
						$count++;
					?>
					
				<?php endwhile; ?>

				</div><!-- #mgm-loop-wrap-->		

				<?php mgm_num_pagination(); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'index' ); ?>

			<?php endif; ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->
		
	<?php 	
	if ($blog_sidebar) { ?>
	
	<div class="col-md-4"><?php get_sidebar(); ?></div>
	
	<?php } ?>

</div><!--row-->

<?php get_footer(); ?>