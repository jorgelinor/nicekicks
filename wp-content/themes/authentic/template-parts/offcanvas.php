<?php
/**
 * The template part for displaying off-canvas area.
 *
 * @package Authentic
 * @subpackage Template Parts
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

?>

<div class="offcanvas-header">

	<?php do_action( 'csco_offcanvas_header_start' ); ?>

	<?php

	$logo       = get_theme_mod( 'offcanvas_logo_select', 'text' );
	$logo_url   = get_theme_mod( 'offcanvas_logo_url', get_template_directory_uri() . '/images/logo-dark.png' );
	$logo_text  = get_theme_mod( 'offcanvas_logo_text', get_bloginfo( 'name' ) );
	$border     = get_theme_mod( 'offcanvas_navbar_border', true );

	?>

	<nav class="navbar navbar-offcanvas <?php echo ( $border ) ? ' navbar-border' : ''; ?>">

		<?php if ( 'none' !== $logo ) { ?>

			<?php if ( 'image' === $logo && $logo_url ) { ?>
			<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			  <img class="logo-image" src="<?php echo esc_html( $logo_url ); ?>" alt="<?php bloginfo( 'name' );?>">
			</a>
			<?php } ?>

			<?php if ( 'text' === $logo && $logo_text ) { ?>
			<a class="navbar-brand site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php echo esc_html( $logo_text ); ?>
			</a>
			<?php } ?>

		<?php } ?>

		<button type="button" class="offcanvas-toggle navbar-toggle">
		  <i class="icon icon-cross"></i>
		</button>

	</nav>

	<?php do_action( 'csco_offcanvas_header_end' ); ?>

</div>

<div class="offcanvas">
	<aside class="sidebar-offcanvas" role="complementary">
	<?php dynamic_sidebar( 'sidebar-offcanvas' ); ?>
	</aside>
</div>

<div class="site-overlay"></div>
