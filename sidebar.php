<?php
$csf = get_option('_prefix_my_options');
?>
<aside id="secondary" class="widget-area dp-none dp-xl-block">
  <?php
  /**
   * 首页.
   */
  if (is_home() && !is_paged()) {
      ?>

      <?php
      /**
       * Sidebar1.
       */
      if (isset($csf['opt_adm_sidebar1']) && !empty($csf['opt_adm_sidebar1'])) {
          ?>
      <div class="widget widget-ticket section">
        <div class="widget-content"><?php  echo $csf['opt_adm_sidebar1']; ?></div>
      </div>
      <!-- .widget-ticket -->
      <?php
      } ?>

  <?php
  }?>

  <?php
  /**
   * 作者页.
   */
  if (is_author()) {
      ?>
    <div class="widget widget-author section">
       <div class="widget-content flex flex-column">
          <?php
          // var_dump(get_queried_object());
          // 作者ID
          $author_ID = get_queried_object()->ID;
      // 用户信息
      $user_info = get_userdata($author_ID);
      //  var_dump($user_info);
      // 邮箱
      $user_email = get_queried_object()->user_email;
      // 显示名称
      $display_name = get_queried_object()->display_name;
      // 个人说明
      $description = get_the_author_meta('description');
      // 站点
      $url = get_queried_object()->user_url;
      // 角色
      // $roles = get_the_author_meta( 'roles' );
      $roles = get_queried_object()->roles;
      $roles = $roles[0]; ?>
          <div class="widget-author-info">
            <div class="face flex flex-middle flex-center flex-column">
                <p><?php echo get_avatar($user_email, 120, null, $display_name); ?></p>
                <p><?php echo $display_name; ?>，<?php
                // echo $roles;
                if ($roles == 'administrator') {
                    echo '管理员';
                } elseif ($roles == 'editor') {
                    echo '编辑';
                } elseif ($roles == 'author') {
                    echo '作者';
                } elseif ($roles == 'contributor') {
                    echo '投稿者';
                } ?></p>
            </div>
            <!-- .face -->

            <div class="detail flex flex-middle flex-between">
              <!-- <p class="roles flex flex-middle flex-center flex-column" title="角色"><i class="iconfont">&#xec84;</i> -->
              <?php
                // if( $roles == "administrator") {
                //     echo "管理员";
                //   } elseif ( $roles == "editor" ){
                //     echo "编辑";
                //   } elseif ( $roles == "author" ){
                //     echo "作者";
                //   } elseif ( $roles == "contributor" ){
                //     echo "投稿者";
                //   }?>
              <!-- </p> -->
              <p class="reg flex flex-middle flex-center flex-column" title="注册时间"><i class="iconfont">&#xea47;</i><?php echo get_date_from_gmt(get_the_author_meta('user_registered'), 'Y-m-d'); ?></p>
              <p class="count flex flex-middle flex-center flex-column" title="文章数量"><i class="iconfont">&#xeb0d;</i><?php echo count_user_posts(get_the_author_meta('ID')).'篇'; ?></p>
              <p class="reply flex flex-middle flex-center flex-column" title="评论条数"><i class="iconfont">&#xead2;</i><?php
              // 评论条数
              $args = array(
                'user_id' => $author_ID, // use user_id
                'count' => true, //return only the count
              );
      $comments = get_comments($args);
      echo $comments.'条';
      // wp_reset_postdata();?></p>
              <p class="original flex flex-middle flex-center flex-column" title="原创文章"><i class="iconfont">&#xead6;</i><?php

              // post_meta_key
              // $original = get_field('original');

              // The array
              $args = array(
                'posts_per_page' => -1,
                'author' => $author_ID,
                'meta_key' => 'original',
                'meta_value' => '1',
                'post_type' => 'post',
              );

      // The Query
      $query = new WP_Query($args);

      // The Loop
      // if ( $query->have_posts() ) {
      //   while ( $query->have_posts() ) {
      //     $query->the_post();
      //     echo '<li>' . get_the_title() . get_field('original') .'</li>';
      //   }
      // } else {
      //   // no posts found
      // }
      /* Restore original Post Data */
      echo $query->found_posts.'篇';
      wp_reset_postdata(); ?></p>
            </div>
            <!-- .detail -->

            <div class="footer">
              <?php
              /**
               * 个人说明.
               */
              if ($description != '') {
                  ?>
                <p class="introduce" title="个人说明"><?php echo $description; ?></p>
              <?php
              }
      /*
       * 站点
       */
      if ($url != '') {
          ?>
                <p class="url" title="站点"><i class="iconfont">&#xebff;</i><a href="<?php echo $url; ?>" rel="nofollow" target="_blank"><?php echo $url; ?></a></p>
              <?php
      } ?>
              <?php
              /**
               * 当前登录用户ID是否与作者页面匹配.
               */
              // 登录用户ID
              $user_ID = wp_get_current_user()->ID;
      if ($user_ID == $author_ID) {
          ?>
                <p class="opt">
                  <?php
                  // 权限
                  if ($roles = 'administrator' || $roles = 'editor' || $roles = 'author' || $roles == 'contributor') {
                      ?>
                  <a href="<?php echo esc_url(home_url('/')); ?>wp-admin/post-new.php" class="btn btn-primary" rel="nofollow" target="_blank">写文章</a>
                  <?php
                  } ?>
                  <a href="<?php echo esc_url(home_url('/')); ?>wp-admin" class="btn btn-secondary" rel="nofollow" target="_blank">仪表盘</a>
                </p>
                <!-- .opt -->
              <?php
      } ?>

            </div>
            <!-- .footer -->

        </div>
        <!-- .widget-author-info -->

       </div>
       <!-- .widget-content -->

     </div>
     <!-- .widget-author -->

     <?php
    /**
     * Sidebar1.
     */
    if (isset($csf['opt_adm_sidebar1']) && !empty($csf['opt_adm_sidebar1'])) {
        ?>
     <div class="widget widget-ticket section">
       <div class="widget-content"><?php echo $otst = $csf['opt_adm_sidebar1']; ?></div>
     </div>
     <!-- .widget-ticket -->
      <?php
    } ?>

  <?php
  }?>

  <?php
  /**
   * 非文章页.
   */
  if (!is_single()) {
      ?>
    <?php
    /**
     * 非作者页.
     */
    if (!is_author()) {
        ?>
      <div class="widget widget-hots section">
            <div class="section-title">
              <h3><svg viewBox="0 0 1024 1024"><path d="M237.13426 364.040587h186.270239V301.953326H237.13426v62.087261zM237.13426 519.267195h496.719227V457.175706H237.13426v62.091489zM237.13426 674.493803h496.719227v-62.091489H237.13426V674.493803zM237.13426 829.716183h496.719227v-62.091489H237.13426v62.091489z" fill="#1B5A97"></path><path d="M826.988606 414.807346v508.048185a91.976428 91.976428 0 0 0 5.713111 31.04363H143.999141V146.726718h414.490186a222.680218 222.680218 0 0 1 24.273319-62.091489H81.907652v931.351193h807.172443v-81.88228c-1.361674-3.49299 0-7.277767 0-11.25284V390.41562a222.646387 222.646387 0 0 1-62.091489 24.391726z" fill="#1B5A97"></path><path d="M777.038006 388.444999c-105.927243 0-192.110213-86.178741-192.110214-192.110213S671.106534 4.228801 777.038006 4.228801s192.110213 86.178741 192.110213 192.110213-86.18297 192.105984-192.110213 192.105985z m0-324.437863c-72.967966 0-132.32765 59.363912-132.32765 132.32765s59.363912 132.32765 132.32765 132.327649 132.32765-59.363912 132.327649-132.327649-59.363912-132.32765-132.327649-132.32765z" fill="#106A37"></path></svg>热点阅读</h3>
            </div>
            <!-- .section-title -->

            <div class="widget-content tab">
              <div class="hots-head tab-head flex flex-center flex-center flex-middle">
                <span class="tab-head-item current">7 天</span>
                <span class="tab-head-item">1 个月</span>
                <span class="tab-head-item">6 个月</span>
                <span class="tab-head-item">全部</span>
              </div>
              <!-- .hots-head -->

              <div class="hots-content tab-content">
                <ul class="reset-box-model no-bullets hots-content-item tab-content-item current">
                  <?php
                  /**
                   * 7天.
                   */
                  // Create a new filtering function that will add our where clause to the query
                  function filter_where_7($where = '')
                  {
                      // posts in the last 30 days
                      $where .= " AND post_date > '".date('Y-m-d', strtotime('-7 days'))."'";

                      return $where;
                  }

        add_filter('posts_where', 'filter_where_7');
        $args = array(
                    'meta_key' => 'views',
                    'orderby' => 'meta_value_num',
                    'posts_per_page' => 10,
                    'post_type' => 'post',
                  );

        $most_viewd_posts = new WP_Query($args); //使用 WP_Query 自定义 WordPress Loop

        /*
         * The loop.
         */
        if ($most_viewd_posts->have_posts()) : while ($most_viewd_posts->have_posts()) : $most_viewd_posts->the_post(); ?>
                    <?php
                    /**
                     * index.
                     */
                    $current_post = ($most_viewd_posts->current_post) + 1; ?>
                    <li data-index="<?php echo $current_post; ?>"><a class="secondary-link" href="<?php the_permalink(); ?>" rel="bookmark" target="_blank" ><?php the_title(); ?></a></li>
                    <?php

                    endwhile;

        wp_reset_postdata();

        remove_filter('posts_where', 'filter_where_7'); ?>

                  <?php else : ?>
                          <p><?php esc_html_e('Sorry, no posts matched your criteria.', 'info'); ?></p>
                  <?php endif; ?>

                </ul>
                <!-- .hots-content-item -->

                <ul class="reset-box-model no-bullets hots-content-item tab-content-item">
                  <?php
                  /**
                   * 最近30天.
                   */
                  // Create a new filtering function that will add our where clause to the query
                  function filter_where_30($where = '')
                  {
                      // posts in the last 30 days
                      $where .= " AND post_date > '".date('Y-m-d', strtotime('-30 days'))."'";

                      return $where;
                  }

        add_filter('posts_where', 'filter_where_30');

        /**
         * 1个月.
         */
        $args = array(
                    'meta_key' => 'views',
                    'orderby' => 'meta_value_num',
                    'posts_per_page' => 10,
                    'post_type' => 'post',
                  );

        $most_viewd_posts = new WP_Query($args); //使用 WP_Query 自定义 WordPress Loop

        /*
         * The loop.
         */
        if ($most_viewd_posts->have_posts()) : while ($most_viewd_posts->have_posts()) : $most_viewd_posts->the_post(); ?>
                    <?php
                    /**
                     * index.
                     */
                    $current_post = ($most_viewd_posts->current_post) + 1; ?>
                    <li data-index="<?php echo $current_post; ?>"><a class="secondary-link" href="<?php the_permalink(); ?>" rel="bookmark" target="_blank" ><?php the_title(); ?></a></li>
                    <?php

                    endwhile;

        wp_reset_postdata();

        remove_filter('posts_where', 'filter_where_30'); ?>

                  <?php else : ?>
                          <p><?php esc_html_e('Sorry, no posts matched your criteria.', 'info'); ?></p>
                  <?php endif; ?>

                </ul>
                <!-- .hots-content-item -->

                <ul class="reset-box-model no-bullets hots-content-item tab-content-item">
                  <?php
                  /**
                   * 最近180天.
                   */
                  // Create a new filtering function that will add our where clause to the query
                  function filter_where_180($where = '')
                  {
                      // posts in the last 180 days
                      $where .= " AND post_date > '".date('Y-m-d', strtotime('-180 days'))."'";

                      return $where;
                  }

        add_filter('posts_where', 'filter_where_180');

        /**
         * 6个月.
         */
        $args = array(
                    'meta_key' => 'views',
                    'orderby' => 'meta_value_num',
                    'posts_per_page' => 10,
                    'post_type' => 'post',
                  );

        $most_viewd_posts = new WP_Query($args); //使用 WP_Query 自定义 WordPress Loop

        /*
         * The loop.
         */
        if ($most_viewd_posts->have_posts()) : while ($most_viewd_posts->have_posts()) : $most_viewd_posts->the_post(); ?>
                    <?php
                    /**
                     * index.
                     */
                    $current_post = ($most_viewd_posts->current_post) + 1; ?>
                    <li data-index="<?php echo $current_post; ?>"><a class="secondary-link" href="<?php the_permalink(); ?>" rel="bookmark" target="_blank" ><?php the_title(); ?></a></li>
                    <?php

                    endwhile;

        wp_reset_postdata();

        remove_filter('posts_where', 'filter_where_180'); ?>

                  <?php else : ?>
                          <p><?php esc_html_e('Sorry, no posts matched your criteria.', 'info'); ?></p>
                  <?php endif; ?>

                </ul>
                <!-- .hots-content-item -->

                <ul class="reset-box-model no-bullets hots-content-item tab-content-item">
                  <?php
                  /**
                   * 全部.
                   */
                  $args = array(
                    'meta_key' => 'views',
                    'orderby' => 'meta_value_num',
                    'posts_per_page' => 10,
                    'post_type' => 'post',
                  );

        $most_viewd_posts = new WP_Query($args); //使用 WP_Query 自定义 WordPress Loop

        /*
         * The loop.
         */
        if ($most_viewd_posts->have_posts()) : while ($most_viewd_posts->have_posts()) : $most_viewd_posts->the_post(); ?>
                    <?php
                    /**
                     * index.
                     */
                    $current_post = ($most_viewd_posts->current_post) + 1; ?>
                    <li data-index="<?php echo $current_post; ?>"><a class="secondary-link" href="<?php the_permalink(); ?>" rel="bookmark" target="_blank" ><?php the_title(); ?></a></li>
                    <?php endwhile;
        wp_reset_postdata(); ?>

                  <?php else : ?>
                          <p><?php esc_html_e('Sorry, no posts matched your criteria.', 'info'); ?></p>
                  <?php endif; ?>

                </ul>
                <!-- .hots-content-item -->

              </div>
              <!-- .hots-content -->

            </div>
            <!-- .widget-content -->

      </div>
      <!-- .widget-hots -->

      <div class="widget widget-comments section">
            <div class="section-title">
              <h3><svg viewBox="0 0 1024 1024"><path d="M433.424027 782.121151H130.165821V41.193909h763.668358v740.927242h-316.816243l-73.161422 159.057868-70.432487-159.057868z" fill="#FFFFFF"></path><path d="M863.51269 71.515398v680.284264h-305.943824l-53.192555 115.654822-51.2-115.654822H160.48731v-680.067682h703.02538m60.642978-60.642978H99.844332v801.353638h313.870727l35.216244 79.57225 54.405414 122.888663 56.311337-122.065651 36.992217-80.395262h327.688663V10.87242z" fill="#1B5A97"></path><path d="M311.878173 283.375973h431.907952v60.642978H311.878173zM269.081557 470.113029h431.907952v60.642978H269.081557z" fill="#106A37"></path><path d="M582.215905 627.914721L687.864636 160.054146h-62.159052l-105.648731 467.860575h62.159052zM393.572927 627.914721l105.605415-467.860575h-62.159053L331.413875 627.914721h62.159052z" fill="#106A37"></path></svg>最新评论</h3>
            </div>
            <!-- .section-title -->

            <div class="widget-content">
              <?php
              /**
               * 最新评论
               * http://codex.wordpress.org.cn/Function_Reference/get_comments.
               */
              $comments = get_comments('status=approve&number=10&order=DESC&post__not_in=1552');
        if (!empty($comments)) {
            echo '<ul class="reset-box-model no-bullets">';
            foreach ($comments as $comment) :?>
                    <?php // var_dump($comment);?>
                    <li class="flex flex-top">
                      <div class="comment-cover">
                        <?php echo get_avatar($comment->comment_author_email, 38, null, $comment->comment_author); ?>
                      </div>
                      <div class="comment-info">
                        <p class="comment-content"><a class="secondary-link" href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>" target="_blank" rel="nofollow"><?php echo $comment->comment_content; ?></a></p>
                        <p class="comment-meta"><?php $date = date_create($comment->comment_date);
            echo date_format($date, 'Y 年 m 月 d 日'); ?></p>
                      </div>
                    </li>
                  <?php endforeach;
            echo '</ul>';
        } else {
            echo '<p>';
            esc_html_e('Sorry, no posts matched your criteria.', 'info');
            echo '</p>';
        } ?>

            </div>
            <!-- .widget-content -->

      </div>
      <!-- .widget-comments -->

    <?php
    } ?>

    <?php
    /**
     * 推荐.
     */
    if (isset($csf['opt_adm_tj']) && !empty($csf['opt_adm_tj'])) {
        ?>
    <div class="widget widget-cloud section">
      <div class="section-title">
          <h3><svg viewBox="0 0 1024 1024"><path d="M899.44061 261.858336v692.771522H306.400291V836.905194h-65.092627v183.003269h723.225572v-822.956774H785.760988v65.092626h113.633128" fill="#1B5A97"></path><path d="M207.27352 452.626226h495.029422v65.092626H207.27352zM524.879041 263.625136h177.423901v65.092626h-177.423901zM207.27352 617.868507h495.029422v65.092626H207.27352z" fill="#1B5A97"></path><path d="M418.685071 46.494733a232.473665 232.473665 0 0 1 39.009081 60.675627h295.938975V809.008355H151.758809V412.361787a232.473665 232.473665 0 0 1-60.443153-39.288049V869.451507h722.993098V46.494733z" fill="#1B5A97"></path><path d="M245.58518 397.622957a197.137668 197.137668 0 1 1 197.137668-197.137668 197.370142 197.370142 0 0 1-197.137668 197.137668z m0-333.59971a136.462041 136.462041 0 1 0 136.462041 136.462042 136.64802 136.64802 0 0 0-136.462041-136.462042z" fill="#106A37"></path></svg>推荐</h3>
      </div>
      <!-- .section-title -->

      <div class="widget-content"><?php echo $csf['opt_adm_tj']; ?></div>
      <!-- .widget-content -->

    </div>
    <!-- .widget-cloud -->
    <?php
    } ?>

    <?php
    /**
     * wordpress主题.
     */
    if (isset($csf['opt_adm_wp']) && !empty($csf['opt_adm_wp'])) {
        ?>
    <div class="widget widget-wordpress section">
      <div class="section-title">
          <h3><svg viewBox="0 0 1024 1024"><path d="M995.176296 933.167407H40.011852v-671.288888h955.164444z m-898.275555-56.888888h841.386666v-557.511112H96.900741z" fill="#1B5A97"></path><path d="M834.37037 213.143704h-56.888889V167.063704a50.820741 50.820741 0 0 0-50.82074-50.820741H308.337778a50.820741 50.820741 0 0 0-50.820741 50.820741v46.08h-56.888889V167.063704a107.899259 107.899259 0 0 1 107.70963-107.70963h418.512592A107.899259 107.899259 0 0 1 834.37037 167.063704z" fill="#106A37"></path><path d="M517.688889 731.401481a497.777778 497.777778 0 0 1-360.296296-155.875555l-113.777778-121.742222 41.339259-38.874074 113.777778 121.742222a438.992593 438.992593 0 0 0 638.862222 0l113.777778-121.742222 41.339259 38.874074-113.777778 121.742222a497.588148 497.588148 0 0 1-361.244444 155.875555z" fill="#1B5A97"></path><path d="M433.114074 528.308148h169.14963v56.888889h-169.14963z" fill="#1B5A97"></path></svg>WordPress主题</h3>
      </div>
      <!-- .section-title -->

      <div class="widget-content"><?php echo $csf['opt_adm_wp']; ?></div>
      <!-- .widget-content -->

    </div>
    <!-- .widget-wordpress -->
    <?php
    } ?>

    <?php
    /**
     * 首页.
     */
    if (is_home() && !is_paged()) {
        /**
         * 作者列表.
         */
        $args = array(
        'orderby' => 'post_count',
        'order' => 'DESC',
        'role__in' => array('administrator', 'editor', 'author'),
      );

        // The Query
        $user_query = new WP_User_Query($args);

        // User Loop
        if (!empty($user_query->get_results())) {
            echo '<div class="widget widget-authors section">';
            echo '<div class="section-title">';
            echo '<h3><span class="svg-authors"><svg t="1577154379450" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="10750"><path d="M809.984 896l0-598.016-468.010667 0 0 598.016 468.010667 0zM809.984 214.016q34.005333 0 59.989333 25.002667t25.984 59.008l0 598.016q0 34.005333-25.984 59.989333t-59.989333 25.984l-468.010667 0q-34.005333 0-59.989333-25.984t-25.984-59.989333l0-598.016q0-34.005333 25.984-59.008t59.989333-25.002667l468.010667 0zM681.984 41.984l0 86.016-512 0 0 598.016-84.010667 0 0-598.016q0-34.005333 25.002667-59.989333t59.008-25.984l512 0z" p-id="10751" fill="#1B5A97"></path></svg><svg t="1577154141461" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="10575" width="10" height="10"><path d="M884.010667 299.989333l-77.994667 77.994667-160-160 77.994667-77.994667q11.989333-11.989333 29.994667-11.989333t29.994667 11.989333l100.010667 100.010667q11.989333 11.989333 11.989333 29.994667t-11.989333 29.994667zM128 736l472.021333-472.021333 160 160-472.021333 472.021333-160 0 0-160z" p-id="10576" fill="#106A37"></path></svg></span>本站作者</h3>';
            echo '</div>';
            echo '<div class="widget-content">';
            echo '<div class="flex flex-wrap">';
            foreach ($user_query->get_results() as $user) {
                // var_dump($user);
                // ID
                // $user->ID;
                // 邮箱
                // $user->user_email;
                // 昵称
                // $user->user_nicename;

                echo '<div class="widget-authors-item flex flex-middle flex-center flex-column">
                          <p class="face"><a class="secondary-link" href="'.get_author_posts_url($user->ID).'" target="_blank" rel="nofollow">'.get_avatar($user->user_email, 56, null, $user->display_name).'</a></p>
                          <p class="name"><a class="secondary-link" href="'.get_author_posts_url($user->ID).'" target="_blank">'.$user->display_name.'</a></p>
                          <p class="count">文章<b>'.count_user_posts($user->ID).'</b>篇</p>';
                echo '</div>';
            }
            echo '</div>';
            echo '</div>';
            echo '</div>';
        } ?>

      <?php
      /**
       * 友情链接.
       */
      if (!empty($csf['opt_links'])) {
          $links = $csf['opt_links'];
          if (!empty($links)) {
              ?>
          <div class="widget widget-links section">
            <div class="section-title">
                <h3><svg viewBox="0 0 1024 1024"><path d="M268.504763 408.640408h472.384061V342.242277H268.504763v66.398131zM268.504763 547.315413h291.499688v-66.398131H268.504763v66.398131z" fill="#106A37"></path><path d="M933.001594 174.413234V143.93874h-96.424937l0.497432-104.415505V9.044219H192.587592c-54.45524 0-98.423709 43.963947-98.42371 98.423709v802.3669c0 54.45524 43.963947 98.423709 98.42371 98.423709H933.001594s-1.031041-0.054265 0-0.153751V174.413234zM192.587592 69.99773h583.040076V143.93874H192.587592a36.886846 36.886846 0 0 1-36.972766-36.972766 36.891368 36.891368 0 0 1 36.972766-36.968244z m-0.497432 876.805342a36.886846 36.886846 0 0 1-36.972766-36.972766V198.516077a98.355878 98.355878 0 0 0 37.470198 7.371038h678.963059v740.911435H192.09016z" fill="#1B5A97"></path><path d="M527.323167 483.169292H307.996343a30.280044 30.280044 0 0 0-30.474494 30.474495c0 16.487611 13.489452 30.474495 30.474494 30.474494h219.326824c16.985043 0 30.976449-13.489452 30.474495-30.474494a30.275522 30.275522 0 0 0-30.474495-30.474495zM705.182249 344.277226H307.996343a30.280044 30.280044 0 0 0-30.474494 30.474495c0 16.487611 13.489452 30.474495 30.474494 30.474495h397.185906c16.985043 0 30.474495-13.489452 30.474495-30.474495s-13.48493-30.474495-30.474495-30.474495z" fill="#106A37"></path></svg>友情链接</h3>
            </div>
            <!-- .section-title -->

            <div class="widget-content flex flex-wrap">
              <?php
              if (is_home()) {
                  $args = array(
                      'category' => $links,
                      'categorize' => '0',
                      'title_li' => '',
                      'category_before' => '',
                      'category_after' => '',
                      'title_before' => '',
                      'title_after' => '',
                      'before' => '',
                      'after' => '',
                      'orderby' => 'link_id',
                  );
                  wp_list_bookmarks($args);
              } ?>
            </div>
            <!-- .widget-content -->

          </div>
          <!-- .widget-links -->

        <?php
          }
      } ?>

    <?php
    } ?>

  <?php
  }
  /*
   * 文章页
   */
  else {
      ?>
     <div class="widget widget-sticky">
       <h3 class="reset-box-model widget-title reset-font">推荐阅读</h3>
       <div class="widget-content">
         <ul class="reset-box-model no-bullets">
            <?php
            /**
             * 推荐阅读.
             */
            $otdf = explode(',', $csf['opt-select']);
      foreach ($otdf as $post_id) {
          $post = get_post($post_id);
          // echo '<pre>';
          // var_dump($post);
          // echo '</pre>';?>
              <li>
                <p class="title"><a class="secondary-link" href="<?php echo get_permalink($post->ID); ?>" rel="bookmark" target="_blank"  title="<?php echo $post->post_title; ?>"><?php echo $post->post_title; ?></a></p>
                <p class="time"><?php $date = date_create($post->post_date);
          echo date_format($date, 'Y 年 m 月 d 日'); ?></p>
              </li>
            <?php
      } ?>
       </div>
     </div>
     <!-- .widget-sticky -->

     <div class="widget widget-views">
       <h3 class="reset-box-model widget-title reset-font">热门文章</h3>
       <div class="widget-content">
          <ul class="reset-box-model no-bullets">
            <?php
            /**
             * 10篇热门.
             */
            $args = array(
              'meta_key' => 'views',
              'orderby' => 'meta_value_num',
              'posts_per_page' => 10,
              'post_type' => 'post',
            );
      $most_viewd_posts = new WP_Query($args); //使用 WP_Query 自定义 WordPress Loop

      /*
       * The loop.
       */
      if ($most_viewd_posts->have_posts()) : while ($most_viewd_posts->have_posts()) : $most_viewd_posts->the_post(); ?>
              <li>
                <p class="title"><a class="secondary-link" href="<?php the_permalink(); ?>" rel="bookmark" target="_blank"  title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></p>
                <p class="time"><?php the_time('Y 年 m 月 d 日'); ?></p>
              </li>
            <?php endwhile;
      wp_reset_postdata(); ?>

            <?php else : ?>
              <li><p><?php esc_html_e('Sorry, no posts matched your criteria.', 'info'); ?></p></li>
            <?php endif; ?>
          </ul>
       </div>
     </div>
     <!-- .widget-views -->

  <?php
  }?>

  <div class="widget widget-contribution section">
    <div class="widget-content">
      <p class="reset-box-model flex flex-middle flex-between">
          <a class="flex flex-middle secondary-link" href="<?php echo esc_url(home_url('/')); ?>contribute" target="_blank"><span class="cover flex flex-middle flex-center"><svg viewBox="0 0 1024 1024"><path d="M959.34464 237.056a23.90016 23.90016 0 0 0-5.632-9.58464 16.03584 16.03584 0 0 0-5.632-5.05856 60.88704 60.88704 0 0 0-43.37664-18.0224h-656.384a31.47776 31.47776 0 0 0-31.5392 31.5392 30.72 30.72 0 0 0 14.6432 26.48064l134.08256 124.5184H194.80576a31.55968 31.55968 0 1 0 0 63.09888h170.7008a31.15008 31.15008 0 0 0 31.55968-31.55968v-2.2528l161.13664 149.87264a30.24896 30.24896 0 0 0 21.38112 8.45824 33.1776 33.1776 0 0 0 20.29568-7.33184l298.5984-251.904-43.37664 441.1392h-509.952a31.55968 31.55968 0 1 0 0 63.09888h509.952c34.36544 0 61.97248-28.16 61.97248-58.01984L966.656 266.91584a66.78528 66.78528 0 0 0-7.33184-29.85984zM580.73088 500.16256L329.46176 266.91584l532.48-3.3792z m0 0" fill="#1458D4"></path><path d="M472.00256 546.93888a31.51872 31.51872 0 0 0-31.55968-31.55968H88.8832a31.55968 31.55968 0 1 0 0 63.09888h351.55968c17.46944 0 32.11264-14.09024 31.55968-31.5392z" fill="#1458D4"></path><path d="M555.95008 669.20448a31.51872 31.51872 0 0 0-31.55968-31.55968h-276.0704a31.55968 31.55968 0 0 0 0 63.09888h276.0704a31.49824 31.49824 0 0 0 31.55968-31.5392z" fill="#09ACA8"></path></svg></span><span class="text">我要投稿
