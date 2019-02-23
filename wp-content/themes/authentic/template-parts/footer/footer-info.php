<?php
/**
 * Info Footer Component.
 *
 * @package Authentic
 * @subpackage Footer Components
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

$logo        = get_theme_mod( 'footer_logo_select', 'text' );
$text        = get_theme_mod( 'footer_logo_text', get_bloginfo( 'name' ) );
$logo_url    = get_theme_mod( 'footer_logo_url', get_template_directory_uri() . '/images/logo-light.png' );

$footer_text = get_theme_mod( 'footer_text', get_bloginfo( 'description' ) );

?>

<div class="footer-section">
	<div class="container">
		<div class="footer-info">

			<?php if ( 'image' === $logo && $logo_url ) { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
				<img class="logo-image" src="<?php echo esc_html( $logo_url ); ?>" alt="<?php bloginfo( 'name' ); ?>">
			</a>
			<?php } ?>

			<?php if ( 'text' === $logo && $text ) { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-title"><?php echo esc_html( $text ); ?></a>
			<?php	} ?>

			<?php
			if ( has_nav_menu( 'footer-menu' ) ) {
				wp_nav_menu( array(
					'theme_location'    => 'footer-menu',
					'menu_class'        => 'nav navbar-nav',
					'container'         => 'nav',
					'container_class'   => 'nav navbar-footer navbar-lonely',
					'depth'             => 1,
				));
			}
			?>

			<?php if ( $footer_text ) { ?>
				<div class="footer-copyright"><?php echo wp_kses_post( $footer_text ); ?></div>
			<?php } ?>

		</div><!-- .footer-info -->
	</div><!-- .container -->
</div><!-- .footer-section -->
