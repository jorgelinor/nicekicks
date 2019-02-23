<?php
/**
 * Search Results
 *
 * @package      NiceKicks
 * @author       Bill Erickson <bill@billerickson.net>
 * @copyright    Copyright © 2011, Bill Erickson
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */

add_action( 'genesis_before_loop', 'be_search_intro' );
function be_search_intro() {
	echo '<div class="taxonomy-description"><h1>Search results for: ' . get_query_var('s') . '</h1></div>';
}

genesis();