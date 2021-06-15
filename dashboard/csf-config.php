<?php

// https://github.com/Codestar/codestar-framework/
// Check core class for avoid errors
if( class_exists( 'CSF' ) ) {

  // Set a unique slug-like ID
  $prefix = '_prefix_my_options';

  //
	// Create options
	//
	CSF::createOptions( $prefix, array(
		'menu_title' => '主题',
		'menu_slug'  => 'csf-demo',
	) );


  //
  // =========================== 1、基本设置 ===========================
  //
  CSF::createSection( $prefix, array(
    'id'    => 'basic_fields',
    'title'  => '基本设置',
    'fields'      => array(
      array(
        'id'    => 'opt-logo',
        'type'  => 'media',
        'title' => 'Logo',
        'library' => 'image',
        'desc' => '默认显示主题中的“images/logo.png',
        'default' => array('url' => get_template_directory_uri().'/dist/images/logo.png' ),
      ),
      array(
        'id'    => 'opt-favicon',
        'type'  => 'media',
        'title' => 'Favicon',
        'library' => 'image',
        'desc' => '270 x 270px，默认显示主题中的“images/favicon.png',
        'default' =>  array('url' => get_template_directory_uri().'/dist/images/favicon.png' ),
      ),
      array(
        'id'          => 'opt-thumb',
        'type'        => 'select',
        'title'       => '缩图方案',
        'placeholder' => '请选择',
        'desc' => '可选<a href="https://www.aliyun.com/product/oss?source=5176.11533457&amp;userCode=zj48tyhb&amp;type=copy" rel="nofollow" target="_blank">阿里云OSS</a>、PHP TimThumb方案，推荐使用阿里云OSS，效率更高也便于附件管理。',
        'options'     => array(
          'aliyun-oss'  => '阿里云OSS',
          'php-TimThumb'  => 'TimThumb',
        ),
        'default'     => 'php-TimThumb'
      ),
      array(
        'id'    => 'opt_footer_logo',
        'type'  => 'media',
        // 'library' => 'image',
        'title' => '底部Logo',
        'desc'  => '默认显示主题中的“images/logo.png',
        'default' => array(
          'url' => get_template_directory_uri().'/dist/images/logo.png',
        ),
      ),
      array(
        'id'    => 'opt_footer_desc',
        'type'  => 'textarea',
        'title' => '底部描述',
        'desc'  => 'logo下方文本描述'
      ),
      array(
        'id'    => 'opt-icp',
        'type'  => 'text',
        'title' => 'ICP备案号',
      )
    )
  ) );


  //
  // =========================== 2、站点工具 ===========================
  //
  CSF::createSection( $prefix, array(
    'id'    => 'tools_fields',
    'title'  => '站点工具',
  ) );

  /**
   * 2.1 网站验证
   */
  CSF::createSection( $prefix, array(
    'parent'      => 'tools_fields',
    'title'       => '网站验证',
    'description' => '只填写meta方式验证的content值，如果meta方式验证请注意清理网站缓存。如果安装了 Yoast SEO等其他插件支持网站验证的功能，请任意填写一个即可。',
    'fields'      => array(
      array(
        'id'    => 'opt-tbaidu',
        'type'  => 'text',
        'title' => '百度验证码',
      ),
      array(
        'id'    => 'opt-tbing',
        'type'  => 'text',
        'title' => 'Bing 验证码',
      ),
      array(
        'id'    => 'opt-tgoogle',
        'type'  => 'text',
        'title' => 'Goole 验证码',
      ),
      array(
        'id'    => 'opt-tyandex',
        'type'  => 'text',
        'title' => 'Yandex 验证码',
      ),
      array(
        'id'    => 'opt-t360',
        'type'  => 'text',
        'title' => '360 验证码',
      ),
      array(
        'id'    => 'opt-tsogou',
        'type'  => 'text',
        'title' => '搜狗验证码',
      ),
      array(
        'id'    => 'opt-ttoutiao',
        'type'  => 'text',
        'title' => '头条验证码',
      ),
      array(
        'id'    => 'opt-tshenma',
        'type'  => 'text',
        'title' => '神马验证码',
      ),
    )
  ) );

  /**
   * 2.2 推送收录
   */
  CSF::createSection( $prefix, array(
    'parent'      => 'tools_fields',
    'title'       => '推送收录',
    'fields'      => array(
      array(
        'id'    => 'opt-push-1',
        'type'  => 'switcher',
        'title' => '百度自动推送',
        'default' => false
      ),
      array(
        'id'    => 'opt-push-2',
        'type'  => 'text',
        'title' => '百度主动推送',
        'desc' => '只填写"token=*"后面对应的值。'
      ),
      array(
        'id'    => 'opt-push-3',
        'type'  => 'text',
        'title' => '360 自动收录',
        'desc' => '只填写"js?*"后面对应的id。'
      )
    )
  ) );

  /**
   * 2.3 网站统计
   */
  CSF::createSection( $prefix, array(
    'parent'      => 'tools_fields',
    'title'       => '网站统计',
    'fields'      => array(
      array(
        'id'    => 'opt-analytics-1',
        'type'  => 'text',
        'title' => '百度统计',
        'desc' => '异步统计代码，只填写"js?*"后面对应的id。'
      ),
    )
  ) );


  //
  // =========================== 3、性能优化 ===========================
  //
  CSF::createSection( $prefix, array(
    'id'    => 'performance_fields',
    'title'  => '性能优化',
    'fields'      => array(
      array(
        'id'      => 'opt-func-14',
        'type'    => 'switcher',
        'title'   => 'Feed',
        'default' => true
      ),
      array(
        'id'      => 'opt-func-3',
        'type'    => 'switcher',
        'title'   => 'Emoji',
        'default' => false
      ),
      array(
        'id'      => 'opt-func-6',
        'type'    => 'switcher',
        'title'   => 'Embed',
        'default' => false
      ),
      array(
        'id'      => 'opt-func-32',
        'type'    => 'switcher',
        'title'   => 'shortlink',
        'default' => false
      ),
      array(
        'id'      => 'opt-func-11',
        'type'    => 'switcher',
        'title'   => 'XML-RPC',
        'default' => false
      ),
      array(
        'id'      => 'opt-func-13',
        'type'    => 'switcher',
        'title'   => 'REST API',
        'default' => true
      ),
      array(
        'id'      => 'opt-func-9',
        'type'    => 'switcher',
        'title'   => 'Admin Bar',
        'default' => false
      ),
      array(
        'id'      => 'opt-func-12',
        'type'    => 'switcher',
        'title'   => 'Trackbacks',
        'default' => false
      ),
      array(
        'id'      => 'opt-func-7',
        'type'    => 'switcher',
        'title'   => 'Auto Embeds',
        'default' => false
      ),
      array(
        'id'      => 'opt-func-33',
        'type'    => 'switcher',
        'title'   => 'CDN Gravatar',
        'default' => false
      ),
      array(
        'id'      => 'opt-func-19',
        'type'    => 'switcher',
        'title'   => '链接管理',
        'default' => true
      ),
      array(
        'id'      => 'opt-func-26',
        'type'    => 'switcher',
        'title'   => '转译字符',
        'default' => false
      ),
      array(
        'id'      => 'opt-func-27',
        'type'    => 'switcher',
        'title'   => '日志修订',
        'default' => false
      ),
      array(
        'id'      => 'opt-func-2',
        'type'    => 'switcher',
        'title'   => '输出版本号',
        'default' => false
      ),
      array(
        'id'      => 'opt-func-4',
        'type'    => 'switcher',
        'title'   => '古滕堡编辑器',
        'default' => false
      ),
      array(
        'id'      => 'opt-func-28',
        'type'    => 'switcher',
        'title'   => '图像大小属性',
        'default' => false
      ),
      array(
        'id'      => 'opt-func-8',
        'type'    => 'switcher',
        'title'   => '前台加载语言包',
        'default' => true
      ),
      array(
        'id'      => 'opt-func-10',
        'type'    => 'switcher',
        'title'   => '管理员邮箱验证',
        'default' => false
      ),
      array(
        'id'      => 'opt-func-16',
        'type'    => 'switcher',
        'title'   => '插件自动更新',
        'default' => true
      ),
      array(
        'id'      => 'opt-func-17',
        'type'    => 'switcher',
        'title'   => '主题自动更新',
        'default' => true
      ),
      array(
        'id'      => 'opt-func-15',
        'type'    => 'switcher',
        'title'   => '核心文件自动更新',
        'default' => true
      ),
      array(
        'id'      => 'opt-func-22',
        'type'    => 'switcher',
        'title'   => '仪表盘页脚信息',
        'default' => false
      ),
      array(
        'id'      => 'opt-func-24',
        'type'    => 'switcher',
        'title'   => '仪表盘右上角帮助',
        'default' => false
      ),
      array(
        'id'      => 'opt-func-1',
        'type'    => 'switcher',
        'title'   => '仪表盘左上角Logo',
        'default' => false
      ),
      array(
        'id'      => 'opt-func-18',
        'type'    => 'switcher',
        'title'   => '仪表盘隐私相关页面',
        'default' => false
      ),
      array(
        'id'      => 'opt-func-5',
        'type'    => 'switcher',
        'title'   => '仪表盘CSS、JS打包加载',
        'default' => false
      ),
      array(
        'id'      => 'opt-func-20',
        'type'    => 'switcher',
        'title'   => '管理界面配色方案',
        'default' => false
      ),
      array(
        'id'      => 'opt-func-23',
        'type'    => 'switcher',
        'title'   => '图片响应式资源请求',
        'default' => false
      ),
      array(
        'id'      => 'opt-func-21',
        'type'    => 'switcher',
        'title'   => '附件重命名防止乱码',
        'default' => true
      ),
      array(
        'id'      => 'opt-func-29',
        'type'    => 'switcher',
        'title'   => '插入图片使用完整尺寸',
        'default' => true
      ),
      array(
        'id'      => 'opt-func-30',
        'type'    => 'switcher',
        'title'   => '登录页面返回站点信息',
        'default' => true
      ),
      array(
        'id'      => 'opt-func-25',
        'type'    => 'switcher',
        'title'   => '全高度编辑器和免打扰功能',
        'default' => false
      ),
      array(
        'id'      => 'opt-func-31',
        'type'    => 'switcher',
        'title'   => '去除utf8mb4不支持的非法字符',
        'default' => true
      ),
        array(
            'id'    => 'opt-seo_X-DNS-Prefetch-Control',
            'type'  => 'textarea',
            'title' => 'X-DNS-Prefetch-Control',
            'desc' => __('DNS 预读取是一项使浏览器主动去执行域名解析的功能，参考资料：https://developer.mozilla.org/zh-CN/docs/Controlling_DNS_prefetching，默认以开启，此处只需填写 link rel 代码。', 'redux-framework-demo'),
        ),
      )
  ) );

  CSF::createSection( $prefix, array(
    'id'    => 'data_fields',
    'title'  => '数据调用',
    'fields'      => array(
      array(
        'id'     => 'opt-select',
        'type'   => 'text',
        'title'  => '精选内容',
        'desc' => '4篇文章ID，使用“,”隔开。'
      ),
      array(
        'id'     => 'opt-talk',
        'type'   => 'text',
        'title'  => '讨论板块',
        'desc' => '1个分类目录ID。'
      ),
      array(
        'id'     => 'opt_cloud_tag',
        'type'   => 'number',
        'title'  => '标签个数',
        'desc' => '导航下方标签调用。'
      ),
      array(
        'id'     => 'opt_links',
        'type'   => 'number',
        'title'  => '友情链接',
        'desc' => '连接分类ID'
      ),
      array(
        'id'     => 'opt_count',
        'type'   => 'number',
        'title'  => '统计页面',
        'desc' => '统计用户文章情况，填写页面ID。'
      ),
      array(
        'id'     => 'opt-thumbnail',
        'type'   => 'group',
        'title'  => '特色图像',
        'description' => '文章无特色图像时随机调用。',
        'fields' => array(
          array(
            'id'           => 'opt-thumbnail-upload',
            'type'         => 'upload',
            'title'        => '上传图像',
            'library'      => 'image',
          ),
        )
      ),
    )
  ) );

  CSF::createSection( $prefix, array(
    'id'    => 'ad_fields',
    'title'  => '广告管理',
    'fields'      => array(
      array(
        'id'     => 'opt_adm_sidebar1',
        'type'   => 'code_editor',
        'title'  => 'Sidebar1',
        'sanitize' => false,
      ),
      array(
        'id'     => 'opt_adm_tj',
        'type'   => 'code_editor',
        'title'  => '推荐',
        'sanitize' => false,
      ),
      array(
        'id'     => 'opt_adm_wp',
        'type'   => 'code_editor',
        'title'  => 'WordPress主题',
        'sanitize' => false,
      ),
      array(
        'id'     => 'opt_adm_article_loop',
        'type'   => 'code_editor',
        'title'  => '文章循环',
        'sanitize' => false,
      ),
      array(
        'id'     => 'opt_adm_article_start',
        'type'   => 'code_editor',
        'title'  => '文章开始',
        'sanitize' => false,
      ),
      array(
        'id'     => 'opt_adm_content_end',
        'type'   => 'code_editor',
        'title'  => '内容结束',
        'sanitize' => false,
      ),
      array(
        'id'     => 'opt_adm_article_end',
        'type'   => 'code_editor',
        'title'  => '文章结束',
        'sanitize' => false,
      ),
    )
  ) );

  //
  // =========================== 5、Field: backup ===========================
  //
  CSF::createSection( $prefix, array(
    'title'       => '数据备份',
    'description' => 'Visit documentation for more details on this field: <a href="http://codestarframework.com/documentation/#/fields?id=backup" target="_blank">Field: backup</a>',
    'fields'      => array(
      array(
        'type' => 'backup',
      ),

    )
  ) );
}
