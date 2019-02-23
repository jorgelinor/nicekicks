<?php
/**
 * Instagram Footer Component.
 *
 * @package Authentic
 * @subpackage Footer Components
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

$instagram_username = get_theme_mod( 'footer_instagram_username' );

?>

<div class="footer-instagram">

	<?php

	$args = array(
		'username' => esc_html( $instagram_username ),
		'size' => 'small',
		'number' => apply_filters( 'csco_instagram_footer_number', 6 ),
		'target' => '_blank',
		'link' => '',
	);

	if ( function_exists( 'wpiw_widget' ) ) {
		the_widget( 'null_instagram_widget', $args );
	}

	?>

</div>
