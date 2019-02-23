<?php
/**
 * The template part for displaying previous / next posts.
 *
 * @package Authentic
 * @subpackage Template Parts
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

$previous_post = get_previous_post();
$next_post     = get_next_post();

if ( $previous_post || $next_post ) { ?>

<section class="posts-pagination">

	<?php if ( $previous_post ) { ?>
	<article <?php post_class( 'post-pagination post-previous' ); ?>>
		<a href="<?php echo esc_url( get_permalink( $previous_post->ID ) ); ?>" class="pagination-title"><?php esc_html_e( 'Previous Article','authentic' );?></a>
		<div class="pagination-content">
			<?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $previous_post->ID ), 'md-hor' ); ?>
			<div class="overlay" style="background-image: url(<?php echo esc_url( $thumbnail[0] ); ?>)">
				<div class="overlay-content">
					<?php csco_meta_category( 'span', false, $previous_post->ID ); ?>
					<h4><?php echo get_the_title( $previous_post->ID ); ?></h4>
					<?php csco_the_read_more( 'btn btn-primary btn-effect', 'arrow-left', get_permalink( $previous_post->ID ) ); ?>
				</div>
				<a href="<?php echo esc_url( get_permalink( $previous_post->ID ) ); ?>" class="overlay-link"></a>
			</div>
		</div>
	</article>
	<?php } ?>

	<?php if ( $next_post ) { ?>
	<article <?php post_class( 'post-pagination post-next' ); ?>>
		<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="pagination-title"><?php esc_html_e( 'Next Article','authentic' );?></a>
		<div class="pagination-content">
			<?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $next_post->ID ), 'md-hor' ); ?>
			<div class="overlay" style="background-image: url(<?php echo esc_url( $thumbnail[0] ); ?>)">
				<div class="overlay-content">
					<?php csco_meta_category( 'span', false, $next_post->ID ); ?>
					<h4><?php echo get_the_title( $next_post->ID ); ?></h4>
					<?php csco_the_read_more( 'btn btn-primary btn-effect', 'arrow-right', get_permalink( $next_post->ID ) ); ?>
				</div>
				<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="overlay-link"></a>
			</div>
		</div>
	</article>
	<?php } ?>

</section>

<?php }// End if().