</span></a>
          <a class="flex flex-middle secondary-link" href="<?php echo esc_url(home_url('/')); ?>beeditor" target="_blank"><span class="cover flex flex-middle flex-center"><svg viewBox="0 0 1024 1024"><path d="M710.41024 866.304H313.58976c-62.60736 0-113.84832-47.24736-113.84832-104.98048V262.67648c0-57.73312 51.2-104.98048 113.84832-104.98048h396.82048c62.60736 0 113.84832 47.24736 113.84832 104.98048 0 15.74912-11.38688 26.23488-28.4672 26.23488s-28.4672-10.48576-28.4672-26.23488c0-28.8768-25.6-52.49024-56.91392-52.49024H313.58976c-31.31392 0-56.91392 23.61344-56.91392 52.49024v498.64704c0 28.8768 25.6 52.49024 56.91392 52.49024h396.82048c31.31392 0 56.91392-23.61344 56.91392-52.49024V551.36256c0-15.74912 11.38688-26.23488 28.4672-26.23488s28.4672 10.48576 28.4672 26.23488v209.96096c0 57.73312-51.2 104.98048-113.84832 104.98048z m0 0" fill="#1458D4"></path><path d="M603.83232 692.08064a25.35424 25.35424 0 0 1-13.45536-2.56c-13.45536-7.72096-18.8416-23.16288-10.77248-36.02432l175.0016-308.71552c8.06912-12.88192 24.22784-15.44192 37.6832-10.24 13.47584 7.72096 18.8416 23.16288 10.77248 36.02432l-174.98112 308.65408a28.672 28.672 0 0 1-24.24832 12.86144z m0 0" fill="#09ACA8"></path><path d="M325.79584 383.32416m25.7024 0l282.112 0q25.7024 0 25.7024 25.7024l0 0q0 25.7024-25.7024 25.7024l-282.112 0q-25.7024 0-25.7024-25.7024l0 0q0-25.7024 25.7024-25.7024Z" fill="#1458D4"></path><path d="M328.56064 501.80096m25.7024 0l162.57024 0q25.7024 0 25.7024 25.7024l0 0q0 25.7024-25.7024 25.7024l-162.57024 0q-25.7024 0-25.7024-25.7024l0 0q0-25.7024 25.7024-25.7024Z" fill="#1458D4"></path><path d="M327.5776 615.54688m25.7024 0l162.57024 0q25.7024 0 25.7024 25.7024l0 0q0 25.7024-25.7024 25.7024l-162.57024 0q-25.7024 0-25.7024-25.7024l0 0q0-25.7024 25.7024-25.7024Z" fill="#1458D4"></path></svg></span><span>成为编辑</span></a>
      </p>
    </div>
  </div>
  <!-- .widget-contribution -->

</aside>
<!-- #secondary -->
