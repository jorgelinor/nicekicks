<?php
/*
Plugin Name: Fragment Cache
Description: Fragment Cache
Version: 0.6
Plugin URI: http://www.w3-edge.com/wordpress-plugins/fragment-cache/
Author: Frederick Townes
Author URI: http://www.linkedin.com/in/w3edge
*/

/**
 * Path to cache dir
 * @var string
 */
define('FC_CACHE_DIR', WP_CONTENT_DIR . '/cache');

/**
 * Turn off fc-cache when WP_DEBUG is true
 * @var bool
 */
define('FC_DEBUG', false);

/**
 * Array of memcached servers
 * @var array
 */
$fc_memcached_servers = array(
    //'192.168.100.166:11211'
);

register_activation_hook(__FILE__, 'fc_activation');
register_deactivation_hook(__FILE__, 'fc_deactivation');
add_action('fc_update', 'fc_update', 0, 5);

/**
 * Does fragment cache logic
 *
 * @param string $function_or_array Function name to call, or array($function, $key_part1, ..., $key_part_n)
 * @param array $params Function params
 * @param integer $expire Cache expire time
 * @param string $filter Function name to be called to filter output
 * @return void
 */
function fc_cache($function_or_array, $params = null, $expire = 3600, $filter = false)
{
    if(is_null($params)) $params = array();

    $key = _fc_get_cache_key($function_or_array, $params, $expire);
    $function = is_array($function_or_array) ? $function_or_array[0] : $function_or_array;

    $debug = array();

    if (FC_DEBUG && defined('WP_DEBUG') && WP_DEBUG == true) {
        $data = _fc_call($function, $params);
        $debug[] = 'call';
    } else {
        if (_fc_is_cache_valid($key, $expire)) {
            $data = _fc_fetch_disk($key);
            $debug[] = 'disk';
        } else {
            $data = _fc_fetch_memcache($key);

            if ($data) {
                _fc_store_disk($key, $data);
                $debug[] = 'mem';
            } else {
                $data = _fc_fetch_disk($key);

                if ($data) {
                    _fc_schedule($key, $function, $params, $expire);
                    $debug[] = 'cron';
                } else {
                    $data = _fc_call($function, $params);
                    $debug[] = 'call';

                    _fc_store($key, $data, $expire);
                }
            }
        }
    }

    //Print debug message
    if ( defined('WP_DEBUG') && WP_DEBUG == true ) {
        echo sprintf("<!-- FC: %s/%s -->\n", $function, implode(',', $debug));
    }

    //Filter output if set
    $filter = trim($filter);
    if( !empty($filter) && function_exists($filter) ) {
        $data['output'] = call_user_func_array( $filter, array($data['output'], $data['return']) );
    }

    echo $data['output'];
    return $data['return'];
}

/**
 * Plugin update cache action
 *
 * @param string $key
 * @param string $function
 * @param array $params
 * @param integer $expire
 * @return boolean
 */
function fc_update($key, $function, $params, $expire)
{
    $data = _fc_call($function, $params);

    return _fc_store($key, $data, $expire);
}

/**
 * Plugin activation action
 *
 * @return void
 */
function fc_activation()
{
    @mkdir(FC_CACHE_DIR);
}

/**
 * Plugin deactivation action
 *
 * @return void
 */
function fc_deactivation()
{
    @rmdir(FC_CACHE_DIR);
}

/**
 * Schedule next cache update
 *
 * @param string $key
 * @param string $function
 * @param array $params
 * @param integer $expire
 * @return void
 */
function _fc_schedule($key, $function, $params, $expire)
{
    $args = array(
        $key,
        $function,
        $params,
        $expire
    );

    if (!wp_next_scheduled('fc_update', $args)) {
        wp_schedule_single_event(time(), 'fc_update', $args);
    }
}

/**
 * Call function and grab output
 *
 * @param string $function
 * @param array $params
 * @return string
 */
function _fc_call($function, $params)
{
    ob_start();
    $return = call_user_func_array($function, $params);
    $output = ob_get_contents();
    ob_end_clean();

    return array('output' => $output, 'return' => $return);
}

/**
 * Fetch cache from file
 *
 * @param string $key
 * @return string
 */
function _fc_fetch_disk($key)
{
    $path = _fc_get_cache_path($key);
    $data = @file_get_contents($path, LOCK_EX);

    if ($data !== false) {
        $data = @unserialize($data);

        return $data;
    }

    return false;
}

