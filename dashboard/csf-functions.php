<?php

$csf = get_option('_prefix_my_options'); // unique id of the framework

/**
 * field.
 */
$fields = ['favicon','tbaidu','tbing','tgoogle','tyandex','t360','tsogou','ttoutiao','tshenma','push-1','push-2','analytics-1','push-3'];
foreach ($fields as $field) {
    $csf['opt-'.$field];
}

/**
 * favicon
 */
if ($csf['opt-favicon']) {
    add_action('wp_head', 'favicon', 98);
    function favicon()
    {
        echo '<link rel="icon" href="'.get_option('_prefix_my_options')['opt-favicon']['url'].'?x-oss-process=image/auto-orient,1/resize,m_fixed,w_32,h_32/quality,q_98/format,webp" sizes="32x32" />'.PHP_EOL;
        echo '<link rel="icon" href="'.get_option('_prefix_my_options')['opt-favicon']['url'].'?x-oss-process=image/auto-orient,1/resize,m_fixed,w_192,h_192/quality,q_98/format,webp" sizes="192x192" />'.PHP_EOL;
        echo '<link rel="apple-touch-icon-precomposed" href="'.get_option('_prefix_my_options')['opt-favicon']['url'].'?x-oss-process=image/auto-orient,1/resize,m_fixed,w_180,h_180/quality,q_98/format,webp" />'.PHP_EOL;
        echo '<meta name="msapplication-TileImage" content="'.get_option('_prefix_my_options')['opt-favicon']['url'].'?x-oss-process=image/auto-orient,1/resize,m_fixed,w_270,h_270/quality,q_98/format,webp" />'.PHP_EOL;
    }
}

// 百度验证码
if ($csf['opt-tbaidu']) {
    add_action('wp_head', 'tbaidu', -1);
    function tbaidu() {
        echo '<meta name="baidu-site-verification" content="'.get_option('_prefix_my_options')['opt-tbaidu'].'" />'.PHP_EOL;
    }
}

// Bing 验证码
if ($csf['opt-tbing']) {
    add_action('wp_head', 'tbing', -2);
    function tbing() {
        echo '<meta name="msvalidate.01" content="'.get_option('_prefix_my_options')['opt-tbing'].'" />'.PHP_EOL;
    }
}

// Google 验证码
if ($csf['opt-tgoogle']) {
    add_action('wp_head', 'tgoogle', -3);
    function tgoogle() {
        echo '<meta name="google-site-verification" content="'.get_option('_prefix_my_options')['opt-tgoogle'].'" />'.PHP_EOL;
    }
}

// Yandex 验证码
if ($csf['opt-tyandex']) {
    add_action('wp_head', 'tyandex', -4);
    function tyandex() {
        echo '<meta name="yandex-verification" content="'.get_option('_prefix_my_options')['opt-tyandex'].'" />'.PHP_EOL;
    }
}

// 360 验证码
if ($csf['opt-t360']) {
    add_action('wp_head', 't360', -5);
    function t360() {
        echo '<meta name="360-site-verification" content="'.get_option('_prefix_my_options')['opt-t360'].'" />'.PHP_EOL;
    }
}

// 搜狗验证码
if ($csf['opt-tsogou']) {
    add_action('wp_head', 'tsogou', -6);
    function tsogou() {
        echo '<meta name="sogou_site_verification" content="'.get_option('_prefix_my_options')['opt-tsogou'].'" />'.PHP_EOL;
    }
}

// 头条验证码
if ($csf['opt-ttoutiao']) {
    add_action('wp_head', 'ttoutiao', -7);
    function ttoutiao() {
        echo '<meta name="toutiao-site-verification" content="'.get_option('_prefix_my_options')['opt-ttoutiao'].'" />'.PHP_EOL;
    }
}

