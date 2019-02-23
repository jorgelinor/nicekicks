<?php
/*
Plugin Name: CSCO: Shortcodes
Plugin URI: http://codesupply.co/csco-shortcodes
Description: Provides shortcodes for themes by Code Supply Co.
Version: 1.0.0
Author: Code Supply Co.
Author URI: http://codesupply.co/
License: GPL2
*/

/* ============================================================= */

// Intelligently remove extra P and BR tags around shortcodes that WordPress likes to add
function csco_fix_shortcodes($content){   
  $array = array (
    '<p>[' => '[', 
    ']</p>' => ']', 
    ']<br />' => ']',
    ']<br>' => ']'
  );

  $content = strtr($content, $array);
  return $content;
}

add_filter('the_content', 'csco_fix_shortcodes');

// We need to be able to figure out the attributes of a wrapped shortcode
function csco_attribute_map($str, $att = null) {
  $res = array();
  $return = array();
  $reg = get_shortcode_regex();
  preg_match_all('~'.$reg.'~',$str, $matches);
  foreach($matches[2] as $key => $name) {
    $parsed = shortcode_parse_atts($matches[3][$key]);
    $parsed = is_array($parsed) ? $parsed : array();

    $res[$name] = $parsed;
    $return[] = $res;
  }
  return $return;
}

// Begin Shortcodes
class CSCOShortcodes {

  function __construct() {
    add_action( 'init', array( $this, 'add_shortcodes' ) );
  }

  /*--------------------------------------------------------------------------------------
    *
    * add_shortcodes
    *
    *-------------------------------------------------------------------------------------*/
  function add_shortcodes() {

    $shortcodes = array(
      'alert', 
      'collapse', 
      'collapsibles', 
      'column', 
      'row', 
      'tab', 
      'tabs', 
    );

    foreach ( $shortcodes as $shortcode ) {

      $function = 'csco_' . str_replace( '-', '_', $shortcode );
      add_shortcode( $shortcode, array( $this, $function ) );
      
    }
  }
          
  /*--------------------------------------------------------------------------------------
    *
    * csco_alert
    *
    *-------------------------------------------------------------------------------------*/
  function csco_alert( $atts, $content = null ) {

  $atts = shortcode_atts( array(
      "type"          => false,
      "dismissable"   => false,
      "xclass"        => false,
      "data"          => false
  ), $atts );
      
    $class  = 'alert';
    $class .= ( $atts['type'] )         ? ' alert-' . $atts['type'] : ' alert-success';
    $class .= ( $atts['dismissable']   == 'true' )  ? ' alert-dismissable' : '';
    $class .= ( $atts['xclass'] )       ? ' ' . $atts['xclass'] : '';
      
    $dismissable = ( $atts['dismissable'] ) ? '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' : '';
    
    $data_props = $this->parse_data_attributes( $atts['data'] );
      
    return sprintf( 
      '<div class="%s"%s>%s%s</div>',
      esc_attr( $class ),
      ( $data_props )  ? ' ' . $data_props : '',
      $dismissable,
      do_shortcode( $content )
    );
  }

  /*--------------------------------------------------------------------------------------
    *
    * csco_row
    *
    *-------------------------------------------------------------------------------------*/
  function csco_row( $atts, $content = null ) {

  $atts = shortcode_atts( array(
      "xclass" => false,
      "data"   => false
  ), $atts );

    $class  = 'row';      
    $class .= ( $atts['xclass'] )   ? ' ' . $atts['xclass'] : '';
      
    $data_props = $this->parse_data_attributes( $atts['data'] );
      
    return sprintf( 
      '<div class="%s"%s>%s</div>',
      esc_attr( $class ),
      ( $data_props ) ? ' ' . $data_props : '',
      do_shortcode( $content )
    );
  }

