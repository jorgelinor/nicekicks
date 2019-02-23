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

<style type="text/css">
.sneaker-release {
	margin-bottom: 2rem;
}
.sneaker__title {
	font-size: 1.1rem;
}
.sneaker__release_date {
	margin: 1rem 0 0.5rem;
}
.post-thumbnail img {
	max-height: 320px;
	width: auto;
}
.post-thumbnail {
	height: 320px;
	display: flex;
	justify-content: center;
	align-items: center;
}

.sneaker__vital {
	font-size: 0.8rem;
}
.sneaker__price {
	font-size: 1rem;
}
.sneaker__value {
}
</style>

<article <?php post_class( $post_class ); ?>>

	<div class="sneaker-release <?php echo esc_html( $class ); ?>"<?php echo $attr; ?>>

		<?php if ( has_post_thumbnail() && 'standard' !== $archive && ! $featured ) { ?>
			<div class="<?php echo esc_html( $media_class ); ?>">
				<div class="post-thumbnail">
					<?php the_post_thumbnail( $csco_query['thumbnail_size'] ); ?>
				  <a href="<?php the_permalink();?>"></a>
				</div>
			</div>
		<?php } ?>

		<div class="<?php echo esc_html( $content_class ); ?>">
			<header class="entry-header">
				<div class="sneaker__vital">
						<h4 class="sneaker__release_date">
							<a href="<?php the_permalink();?>">
				        <?php
				          $release_date_type = get_field('release_date_type');
									$release_date = DateTime::createFromFormat('Y-m-d', get_field('calendar_release_date'));
									$show_release_year = date("Y") !== $release_date->format("Y");
				          if ($release_date_type === 'Calendar Date') {
				            $format_out = $show_release_year ? 'F j, Y' : 'F j';
				            echo $release_date->format($format_out);
				          }
				        ?>
							</a>
						</h4>
		    </div>

		    <div class="sneaker__title">
		      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		    </div>
			</header>
		</div>

    <div>
      <?php
        if (get_field('price')) {
          ?>
            <div class="sneaker__vital sneaker__price">
              <span class="sneaker__value">$<?php the_field('price'); ?></span>
            </div>
          <?php
        }
      ?>
    </div>

		<?php if ( $featured ) { ?>
			<a href="<?php the_permalink();?>"></a>
		<?php } ?>

	</div>

</article>
