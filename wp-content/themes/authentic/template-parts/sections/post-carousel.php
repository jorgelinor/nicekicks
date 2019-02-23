<?php
/**
 * Post Carousel
 *
 * Displays post carousel.
 * See all post sections at template-parts/sections/
 *
 * @package Authentic
 * @subpackage Template Parts
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

$settings        = csco_get_post_section_vars( 'carousel' );
$post_meta       = get_theme_mod( 'post_meta', array( 'date', 'category', 'comments', 'reading_time', 'views', 'author' ) );

$title           = $settings['title'];
$columns         = $settings['columns'];
$thumbnail_size  = $settings['thumbnail'];
$padding         = $settings['padding'];

$args = csco_get_post_source_query_vars( $settings );

// Add filter for the query.
$the_query = new WP_Query( apply_filters( 'csco_carousel_query_args', $args ) );

// Check if there're posts in the query.
if ( $the_query->have_posts() ) { ?>

	<?php do_action( 'csco_carousel_before' ); ?>

	<section class="section-carousel">
		<div class="<?php echo esc_html( $settings['container'] );?>">

			<?php if ( $title ) { ?>
				<h3 class="title-block"><?php echo esc_html( $title ); ?></h3>
			<?php } ?>

			<div class="owl-container owl-loop" data-columns="<?php echo intval( $columns ); ?>" data-padding="<?php echo intval( $padding ); ?>">
				<div class="owl-carousel">
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<article <?php post_class(); ?>>
							<div class="post-thumbnail">
								<?php the_post_thumbnail( $thumbnail_size ); ?>
								<?php csco_the_read_more( 'btn-link', null ); ?>
								<?php
								if ( '6' !== $columns ) {
									csco_post_meta( array( 'reading_time', 'views' ), $post_meta, true );
								} ?>
							  <a href="<?php the_permalink();?>"></a>
							</div>
							<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
							<?php csco_post_meta( array( 'date', 'author' ), $post_meta ); ?>
						</article>
					<?php endwhile; ?>
				</div>
				<div class="owl-dots"></div>
			</div>

			<?php wp_reset_postdata(); ?>
		</div>
	</section>

	<?php do_action( 'csco_carousel_after' ); ?>

<?php }// End if().
