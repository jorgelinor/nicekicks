<?php
/**
 * Post Format: Image
 *
 * @package Authentic
 * @subpackage Template Parts
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

if ( is_single() ) {
	if ( has_post_format( 'image' ) ) {
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>
		<div class="post-media">
			<figure>
				<a href="<?php echo esc_url( $thumb[0] );?>">
					<?php the_post_thumbnail( 'large' ); ?>
				</a>
			</figure>
		</div>
	<?php
	}
} else { ?>
	<div class="post-media">
		<a href="<?php the_permalink();?>">
			<?php the_post_thumbnail( 'large' ); ?>
		</a>
	</div>
<?php }
