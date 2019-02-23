<?php
/**
 * Post Slider
 *
 * Displays post slider.
 * See all post sections at template-parts/sections/
 *
 * @package Authentic
 * @subpackage Template Parts
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

$settings        = csco_get_post_section_vars( 'slider' );
$post_meta       = get_theme_mod( 'post_meta', array( 'date', 'category', 'comments', 'reading_time', 'views', 'author' ) );

$slider_type     = $settings['slider_type'];
$thumbnail_size  = $settings['thumbnail'];

$slider_class    = 'owl-container owl-featured owl-' . $slider_type;
$slider_attr     = 'data-autoplay="' . intval( $settings['autoplay'] ) . '"';
$slider_attr    .= ' data-timeout="' . intval( $settings['timeout'] ) . '"';

$more_class      = 'btn btn-primary btn-effect';

if ( 'multiple' === $slider_type ) {
	$slider_attr  .= ' data-slides-visible="' . intval( $settings['visible'] ) . '"';
}

if ( 'large' === $slider_type ) {
	$more_class  .= ' btn-lg';
}

if ( 'center' === $slider_type || 'multiple' === $slider_type ) {
	$slider_attr  .= ' data-padding="' . intval( $settings['padding'] ) . '"';
}

$args = csco_get_post_source_query_vars( $settings );

// Add filter for the post slider query.
$the_query = new WP_Query( apply_filters( 'csco_slider_query_args', $args ) );

// Check if there're enough posts in the query.
if ( $the_query->have_posts() ) { ?>

	<?php do_action( 'csco_slider_before' ); ?>

	<section class="section-slider">
		<div class="<?php echo esc_html( $slider_class ); ?>"<?php echo $slider_attr; ?>>

			<div class="owl-carousel">
				<?php while ( $the_query->have_posts() ) : $the_query->the_post();

					$class = 'post-outer overlay';
					$attr  = '';

					if ( has_post_thumbnail() ) {

						// Enable Parallax.
						if ( $settings['parallax'] ) {
							$class .= ' slide-parallax';
						}

						$video_bg = csco_get_video_background( 'slider' );

						// Enable Video Background.
						if ( $video_bg ) {
							$class .= ' slide-video';
							$attr  .= ' data-video="' . $video_bg['url'] . '"';
							$attr  .= ' data-start="' . $video_bg['start'] . '"';
							$attr  .= ' data-end="' . $video_bg['end'] . '"';
						}

						// Add inline image background.
						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_ID(), $thumbnail_size );
						$attr  .= ' style="background-image: url(' . $thumbnail[0] . ');"';

					}	?>

					<article <?php post_class(); ?>>

						<div class="<?php echo esc_html( $class ); ?>"<?php echo $attr; ?>>
							<div class="post-inner">
								<?php csco_post_meta( 'category', $post_meta ); ?>
								<h2 class="entry-title"><?php the_title(); ?></h2>
								<?php csco_post_meta( array( 'date', 'author' ), $post_meta ); ?>
								<?php csco_the_read_more( $more_class );?>
							</div>
							<a href="<?php the_permalink(); ?>"></a>
						</div>

					</article>

				<?php endwhile; ?>
			</div>

			<div class="owl-arrows"></div>
			<div class="owl-dots"></div>

		</div>
	</section>

	<?php wp_reset_postdata(); ?>

	<?php do_action( 'csco_slider_after' ); ?>

<?php }// End if().
