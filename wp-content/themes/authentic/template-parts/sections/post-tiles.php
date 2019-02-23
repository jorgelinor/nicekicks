<?php
/**
 * Post Tiles
 *
 * Displays post tiles.
 * See all post sections at template-parts/sections/
 *
 * @package Authentic
 * @subpackage Template Parts
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

$settings = csco_get_post_section_vars( 'tiles' );

$post_meta = get_theme_mod( 'post_meta', array( 'date', 'category', 'comments', 'reading_time', 'views', 'author' ) );

$args = csco_get_post_source_query_vars( $settings );

// Add filter for the query.
$the_query = new WP_Query( apply_filters( 'csco_tiles_query_args', $args ) );

// Check if there're enough posts in the query.
if ( $the_query->have_posts() ) { ?>

	<?php do_action( 'csco_tiles_before' ); ?>

	<section class="section-tiles tiles-<?php echo esc_html( $settings['layout'] );?>">
		<div class="<?php echo esc_html( $settings['container'] );?>">
			<div class="tiles-outer">

				<?php while ( $the_query->have_posts() ) : $the_query->the_post();

					$class      = '';
					$post_class = '';
					$attr       = '';

					$video_bg = csco_get_video_background( 'tiles' );

					// Enable Video Background.
					if ( $video_bg ) {
						$class .= ' parallax-video';
						$attr  .= ' data-video="' . $video_bg['url'] . '"';
						$attr  .= ' data-start="' . $video_bg['start'] . '"';
						$attr  .= ' data-end="' . $video_bg['end'] . '"';
					}

					// Enable Parallax.
					if ( $settings['parallax'] ) {
						$class .= ' parallax';
					}

					$current = $the_query->current_post + 1;

					if ( in_array( $settings['layout'], array( '1', '2', '9' ), true ) || 1 === $current ) {
						$thumbnail_size = 'lg-sq';
						$post_class = 'tile-primary';
					} else {
						$thumbnail_size = 'md-sq';
						$post_class = 'tile-secondary';
					}

					if ( has_post_thumbnail() ) {
						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_ID(), $thumbnail_size );
						$attr  .= ' style="background-image: url(' . $thumbnail[0] . ');"';
					}

					if ( has_post_thumbnail() ) {
						$class .= ' overlay';
					}

					?>

					<article <?php post_class( $post_class ); ?>>

						<div class="post-outer<?php echo esc_html( $class ); ?>"<?php echo $attr; ?>>

							<div class="post-inner">
								<h2 class="entry-title"><?php the_title();?></h2>
								<?php csco_post_meta( array( 'date', 'author' ), $post_meta ); ?>
							</div>

							<a href="<?php the_permalink(); ?>"></a>

						</div>

					</article>

				<?php endwhile; ?>
			</div>

			<?php wp_reset_postdata(); ?>
		</div>
	</section>

	<?php do_action( 'csco_tiles_after' ); ?>

<?php }// End if().
