<?php
/**
 * The template part for displaying fullscreen site search.
 *
 * @package Authentic
 * @subpackage Template Parts
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

?>

<div class="site-search" id="search">
	<button type="button" class="close"></button>
	<div class="form-container">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 offset-lg-3">
					<?php get_search_form( true ); ?>
					<p><?php esc_html_e( 'Input your search keywords and press Enter.','authentic' ); ?></p>
				</div>
			</div>
		</div>
	</div>
</div>
