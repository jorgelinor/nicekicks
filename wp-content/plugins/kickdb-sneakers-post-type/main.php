<?php
if (!function_exists('kickdb_sneakers_custom_post_type')) {
    function kickdb_sneakers_custom_post_type()
    {
        $labels = array(
            'name' => _x('Sneakers', 'Post Type General Name', 'text_domain'),
            'singular_name' => _x(
                'Sneaker',
                'Post Type Singular Name',
                'text_domain'
            ),
            'menu_name' => __('Sneakers', 'text_domain'),
            'name_admin_bar' => __('Sneaker', 'text_domain'),
            'archives' => __('Sneaker Archives', 'text_domain'),
            'attributes' => __('Sneaker Attributes', 'text_domain'),
            'parent_item_colon' => __('Parent Sneaker:', 'text_domain'),
            'all_items' => __('All Sneakers', 'text_domain'),
            'add_new_item' => __('Add New Sneaker', 'text_domain'),
            'add_new' => __('Add New', 'text_domain'),
            'new_item' => __('New Sneaker', 'text_domain'),
            'edit_item' => __('Edit Sneaker', 'text_domain'),
            'update_item' => __('Update Sneaker', 'text_domain'),
            'view_item' => __('View Sneaker', 'text_domain'),
            'view_items' => __('View Sneakers', 'text_domain'),
            'search_items' => __('Search Sneakers', 'text_domain'),
            'not_found' => __('Not found', 'text_domain'),
            'not_found_in_trash' => __('Not found in Trash', 'text_domain'),
            'featured_image' => __('Featured Image', 'text_domain'),
            'set_featured_image' => __('Set featured image', 'text_domain'),
            'remove_featured_image' => __(
                'Remove featured image',
                'text_domain'
            ),
            'use_featured_image' => __('Use as featured image', 'text_domain'),
            'insert_into_item' => __('Insert into sneaker', 'text_domain'),
            'uploaded_to_this_item' => __(
                'Uploaded to this sneaker',
                'text_domain'
            ),
            'items_list' => __('Sneakers list', 'text_domain'),
            'items_list_navigation' => __(
                'Sneakers list navigation',
                'text_domain'
            ),
            'filter_items_list' => __('Filter sneakers list', 'text_domain')
        );
        $rewrite = array(
            'slug' => 'sneakers',
            'with_front' => true,
            'pages' => true,
            'feeds' => true
        );
        $args = array(
            'label' => __('Sneaker', 'text_domain'),
            'description' => __('Post Type Description', 'text_domain'),
            'labels' => $labels,
            'supports' => array('title'),
            'taxonomies' => array('category', 'post_tag'),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => false,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'rewrite' => $rewrite,
            'capability_type' => 'post',
            'show_in_rest' => true,
            'rest_base' => 'sneakers'
        );
        register_post_type('kickdb_sneakers', $args);
    }
}

function kickdb_load_sneaker_template($template)
{
    global $post;

    if (
        $post->post_type == "kickdb_sneakers" &&
        $template !== locate_template(array("single-sneaker.php"))
    ) {
        /* This is a "sneaker" post
         * AND a 'single sneaker template' is not found on
         * theme or child theme directories, so load it
         * from our plugin directory
         */
        return plugin_dir_path(__FILE__) . "/templates/single-sneaker.php";
    }

    return $template;
}

function kickdb_amp_init()
{
    // Enable AMP for the kickdb_sneakers post type
    // Note that we have to disable the support for the calendar pages

    // https://github.com/ahmedkaludi/accelerated-mobile-pages/blob/cc12e8351551b2b41d4bb1759dc1932e3ccf639c/templates/features.php#L150-L152
    // https://github.com/ahmedkaludi/accelerated-mobile-pages/blob/cc12e8351551b2b41d4bb1759dc1932e3ccf639c/templates/features.php#L117-L122
    global $redux_builder_amp;
    $redux_builder_amp['ampforwp-custom-type'][] = 'kickdb_sneakers';
}

function kickdb_amp_set_review_template($file, $type, $post)
{
    if ('single' === $type && 'kickdb_sneakers' === $post->post_type) {
        $file = dirname(__FILE__) . '/templates/single-sneaker-amp.php';
    }
    return $file;
}

function kickdb_sneakers_post_type_activation_hook()
{
    // call your CPT registration function here (it should also be hooked into 'init')
    myplugin_custom_post_types_registration();
    flush_rewrite_rules();
}

function kickdb_include_on_archive_pages_query( $query ) {
  // Show the kickdb_sneakers post type on tag and category pages
  if (is_archive()) {
    $query->set('post_type', array('post', 'kickdb_sneakers'));
  }
}

function set_featured_image_from_gallery() {
  global $post;
  if ($post->post_type === "kickdb_sneakers") {
    $has_thumbnail = get_the_post_thumbnail($post->ID);

    if (!$has_thumbnail) {
      $images = get_field('images', false, false);
      $image_id = $images[0];
      if ($image_id) {
        set_post_thumbnail( $post->ID, $image_id );
      }
    }
  }
}

function init_kickdb_sneakers_post_type() {
    register_deactivation_hook(__FILE__, 'flush_rewrite_rules');
    register_activation_hook(__FILE__, 'myplugin_flush_rewrites');

    add_filter('acf/settings/show_updates', '__return_true', 100);
    add_filter('acf/settings/show_admin', '__return_true', 100);
    add_filter('acf/settings/show_admin', '__return_true', 100);

    add_action('init', 'kickdb_sneakers_custom_post_type', 0);
    add_filter('single_template', 'kickdb_load_sneaker_template');

    add_action('amp_init', 'kickdb_amp_init');
    add_filter('amp_post_template_file', 'kickdb_amp_set_review_template', 10, 3);

    add_action('pre_get_posts', 'kickdb_include_on_archive_pages_query' );

    add_action('save_post', 'set_featured_image_from_gallery');

    require plugin_dir_path(__FILE__) . 'acf-bidirectional-relationship.php';

    require plugin_dir_path(__FILE__) . 'kickdb-sneakers-calendar.php';

    init_kickdb_sneakers_calendar();
}
