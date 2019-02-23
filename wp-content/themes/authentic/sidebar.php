<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package Authentic
 * @subpackage Templates
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

$sidebar = apply_filters( 'csco_sidebar', 'sidebar-main' );

if ( is_active_sidebar( $sidebar ) && 'layout-fullwidth' !== csco_get_page_layout() ) { ?>

	<aside id="secondary" class="sidebar-area widget-area" role="complementary">

		<?php do_action( 'csco_sidebar_before' ); ?>

		<div class="sidebar">
			<?php do_action( 'csco_sidebar_start' ); ?>
			<?php dynamic_sidebar( $sidebar ); ?>
			<?php do_action( 'csco_sidebar_end' ); ?>
		</div><!-- .sidebar -->

		<?php do_action( 'csco_sidebar_after' ); ?>

	</aside><!-- .sidebar-area .widget-area -->

<?php }
