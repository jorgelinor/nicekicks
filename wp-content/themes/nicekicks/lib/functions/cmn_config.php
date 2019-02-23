<?php
global $wp_query;
$paged = $wp_query->get( 'paged' );
if ( is_single() ) {
    $cats =  get_the_category();
    $cat = $cats[0]; // let's just assume the post has one category
}
else { // category archives
    $cat = get_category( get_query_var( 'cat' ) );
}
$cat_id = $cat->cat_ID;
$cat_name = $cat->name;
$cat_slug = $cat->slug;
//echo $cat_slug;

//get decendendants of category
function childrencategories( $cats, $_post = null )
{
	foreach ( (array) $cats as $cat ) {
		// get_term_children() accepts integer ID only
		$descendants = get_term_children( (int) $cat, 'category');
		if ( $descendants && in_category( $descendants, $_post ) )
			return true;
	}
	return false;
}
//check page number
$entry=explode("/", $_SERVER['REQUEST_URI']);
$paged_value = trim($entry[2]);
$page_num = trim($entry[3]);

$post = $wp_query->post;
// gets the tags from the current page and separates them by comma
if (is_single()){
    foreach (wp_get_post_tags($post->ID) as $cmnKW_data) {
$cmnKW .= $cmnKW_data ->slug.',';
}
} else {
$cmnKW .= '';
}
// dynamic logic for internal site channels
$searchparam = htmlspecialchars($_GET["s"]);
$category = get_the_category(); 
$wp_cat = $category[0]->cat_name;
$exclude = '';
$subsilo = '';
$tier = 't2,subhome';
$zone = 'system';

if ($searchparam > '') {
$tier = 't2,subhome';
$zone = 'system';
}
if (is_home()) {
$subsilo = '';
$tier = 'to,home';
$zone = 'home';
}
if (is_single() || is_paged() || is_search() || is_day() || is_month() || is_year() || is_author() || $searchparam > '') {
$tier = 't2,internal';
}
if (is_single()) {
$exclude = 'ugc';
$hiddenkeyword = get_post_meta($post->ID, 'promokeyword', true);
	$cmnKW .= $hiddenkeyword;
	$exclude .= ','.$hiddenkeyword;
}
if (is_page('about') || is_page('contact')) {
$zone = 'system';
$tier = 't2,internal';
}
if ($cat_slug == 'features' || is_page('features')) {
$zone = 'features';
}
elseif ($cat_slug == 'release-dates') {
$zone = 'release';
}
elseif ($cat_slug == 'asics') {
$zone = 'release';
}
elseif ($cat_slug == 'bring-em-back' || $cat_slug == 'in-retrospect') {
$zone = 'retro';
}
elseif ($cat_slug == 'celebrity-sneaker-stalker') {
$zone = 'celebrity';
}
elseif ($cat_slug == 'clothing' || $cat_slug == 'accessories' || $cat_slug == 'g-shock' || $cat_slug == 'incase-2' || $cat_slug == 'nixon' || $cat_slug == 'oakley' || $cat_slug == 'the-hundreds' || $cat_slug == 'timberland' || $cat_slug == 'under-armour' || $cat_slug == 'undftd-2' || $cat_slug == 'undr-crwn') {
$zone = 'style';
}
elseif ($cat_slug == 'airwalk' || $cat_slug == 'alife' || $cat_slug == 'anta' || $cat_slug == 'and-1-2' || $cat_slug == 'clae' || $cat_slug == 'creative-recreation' || $cat_slug == 'customs' || $cat_slug == 'dc-shoes' || $cat_slug == 'dvs' || $cat_slug == 'etnies' || $cat_slug == 'fila' || $cat_slug == 'fms' || $cat_slug == 'gourmet' || $cat_slug == 'greedy-genius' || $cat_slug == 'huf-2' || $cat_slug == 'k-swiss-2' || $cat_slug == 'kangaroos-2' || $cat_slug == 'lacoste' || $cat_slug == 'osiris' || $cat_slug == 'other-sneakers' || $cat_slug == 'performance-review' || $cat_slug == 'pf-flyers' || $cat_slug == 'pony' || $cat_slug == 'pro-keds' || $cat_slug == 'saucony'|| $cat_slug == 'sneaker-showdown' || $cat_slug == 'sneaker-into-the-club' || $cat_slug == 'this-week-in-sneaks' || $cat_slug == 'this-day-in-sneaker-history') {
$zone = 'sneakers';
}
elseif ($cat_slug == 'store-blog') {
$zone = 'blog';
}
elseif ($cat_slug == 'events') {
$zone = 'events';
}
elseif ($cat_slug == 'todays-kicks') {
$zone = 'today';
}
elseif ($cat_slug == 'interviews') {
$zone = 'interviews';
}
elseif ($cat_slug == 'kobe') {
$zone = 'kobe';
}
elseif ($cat_slug == 'lebron') {
$zone = 'lebron';
}
elseif ($cat_slug == 'news') {
$zone = 'news';
}
elseif ($cat_slug == 'new-balance') {
$zone = 'new-balance';
}
elseif ($cat_slug == 'air-jordans' || $cat_slug == 'jordan-brand' || $cat_slug == 'michael-jordan' || is_page('air-jordans')) {
$zone = 'airjordans';
}
elseif ($cat_slug == 'nike' || $cat_slug == 'nike-basketball' || $cat_slug == 'nike-running' || $cat_slug == 'nike-sportswear' || $cat_slug == 'nikeid' || $cat_slug == 'nike-shoes' || is_page('nike')) {
$zone = 'nike';
}
elseif ($cat_slug == 'adidas' || is_page('adidas')) {
$zone = 'adidas';
}
elseif ($cat_slug == 'new-balance' || is_page('new-balance')) {
$zone = 'new-balance';
}
elseif ($cat_slug == 'converse' || is_page('converse')) {
$zone = 'converse';
}
elseif ($cat_slug == 'reebok' || is_page('reebok')) {
$zone = 'reebok';
}
elseif ($cat_slug == 'supra' || is_page('supra') || is_page('supra-vaider')) {
$zone = 'supra';
}
elseif ($cat_slug == 'vans' || is_page('vans')) {
$zone = 'vans';
}
elseif ($cat_slug == 'video') {
$zone = 'video';
}
elseif ($cat_slug == 'puma') {
$zone = 'puma';
}
elseif (is_home() && $paged_value = 'page' && $page_num < 2) {
$tier = 'to,home';	
$zone = 'home';
}
elseif (is_home() && $paged_value = 'page' && $page_num < 6) {
$tier = 't2,subhome';	
$zone = 'home';
}
elseif (is_home() && $paged_value = 'page' && $page_num > 6) {
$tier = 't2,internal';	
$zone = 'home';
}
else {
$subsilo = '';
$tier = 't2,subhome';
$zone = 'system';
$exclude = '';
}
$cmnParams = array('subsilo' => $subsilo, 'tier' => $tier, 'zone' => $zone, 'exclude' => $exclude);