// 神马验证码
if ($csf['opt-tshenma']) {
    add_action('wp_head', 'tshenma', -7);
    function tshenma() {
        echo '<meta name="shenma-site-verification" content="'.get_option('_prefix_my_options')['opt-tshenma'].'" />'.PHP_EOL;
    }
}

// 百度自动推送
if ($csf['opt-push-1']) {
    add_action('wp_footer', 'opt_push_1', 97);
    function opt_push_1()
    {
        if (get_option('_prefix_my_options')['opt-push-1'] == '1') {
            ?>
<script>
(function(){
var bp = document.createElement('script');
var curProtocol = window.location.protocol.split(':')[0];
if (curProtocol === 'https') {
    bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
}
else {
    bp.src = 'http://push.zhanzhang.baidu.com/push.js';
}
var s = document.getElementsByTagName("script")[0];
s.parentNode.insertBefore(bp, s);
})();
</script>
        <?php
        }
    }
}

// 百度主动推送
if ($csf['opt-push-2']) {
    add_action('wp_footer', 'opt_push_2', 98);
    function opt_push_2()
    {
        global $csf;
        if (!empty(get_option('_prefix_my_options')['opt-push-2']) && is_single()) {
            $webhome = get_option('home'); // home

            $urls = array(
                get_the_permalink(),
            );
            $api = 'http://data.zz.baidu.com/urls?site='.$webhome.'&token='.get_option('_prefix_my_options')['opt-push-2'];
            $ch = curl_init();
            $csfions = array(
            CURLOPT_URL => $api,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => implode("\n", $urls),
            CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
            );
            curl_setopt_array($ch, $csfions);
            $result = curl_exec($ch);

            // echo '<!-- 百度主动推送调试结果 开始 -->'. "\n";
            // echo '<!-- api:'.$api.' -->'. "\n";
            // echo '<!-- return:'.$result.' -->'. "\n";
            // echo '<!-- 百度主动推送调试结果 结束 -->'. "\n";
        }
    }
}

// 360 自动收录
if ($csf['opt-push-3']) {
    add_action('wp_footer', 'opt_push_3', 99);
    function opt_push_3()
    {
        if (!empty(get_option('_prefix_my_options')['opt-push-3'])) {
            ?>
<script>
(function(){
var src = "https://s.ssl.qhres2.com/ssl/<?php echo get_option('_prefix_my_options')['opt-push-3']; ?>.js";
document.write('<script src="' + src + '" id="sozz"><\/script>');
})();
</script>
        <?php
        }
    }
}

// 百度统计
if (!function_exists($csf['opt-analytics-1'])) {
    add_action('wp_head', 'baidu_statistics', 99);
    function baidu_statistics()
    {
        global $csf;
        if (!empty(get_option('_prefix_my_options')['opt-analytics-1'])) {
            echo '<script>
var _hmt = _hmt || [];
(function() {
var hm = document.createElement("script");
hm.src = "https://hm.baidu.com/hm.js?'.get_option('_prefix_my_options')['opt-analytics-1'].'";
var s = document.getElementsByTagName("script")[0];
s.parentNode.insertBefore(hm, s);
})();
</script>'.PHP_EOL;
        }
    }
}

/**
 * WordPress移除后台左上角 WordPress Logo
 * https://wpmore.cn/wordpress-removes-the-top-left-corner-of-the-background-wordpress-logo.html
 */
if(empty(get_option('_prefix_my_options')['opt-func-1']) || get_option('_prefix_my_options')['opt-func-1'] === '0'){
	function annointed_admin_bar_remove() {
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu('wp-logo');
	}
	add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);
}

/**
 * 移除WordPress版本号
 * https://wpmore.cn/remove-wp_generator.html
 */
if(empty(get_option('_prefix_my_options')['opt-func-2']) || get_option('_prefix_my_options')['opt-func-2'] === '0'){
	remove_action('wp_head', 'wp_generator');
}

