<?php
function kickdb_load_sneaker_calendar_template($page_template) {
  global $wp_query;

  if ($wp_query->query['kickdb_query_id'] == 'kickdb_release_calendar_query') {
    $page_template = plugin_dir_path(__FILE__) . "templates/sneaker-calendar.php";
  }
  return $page_template;
}

function kickdb_release_calendar_title($title){
    // Note this affects the page title only
    // This code needs to be duplicated in the template sneaker-calendar.php

    global $wp_query;

    if ($wp_query->query_vars['kickdb_original_pagename'] === 'sneaker-release-dates') {
      return "Sneaker Release Dates";
    }
    if ($wp_query->query_vars['kickdb_original_pagename'] === 'upcoming-release-dates') {
      return "Upcoming Releases";
    }
    if ($wp_query->query_vars['kickdb_original_pagename'] === 'jordan-release-dates') {
      return "Jordan Release Dates";
    }
    if ($wp_query->query_vars['kickdb_original_pagename'] === 'past-release-dates') {
      return "Past Releases";
    }

    return $title;
}

function get_calendar_query($pagename, $amp) {
  $show_future_releases = $pagename !== 'past-release-dates';
  $show_hype_only = $pagename === 'sneaker-release-dates' || $pagename === 'jordan-release-dates';

  if ($pagename === 'jordan-release-dates') {
    $brand_filter = array(
        'key' => 'brand',
        'value' => 'Jordan',
        'compare' => '=',
    );
  }

  $query = array(
     // Use kickdb_query_id so we can tell whether the current page is a sneaker calendar release page
     // We can't inspect $post anymore, since its being overwritten by the `request` hook
    'kickdb_query_id' => 'kickdb_release_calendar_query',
    'kickdb_original_pagename' => $pagename,
    'amp' => $amp,
    'posts_per_page' => 30,
    'post_type' => array('kickdb_sneakers'),
    'post_status' => array('publish'),
    'orderby' => 'meta_value',
    'meta_key' => 'calendar_release_date',
    'order' => $show_future_releases ? 'ASC' : 'DESC',
    'meta_query' => array(
          array(
              'key' => 'calendar_release_date',
              'value' => date("Y-m-d"),
              'compare' => $show_future_releases ? '>=' : '<',
              'type' => 'DATE'
          ),
          $show_hype_only ? array(
              'key' => 'hype',
              'value' => true,
              'compare' => '=',
          ) : null,
          $brand_filter,
      )
  );

  return $query;
}

function kickdb_release_calendar_query($request) {
  if (
    $request['pagename'] === 'sneaker-release-dates' ||
    $request['pagename'] === 'jordan-release-dates' ||
    $request['pagename'] === 'upcoming-release-dates' ||
    $request['pagename'] === 'past-release-dates'
  ) {
    return get_calendar_query($request['pagename'], $request['amp']);
  }

  return $request;
}


function ampforwp_return_loop_args($query){
  // https://ampforwp.com/tutorials/article/modify-homepage-posts-loop-amp-version-right-way/

  global $wp;
  if ($wp->query_vars && $wp->query_vars['kickdb_original_pagename']) {
    $query = get_calendar_query($wp->query_vars['kickdb_original_pagename'], true);
  }

  return $query;
}

function ampforwp_calendar_init(){
  add_filter('ampforwp_query_args', 'ampforwp_return_loop_args');
}


function kickdb_disable_amp_for_calendar() {
  // Remove AMP support for the release calendar pages

  global $wp;
  global $redux_builder_amp;

  if ($wp->query_vars && $wp->query_vars['kickdb_original_pagename']) {
    $pos = array_search('kickdb_sneakers', $redux_builder_amp['ampforwp-custom-type']);
    unset($redux_builder_amp['ampforwp-custom-type'][$pos]);
  }
}

function init_kickdb_sneakers_calendar() {
    add_filter('template_include', 'kickdb_load_sneaker_calendar_template');

    add_filter('request', 'kickdb_release_calendar_query');
    add_filter('pre_get_document_title','kickdb_release_calendar_title');

    add_action('pre_get_posts', 'kickdb_disable_amp_for_calendar');

    add_action('amp_init', 'ampforwp_calendar_init');
}
