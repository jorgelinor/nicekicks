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
			<!-- Tag ID: nicekicks_300x250_300x600_160x600_Right -->
			<div align="center" id="nicekicks_300x250_300x600_160x600_Right">
			<script data-cfasync="false" type="text/javascript">
			    freestar.queue.push(function () { googletag.display('nicekicks_300x250_300x600_160x600_Right'); });
			</script>
			</div>
			<?php dynamic_sidebar( $sidebar ); ?>
			<?php do_action( 'csco_sidebar_end' ); ?>
		</div><!-- .sidebar -->

		<?php do_action( 'csco_sidebar_after' ); ?>

	</aside><!-- .sidebar-area .widget-area -->

<?php }
