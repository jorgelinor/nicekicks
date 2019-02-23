<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * @package Authentic
 * @subpackage Template Parts
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

?>

<div class="alert alert-warning">
	<?php esc_html_e( 'Sorry, no results were found.', 'authentic' ); ?>
</div>

<?php get_search_form(); ?>
