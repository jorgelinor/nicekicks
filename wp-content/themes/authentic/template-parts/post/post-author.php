<?php
/**
 * The template part for displaying post author section.
 *
 * @package Authentic
 * @subpackage Template Parts
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

$coauthors = array();
$class     = '';
$layout    = get_theme_mod( 'post_author_type', 'default' );

if ( function_exists( 'get_coauthors' ) ) {
	$coauthors   = get_coauthors();
	if ( count( $coauthors ) > 1 && 'default' === $layout ) {
		$layout .= ' row';
		$class   = 'col-md-' . ceil( 12 / count( $coauthors ) );
	}
}

?>

<?php do_action( 'csco_author_before' ); ?>

<section class="post-author">

	<div class="authors-<?php echo esc_html( $layout ); ?>">

	<?php
	if ( $coauthors ) {

		foreach ( $coauthors as $author ) {

			if ( isset( $author->type ) && 'guest-author' === $author->type ) {

				// Get guest author details.
				csco_post_coauthor( $author, $class );

			} else {

				// Get registered user details.
				csco_post_author( $author->ID, $class );

			}
		}
	} else {

		// Get the default WP author details.
		csco_post_author();

	} ?>

	</div>

</section>

<?php do_action( 'csco_author_after' ); ?>
