<?php
/**
 * Page
 *
 * @package      NiceKicks
 * @author       Bill Erickson <bill@billerickson.net>
 * @copyright    Copyright (c) 2011, Bill Erickson
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */

// move sharing
remove_action( 'genesis_after_post_content', 'be_sharing', 15 );
add_action( 'genesis_before_post_content', 'be_sharing', 15 );
 
 
genesis();
