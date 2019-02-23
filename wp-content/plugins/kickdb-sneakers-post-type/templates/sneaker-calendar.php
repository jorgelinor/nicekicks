<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Authentic
 * @subpackage Templates
 * @version 1.0.0
 * @since Authentic 2.0.0
 */

get_header(); ?>


<?php /* Can't figure out how to get the slider to hide.
    * The Page -> Header Layout = None option is ignored.
		*/
?>
<style type="text/css">.section-slider { display: none; visibility: hidden; } </style>

	<div id="primary" class="content-area">

		<h1><?php
				global $wp_query;

				if ($wp_query->query_vars['kickdb_original_pagename'] === 'sneaker-release-dates') {
		      echo "Sneaker Release Dates";
		    }
		    if ($wp_query->query_vars['kickdb_original_pagename'] === 'upcoming-release-dates') {
		      echo "Upcoming Releases";
		    }
		    if ($wp_query->query_vars['kickdb_original_pagename'] === 'jordan-release-dates') {
		      echo "Jordan Release Dates";
		    }
		    if ($wp_query->query_vars['kickdb_original_pagename'] === 'past-release-dates') {
		      echo "Past Releases";
		    }

		 ?></h1>

		<?php do_action( 'csco_main_before' ); ?>

		<main id="main" class="site-main" role="main">

			<?php do_action( 'csco_main_start' ); ?>

			<?php require plugin_dir_path(__FILE__) . 'sneaker-calendar-archive-part.php'; ?>

			<?php do_action( 'csco_main_end' ); ?>

		</main>

		<?php do_action( 'csco_main_after' ); ?>

	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
