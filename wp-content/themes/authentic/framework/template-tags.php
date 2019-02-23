<?php
/**
 * Template Tags
 *
 * Functions that are called directly from template parts or within actions.
 *
 * @package Authentic WordPress Theme
 * @subpackage Framework
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

/**
 * Page Title
 */
function csco_page_title() {

	// Reset $class variable.
	$class = '';

	if ( is_archive() ) {

		if ( is_category() ) {

			$title = single_cat_title( '', false );

		} elseif ( is_tag() ) {

			$subtitle = esc_html__( 'Posts by tag', 'authentic' );
			$title = single_tag_title( '', false );

		} elseif ( is_author() ) {

			$subtitle = esc_html__( 'Posts by author', 'authentic' );
			$title = get_the_author( '', false );

		} elseif ( is_year() ) {

			$subtitle = esc_html__( 'Posts by year', 'authentic' );
			$title = get_the_date( 'Y' );

		} elseif ( is_month() ) {

			$subtitle = esc_html__( 'Posts by month', 'authentic' );
			$title = get_the_date( 'F Y' );

		} elseif ( is_day() ) {

			$subtitle = esc_html__( 'Posts by day', 'authentic' );
			$title = get_the_date( 'F j, Y' );

		} else {

			$title = get_the_archive_title();

		}
	} elseif ( is_search() ) {

		$subtitle = esc_html__( 'Search Results for', 'authentic' );
		$title = get_search_query();

	} elseif ( is_404() ) {

		$subtitle = '404';
		$title = esc_html__( 'Page not found', 'authentic' );

	} elseif ( is_single() ) {

		$title = get_the_title();
		$class = 'entry-title';

	} elseif ( is_page() ) {

		$title = get_the_title();

	}// End if().

	if ( $class ) {
		$class = ' class="' . $class . '"';
	}

	if ( isset( $title ) && $title ) {
		if ( isset( $subtitle ) && $subtitle ) {
			echo '<p class="sub-title">' . esc_html( $subtitle ) . '</p>';
		}
		echo '<h1' . $class . '>' . esc_html( $title ) . '</h1>';
	}

}

/**
 * Page Header
 *
 * @param string $type Page Header type.
 */
function csco_page_header( $type ) {
	if ( 'large' === $type || 'wide' === $type ) {
		$element = 'section';
	} else {
		$element = 'header';
	}
	?>
	<<?php echo esc_html( $element ); ?><?php csco_get_page_header_attr( $type ); ?>>
		<div>
			<?php do_action( 'csco_page_header_start' ); ?>
			<?php csco_page_title(); ?>
			<?php do_action( 'csco_page_header_end' ); ?>
		</div>
	</<?php echo esc_html( $element ); ?>>
	<?php
}

/**
 * Icon List
 *
 * Returns the list of social icons within the given element.
 *
 * @param array  $links array of social accounts.
 * @param string $class class name of the wrapping <div>.
 * @param bool   $title title of the account.
 */
function csco_the_icon_list( $links = array(), $class = 'default', $title = false ) {

	// Check if the array is not empty.
	if ( $links ) { ?>

	<div class="bsa-wrap bsa-<?php echo esc_html( $class ); ?>">
		<div class="bsa-items">

			<?php // Loop through the array of social accounts.
			foreach ( $links as $link ) {

				// Get text, icon and URL of each social account.
				$item = $link['type'];
				$url  = $link['url'];

				// Check if URL of a social icon is not empty.
				if ( $url ) { ?>

				<div class="bsa-item bsa-<?php echo esc_html( $item ); ?>">
					<a href="<?php echo esc_url( $url ); ?>" class="bsa-link" target="_blank">
						<i class="bsa-icon icon icon-<?php echo esc_html( $item ); ?>"></i>
						<?php if ( $title && isset( $link['text'] ) && $link['text'] ) { ?>
						<span class="bsa-title"><?php echo esc_html( $text ); ?></span>
						<?php } ?>
					</a>
				</div>

				<?php	}
			} // End foreach().
			?>

		</div>
	</div>

	<?php
	} // End if().
}

/**
 * Post Author Social Accounts
 *
 * @param int $id Post Author ID.
 */