/**
 * WordPress 禁用 Emoji 功能
 * https://wpmore.cn/wordpress-%e7%a6%81%e7%94%a8-emoji-%e5%8a%9f%e8%83%bd.html
 */
if(empty(get_option('_prefix_my_options')['opt-func-3']) || get_option('_prefix_my_options')['opt-func-3'] === '0'){
	remove_action('admin_print_scripts',    'print_emoji_detection_script');
	remove_action('admin_print_styles',    'print_emoji_styles');

	remove_action('wp_head',        'print_emoji_detection_script',    7);
	remove_action('wp_print_styles',    'print_emoji_styles');

	remove_action('embed_head',        'print_emoji_detection_script');

	remove_filter('the_content_feed',    'wp_staticize_emoji');
	remove_filter('comment_text_rss',    'wp_staticize_emoji');
	remove_filter('wp_mail',        'wp_staticize_emoji_for_email');

	add_filter( 'emoji_svg_url',        '__return_false' );
}

/**
 * WordPress后台加载慢？load-scripts.php、load-styles.php不合并JS、CSS
 * https://wpmore.cn/wordpress%e5%90%8e%e5%8f%b0%e5%8a%a0%e8%bd%bd%e6%85%a2%ef%bc%9fload-scripts-php%e3%80%81load-styles-php%e4%b8%8d%e5%90%88%e5%b9%b6js%e3%80%81css.html
 */
if(empty(get_option('_prefix_my_options')['opt-func-5']) || get_option('_prefix_my_options')['opt-func-5'] === '0'){
	define('CONCATENATE_SCRIPTS', false);
}

/**
 * WordPress禁止Embed引入文章
 * https://wpmore.cn/disable-embed.html
 */
if(empty(get_option('_prefix_my_options')['opt-func-6']) || get_option('_prefix_my_options')['opt-func-6'] === '0'){
	remove_action( 'rest_api_init', 'wp_oembed_register_route' );
	remove_filter( 'rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4 );

	add_filter( 'embed_oembed_discover', '__return_false' );

	remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
	remove_filter( 'oembed_response_data',   'get_oembed_response_data_rich',  10, 4 );

	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );

	add_filter('tiny_mce_plugins', function ($plugins){
		return array_diff( $plugins, ['wpembed'] );
	});
}

/**
 * 如何禁用WordPress Auto Embeds (oEmbed)
 * https://wpmore.cn/disabled-auto-embeds.html
 */
if(empty(get_option('_prefix_my_options')['opt-func-7']) || get_option('_prefix_my_options')['opt-func-7'] === '0'){
	remove_filter('the_content',			[$GLOBALS['wp_embed'], 'run_shortcode'], 8);
	remove_filter('widget_text_content',	[$GLOBALS['wp_embed'], 'run_shortcode'], 8);

	remove_filter('the_content',			[$GLOBALS['wp_embed'], 'autoembed'], 8);
	remove_filter('widget_text_content',	[$GLOBALS['wp_embed'], 'autoembed'], 8);

	remove_action('edit_form_advanced',		[$GLOBALS['wp_embed'], 'maybe_run_ajax_cache']);
	remove_action('edit_page_form',			[$GLOBALS['wp_embed'], 'maybe_run_ajax_cache']);
}

/**
 * WordPress主题开发能不加载语言包就不要吧
 * https://wpmore.cn/wordpress-try-not-to-use-load_-theme_-textdomain.html
 */
if(empty(get_option('_prefix_my_options')['opt-func-8']) || get_option('_prefix_my_options')['opt-func-8'] === '0'){
	add_filter('locale', function($locale) {
    $locale = ( is_admin() ) ? $locale : 'en_US';
    return $locale;
	});
}

/**
 * 移除 WordPress 的 Admin Bar
 * https://wpmore.cn/remove-admin_bar.html
 */
if( empty(get_option('_prefix_my_options')['opt-func-9']) || get_option('_prefix_my_options')['opt-func-9'] === '0'){
	add_filter( 'show_admin_bar', '__return_false' );
}

