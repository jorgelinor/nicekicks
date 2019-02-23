<?php
/**
 * Widget Area Footer Component.
 *
 * @package Authentic
 * @subpackage Footer Components
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

?>

<div class="footer-section">
	<div class="container">
		<div class="footer-widgets">
		  <div class="footer-sidebars">

			<?php if ( is_active_sidebar( 'sidebar-footer' ) ) { ?>
				<div class="sidebar-footer">
					<?php dynamic_sidebar( 'sidebar-footer' ); ?>
				</div>
			<?php } ?>

			<?php if ( is_active_sidebar( 'sidebar-footer-2' ) ) { ?>
				<div class="sidebar-footer">
					<?php dynamic_sidebar( 'sidebar-footer-2' ); ?>
				</div>
			<?php } ?>

			<?php if ( is_active_sidebar( 'sidebar-footer-3' ) ) { ?>
				<div class="sidebar-footer">
					<?php dynamic_sidebar( 'sidebar-footer-3' ); ?>
				</div>
			<?php } ?>

		  </div><!-- .footer-sidebars -->
		</div><!-- .footer-widgets -->
	</div><!-- .container -->
</div><!-- .footer-section -->