  /*--------------------------------------------------------------------------------------
    *
    * csco_column
    *
    *-------------------------------------------------------------------------------------*/
  function csco_column( $atts, $content = null ) {

  $atts = shortcode_atts( array(
      "lg"          => false,
      "md"          => false,
      "sm"          => false,
      "xs"          => false,
      "offset_lg"   => false,
      "offset_md"   => false,
      "offset_sm"   => false,
      "offset_xs"   => false,
      "pull_lg"     => false,
      "pull_md"     => false,
      "pull_sm"     => false,
      "pull_xs"     => false,
      "push_lg"     => false,
      "push_md"     => false,
      "push_sm"     => false,
      "push_xs"     => false,
      "xclass"      => false,
      "data"        => false
  ), $atts );

    $class  = '';
    $class .= ( $atts['lg'] )                                     ? ' col-lg-' . $atts['lg'] : '';
    $class .= ( $atts['md'] )                                           ? ' col-md-' . $atts['md'] : '';
    $class .= ( $atts['sm'] )                                           ? ' col-sm-' . $atts['sm'] : '';
    $class .= ( $atts['xs'] )                                           ? ' col-xs-' . $atts['xs'] : '';
    $class .= ( $atts['offset_lg'] || $atts['offset_lg'] === "0" )      ? ' col-lg-offset-' . $atts['offset_lg'] : '';
    $class .= ( $atts['offset_md'] || $atts['offset_md'] === "0" )      ? ' col-md-offset-' . $atts['offset_md'] : '';
    $class .= ( $atts['offset_sm'] || $atts['offset_sm'] === "0" )      ? ' col-sm-offset-' . $atts['offset_sm'] : '';
    $class .= ( $atts['offset_xs'] || $atts['offset_xs'] === "0" )      ? ' col-xs-offset-' . $atts['offset_xs'] : '';
    $class .= ( $atts['pull_lg']   || $atts['pull_lg'] === "0" )        ? ' col-lg-pull-' . $atts['pull_lg'] : '';
    $class .= ( $atts['pull_md']   || $atts['pull_md'] === "0" )        ? ' col-md-pull-' . $atts['pull_md'] : '';
    $class .= ( $atts['pull_sm']   || $atts['pull_sm'] === "0" )        ? ' col-sm-pull-' . $atts['pull_sm'] : '';
    $class .= ( $atts['pull_xs']   || $atts['pull_xs'] === "0" )        ? ' col-xs-pull-' . $atts['pull_xs'] : '';
    $class .= ( $atts['push_lg']   || $atts['push_lg'] === "0" )        ? ' col-lg-push-' . $atts['push_lg'] : '';
    $class .= ( $atts['push_md']   || $atts['push_md'] === "0" )        ? ' col-md-push-' . $atts['push_md'] : '';
    $class .= ( $atts['push_sm']   || $atts['push_sm'] === "0" )        ? ' col-sm-push-' . $atts['push_sm'] : '';
    $class .= ( $atts['push_xs']   || $atts['push_xs'] === "0" )        ? ' col-xs-push-' . $atts['push_xs'] : '';
    $class .= ( $atts['xclass'] )                                       ? ' ' . $atts['xclass'] : '';
      
    $data_props = $this->parse_data_attributes( $atts['data'] );
      
    return sprintf( 
      '<div class="%s"%s>%s</div>',
      esc_attr( $class ),
      ( $data_props ) ? ' ' . $data_props : '',
      do_shortcode( $content )
    );
  }

  /*--------------------------------------------------------------------------------------
    *
    * csco_tabs
    *
    *-------------------------------------------------------------------------------------*/
  function csco_tabs( $atts, $content = null ) {

    if( isset( $GLOBALS['tabs_count'] ) )
      $GLOBALS['tabs_count']++;
    else
      $GLOBALS['tabs_count'] = 0;

    $GLOBALS['tabs_default_count'] = 0;

  $atts = shortcode_atts( array(
      "type"   => false,
      "xclass" => false,
      "data"   => false
  ), $atts );
 
    $ul_class  = 'nav';
    $ul_class .= ( $atts['type'] )     ? ' nav-' . $atts['type'] : ' nav-tabs';
    $ul_class .= ( $atts['xclass'] )   ? ' ' . $atts['xclass'] : '';
      
    $div_class = 'tab-content';
      
    $id = 'custom-tabs-'. $GLOBALS['tabs_count'];
 
    $data_props = $this->parse_data_attributes( $atts['data'] );
    
    $atts_map = csco_attribute_map( $content );
    
    // Extract the tab titles for use in the tab widget.
    if ( $atts_map ) {
      $tabs = array();
      $GLOBALS['tabs_default_active'] = true;
      foreach( $atts_map as $check ) {
          if( !empty($check["tab"]["active"]) ) {
              $GLOBALS['tabs_default_active'] = false;
          }
      }
      $i = 0;
      foreach( $atts_map as $tab ) {
        
        $li_class  = 'nav-item';
        $a_class = ( !empty($tab["tab"]["active"]) || ($GLOBALS['tabs_default_active'] && $i == 0) ) ? ' ' . 'active' : '';
        $li_class .= ( !empty($tab["tab"]["xclass"]) ) ? ' ' . $tab["tab"]["xclass"] : '';
        
        $tabs[] = sprintf(
          '<li%s><a href="#%s" data-toggle="tab" class="nav-link%s">%s</a></li>',
          ( !empty($li_class) ) ? ' class="' . $li_class . '"' : '',
          'custom-tab-' . $GLOBALS['tabs_count'] . '-' . md5($tab["tab"]["title"]),
          ( !empty($a_class) ) ? ' ' . $a_class : '',
          $tab["tab"]["title"]
        );
        $i++;
      }
    }
    return sprintf( 
      '<ul class="%s" id="%s"%s>%s</ul><div class="%s">%s</div>',
      esc_attr( $ul_class ),
      esc_attr( $id ),
      ( $data_props ) ? ' ' . $data_props : '',
      ( $tabs )  ? implode( $tabs ) : '',
      esc_attr( $div_class ),
      do_shortcode( $content )
    );
  }