/**
 * 屏蔽站点管理员邮箱验证功能
 * https://wpmore.cn/disabled-admin_email_check_interval.html
 */
if( empty(get_option('_prefix_my_options')['opt-func-10']) || get_option('_prefix_my_options')['opt-func-10'] === '0'){
	add_filter('admin_email_check_interval', '__return_false');
}


/**
 * 移除短链接shortlink
 * https://wpmore.cn/remove-shortlink.html
 */
if( empty(get_option('_prefix_my_options')['opt-func-32']) || get_option('_prefix_my_options')['opt-func-32'] === '0'){
	remove_action('wp_head','wp_shortlink_wp_head',10,0);
	remove_action('template_redirect','wp_shortlink_header',11,0);
}

/**
 * WordPress禁用XML-RPC功能
 * https://wpmore.cn/disable-wordpress-xml-rpc-functionality.html
 */
if( empty(get_option('_prefix_my_options')['opt-func-11']) || get_option('_prefix_my_options')['opt-func-11'] === '0'){
	add_filter('xmlrpc_enabled', '__return_false');
}

/**
 * 屏蔽Trackbacks
 */
if( empty(get_option('_prefix_my_options')['opt-func-12']) || get_option('_prefix_my_options')['opt-func-12'] === '0'){
	if(get_option('_prefix_my_options')['opt-func-12'] === '0'){
			//彻底关闭 pingback
			add_filter('xmlrpc_methods',function($methods){
				return array_merge($methods, [
					'pingback.ping'						=> '__return_false',
					'pingback.extensions.getPingbacks'	=> '__return_false'
				]);
			});
	}

	//禁用 pingbacks, enclosures, trackbacks
	remove_action( 'do_pings', 'do_all_pings', 10 );

	//去掉 _encloseme 和 do_ping 操作。
	remove_action( 'publish_post','_publish_post_hook',5 );
}

/**
 * 屏蔽WordPress REST API
 * https://wpmore.cn/disable-rest-api.html
 */
if( empty(get_option('_prefix_my_options')['opt-func-13']) || get_option('_prefix_my_options')['opt-func-13'] === '0'){
	remove_action('init',			'rest_api_init' );
	remove_action('rest_api_init',	'rest_api_default_filters', 10 );
	remove_action('parse_request',	'rest_api_loaded' );

	add_filter('rest_enabled',		'__return_false');
	// add_filter('rest_jsonp_enabled','__return_false');

	// 移除头部 wp-json 标签和 HTTP header 中的 link
	remove_action('wp_head',			'rest_output_link_wp_head', 10 );
	remove_action('template_redirect',	'rest_output_link_header', 11);

	remove_action('xmlrpc_rsd_apis',	'rest_output_rsd');

	remove_action('auth_cookie_malformed',		'rest_cookie_collect_status');
	remove_action('auth_cookie_expired',		'rest_cookie_collect_status');
	remove_action('auth_cookie_bad_username',	'rest_cookie_collect_status');
	remove_action('auth_cookie_bad_hash',		'rest_cookie_collect_status');
	remove_action('auth_cookie_valid',			'rest_cookie_collect_status');
	remove_filter('rest_authentication_errors',	'rest_cookie_check_errors', 100 );
}

/**
 * WordPress禁用RSS Feed
 * https://wpmore.cn/disable-rss-feed.html
 */
