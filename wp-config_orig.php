<?php
# Database Configuration
define( 'DB_NAME', 'wp_nicekickscom' );
define( 'DB_USER', 'nicekickscom' );
define( 'DB_PASSWORD', 'ChnrpHLJa0vwVNWV' );
define( 'DB_HOST', '127.0.0.1' );
define( 'DB_HOST_SLAVE', '127.0.0.1' );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = 'B2hPG_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         ':7q8vO[1ho@<2LXu0b%@?oaCmuaQdAb^*a 6s8u-+-}20r(#mPZG5kF4i`87[Sk<');
define('SECURE_AUTH_KEY',  'li0r`X]Q%-!lUH`-lVM$+$p`H<2m-):v8|N-QZV2fc>}r;c3xec-9uy&F.2n%Ia:');
define('LOGGED_IN_KEY',    ':!q2&#|#CH^;*Ey;V[.Op9yVMsZ<yw;~wWg8saN)rz-WrJ6Av+siX)~?&oiP(F5S');
define('NONCE_KEY',        'Y+|+G?>pSC-mCAH_&;+&DJJS+eS(f{tJp$!#PH& C|Qf>_u@!-%-cId2eDf?7%zk');
define('AUTH_SALT',        '+VN/9<j %-.Xn:r!-zPtr,d[r~jMzgNE+s9eDl+xl)3 >|?Wm^U,U+e_d&;Fn8]v');
define('SECURE_AUTH_SALT', 'e;ea%,z@tR=/G.T*|6TKh[D{--PgWf6+zkbhDg)rVhqF@m]AFT1hSta<Ed{E14>t');
define('LOGGED_IN_SALT',   'QlZ/-J%7&<aeS]B%a./zH1oj nZ/[#11laM<J-Qsr6?hob.ZWJY7-GseStBzp>1&');
define('NONCE_SALT',       'G)k0p#0UgNK_(yT~GE/bbQ rSQDYARl*K@8bLy+KOZmf1uW4W4=Y18DTY%54JN8?');



# Localized Language Stuff

# Enable admin ajax logging to see what's hitting admin-ajax.php so hard
//define( 'WPE_MONITOR_ADMIN_AJAX', true );

define( 'WP_CACHE', TRUE );

define( 'PWP_NAME', 'nicekickscom' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

define( 'PWP_ROOT_DIR', '/nas/wp' );

define( 'WPE_APIKEY', '6f4aa2b1898156168dab6a869eea180d6f99f068' );

define( 'WPE_FOOTER_HTML', "" );

define( 'WPE_CLUSTER_ID', '112784' );

define( 'WPE_CLUSTER_TYPE', 'pod' );

define( 'WPE_ISP', true );

define( 'WPE_BPOD', false );

define( 'WPE_RO_FILESYSTEM', false );

define( 'WPE_LARGEFS_BUCKET', 'largefs.wpengine' );

define( 'WPE_CDN_DISABLE_ALLOWED', false );


define( 'DISALLOW_FILE_MODS', FALSE );

define( 'DISABLE_WP_CRON', false );

define( 'WPE_FORCE_SSL_LOGIN', false );

define( 'FORCE_SSL_LOGIN', false );

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define( 'WPE_EXTERNAL_URL', false );

define( 'WP_POST_REVISIONS', FALSE );

define( 'WPE_WHITELABEL', 'wpengine' );

define( 'WP_TURN_OFF_ADMIN_BAR', false );

define( 'WPE_BETA_TESTER', false );

umask(0002);

$wpe_cdn_uris=array ( );

$wpe_no_cdn_uris=array ( );

$wpe_content_regexs=array ( );

$wpe_all_domains=array ( 0 => 'nicekicks.com', 1 => 'nicekickscom.wpengine.com', 2 => 'www.nicekicks.com', );

$wpe_varnish_servers=array ( 0 => 'pod-112784', );

$wpe_ec_servers=array ( );

$wpe_largefs=array ( );

$wpe_netdna_domains=array ( 0 =>  array ( 'zone' => 'iqbkkd2tcm3u6mnv1c41azk6', 'match' => 'www.nicekicks.com', 'secure' => false, 'dns_check' => '0', ), );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( );

define( 'WP_AUTO_UPDATE_CORE', false );

define( 'WPE_HYPER_DB', 'safe' );

$wpe_special_ips=array ( 0 => '104.198.244.143', );

$wpe_netdna_domains_secure=array ( );

define( 'WPE_CACHE_TYPE', 'standard' );


# WP Engine ID
//define('WP_CONTENT_URL', '/files');

define('PWP_DOMAIN_CONFIG', 'www.nicekicks.com' );

# WP Engine Settings

define('WP_MEMORY_LIMIT', '1024M' );
define( 'WP_MAX_MEMORY_LIMIT', '1024M' );


# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');

$_wpe_preamble_path = null; if(false){}

define( 'WPE_SFTP_PORT', 2222 );

define( 'WPE_LBMASTER_IP', '' );

define( 'DISALLOW_FILE_EDIT', FALSE );