function csco_post_author_social_accounts( $id ) {
	foreach ( csco_get_social_accounts() as $account => $name ) {
		$author_accounts[] = array(
			'url'  => get_the_author_meta( $account, $id ),
			'text' => $name,
			'type' => $account,
		);
	}
	csco_the_icon_list( $author_accounts, 'default', null, true );
}

/**
 * Post Co-Author Social Accounts
 *
 * @param obj $coauthor Co-Author Object.
 */
function csco_post_coauthor_social_accounts( $coauthor ) {
	$author_accounts = array();
	foreach ( csco_get_social_accounts() as $account => $name ) {
		$author_accounts[] = array(
			'url'  => $coauthor->$account,
			'text' => $name,
			'type' => $account,
		);
	}
	csco_the_icon_list( $author_accounts, 'default', null, true );
}

/**
 * Post Pagination
 */
function csco_post_pagination() {
	wp_link_pages( array(
		'before'           => '<div class="navigation pagination"><div class="nav-links">',
		'after'            => '</div></div>',
		'link_before'      => '<span class="page-number">',
		'link_after'       => '</span>',
		'next_or_number'   => 'next_and_number',
		'separator'        => ' ',
		'nextpagelink'     => esc_html__( 'Next page', 'authentic' ),
		'previouspagelink' => esc_html__( 'Previous page', 'authentic' ),
	) );
}

/**
 * Post Tags
 */
function csco_post_tags() {
	if ( get_theme_mod( 'post_tags', true ) ) {
		$title = get_theme_mod( 'post_tags_title', esc_html__( 'Related Topics', 'authentic' ) );
		the_tags( '<div class="post-tags"><h5>' . esc_html( $title ) . '</h5><ul><li>', '</li><li>', '</li></ul></div>' );
	}
}

/**
 * Read More Button
 *
 * @param string $class class name of the anchor.
 * @param string $icon 	icon name inside <span> element.
 * @param string $url 	URL of the post.
 */
function csco_read_more( $class = 'btn btn-primary btn-effect', $icon = 'arrow-right', $url = null ) {

	if ( ! $url ) {
		$url = get_permalink();
	}

	$output  = '<div class="post-more">';
	$output .= '<a href="' . esc_url( $url ) . '" class="' . esc_html( $class ) . '">';
	$output .= '<span>' . esc_html__( 'View Post', 'authentic' ) . '</span>';
	$output .= ( $icon ) ? '<span><i class="icon icon-' . esc_html( $icon ) . '"></i></span>' : '';
	$output .= '</a>';
	$output .= '</div>';

	return $output;

}

/**
 * Echo Read More Button
 *
 * @param string $class class name of the anchor.
 * @param string $icon 	icon name inside <span> element.
 * @param string $url 	URL of the post.
 */
function csco_the_read_more( $class = 'btn btn-primary btn-effect', $icon = 'arrow-right', $url = null ) {
	echo wp_kses_post( csco_read_more( $class, $icon, $url ) );
}

/**
 * Post Count in Archive Pages
 */
function csco_archive_post_count() {
	if ( is_archive() ) {
		global $wp_query;
		$found_posts = $wp_query->found_posts; ?>
		<div class="post-count">
			<?php printf( esc_html( _n( '%s post', '%s posts', $found_posts, 'authentic' ) ), intval( $found_posts ) ); ?>
		</div>
	<?php }
}

/**
 * Header Content
 *
 * Returns header content in either left or right column.
 *
 * @param string $location Left or right.
 * @param string $default  Default content type.
 */
