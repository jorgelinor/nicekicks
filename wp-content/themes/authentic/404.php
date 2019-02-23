<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Authentic
 * @subpackage Templates
 * @version 1.0.0
 * @since Authentic 2.0.0
 */

get_header(); ?>

	<div id="primary" class="content-area">

		<?php do_action( 'csco_main_before' ); ?>

		<main id="main" class="site-main" role="main">

			<?php do_action( 'csco_main_start' ); ?>

				<section class="error-404 not-found">

					<?php do_action( 'csco_page_start' ); ?>

					<div class="page-wrap">

						<?php do_action( 'csco_page_main_before' ); ?>

						<div class="page-main">

							<?php do_action( 'csco_page_content_before' ); ?>

							<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'authentic' ); ?></p>

							<?php get_search_form(); ?>

							<?php do_action( 'csco_page_content_after' ); ?>

						</div><!-- .page-main -->

						<?php do_action( 'csco_page_main_after' ); ?>

					</div><!-- .page-wrap -->

					<?php do_action( 'csco_page_end' ); ?>

				</section>

			<?php do_action( 'csco_main_end' ); ?>

		</main>

		<?php do_action( 'csco_main_after' ); ?>

	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