if( empty(get_option('_prefix_my_options')['opt-func-14']) || get_option('_prefix_my_options')['opt-func-14'] === '0'){
	// 删除 wp_head 输入到模板中的feed地址链接
	add_action( 'wp_head', 'wpse33072_wp_head', 1 );
	function wpse33072_wp_head() {
		remove_action( 'wp_head', 'feed_links', 2 );
		remove_action( 'wp_head', 'feed_links_extra', 3 );
	}

	foreach( array( 'rdf', 'rss', 'rss2', 'atom' ) as $feed ) {
		add_action( 'do_feed_' . $feed, 'wpse33072_remove_feeds', 1 );
	}
	unset( $feed );

	// 当执行 do_feed action 时重定向到首页
	function wpse33072_remove_feeds() {
		wp_redirect( home_url(), 302 );
		exit();
	}

	// 删除feed的重定向规则
	add_action( 'init', 'wpse33072_kill_feed_endpoint', 99 );

	function wpse33072_kill_feed_endpoint() {
		global $wp_rewrite;
		$wp_rewrite->feeds = array();

		// 运行一次后，记得删除下面的代码
		flush_rewrite_rules();
	}
}

/**
 * 怎么禁止WordPress自动更新版本？
 * https://wpmore.cn/how-to-disable-automatic-updates-in-wordpress.html
 */
if( empty(get_option('_prefix_my_options')['opt-func-15']) || get_option('_prefix_my_options')['opt-func-15'] === '0'){
	// 禁止更新核心文件自动更新
	define( 'WP_AUTO_UPDATE_CORE', false );
}
if( empty(get_option('_prefix_my_options')['opt-func-16']) || get_option('_prefix_my_options')['opt-func-16'] === '0'){
	// 禁止插件自动更新
	add_filter( 'auto_update_plugin', '__return_false' );
}
if( empty(get_option('_prefix_my_options')['opt-func-17']) || get_option('_prefix_my_options')['opt-func-17'] === '0'){
	// 禁止主题自动更新
	add_filter( 'auto_update_theme', '__return_false' );
}


/**
 * WordPress移除后台隐私相关的页面
 * https://wpmore.cn/wordpress-remove-gdpr-pages.html
 */
if( empty(get_option('_prefix_my_options')['opt-func-18']) || get_option('_prefix_my_options')['opt-func-18'] === '0'){
	add_action('admin_menu', function (){
		global $menu, $submenu;

		// 移除设置菜单下的隐私子菜单。
		unset($submenu['options-general.php'][45]);

		// 移除工具彩带下的相关页面
		remove_action( 'admin_menu', '_wp_privacy_hook_requests_page' );

		remove_filter( 'wp_privacy_personal_data_erasure_page', 'wp_privacy_process_personal_data_erasure_page', 10, 5 );
		remove_filter( 'wp_privacy_personal_data_export_page', 'wp_privacy_process_personal_data_export_page', 10, 7 );
		remove_filter( 'wp_privacy_personal_data_export_file', 'wp_privacy_generate_personal_data_export_file', 10 );
		remove_filter( 'wp_privacy_personal_data_erased', '_wp_privacy_send_erasure_fulfillment_notification', 10 );

		// Privacy policy text changes check.
		remove_action( 'admin_init', array( 'WP_Privacy_Policy_Content', 'text_change_check' ), 100 );

		// Show a "postbox" with the text suggestions for a privacy policy.
		remove_action( 'edit_form_after_title', array( 'WP_Privacy_Policy_Content', 'notice' ) );

		// Add the suggested policy text from WordPress.
		remove_action( 'admin_init', array( 'WP_Privacy_Policy_Content', 'add_suggested_content' ), 1 );

		// Update the cached policy info when the policy page is updated.
		remove_action( 'post_updated', array( 'WP_Privacy_Policy_Content', '_policy_page_updated' ) );
	},9);
}

/**
 * 不用插件启用WordPress自带友情链接功能
 * https://wpmore.cn/link_manager_enabled.htmll
 */
if(get_option('_prefix_my_options')['opt-func-19'] === '1'){
	add_filter( 'pre_option_link_manager_enabled', '__return_true' );
}

/**
 * 移除WordPress管理界面配色方案
 * https://wpmore.cn/remove-admin_color_scheme_picker.html
 */
