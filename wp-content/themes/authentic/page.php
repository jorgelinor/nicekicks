<?php
/**
 * The template for displaying all single pages.
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

			<?php while ( have_posts() ) : the_post(); ?>

				<?php do_action( 'csco_page_before' ); ?>

				<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php do_action( 'csco_page_start' ); ?>

					<div class="page-wrap">

						<?php do_action( 'csco_page_main_before' ); ?>

						<div class="page-main">

							<?php do_action( 'csco_page_content_before' ); ?>

							<div class="content entry-content">

								<?php the_content(); ?>

							</div>

							<?php do_action( 'csco_page_content_after' ); ?>

						</div><!-- .page-main -->

						<?php do_action( 'csco_page_main_after' ); ?>

					</div><!-- .page-wrap -->

					<?php do_action( 'csco_page_end' ); ?>

				</article>

				<?php do_action( 'csco_page_after' ); ?>

			<?php

			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			endwhile; ?>

			<?php do_action( 'csco_main_end' ); ?>

		</main>

		<?php do_action( 'csco_main_after' ); ?>

	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
