<?php
/**
 * Primary Navigation Bar
 * Have a look at framework/hooks/actions to see what is hooked into the header
 * See all header parts at template-parts/header/
 *
 * @package Authentic
 * @subpackage Template Parts
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

// Get navbar settings.
$container        = get_theme_mod( 'navbar_container', 'container' );
$alignment        = get_theme_mod( 'navbar_alignment', 'center' );
$toggle           = get_theme_mod( 'navbar_toggle', true );
$search           = get_theme_mod( 'navbar_search', false );
$social           = get_theme_mod( 'navbar_social', false );
$cart             = get_theme_mod( 'navbar_cart', false );
$logo             = get_theme_mod( 'navbar_logo_select', 'text' );
$logo_text        = get_theme_mod( 'navbar_logo_text', get_bloginfo( 'name' ) );
$logo_default_url = get_theme_mod( 'navbar_logo_default_url', get_template_directory_uri() . '/images/logo-dark.png' );
$logo_overlay_url = get_theme_mod( 'navbar_logo_overlay_url', get_template_directory_uri() . '/images/logo-light.png' );

// Add alignment class.
$class   = 'navbar-' . $alignment;

// Add search class.
if ( ! $search ) {
	$class .= ' search-disabled';
}

// Add social class.
if ( ! $social ) {
	$class .= ' social-disabled';
}

// Add toggle class.
if ( ! $toggle ) {
	$class .= ' toggle-disabled';
}

?>

<div class="navbar-primary <?php echo esc_html( $class ); ?>">
	<div class="<?php echo esc_html( $container ); ?>">
		<nav class="navbar">

			<div class="navbar-col">
				<div>

					<button class="navbar-toggle offcanvas-toggle" type="button">
						<i class="icon icon-menu"></i>
					</button>

					<?php
					// Logo.
					if ( 'image' === $logo && $logo_default_url ) { ?>
						<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<img class="logo-image" src="<?php echo esc_html( $logo_default_url ); ?>" alt="<?php bloginfo( 'name' ); ?>">
							<?php if ( 'large' === csco_get_page_header_type() && $logo_overlay_url ) { ?>
								<img class="logo-image logo-overlay" src="<?php echo esc_html( $logo_overlay_url ); ?>" alt="<?php bloginfo( 'name' ); ?>">
							<?php } ?>
						</a>
					<?php } ?>

					<?php
					// Text Logo.
					if ( 'text' === $logo && $logo_text ) { ?>
						<a class="navbar-brand site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php echo esc_html( $logo_text ); ?>
						</a>
					<?php } ?>

				</div>
			</div>

			<?php
			// Primary Menu
			if ( has_nav_menu( 'primary-menu' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'primary-menu',
					'menu_class' => 'nav navbar-nav',
					'container' => '',
					'container_class' => '',
					'depth' => 3,
				));
			} ?>

			<div class="navbar-col">
				<div>

					<?php
					// Social Accounts.
					if ( $social && function_exists( 'bsa_get_accounts' ) ) {

						$labels = get_theme_mod( 'navbar_social_accounts_labels', false );
						$titles = get_theme_mod( 'navbar_social_accounts_titles', false );
						$counts = get_theme_mod( 'navbar_social_accounts_counts', true );
						$limit  = get_theme_mod( 'navbar_social_accounts_limit', 3 );

						bsa_get_accounts( $labels, $titles, $counts, 'nav hidden-md-down', $limit );

					}
					?>

					<?php
					// Cart.
					if ( $cart && class_exists( 'woocommerce' ) ) {
						?>

						<a class="header-cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_html_e( 'View your shopping cart', 'authentic' ); ?>">
							<i class="icon icon-cart"></i>
							<span class="cart-quantity"><?php echo intval( WC()->cart->get_cart_contents_count() ); ?></span>
						</a>

						<?php
					}	?>

					<a href="#search" class="navbar-search"><i class="icon icon-search"></i></a>

				</div>
			</div>

		</nav>
	</div>
</div><!-- .navbar-primary -->
