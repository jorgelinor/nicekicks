<?php
/**
 * Post Format: Gallery
 *
 * @package Authentic
 * @subpackage Template Parts
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

?>
<?php $images = csco_get_field( 'csco_post_gallery' ); ?>
<?php if ( $images ) { ?>
	<div class="post-media">
	<?php $gallery_type = csco_get_field( 'csco_post_gallery_type' ); ?>

	<?php if ( 'slider' === $gallery_type ) { ?>

	<div class="gallery gallery-slider owl-container owl-simple">

	  <div class="owl-carousel">
		<?php foreach ( $images as $image ) { ?>
		  <div class="owl-slide">
			<figure>
				<?php echo wp_get_attachment_link( $image['id'], 'large', false, false, false ); ?>
			</figure>
		  </div>
		<?php } ?>
	  </div>

	  <div class="owl-dots"></div>

	</div>

	<?php } elseif ( 'justified' === $gallery_type ) { ?>

	<div class="gallery gallery-justified">
		<?php foreach ( $images as $image ) { ?>
		<figure>
			<?php echo wp_get_attachment_link( $image['id'], 'md', false, false, false ); ?>
		</figure>
		<?php } ?>
	</div>
	<?php } ?>
	</div>
<?php } ?>
