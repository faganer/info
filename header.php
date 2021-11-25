<?php
$csf = get_option('_prefix_my_options');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta name="force-rendering" content="webkit|ie-comp|ie-stand">
    <meta name="applicable-device" content="pc,mobile">
    <meta http-equiv="Cache-Control" content="no-transform" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta http-equiv="x-dns-prefetch-control" content="on">
    <?php
    /**
     * 头条搜索：时间因子
     */
    if( is_single() ) {
    $pTime = get_the_time( 'U' );
    $uTime = get_the_modified_time( 'U' );
    $lTime = get_the_date( DATE_W3C );
    if( $pTime !== $uTime ){
      $lTime = get_the_modified_time( DATE_W3C );
    }?>
      <?php if(get_the_date( DATE_W3C )){?>
      <meta property="bytedance:published_time" content="<?php echo get_the_date( DATE_W3C );?>" />
      <?php }?>
      <?php if(get_the_modified_time( DATE_W3C )){?>
      <meta property="bytedance:lrDate_time" content="<?php echo get_the_modified_time( DATE_W3C );?>" />
      <?php }?>
    <meta property="bytedance:updated_time" content="<?php echo $lTime;?>" />
    <?php }?>
    <?php wp_head(); ?>
</head>

<body <?php if (wp_is_mobile()) {
    body_class('wp_mobile');
} else {
    body_class('wp_desktop');
}?>>
  <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

  <div id="page" class="site">
    <header id="masthead" class="site-header flex flex-middle primary-bg">
      <div class="container flex flex-middle flex-between">
        <div class="menu-min-icon dp-xl-none"><i class="iconfont">&#xec3a;</i></div>
        <!-- .menu-min-icon -->

        <?php
        /**
         * 首页.
         */
        if (is_front_page() && is_home()) :?>
          <h1 class="site-title reset-box-model reset-font"><a
            href="<?php echo esc_url(home_url('/')); ?>"
            rel="home"
            title="<?php bloginfo('name'); ?>"><img
              src="<?php echo get_option('_prefix_my_options')['opt-logo']['url']; ?>"
              alt="<?php bloginfo('name'); ?>"></a>
        </h1>
        <?php
        /**
         * 非首页.
         */
        else : ?>
        <p class="site-title reset-box-model reset-font"><a
            href="<?php echo esc_url(home_url('/')); ?>"
            rel="home"
            title="<?php bloginfo('name'); ?>"><img
              src="<?php echo get_option('_prefix_my_options')['opt-logo']['url']; ?>"
              alt="<?php bloginfo('name'); ?>"></a>
        </p>
        <?php endif; ?>

        <nav id="site-navigation" class="main-navigation dp-none dp-xl-block">
          <?php
          wp_nav_menu(array(
            'theme_location' => 'menu-1',
            'menu_id' => 'primary-menu',
            'menu_class' => 'primary-menu reset-box-model no-bullets inline-list',
          ));
          ?>
        </nav>
        <!-- #site-navigation -->

        <form role="search" method="get" class="site-searchform flex dp-none dp-xl-block" action="<?php echo esc_url(home_url('/')); ?>">
            <input type="search" required name="s" id="s" class="searchinput reset-focus" placeholder="搜索">
            <button type="submit" id="searchsubmit" class="searchsubmit reset-focus"><i class="iconfont">&#xece1;</i></button>
        </form>
        <!-- .site-searchform -->

        <div class="searchform-min-icon dp-xl-none">
          <i class="iconfont">&#xece1;</i></div>
        <!-- .searchform-min-icon -->


        <?php
        /**
         * 未登录.
         */
        if (!is_user_logged_in()) {
            ?>
          <div class="site-login dp-none dp-xl-block flex flex-middle">
            <a class="secondary-link" href="<?php if (!is_home()) {
                echo wp_login_url(get_permalink());
            } else {
                echo wp_login_url(home_url());
            } ?>"><?php esc_html_e('登录', 'info'); ?></a>
            <span></span>
            <a class="secondary-link" href="<?php if (!is_home()) {
                echo wp_registration_url(get_permalink());
            } else {
                echo wp_registration_url(home_url());
            } ?>"><?php esc_html_e('注册', 'info'); ?></a>
          </div>
          <!-- .site-login -->

        <?php
        }

        /*
         * 已登录
         */
        else {
            ?>
          <div class="site-login dp-none dp-xl-block flex flex-middle logged">
          <?php
            // 登录用户
            $current_user = wp_get_current_user();
            // ID
            $user_ID = $current_user->ID;
            // 显示名称
            $display_name = $current_user->display_name;
            // 邮箱
            $email = $current_user->user_email; ?><a href="<?php echo esc_url(home_url('/')); ?>wp-admin" rel="nofollow" title="嗨！<?php echo $display_name; ?>，进入仪表盘"><?php echo get_avatar($email, 32, null, $display_name); ?></a><a class="secondary-link" href="<?php echo esc_url(home_url('/')); ?>?author=<?php echo $user_ID; ?>" rel="nofollow">个人中心</a>，<a class="secondary-link" href="<?php if (!is_home()) {
                echo wp_logout_url(get_permalink());
            } else {
                echo wp_logout_url(home_url());
            } ?>"><?php esc_html_e('退出', 'info'); ?></a>
        </div>
        <!-- .site-login -->
      <?php
        }?>

      </div>
      <!-- .container -->

    </header>
    <!-- #masthead -->

    <?php
    /**
     * 标签云.
     */
    if (!empty($csf['opt_cloud_tag'])) {
        ?>
    <div class="site-tags container dp-none dp-xl-block">
      <div class="site-tags-content flex flex-center flex-middle">
        <?php
        /**
         * 标签云.
         */
        $_i_tn = $csf['opt_cloud_tag'];
        $arrayName = array(
          'unit' => 'px',
          'smallest' => 14,
          'largest' => 14,
          'number' => $_i_tn,
          'orderby' => 'count',
          'order' => 'DESC',
        );
        wp_tag_cloud($arrayName); ?>
        <a href="javascript:;" title="更多主题" class="site-tags-more flex flex-middle"><span class="dp-block"></span></a>
      </div>
      <!-- .site-tags-content -->

    </div>
    <!-- .site-tags -->
      <?php
    }?>

    <!-- <nav id="menu-min" class="dp-none"> -->
    <nav id="menu-min" class="menu-min-container">
      <?php
      /**
       * 未登录.
       */
      if (!is_user_logged_in()) {
          ?>
        <a class="site-login-min flex flex-middle" href="<?php if (!is_home()) {
              echo wp_login_url(get_permalink());
          } else {
              echo wp_login_url(home_url());
          } ?>">
          <span class="iconfont">&#xea39;</span>
          <span>登录|注册</span>
        </a>
        <!-- .site-login-min -->

      <?php
      }
      /*
       * 已登录
       */
      else {
          ?>
        <div class="site-login-min-logged flex flex-center flex-middle flex-column">
        <?php
          // 登录用户
          $current_user = wp_get_current_user();
          // ID
          $user_ID = $current_user->ID;
          // 显示名称
          $display_name = $current_user->display_name;
          // 邮箱
          $email = $current_user->user_email; ?><a class="face" href="<?php echo esc_url(home_url('/')); ?>wp-admin" rel="nofollow"><?php echo get_avatar($email, 46, null, $display_name); ?></a><span><?php echo $display_name; ?></span><a class="secondary-link" href="<?php if (!is_home()) {
              echo wp_logout_url(get_permalink());
          } else {
              echo wp_logout_url(home_url());
          } ?>"><?php esc_html_e('退出', 'info'); ?></a>
        </div>
      <!-- .site-login -->
      <?php
      }?>

      <?php
      wp_nav_menu(array(
        'theme_location' => 'menu-1',
        // 'menu_id'        => 'primary-menu',
        'menu_class' => 'menu-min reset-box-model no-bullets inline-list flex flex-column',
      ));
      ?>
      <!-- .menu-min -->

      <div class="menu-min-close"><span class="iconfont">&#xeadd;</span></div>
      <!-- .menu-min-close -->

    </nav>
    <!-- #site-navigation -->