if(empty(get_option('_prefix_my_options')['opt-func-20']) || get_option('_prefix_my_options')['opt-func-20'] === '0'){
	remove_action("admin_color_scheme_picker", "admin_color_scheme_picker");
}

/**
 * 利用MD5 16位 + 时间戳，防止WordPress附件乱码
 * https://wpmore.cn/md5-16-strtotime-wordpress-filename.html
 */
if(isset(get_option('_prefix_my_options')['opt-func-21']) && get_option('_prefix_my_options')['opt-func-21'] === '1'){
	function make_filename($filename) {
		$info = pathinfo($filename);
		$ext  = empty($info['extension']) ? '' : '.' . $info['extension'];
		$name = basename($filename, $ext);
		$strtotime = strtotime(date('Y-m-d H:i:s'));
		return $strtotime.$ext;
	}
	add_filter('sanitize_file_name', 'make_filename', 10);
}

/**
 * WordPress后台移除页脚信息
 * https://wpmore.cn/wordpress-remove-admin_footer.html
 */
if(empty(get_option('_prefix_my_options')['opt-func-22']) || get_option('_prefix_my_options')['opt-func-22'] === '0'){
	function change_footer_admin()
	{
		return '';
	}
	add_filter('admin_footer_text', 'change_footer_admin', 9999);
	function change_footer_version()
	{
		return '';
	}
	add_filter('update_footer', 'change_footer_version', 9999);
}

/**
 * 禁用WordPress图片响应式资源请求
 * https://wpmore.cn/disable-srcset.html
 */
if(empty(get_option('_prefix_my_options')['opt-func-23']) || get_option('_prefix_my_options')['opt-func-23'] === '0'){
	function disable_srcset( $sources ) {
		return false;
	}
	add_filter( 'wp_calculate_image_srcset', 'disable_srcset' );
}

/**
 * 移除WordPress后台右上角帮助
 * https://wpmore.cn/remove-wordpress-help-tabs.html
 */
if(empty(get_option('_prefix_my_options')['opt-func-24']) || get_option('_prefix_my_options')['opt-func-24'] === '0'){
	add_action('in_admin_header', function(){
		global $current_screen;
		$current_screen->remove_help_tabs();
	});
}

/**
 * WordPress彻底关闭全高度编辑器和免打扰功能
 * https://wpmore.cn/disable-full-height-editor-and-distraction-free-functionality.html
 */
if(empty(get_option('_prefix_my_options')['opt-func-25']) || get_option('_prefix_my_options')['opt-func-25'] !== '1'){
	add_action('admin_init', function(){
		wp_deregister_script('editor-expand');
	});

	add_filter('tiny_mce_before_init', function($init){
		unset($init['wp_autoresize_on']);
		return $init;
	});
}

/**
 * 如何禁用WordPress转译字符？
 * https://wpmore.cn/disable-wptexturize.html
 */
if( empty(get_option('_prefix_my_options')['opt-func-26']) || get_option('_prefix_my_options')['opt-func-26'] === '0'){
	remove_filter('the_content', 'wptexturize');
	remove_filter('the_excerpt', 'wptexturize');
	remove_filter('comment_text', 'wptexturize');
}

/**
 * 如何让WordPress文章中的图像大小属性失效或将其删除
 * https://wpmore.cn/image-in-wordpress-article-width-height-invalid-or-deleted.html
 */
if( empty(get_option('_prefix_my_options')['opt-func-28']) || get_option('_prefix_my_options')['opt-func-28'] === '0'){
	// 移除图片高度和宽度属性从文章内容中的图片上
	function salong_remove_image_size_attributes( $html ) {
		return preg_replace( '/(width|height)="\d*"/', '', $html );
	}
	// 从特色图像中删除图片大小属性
	add_filter( 'post_thumbnail_html', 'salong_remove_image_size_attributes' );
	// 从添加到WordPress文章的图像中删除图像大小属性
	add_filter( 'image_send_to_editor', 'salong_remove_image_size_attributes' );
}