/**
 * Fetch cache from Memcache
 *
 * @param string $key
 * @return string
 */
function _fc_fetch_memcache($key)
{
    $memcache = _fc_get_memcache();

    if ($memcache) {
        return $memcache->get($key);
    }

    return false;
}

/**
 * Store cache data in file cache
 *
 * @param string $key
 * @param string $data
 * @return boolean
 */
function _fc_store_disk($key, $data)
{
    $path = _fc_get_cache_path($key);
    $data = serialize($data);
    $dir = dirname($path);
    if(!file_exists($dir))
      mkdir($dir, 0774, true);

    return @file_put_contents($path, $data, LOCK_EX);
}

/**
 * Store cache data in Memcache
 *
 * @param string $key
 * @param string $data
 * @param integer $expire
 * @return boolean
 */
function _fc_store_memcache($key, $data, $expire)
{
    $memcache = _fc_get_memcache();

    if ($memcache) {
        return $memcache->set($key, $data, 0, $expire);
    }

    return false;
}

/**
 * Store cache data
 *
 * @param string $key
 * @param string $data
 * @param integer $expire
 * @return boolean
 */
function _fc_store($key, $data, $expire)
{
    if(empty($data['return']) && empty($data['output'])) return false;

    $result1 = _fc_store_disk($key, $data);
    $result2 = _fc_store_memcache($key, $data, $expire);

    return ($result1 && $result2);
}

/**
 * Returns Memcache instance
 *
 * @return Memcache
 */
function _fc_get_memcache()
{
    static $memcache = null;

    /*if (!$memcache) {
        if (class_exists('Memcache')) {
            $memcache = new Memcache();

            foreach ($GLOBALS['fc_memcached_servers'] as $fc_memcached_server) {
                list ($server, $port) = explode(':', $fc_memcached_server);

                $memcache->addServer($server, $port);
            }
        } else {
            $memcache = null;
        }
    }*/

    return $memcache;
}

/**
 * Returns cache key
 *
 * @param string $function
 * @param array $params
 * @param integer $expire
 * @return string
 */
function _fc_get_cache_key($function, $params) {
    if(is_array($function)) {
        return sprintf('%s.%s_%s', $function[0], md5(serialize($function)), md5(serialize($params)));
    } else {
        return sprintf('%s.%s', $function, md5(serialize($params)));
    }
}

/**
 * Returns cache file path from key
 *
 * @param string $key
 * @return string
 */
function _fc_get_cache_path($key)
{
    list($func, $rest) = explode(".", $key, 2);
    $seg = md5($rest);
    $seg1 = substr($seg, 0, 2);
    $seg2 = substr($seg, 2, 2);
    $path = sprintf('%s/%s/%s/%s/%s.frag', FC_CACHE_DIR, $func, $seg1, $seg2, $rest);
    return $path;
}

/**
 * Check if cache file is valid
 *
 * @param string $key
 * @param integer $expire
 * @return boolean
 */
function _fc_is_cache_valid($key, $expire)
{
    $path = _fc_get_cache_path($key);

    if (file_exists($path)) {
        $time = @filemtime($path);

        if ($time && (time() - $time) <= $expire) {
            return true;
        }
    }

    return false;
}

function fc_file_get_contents($filename)
{
    if (file_exists($filename)) {
        $data = file_get_contents($filename);
    } else {
        $data = _fc_fetch_memcache($key);
        if($data){
            @file_put_contents($filename, $data);
            $data = unserialize( $data );
        } else {
            $data = false;
        }
    }
    $data = maybe_unserialize($data);
    
    return maybe_unserialize( $data['content'] );
}

function fc_file_put_contents($filename, $data)
{
    $contents = array('content' => maybe_serialize($data), 'modified' => time());
    $result1 = file_put_contents($filename, serialize($contents) );
    $result2 = _fc_store_memcache($filename, $contents, 0);

    return ($result1 && $result2);
}

function fc_filemtime($filename)
{
    if (file_exists($filename)) {
        $data = file_get_contents($filename);
    } else {
        $data = _fc_fetch_memcache($key);
        if($data){
            @file_put_contents($filename, $data);
        } else {
            $data = false;
        }
    }
    $data = maybe_unserialize($data);
    
    return $data['modified'];
}

function fc_file_exists($filename)
{
    if (file_exists($filename)) {
        return true;
    } else {
        $data = _fc_fetch_memcache($key);
        if($data){
            @file_put_contents($filename, $data);
            return true;
        } else {
            return false;
        }
    }
}
