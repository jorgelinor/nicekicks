<?php
/**
 * The template for displaying comments
 *
 * @package Authentic
 * @subpackage Templates
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

if ( post_password_required() ) {
	return;
}
?>

<?php do_action( 'csco_comments_before' ); ?>



<?php do_action( 'csco_comments_after' ); ?>