/**
 * WordPress插入图片使用完整尺寸
 * https://wpmore.cn/wordpress-inserts-images-using-full-size.html
 */
if(isset(get_option('_prefix_my_options')['opt-func-29']) && get_option('_prefix_my_options')['opt-func-29'] === '1'){
	add_filter('image_size_names_choose', 'wpjam_image_size_names_choose');
	function wpjam_image_size_names_choose($image_sizes){
		unset($image_sizes['thumbnail']);
		unset($image_sizes['medium']);
		unset($image_sizes['large']);
		return $image_sizes;
	}
}

/**
 * WordPress登录页面返回站点信息
 * https://wpmore.cn/login_headerurl-login_headertitle.html
 */
if(isset(get_option('_prefix_my_options')['opt-func-30']) && get_option('_prefix_my_options')['opt-func-30'] === '1'){
	add_filter('login_headerurl', function () {
    get_bloginfo('url');
	});
	add_filter('login_headertitle', function () {
			get_bloginfo('name');
	});
}

/**
 * 去除WordPress utf8mb4不支持的非法字符
 * https://wpmore.cn/strip_invalid_text.html
 */
if(isset(get_option('_prefix_my_options')['opt-func-31']) && get_option('_prefix_my_options')['opt-func-31'] === '1'){
	function rm_strip_invalid_text($str){
		$regex = '/
		(
				(?: [\x00-\x7F]                  # single-byte sequences   0xxxxxxx
				|   [\xC2-\xDF][\x80-\xBF]       # double-byte sequences   110xxxxx 10xxxxxx
				|   \xE0[\xA0-\xBF][\x80-\xBF]   # triple-byte sequences   1110xxxx 10xxxxxx * 2
				|   [\xE1-\xEC][\x80-\xBF]{2}
				|   \xED[\x80-\x9F][\x80-\xBF]
				|   [\xEE-\xEF][\x80-\xBF]{2}
				|    \xF0[\x90-\xBF][\x80-\xBF]{2} # four-byte sequences   11110xxx 10xxxxxx * 3
				|    [\xF1-\xF3][\x80-\xBF]{3}
				|    \xF4[\x80-\x8F][\x80-\xBF]{2}
				){1,50}                          # ...one or more times
		)
		| .                                  # anything else
		/x';

		return preg_replace($regex, '$1', $str);
	}
}

// X-DNS-Prefetch-Control
if (get_option('_prefix_my_options')['opt-seo_X-DNS-Prefetch-Control']) {
  add_action('wp_head', 'dns_prefetchs', 1);
  function dns_prefetchs()
  {
      $urls = explode("\r\n", get_option('_prefix_my_options')['opt-seo_X-DNS-Prefetch-Control']);
      foreach ($urls as $url) {
          echo '<link rel="dns-prefetch" href="'.$url.'">'.PHP_EOL;
      }
  }
}

/**
 * 使用CDN加速Gravatar头像（免费）
 * https://wpmore.cn/%e4%bd%bf%e7%94%a8cdn%e5%8a%a0%e9%80%9fgravatar%e5%a4%b4%e5%83%8f%ef%bc%88%e5%85%8d%e8%b4%b9%ef%bc%89.html
 */
if(isset(get_option('_prefix_my_options')['opt-func-33']) && get_option('_prefix_my_options')['opt-func-33'] === '1'){
	function cdn_gravatar($avatar) {
		// Replacement for HTTPS domain
		$avatar = str_replace(array("//gravatar.com/", "//secure.gravatar.com/","//cn.gravatar.com/","//www.gravatar.com/", "//0.gravatar.com/", "//1.gravatar.com", "//2.gravatar.com/"), "//gravatar.loli.net/", $avatar);
		// Replacement for HTTPS protocol
		$avatar = str_replace("http:", "https:", $avatar);
		return $avatar;
	}

	add_filter('get_avatar', 'cdn_gravatar');
}