function csco_get_header_content( $location, $default ) {

	$content = get_theme_mod( $location . '_select', $default ); ?>

	<?php
	if ( 'toggle' === $content ) { ?>

		<button class="navbar-toggle offcanvas-toggle" type="button">
			<i class="icon icon-menu"></i>
		</button>

	<?php
	} elseif ( 'search' === $content ) { ?>

		<a href="#search" class="navbar-search"><i class="icon icon-search"></i></a>

	<?php
	} elseif ( 'social' === $content ) {

		if ( function_exists( 'bsa_get_accounts' ) ) {

			$labels = get_theme_mod( $location . '_social_accounts_labels', true );
			$titles = get_theme_mod( $location . '_social_accounts_titles', false );
			$counts = get_theme_mod( $location . '_social_accounts_counts', true );
			$limit  = get_theme_mod( $location . '_social_accounts_limit', 3 );

			if ( 'topbar_content_right' === $location || 'topbar_content_left' === $location ) {
				$template = 'nav';
			} else {
				$template = 'default';
			}

			bsa_get_accounts( $labels, $titles, $counts, $template, $limit );

		} else { ?>

			<div class="alert alert-warning"><?php esc_html_e( 'This feature requires the Basic Social Accounts plugin.', 'authentic' ); ?></div>

		<?php }
	} elseif ( 'button' === $content ) {

		$url  = get_theme_mod( $location . '_button_link', get_site_url() );
		$text = get_theme_mod( $location . '_button_text', esc_html__( 'Subscribe', 'authentic' ) );
		$icon = get_theme_mod( $location . '_button_icon', 'mail' );
		?>

		<a href="<?php echo esc_url( $url ); ?>" class="btn btn-primary btn-effect">
			<span><?php echo esc_html( $text ); ?></span>
			<span><i class="icon icon-<?php echo esc_html( $icon ); ?>"></i></span>
		</a>

	<?php
	} elseif ( 'menu' === $content ) {

		$menu = get_theme_mod( $location . '_menu', csco_get_default_menu() );

		if ( is_nav_menu( $menu ) ) {
			wp_nav_menu( array(
				'menu' => $menu,
				'menu_class' => 'nav navbar-nav navbar-lonely hidden-sm-down',
				'container' => '',
				'container_class' => '',
				'depth' => 1,
			));
		}
	} elseif ( 'html' === $content ) {

		echo get_theme_mod( $location . '_html' );

	} elseif ( 'cart' === $content ) { ?>

		<a class="header-cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_html_e( 'View your shopping cart', 'authentic' ); ?>">
			<i class="icon icon-cart"></i>
			<span class="cart-quantity"><?php echo intval( WC()->cart->get_cart_contents_count() ); ?></span>
		</a>

	<?php }
}

/**
 * Post Author Detail
 *
 * @param int    $id    Author ID.
 * @param string $class Class of the wrapping div.
 */
function csco_post_author( $id = null, $class = null ) {
	if ( ! $id ) {
		$id = get_the_author_meta( 'ID' );
	}
	if ( $class ) {
		$class = 'vcard ' . $class;
	} else {
		$class = 'vcard';
	} ?>
	<div class="<?php echo esc_html( $class ); ?>">
		<div class="author">
			<div class="author-avatar">
				<a href="<?php echo esc_url( get_author_posts_url( $id ) );?>" rel="author"><?php echo get_avatar( get_the_author_meta( 'email', $id ), '120' ); ?></a>
			</div>
			<div class="author-description">
				<h5><span class="fn"><a href="<?php echo esc_url( get_author_posts_url( $id ) );?>" rel="author"><?php the_author_meta( 'display_name', $id ); ?></a></span></h5>
				<p class="note"><?php the_author_meta( 'description', $id ); ?></p>
				<?php csco_post_author_social_accounts( $id ); ?>
			</div>
		</div>
	</div>
<?php }

/**
 * Post Co-Author Details
 *
 * @param obj    $coauthor Co-Author Object.
 * @param string $class    Class of the wrapping div.
 */
function csco_post_coauthor( $coauthor, $class = null ) {
	if ( $class ) {
		$class = 'vcard ' . $class;
	} else {
		$class = 'vcard';
	}	?>
	<div class="<?php echo esc_html( $class ); ?>">
		<div class="author coauthor">
			<div class="author-avatar">
				<?php echo wp_kses_post( coauthors_get_avatar( $coauthor, 120 ) ); ?>
			</div>
			<div class="author-description">
				<h5><span class="fn"><?php echo wp_kses_post( coauthors_posts_links_single( $coauthor ) ); ?></span></h5>
				<p class="note"><?php echo wp_kses_post( $coauthor->description ); ?></p>
				<?php echo wp_kses_post( get_the_author_meta( 'description', $coauthor->ID ) ); ?>
				<?php csco_post_coauthor_social_accounts( $coauthor ); ?>
			</div>
		</div>
	</div>
<?php }
