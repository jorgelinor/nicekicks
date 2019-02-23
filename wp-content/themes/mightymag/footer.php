<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package MightyMag
 * @since MightyMag 1.0
 */
?>
				</div><!-- .content-sidebar-wrap -->
			</div><!-- #main .site-main -->
			
			<div id="mgm-footer-wrap" class="mgm-gray-frame">

				<div id="mgm-bottom-ad">
					<?php
						/** WOVEN **/
						if ( function_exists('woven_render_adunit') ) {
							woven_render_adunit( 'btf', 728 );
						}
					?>
				</div>
	
				<div id="mgm-full-footer">
				
					<footer class="container" id="widgetized-footer">
						
						<div class="row">
							
							<div class="col-md-4 footer-item wow fadeInUp">
								<?php
								if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer1')): 
								endif;
								?>
							</div>
							
							<div class="col-md-4 footer-item wow fadeInUp" data-wow-delay="0.2s">
								<?php
								if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer2')): 
								endif;
								?>
							</div>	
							
							<div class="col-md-4 footer-item wow fadeInUp" data-wow-delay="0.4s">
								<?php
								if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer3')): 
								endif;
								?>
							</div>
						
						</div><!--row-->		
					</footer><!--.container-->
				</div><!-- #mgm-full-footer -->
					
				<div id="mgm-full-site-info">	
					<div id="colophon" class="site-footer container" role="contentinfo">
						<div class="site-info row">
							
							<div class="col-md-12">
							
								<?php if ( of_get_option('mgm_footer_logo') != NULL ) { ?>
								<div id="footer-logo" class="wow flipInX" data-wow-delay="0.5s">
									<img src="<?php echo of_get_option('mgm_footer_logo') ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
								</div>
								<?php } ?>
								
								<div class="utilities footer">
									<?php wp_nav_menu( array( 'theme_location' => 'footer', 'container_class' => 'footer-menu', 'depth' => 1 ) ); ?>
								</div>
							
								<p><?php echo of_get_option('mgm_credits') ?></p>
							</div>
							
						</div><!-- .site-info -->
					</div><!-- #colophon .site-footer -->
				</div>
			</div><!--#mgm-footer-wrap-->
					
		</div><!-- #page .hfeed .site -->
		
		<?php if ( of_get_option('mgm_scrollup') AND !of_get_option('mgm_stickynav') ) {
			 echo '<span class="scrollup"><span class="glyphicon glyphicon-chevron-up"></span></span>'; 
		} ?>
		
		
		</div><!-- .container.supermain -->
		
		
	<?php wp_footer(); ?>

	<?php
		/** WOVEN **/
		/** Native Unit only on Home Page **/
		if ( is_home() && function_exists('woven_render_adunit') ) {
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			if ( 1 == $paged ) {
				woven_render_adunit( 'atf', 2 );
			}
		}
	?>
	
	</div><!-- #mgm-super-container -->
</body>
</html>