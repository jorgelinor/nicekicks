<?php
/**
 * The template for displaying search form.
 *
 * @package Authentic
 * @subpackage Templates
 * @version 1.0.0
 * @since Authentic 2.0.0
 */

?>

<form role="search" method="get" class="search-form form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="sr-only"><?php esc_html_e( 'Search for:', 'authentic' ); ?></label>
	<div class="input-group">
		<input type="search" value="<?php the_search_query(); ?>" name="s" class="search-field form-control" placeholder="<?php esc_html_e( 'Enter Keyword', 'authentic' ); ?>" required>
		<span class="input-group-btn">
			<button type="submit" class="search-submit btn btn-primary btn-effect"><span><?php esc_html_e( 'Search', 'authentic' ); ?></span><span><i class="icon icon-search"></i></span></button>
		</span>
	</div>
</form>
