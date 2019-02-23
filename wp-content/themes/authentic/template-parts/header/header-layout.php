<?php
/**
 * Main Header Layout
 * Have a look at framework/hooks/actions to see what is hooked into the header
 * See all header parts at template-parts/header/
 *
 * @package Authentic
 * @subpackage Template Parts
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

$layout      = get_theme_mod( 'header_layout', 'center' );
$container   = get_theme_mod( 'header_container', 'container' );
$logo        = get_theme_mod( 'header_logo_select', 'text' );
$text        = get_theme_mod( 'header_logo_text', get_bloginfo( 'name' ) );
$description = get_theme_mod( 'header_description_text' );

if ( 'large' === csco_get_page_header_type() ) {
	$logo_url  = get_theme_mod( 'header_logo_overlay_url', get_template_directory_uri() . '/images/logo-light.png' );
} else {
	$logo_url  = get_theme_mod( 'header_logo_default_url', get_template_directory_uri() . '/images/logo-dark.png' );
}

?>

<div class="header header-<?php echo esc_html( $layout ); ?> hidden-md-down">
	<div class="<?php echo esc_html( $container ); ?>">

		<?php if ( 'center' === $layout ) { ?>
			<div class="header-col">
				<div>
					<?php csco_get_header_content( 'header_content_left', 'button' ); ?>
				</div>
			</div>
		<?php } ?>

		<div class="header-col">
			<div>

				<?php if ( 'image' === $logo && $logo_url ) { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo">
					<img class="logo-image" src="<?php echo esc_html( $logo_url ); ?>" alt="<?php bloginfo( 'name' ); ?>">
				</a>
				<?php } ?>

				<?php if ( 'text' === $logo && $text ) { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-title"><?php echo esc_html( $text ); ?></a>
				<?php	} ?>

				<?php if ( $description ) { ?>
				<p class="site-description"><?php echo wp_kses_post( $description ); ?></p>
				<?php	} ?>

			</div>
		</div>

		<?php if ( 'center' === $layout || 'left' === $layout ) { ?>
			<div class="header-col">
				<div>
					<?php csco_get_header_content( 'header_content_right', 'search' ); ?>
				</div>
			</div>
		<?php } ?>

	</div>
</div>
