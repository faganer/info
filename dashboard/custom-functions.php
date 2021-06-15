<?php
/**
 * 版本更新提示
 */
function pageNotice(){?>
  <?php
  // 获取主题信息
  $theme = wp_get_theme();
  $verCurrent = floatval($theme->Version);
  $response = wp_remote_get( 'https://wpmore.cn/wp-content/uploads/themes/info.json' );

      if ( is_array( $response ) && ! is_wp_error( $response ) ) {
          $arr=(array)json_decode($response['body'],true);
          $verUpdate = floatval($arr['version']);
          if(($verCurrent - $verUpdate) <0 ){
              echo  '<div class="notice notice-success is-dismissible"><p>主题有版本更新：'.$verUpdate.'，查看<a href="https://wpmore.cn/wordpress-theme-info.html">详情</a>。</p></div>';
          }
      }

  }

add_action('admin_notices', 'pageNotice');// 这是后台全局提示

/**
 * Quicktags API
 * http://codex.wordpress.org.cn/Quicktags_API.
 */
// add more buttons to the html editor
function appthemes_add_quicktags()
{
    if (wp_script_is('quicktags')) {
        ?>
    <script type="text/javascript">
		QTags.addButton( 'eg_h2', 'H2', '<h2>', '</h2>', 'h2', '', 1 );
        QTags.addButton( 'eg_h3', 'H3', '<h3>', '</h3>', 'h3', '', 2 );
		QTags.addButton( 'eg_html', 'html', '<pre><code class="html">', '</code></pre>', 'html', 'highlight.js html', 111 );
        QTags.addButton( 'eg_javascript', 'JavaScript', '<pre><code class="javascript">', '</code></pre>', 'JavaScript', 'highlight.js JavaScript', 112 );
        QTags.addButton( 'eg_bash', 'bash', '<pre><code class="bash">', '</code></pre>', 'bash', 'highlight.js bash', 113 );
    </script>
<?php
    }
}
add_action('admin_print_footer_scripts', 'appthemes_add_quicktags');

/**
 * add more button and pupo to the TinyMCE editor.
 */
// 挂载函数到正确的钩子
function my_add_mce_button()
{
    // 检查用户权限
    if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
        return;
    }
    // 检查是否启用可视化编辑
    if ('true' == get_user_option('rich_editing')) {
        add_filter('mce_external_plugins', 'my_add_tinymce_plugin');
        add_filter('mce_buttons', 'my_register_mce_button');
    }
}
add_action('admin_head', 'my_add_mce_button');

// 声明新按钮的脚本
function my_add_tinymce_plugin($plugin_array)
{
    $plugin_array['my_mce_button'] = get_template_directory_uri().'/dist/js/mce-button.min.js';
    $plugin_array['table'] = get_template_directory_uri().'/dist/js/mce-button.min.js';
    // $plugin_array = get_template_directory_uri() .'/dist/js/mce-button.min.js';
    return $plugin_array;
}

// 在编辑器上注册新按钮
function my_register_mce_button($buttons)
{
    array_push($buttons, 'my_mce_button', 'table');
    // array_push( $buttons, 'my_mce_button' );
    return $buttons;
}

/*
 * 添加和移除用户联系信息字段
 */
add_filter('user_contactmethods', 'wpdaxue_add_contact_fields');
function wpdaxue_add_contact_fields($contactmethods)
{
    $contactmethods['qq'] = 'QQ';
    $contactmethods['weibo'] = '微博';
    $contactmethods['wechat'] = '微信';
    $contactmethods['alipay'] = '支付宝';
    unset($contactmethods['yim']);
    unset($contactmethods['aim']);
    unset($contactmethods['jabber']);
    unset($contactmethods['facebook']);
    unset($contactmethods['instagram']);
    unset($contactmethods['linkedin']);
    unset($contactmethods['myspace']);
    unset($contactmethods['pinterest']);
    unset($contactmethods['soundcloud']);
    unset($contactmethods['tumblr']);
    unset($contactmethods['twitter']);
    unset($contactmethods['youtube']);
    unset($contactmethods['wikipedia']);

    return $contactmethods;
}

/**
 * 如何自定义WordPress的登录页面（Logo/链接/文本）
 * https://www.wpdaxue.com/custom-wordpress-login-page.html.
 */
function my_custom_login_logo()
{
    echo '<style type="text/css">
        .login h1 a {
            background:url("'.get_template_directory_uri().'/dist/images/logo.png") center center no-repeat!important;
        height: 60px;
        width: 250px;
        }
    </style>';
}
add_action('login_head', 'my_custom_login_logo');

/**
 * 可视化编辑器样式
 * http://codex.wordpress.org.cn/Function_Reference/add_editor_style.
 */
function my_theme_add_editor_styles()
{
    $ver = md5(get_template_directory_uri().'/dist/css/editor-style.min.css');
    add_editor_style(get_template_directory_uri().'/dist/css/editor-style.min.css?'.$ver);
}
add_action('init', 'my_theme_add_editor_styles');

