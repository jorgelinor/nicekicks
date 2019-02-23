<?php
/**
 * The template part for displaying WP Instagam Widget loop.
 *
 * Used by WP Instagram Widget plugin.
 *
 * @package Authentic
 * @subpackage Template Parts
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

?>

<li class="<?php echo esc_attr( $liclass ); ?>">
	<div class="overlay overlay-static overlay-zoom">
		<img src="<?php echo esc_url( $item[ $size ] ); ?>" class="<?php echo esc_attr( $imgclass ); ?>" alt="<?php echo esc_html( $item['description'] ); ?>"/>
		<div>
			<span class="instagram-meta">
			  <span class="instagram-likes"><i class="icon icon-heart"></i> <?php echo intval( $item['likes'] ); ?></span>
			  <span class="instagram-comments"><i class="icon icon-speech-bubble"></i> <?php echo intval( $item['comments'] ); ?></span>
			</span>
		</div>
		<a href="<?php echo esc_url( $item['link'] ); ?>" target="<?php echo esc_attr( $target ); ?>"  class="<?php echo esc_attr( $aclass ); ?>"></a>
	</div>
</li>

<?php