  /*--------------------------------------------------------------------------------------
    *
    * csco_tab
    *
    *-------------------------------------------------------------------------------------*/
  function csco_tab( $atts, $content = null ) {

  $atts = shortcode_atts( array(
      'title'   => false,
      'active'  => false,
      'fade'    => false,
      'xclass'  => false,
      'data'    => false
  ), $atts );
    
    if( $GLOBALS['tabs_default_active'] && $GLOBALS['tabs_default_count'] == 0 ) {
        $atts['active'] = true;
    }
    $GLOBALS['tabs_default_count']++;

    $class  = 'tab-pane';
    $class .= ( $atts['fade']   == 'true' )                            ? ' fade' : '';
    $class .= ( $atts['active'] == 'true' )                            ? ' active' : '';
    $class .= ( $atts['active'] == 'true' && $atts['fade'] == 'true' ) ? ' in' : '';
    $class .= ( $atts['xclass'] )                                      ? ' ' . $atts['xclass'] : '';


    $id = 'custom-tab-'. $GLOBALS['tabs_count'] . '-'. md5( $atts['title'] );
 
    $data_props = $this->parse_data_attributes( $atts['data'] );

    return sprintf( 
      '<div id="%s" class="%s"%s>%s</div>',
      esc_attr( $id ),
      esc_attr( $class ),
      ( $data_props ) ? ' ' . $data_props : '',
      do_shortcode( $content )
    );

  }


  /*--------------------------------------------------------------------------------------
    *
    * csco_collapsibles
    *
    *-------------------------------------------------------------------------------------*/
  function csco_collapsibles( $atts, $content = null ) {

    if( isset($GLOBALS['collapsibles_count']) )
      $GLOBALS['collapsibles_count']++;
    else
      $GLOBALS['collapsibles_count'] = 0;

  $atts = shortcode_atts( array(
      "xclass" => false,
      "data"   => false
  ), $atts );
      
    $class = 'card';
    $class .= ( $atts['xclass'] )   ? ' ' . $atts['xclass'] : '';
      
    $id = 'custom-collapse-'. $GLOBALS['collapsibles_count'];
 
    $data_props = $this->parse_data_attributes( $atts['data'] );

    return sprintf( 
      '<div class="%s" id="%s"%s>%s</div>',
      esc_attr( $class ),
      esc_attr( $id ),
      ( $data_props ) ? ' ' . $data_props : '',
      do_shortcode( $content )
    );

  }


  /*--------------------------------------------------------------------------------------
    *
    * csco_collapse
    *
    *-------------------------------------------------------------------------------------*/
  function csco_collapse( $atts, $content = null ) {
      
    if( isset($GLOBALS['single_collapse_count']) )
      $GLOBALS['single_collapse_count']++;
    else
      $GLOBALS['single_collapse_count'] = 0;

  $atts = shortcode_atts( array(
      "title"   => false,
      "active"  => false,
      "data"    => false
  ), $atts );
      
    $collapse_class = ( $atts['active'] == 'true' )  ? ' in' : ' collapse';
    $a_class = ( $atts['active'] == 'true' )  ? '' : 'collapsed';
    $parent = isset( $GLOBALS['collapsibles_count'] ) ? 'custom-collapse-' . $GLOBALS['collapsibles_count'] : 'single-collapse';
    $current_collapse = $parent . '-' . $GLOBALS['single_collapse_count'];

    $data_props = $this->parse_data_attributes( $atts['data'] );
      
    return sprintf( 
      '<div class="panel">
        <div class="card-header"%1$s>
          <a class="%2$s" data-toggle="collapse"%3$s href="#%4$s">%5$s</a>
        </div>
        <div id="%4$s" class="%6$s">
          <div class="card-block">
            %7$s
          </div>
        </div>
      </div>',
      ( $data_props )   ? ' ' . $data_props : '',
      $a_class,
      ( $parent )       ? ' data-parent="#' . $parent . '""' : '',
      $current_collapse,
      $atts['title'],
      esc_attr( $collapse_class ),
      do_shortcode( $content )
    );
  }
    
    
  /*--------------------------------------------------------------------------------------
    *
    * Parse data-attributes for shortcodes
    *
    *-------------------------------------------------------------------------------------*/
  function parse_data_attributes( $data ) {

    $data_props = '';

    if( $data ) {
      $data = explode( '|', $data );

      foreach( $data as $d ) {
        $d = explode( ',', $d );
        $data_props .= sprintf( 'data-%s="%s" ', esc_html( $d[0] ), esc_attr( trim( $d[1] ) ) );
      }
    }
    else { 
      $data_props = false;
    }
    return $data_props;
  }


}

new CSCOShortcodes();
