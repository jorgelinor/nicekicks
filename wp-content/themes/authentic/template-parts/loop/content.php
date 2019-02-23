<?php
/**
 * The template part for post content in post archives.
 *
 * @package Authentic
 * @subpackage Template Parts
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

$archive       = $csco_query['archive_type'];
$post_class    = 'post-' . $archive;
$media_class   = 'post-inner';
$content_class = 'post-inner';
$class         = 'post-outer';
$more_class    = 'btn btn-primary btn-effect';
$attr          = '';
$featured      = false;

$post_meta    = array( 'date', 'author', 'comments' );

// Set the first post to standard.
if ( $csco_query['show_first'] && 0 === $wp_query->current_post ) {
	$archive    = 'standard';
	$post_class = 'post-standard';
}

// Set Read More button class for standard posts.
if ( 'standard' === $archive ) {
	$more_class .= ' btn-lg';
}

// Check if the post is featured.
if ( has_term( 'archive', 'csco_post_featured' ) ) {
	$featured    = true;
}

// Add column classes to list archives.
if ( ! $featured && 'list' === $archive ) {
	$media_class   .= ' col-md-' . $csco_query['thumbnail_width'];
	$content_class .= ' col-md-' . ( 12 - $csco_query['thumbnail_width'] );
}

// Add classes and attributes to featured posts.
if ( $featured ) {

	$post_class  = 'post-featured';
	$class      .= ' parallax overlay ratio';

	$post_meta   = array( 'reading_time', 'views' );

	$video_bg    = csco_get_video_background( 'archive' );

	if ( $video_bg ) {
		$class .= ' parallax-video';
		$attr  .= ' data-video="' . $video_bg['url'] . '"';
		$attr  .= ' data-start="' . $video_bg['start'] . '"';
		$attr  .= ' data-end="' . $video_bg['end'] . '"';
	}

	if ( 'list' === $archive || 'standard' === $archive ) {

		$class     .= ' ratio-horizontal';
		$thumbnail  = 'lg-hor';

	} elseif ( 'masonry' === $archive || 'grid' === $archive ) {

		$class     .= ' ratio-vertical';
		$thumbnail  = 'lg-ver';

	}

	$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_ID(), $thumbnail );
	$attr     .= ' style="background-image: url(' . $thumbnail[0] . ');"';

}

?>

<article <?php post_class( $post_class ); ?>>

	<div class="<?php echo esc_html( $class ); ?>"<?php echo $attr; ?>>

		<?php if ( has_post_thumbnail() && 'standard' !== $archive && ! $featured ) { ?>
			<div class="<?php echo esc_html( $media_class ); ?>">
				<div class="post-thumbnail">
					<?php the_post_thumbnail( $csco_query['thumbnail_size'] ); ?>
					<?php csco_the_read_more( 'btn-link', null ); ?>
					<?php csco_post_meta( array( 'reading_time', 'views' ), $csco_meta, true ); ?>
				  <a href="<?php the_permalink();?>"></a>
				</div>
			</div>
		<?php } ?>

		<div class="<?php echo esc_html( $content_class ); ?>">

			<header class="entry-header">
				<?php csco_post_meta( 'category', $csco_meta ); ?>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<?php csco_post_meta( $post_meta, $csco_meta ); ?>
			</header>

			<?php
			if ( 'standard' === $archive && ! $featured && 'content' !== $csco_query['summary_type'] ) {
				// Get Post Media.
				csco_get_post_media_template();
			} ?>

			<?php
			if ( ! $featured ) {
				// Get full post content for standard posts.
				if ( 'standard' === $archive && 'content' === $csco_query['summary_type'] ) { ?>

					<div class="entry-content content">

						<?php

						// Check if more buttons should be displayed.
						if ( $csco_query['more_button'] ) {
							$more = csco_read_more( $more_class );
						} else {
							$more = '';
						}

						// Return the content.
						the_content( $more );

						?>

					</div>

				<?php
				// Get excerpt for all other posts.
				} else {
					the_excerpt();
				}
			}

			// Display share buttons.
			if ( function_exists( 'bsb_display_shares' ) && get_option( 'bsb_post-loop_display_share_buttons' ) ) { ?>
				<div class="post-share">
					<span class="title-share"><?php esc_html_e( 'Share', 'authentic' ); ?> <i class="icon icon-arrow-right"></i></span>
					<?php bsb_display_shares( 'post-loop' ); ?>
				</div>
			<?php } ?>

		</div>

		<?php if ( $featured ) { ?>
			<a href="<?php the_permalink();?>"></a>
		<?php } ?>

	</div>

</article>