/*
 * 彻底关闭后台主题自定义功能
 * https://blog.wpjam.com/m/disable-wordpress-theme-customize/
 */
add_filter('map_meta_cap', function ($caps, $cap) {
    if ($cap == 'customize') {
        return ['do_not_allow'];
    }

    return $caps;
}, 10, 2);

/**
 * Register a meta box using a class.
 */
class WPDocs_Custom_Meta_Box
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        if (is_admin()) {
            add_action('load-post.php', array($this, 'init_metabox'));
            add_action('load-post-new.php', array($this, 'init_metabox'));
        }
    }

    /**
     * Meta box initialization.
     */
    public function init_metabox()
    {
        add_action('add_meta_boxes', array($this, 'add_metabox'));
        add_action('save_post', array($this, 'save_metabox'), 10, 2);
    }

    /**
     * Adds the meta box.
     */
    public function add_metabox()
    {
        add_meta_box(
            'AipNlp-meta-box',
            __('分词', 'textdomain'),
            array($this, 'render_metabox'),
            'post',
            'advanced',
            'default'
        );
    }

    /**
     * Renders the meta box.
     */
    public function render_metabox($post)
    {
        // Add nonce for security and authentication.
        wp_nonce_field('custom_nonce_action', 'custom_nonce');

        // 获取文章信息
        $title = $post->post_title;
        $content = $post->post_content;

        // 判断文章标题和内容是否为空
        if (!empty($title) && !empty($content)) {
            /**
             * 调用自然语言
             */
            require_once get_template_directory().'/dashboard/aip-php-sdk/AipNlp.php';

            // 你的 APPID AK SK
            define('APP_ID', '16186871');
            define('API_KEY', '2vg48KKFYTKUGaIbYA2QXuw9');
            define('SECRET_KEY', 'cwjxVMKZUO9jpZS7pROLoEqfGcAzxj7N');

            $client = new AipNlp(APP_ID, API_KEY, SECRET_KEY);

            // ================== 文章标签 ==================
            $client->keyword($title, $content);
            $keyword = $client->keyword($title, $content);

            // ================== 新闻摘要接口 ==================
            $maxSummaryLen = 200;

            // 如果有可选参数
            $options = array();
            $options['title'] = $title;

            // 带参数调用新闻摘要接口
            $client->newsSummary($content, $maxSummaryLen, $options);
            $summary = $client->newsSummary($content, $maxSummaryLen, $options);

            // 输出文章标签
            echo '<pre style="white-space: normal;">文章标签：';
            $numItems = count($keyword);
            $i = 0;
            foreach ($keyword as $key => $value) {
                if (++$i === $numItems) {
                    $tags = array_column($value, 'tag');
                    echo $tag = implode(',', $tags);
                }
            }
            echo '</pre>';

            // 输出新闻摘要
            echo '<pre style="white-space: normal;">新闻摘要：';
            //echo $summary;
            print_r($summary[summary]);
            echo '</pre>';
        }
    }

    /**
     * Handles saving the meta box.
     *
     * @param int     $post_id post ID
     * @param WP_Post $post    post object
     *
     * @return null
     */
    public function save_metabox($post_id, $post)
    {
        // Add nonce for security and authentication.
        $nonce_name = isset($_POST['custom_nonce']) ? $_POST['custom_nonce'] : '';
        $nonce_action = 'custom_nonce_action';

        // Check if nonce is valid.
        if (!wp_verify_nonce($nonce_name, $nonce_action)) {
            return;
        }

        // Check if user has permissions to save data.
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        // Check if not an autosave.
        if (wp_is_post_autosave($post_id)) {
            return;
        }

        // Check if not a revision.
        if (wp_is_post_revision($post_id)) {
            return;
        }
    }
}

new WPDocs_Custom_Meta_Box();


/**
 * 使用内存缓存优化 WordPress 后台媒体库加载
 * https://wpmore.cn/memory-cache-optimization-wordpress-background-media-library-loading.html
 */
// 缓存获取附件的月份。
add_filter('media_library_months_with_files', function($months){
    $months    = get_transient('getkit_media_library_months');

    if($months === false) {
        global $wpdb;

        $months = $wpdb->get_results("SELECT DISTINCT YEAR( post_date ) AS year, MONTH( post_date ) AS month FROM $wpdb->posts WHERE post_type = 'attachment' ORDER BY post_date DESC");

        set_transient('getkit_media_library_months', $months, WEEK_IN_SECONDS);
    }

    return $months;
});

// 删除附件月份的缓存
function getkit_delete_media_library_months_cache(){
    delete_transient('getkit_media_library_months');
}
add_action('edit_attachment',    'getkit_delete_media_library_months_cache');
add_action('add_attachment',    'getkit_delete_media_library_months_cache');
add_action('delete_attachment',    'getkit_delete_media_library_months_cache');
