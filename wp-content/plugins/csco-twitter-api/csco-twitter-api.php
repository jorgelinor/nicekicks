<?php
/*
Plugin Name: CSCO: Twitter API
Plugin URI: http://codesupply.co/twitteroauth/
Description: Provides Twitter API support for themes by Code Supply Co.
Author: Code Supply Co.
Version: 1.0.0
Author URI: http://codesupply.co/
*/

// require Twitter OAuth
include_once plugin_dir_path( __FILE__ ) . 'twitteroauth/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;

function get_tweets($consumer_key, $consumer_secret, $access_token, $access_token_secret, $options) {

  if(!empty($consumer_key) && !empty($consumer_key) && !empty($access_token) && !empty($access_token_secret)) {
    $connect = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
    $tweets = $connect->get('statuses/user_timeline', $options);
    return $tweets;
  }

}
