<?php
$KICK_DB_SERVER_URL = false ? "http://localhost:3001" : "https://s.kickdb.com";
function init_kickdb() {
  function encode($s) {
    return htmlspecialchars($s, ENT_QUOTES, false);
  }

  function kickdb_amp_head( $amp_template ) {
    ?>
      <script async custom-element="amp-list" src="https://cdn.ampproject.org/v0/amp-list-0.1.js"></script>
      <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.1.js"></script>
    <?php
  }

  function firstUpper($term) {
    if (!$term) {
      return NULL;
    }
    $arr = explode(',', $term);
    if (count($arr) == 0) {
      return NULL;
    }
    return strtoupper(trim($arr[0]));
  }


  function kickdb_amp_css( $amp_template ) {
  	// only CSS here please...
  	?>
    .kickdb-embed {
      box-sizing: border-box;
      border: 1px solid #ddd;
      margin: 10px 0;
      border-radius: 5px;
      font-size: 0.8rem;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen-Sans", "Ubuntu", "Cantarell", "Helvetica Neue", sans-serif;
      background: #fff;
    }
    .amp-kickdb-list {
    }
    .kickdb-item {
      display: -webkit-box;
      display: flex;
      -webkit-box-orient: horizontal;
      -webkit-box-direction: normal;
      flex-direction: row;
      -webkit-box-pack: center;
      justify-content: center;
      -webkit-box-align: center;
      align-items: center;
      color: #696969;
      padding: 0.25rem 0.5rem;
    }
    a.kickdb-item, a:visited.kickdb-item, a:hover.kickdb-item {
      color: #696969;
    }
    .kickdb-item .img {
      width: 80px;
      height: 80px;
      position: relative;
    }
    .kickdb-item .img img {
      -o-object-fit: contain;
      object-fit: contain;
    }
    .kickdb-item .details {
      line-height: 1.1rem;
      -webkit-box-flex: 1;
      flex: 1;
      padding: 0 0.5rem;
    }
    .kickdb-item .title {
      font-size: 0.8rem;
      line-height: 0.8rem;
    }
    .kickdb-item .right {
      display: -webkit-box;
      display: flex;
      -webkit-box-orient: vertical;
      -webkit-box-direction: normal;
      flex-direction: column;
      -webkit-box-align: center;
      align-items: center;
      -webkit-box-pack: center;
      justify-content: center;
    }
    .kickdb-item .price, .kickdb-item .compare_at_price {
      line-height: 1rem;

    }
    .kickdb-item .compare_at_price {
      text-decoration: line-through;
      color: #e94448;
    }
    .kickdb-item .price {
      color: #3479db;
    }
    .kickdb-item .profile {
      border-radius: 50%;
      margin-bottom: 5px;
    }
    .kickdb-item:hover {
      background: #f4f3f3;
    }
    .kickdb-item:hover, .kickdb-item:hover .title {
      color: #3479db;
    }
    .kickdb-cta {
      text-align: center;
      width: 100%;
      display: -webkit-box;
      display: flex;
      -webkit-box-align: center;
      align-items: center;
      -webkit-box-pack: center;
      justify-content: center;
      border-bottom: 1px solid #ddd;
    }
    .kickdb-cta .cta-container {
      display: -webkit-box;
      display: flex;
      background: #fff;
      color: #696969;
      width: auto;
      border-radius: 1rem;
      border: 1px solid #ddd;
      overflow: hidden;
      -webkit-box-align: stretch;
      align-items: stretch;
      -webkit-box-flex: 1;
      flex: 1;
      margin: 0.5rem 0.25rem;
    }
    .kickdb-cta .input {
      padding: 0.25rem 1rem;
      background: #f4f3f3;
      border-right: 1px solid #ddd;
      display: -webkit-box;
      display: flex;
      -webkit-box-align: center;
      align-items: center;
      -webkit-box-flex: 1;
      flex: 1;
      line-height: 1rem;
      text-overflow: ellipsis;
      white-space: nowrap;
      overflow: hidden;
    }
    .kickdb-cta .input .icon {
      padding-right: 0.5rem;
      display: -webkit-box;
      display: flex;
      -webkit-box-align: center;
      align-items: center;
      font-size: 1rem;
      color: #3479db;
    }
    .kickdb-cta .button {
      background: #fff;
      padding: 0.25rem 1rem;
      display: -webkit-box;
      display: flex;
      -webkit-box-align: center;
      align-items: center;
      color: #3479db;
    }
    .amp-kickdb-list .list-overflow {
      text-align: center;
      width: 100%;
      padding: 0.5rem;
      display: -webkit-box;
      display: flex;
      -webkit-box-align: center;
      align-items: center;
      -webkit-box-pack: center;
      justify-content: center;
      background: linear-gradient(rgba(255, 255, 255, 0), rgba(255, 255, 255, 1));
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
    }
    .list-overflow div {
      background: #fff;
      color: #4080dd;
      width: auto;
      padding: 0.25rem 1rem;
      border-radius: 3rem;
      border: 1px solid #4080dd;
    }
  	<?php
  }

  function kickdb_amp_func($keywords, $stylecodes) {
    global $KICK_DB_SERVER_URL;
    add_action( 'amp_post_template_head', 'kickdb_amp_head' );
    add_action( 'amp_post_template_css', 'kickdb_amp_css' );
    $id = uniqid();

    if (empty($keywords) && empty($stylecodes)) {
      global $post;
      $title = get_the_title($post->id);
      $tags = array_map(function($term) { return $term->name; }, wp_get_post_terms($post->ID, 'post_tag'));
      $cats = array_map(function($term) { return $term->name; }, wp_get_post_terms($post->ID, 'category'));
    }

    $query = http_build_query(array(
      'id' => $id,
      'k' => $keywords,
      's' => $stylecodes,
      'title' => $title,
      'tags' => $tags,
      'cats' => $cats,
      'loc' => "AMPDOC_URL",
    ));

    $searchUrl = "https://kickdb.com/search";

  	return <<<EOT
    <div class="kickdb-embed" data-asdf="$KICK_DB_SERVER_URL">
      <div class="kickdb-cta">
        <a href="$searchUrl" class="cta-container" target="_blank">
          <div class="input">
            <div class="icon">
              <svg width="1em" height="1em" fill="currentColor" data-id="geomicon-search" viewBox="0 0 32 32" data-reactid="22"><path d="M12 0 A12 12 0 0 0 0 12 A12 12 0 0 0 12 24 A12 12 0 0 0 18.5 22.25 L28 32 L32 28 L22.25 18.5 A12 12 0 0 0 24 12 A12 12 0 0 0 12 0 M12 4 A8 8 0 0 1 12 20 A8 8 0 0 1 12 4" data-reactid="23"></path></svg>
            </div>
          </div>
          <div class="button">
            Search KickDB
          </div>
        </a>
      </div>
      <amp-list
        id="$id"
        layout="fixed-height"
        height="200"
        src="$KICK_DB_SERVER_URL/shortcode/v1/amp?$query&client=CLIENT_ID(kickdb)"
        class="amp-kickdb-list"
      >
        <template type="amp-mustache">
          <div>
            <a href="$KICK_DB_SERVER_URL/{{tracking_url}}" class="kickdb-item" target="_blank">
              <div class="img">
                <amp-img
                  alt="{{title}}"
                  height="80"
                  width="80"
                  layout="responsive"
                  src="{{featured_image}}"
                />
              </div>
              <div class="details">
                <div class="title">{{ title }}</div>
              </div>
              <div class="right">
                <amp-img height="20" width="20"
                  src="{{site_img}}"
                  class="profile"
                  alt="{{site_name}}"
                ></amp-img>
                  <span class="compare_at_price">{{ compare_at_price }}</span>
                  <span class="price">{{ price }}</span>
              </div>
            </a>
          </div>
        </template>
        <div overflow class="list-overflow">
          <div>View more</div>
        </div>
      </amp-list>
    </div>
EOT;
  }

  function kickdb_html_func($keywords, $stylecodes) {
    global $KICK_DB_SERVER_URL;
    $script = "$KICK_DB_SERVER_URL/shortcode/shortcode.v1.js";
    wp_enqueue_script('kickdb-links-script', $script);
    $id = uniqid();

    if (empty($keywords) && empty($stylecodes)) {
      global $post;
      $title = get_the_title($post->id);
      $tags = array_map(function($term) { return $term->name; }, wp_get_post_terms($post->ID, 'post_tag'));
      $cats = array_map(function($term) { return $term->name; }, wp_get_post_terms($post->ID, 'category'));

      $tagsStr = implode(",", $tags);
      $catsStr = implode(",", $cats);
    }

    $id = htmlspecialchars($id);
    $stylecodes = htmlspecialchars($stylecodes);
    $keywords = htmlspecialchars($keywords);
    $title = htmlspecialchars($title);
    $tagsStr = htmlspecialchars($tagsStr);
    $catsStr = htmlspecialchars($catsStr);

    return <<<EOT
      <span
        class="kickdb-links-shortcode" style="display: none;"
        id="kickdb-$id"
        data-stylecodes="$stylecodes"
        data-keywords="$keywords"
        data-title="$title"
        data-tags="$tagsStr"
        data-cats="$catsStr"
      ></span>
EOT;
  }

  function kickdb_shortcode( $atts ) {
    try {
      $stylecodes = encode(current(array_filter([
        $atts['stylecodes'], $atts['stylecode'], $atts['styles'], $atts['style'], $atts['codes'], $atts['code']
      ])));

      $keywords = encode(current(array_filter([
        $atts['keywords'], $atts['keyword']
      ])));

      if (function_exists('is_amp_endpoint') && is_amp_endpoint()) {
        return kickdb_amp_func($keywords, $stylecodes);
      }

      return kickdb_html_func($keywords, $stylecodes);
    }
    catch (Exception $ex) {
      global $sentryClient;
      $sentryClient->captureException($ex);
      return "";
    }
  }

  function kickdb_after_content($content) {
    // https://wordpress.stackexchange.com/questions/225721/hook-added-to-the-content-seems-to-be-called-multiple-times
    if (!in_the_loop() || !is_singular() || !is_main_query()) {
        return $content;
    }

    if (function_exists('is_amp_endpoint') && is_amp_endpoint()) {
      return $content;
    }
    if (strpos($content, '[kickdb') !== false) {
      return $content;
    }
    if (!is_single()) {
      return $content;
    }

    // Don't show the KickDB plugin after sneaker custom post types
    if (is_singular('kickdb_sneakers')) {
      return $content;
    }

    $html = kickdb_html_func("", "");
    return $content . $html;
  }

  function kickdb_amp_after_content($data) {
    if (strpos($data["post_amp_content"], 'amp-kickdb') !== false) {
      return $data;
    }

    // Don't show the KickDB plugin after sneaker custom post types
    // the amp template needs to run the_content() to show ads
    if (is_singular('kickdb_sneakers')) {
      // For some reason, these actions are not  triggered when kickdb_amp_func
      // is called for a shortcode.
      add_action( 'amp_post_template_head', 'kickdb_amp_head' );
      add_action( 'amp_post_template_css', 'kickdb_amp_css' );
      return $data;
    }

    $data["post_amp_content"] = $data["post_amp_content"] . kickdb_amp_func("", "");

    return $data;
  }

  function kickdb_ampforwp_after_post_content() {
    echo kickdb_amp_func("", "");
  }

  function kickdb_amp_pixel($data) {
    global $KICK_DB_SERVER_URL;

    // Can't include CLIENT_ID(kickdb) here because parens becomes encoded
    $query = http_build_query(array(
      "url" => "AMPDOC_URL",
      "viewer" => "VIEWER",
      "viewportHeight" => "VIEWPORT_HEIGHT",
      "viewportWidth" => "VIEWPORT_WIDTH",
      "sh" => "SCREEN_HEIGHT",
      "sw" => "SCREEN_WIDTH",
      "ah" => "AVAILABLE_SCREEN_HEIGHT",
      "aw" => "AVAILABLE_SCREEN_WIDTH",
      "v" => "AMP_VERSION",
      "ua" => "USER_AGENT",
      "pid" => "PAGE_VIEW_ID",
      "nt" => "NAV_TYPE",
      "ref" => "EXTERNAL_REFERRER",
    ));

    $pixelHtml = <<<EOT
      <amp-pixel src="$KICK_DB_SERVER_URL/pixel/amp/?client=CLIENT_ID(kickdb)&$query" layout="nodisplay"></amp-pixel>
EOT;
    $data["post_amp_content"] = $pixelHtml . $data["post_amp_content"];
    return $data;
  }

  require_once 'sentry-php-master/lib/Raven/Autoloader.php';
  Raven_Autoloader::register();
  $sentryClient = new Raven_Client('https://b7951ee17b7e4dc5918b0058abff854c:20c4766dcc874620832a797c9d7f5ec2@sentry.io/276343', array(
    'send_callback' => function($data) {
        foreach ($data["exception"]["values"] as $ex) {
          foreach ($ex["stacktrace"]["frames"] as $frame) {
              if (strpos($frame["filename"], "kickdb") !== false && strpos($frame["filename"], "sentry-php-master") === false) {
                return true;
              }
            }
          }
        return false;
      }
  ));

  $error_handler = new Raven_ErrorHandler($sentryClient);
  $error_handler->registerExceptionHandler();
  $error_handler->registerErrorHandler();
  $error_handler->registerShutdownFunction();

  try {
    add_filter('amp_post_template_data', 'kickdb_amp_pixel');

    // In production on nicekicks.com the amp_post_template_data hook runs but
    // the changes it makes get replaced by something else.
    // So instead use the ampforwp specific hook.
    global $redux_builder_amp;
    if (isset($redux_builder_amp)) {
      add_filter('amp_post_template_data', 'kickdb_amp_after_content');
    }
    else {
      add_action('ampforwp_after_post_content', 'kickdb_ampforwp_after_post_content');
    }

    add_action('the_content', 'kickdb_after_content');
    add_shortcode('kickdb', 'kickdb_shortcode');
  }
  catch (Exception $ex) {
    global $sentryClient;
    $sentryClient->captureException($ex);
  }
}
