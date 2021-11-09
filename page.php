<?php

$csf = get_option('_prefix_my_options');

// 年份
$today = getdate();

// 统计页面ID
if (!empty($csf['opt_count'])) {
    $count = $csf['opt_count'];
}?>
<?php get_header();?>

    <div id="content" class="site-main flex flex-center">
      <div id="primary" class="content-area">
        <?php
        /**
         * Breadcrumbs
         */
        // https://wordpress.org/plugins/yoast-seo
        if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p id="breadcrumbs" class="dp-none">', '</p>');
        }
        // https://mtekk.us/code/breadcrumb-navxt/
        if(function_exists('bcn_display'))
        {
            echo '<div class="breadcrumbs dp-none" typeof="BreadcrumbList" vocab="https://schema.org/">';
            bcn_display();
            echo '</div>';
        }
        ?>
        <nav class="page-navigation">
          <?php
          wp_nav_menu(array(
            'theme_location' => 'menu-2',
            'menu_id'        => 'page-menu',
            'menu_class'     => 'page-menu reset-box-model no-bullets inline-list flex flex-middle flex-row flex-wrap',
          ));
          ?>
        </nav>
        <!-- .page-navigation -->

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php
            /**
             * 统计页面
             */
            if (is_page($count)) {?>

              <?php
              /**
               * 判断是否登录
               */
              if (is_user_logged_in()) {
                  $current_user = wp_get_current_user();
                  // var_dump($current_user);

                  // 角色
                  $role = $current_user->roles[0];

                  // 阅读权限
                  if ($role = "administrator" || $role = "editor" || $role = "author") {?>

                  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php
                    /**
                     * 循环输出当年开始截止本月的所有月份数据
                     * 顺序：for ($i = 1; $i <= $today["mon"]; $i++)
                     * 倒序：for ($i = $today["mon"]; $i >= 1 ; $i--)
                     */

                    for ($i = $today["mon"]; $i >= 1 ; $i--) {?>

                      <div class="count-item count-item-mon">
                        <h2><?php echo $today["year"].'年'.$i;?>月</h2>
                        <div class="table-responsive">
                          <table class="pure-table pure-table-horizontal table-nowrap">
                            <thead>
                              <tr>
                                <th>名次</th>
                                <th>名称</th>
                                <th class="text-right"><?php echo $i;?>月文章数/篇</th>
                                <th class="text-right"><?php echo $i;?>月原创文章数/篇</th>
                                <th class="text-right"><?php echo $i;?>月应付/元</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              /**
                               * 作者列表
                               */
                              $args = array(
                                'orderby' => 'post_count',
                                'order' => 'DESC',
                                'role__in' => array('administrator','editor','author'),
                              );
                              // The Query
                              $user_query = new WP_User_Query($args);

                              // 序号
                              $index = 1;

                              // loop
                              foreach ($user_query->get_results() as $user) {
                                  // var_dump($user);

                                  // ID
                                  $ID = $user -> ID;

                                  // 注册时间
                                  // $registered = $user -> user_registered;
                                  // $registered = get_date_from_gmt( $registered ,'Y-m-d');

                                  // 显示名称
                                  $name = $user -> display_name;

                                  // 当月文章数量
                                  $currentMonthPosts = array(
                                  'posts_per_page'=>-1,
                                  'author'=>$ID,
                                  // 'meta_key' => 'original',
                                  // 'meta_value' => '1',
                                  'post_type' => 'post',
                                  'year' => $today["year"],
                                  'monthnum' => $i
                                );
                                  $currentMonthPostsQuery = new WP_Query($currentMonthPosts);
                                  $current_month_posts = $currentMonthPostsQuery->found_posts;
                                  wp_reset_postdata();

                                  // 当月原创文章数量
                                  $currentMonthOriginalPosts = array(
                                  'posts_per_page'=>-1,
                                  'author'=>$ID,
                                  'meta_key' => 'original',
                                  'meta_value' => '1',
                                  'post_type' => 'post',
                                  'year' => $today["year"],
                                  'monthnum' => $i
                                );
                                  $currentMonthOriginalPostsQuery = new WP_Query($currentMonthOriginalPosts);
                                  $current_month_original_posts = $currentMonthOriginalPostsQuery->found_posts;
                                  wp_reset_postdata();

                                  // 当月应付
                                  $money = (($current_month_posts - $current_month_original_posts) * 0.1) + ($current_month_original_posts * 0.5);

                                  // 拼接td
                                  echo '<tr><td>No.' . $index .'</td><td>' . $name .'</td><td class="text-right">' . number_format($current_month_posts) .'</td><td class="text-right">' . number_format($current_month_original_posts) .'</td><td class="text-right">' . number_format($money, 2) . '</td></tr>';
                                  $index++;
                              }?>

                            </tbody>
                          </table>
                          <!-- .pure-table -->

                        </div>
                        <!-- .table-responsive -->

                      </div>
                      <!-- .count-item -->

                    <?php }?>

                    <!-- 年度 -->
                    <div class="count-item count-item-year">
                      <h2><?php echo $today["year"];?>年度</h2>
                      <div class="table-responsive">
                        <table class="pure-table pure-table-horizontal table-nowrap">
                          <thead>
                            <tr>
                              <th>名次</th>
                              <th>名称</th>
                              <th>注册日期</th>
                              <th class="text-right">文章数/篇</th>
                              <th class="text-right">原创文章数/篇</th>
                              <th class="text-right"><?php echo $today["year"];?>年文章数/篇</th>
                              <th class="text-right"><?php echo $today["year"];?>年原创文章数/篇</th>
                              <th class="text-right"><?php echo $today["year"];?>年应付/元</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            /**
                            * 作者列表
                            */
                            $args = array(
                              'orderby' => 'post_count',
                              'order' => 'DESC',
                              'role__in' => array('administrator','editor','author'),
                            );
                            // The Query
                            $user_query = new WP_User_Query($args);

                            // 查询结果个数
                            // $num = $user_query-> get_total();

                            // 序号
                            $index = 1;

                            // loop
                            foreach ($user_query->get_results() as $user) {
                                // var_dump($user);

                                // 年份
                                $today = getdate();

                                // ID
                                $ID = $user -> ID;

                                // 注册时间
                                $registered = $user -> user_registered;
                                $registered = get_date_from_gmt($registered, 'Y-m-d');

                                // 显示名称
                                $name = $user -> display_name;

                                // 文章数量
                                $posts = count_user_posts($ID);

                                // 原创文章
                                $originalArgs = array(
                                'posts_per_page'=>-1,
                                'author'=>$ID,
                                'meta_key' => 'original',
                                'meta_value' => '1',
                                'post_type' => 'post',
                              );
                                $query = new WP_Query($originalArgs);
                                // echo $query->found_posts .'篇';
                                $original_posts = $query->found_posts;
                                wp_reset_postdata();

                                // 当年文章数量
                                $currentYearPosts = array(
                                'posts_per_page'=>-1,
                                'author'=>$ID,
                                // 'meta_key' => 'original',
                                // 'meta_value' => '1',
                                'post_type' => 'post',
                                'year' => $today["year"]
                              );
                                $currentYearPostsQuery = new WP_Query($currentYearPosts);
                                $current_year_posts = $currentYearPostsQuery->found_posts;
                                wp_reset_postdata();

                                // 当年原创文章数量
                                $currentYearOriginalPosts = array(
                                'posts_per_page'=>-1,
                                'author'=>$ID,
                                'meta_key' => 'original',
                                'meta_value' => '1',
                                'post_type' => 'post',
                                'year' => $today["year"]
                              );
                                $currentYearOriginalPostsQuery = new WP_Query($currentYearOriginalPosts);
                                $current_year_original_posts = $currentYearOriginalPostsQuery->found_posts;
                                wp_reset_postdata();

                                // 当年应付
                                $money = (($current_year_posts - $current_year_original_posts) * 0.1) + ($current_year_original_posts * 0.5);

                                // 拼接td
                                echo '<tr><td>No.' . $index .'</td><td>' . $name .'</td><td>' . $registered .'</td><td class="text-right">' . number_format($posts) .'</td><td class="text-right">' . number_format($original_posts) .'</td><td class="text-right">' . number_format($current_year_posts) . '</td><td class="text-right">' . number_format($current_year_original_posts) . '</td><td class="text-right">' . number_format($money, 2) . '</td></tr>';
                                $index++;
                            }?>

                          </tbody>
                        </table>
                        <!-- .pure-table -->

                      </div>
                      <!-- .table-responsive -->

                    </div>
                    <!-- .count-item -->

                  <?php endwhile;?>

                  <?php else : ?>
                    <p><?php esc_html_e('Sorry, no posts matched your criteria.', 'info'); ?></p>
                  <?php endif; ?>

                <?php }
                  // 无权限阅读
                  else {
                      echo '<p>无权限阅读，返回 <a href="/" rel="nofollow">首页</a></p>';
                  }
              }

              /**
              * 未登录
              */
              else {?>
                <p>需要 <a class="btn btn-sm btn-primary" href="<?php if (!is_home()) {
                  echo wp_login_url(get_permalink());
              } else {
                  echo wp_login_url(home_url());
              } ?>"><?php esc_html_e('登录', 'info');?></a> 才能查看内容，无账号请先 <a  class="btn btn-sm btn-secondary" href="<?php if (!is_home()) {
                  echo wp_registration_url(get_permalink());
              } else {
                  echo wp_registration_url(home_url());
              } ?>"><?php esc_html_e('注册', 'info');?></a> 升级成为作者、编辑或管理员。</p>
              <?php }?>

            <?php }

            /**
             * 普通页面
             */
            else {?>

              <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="post-head">
                  <h1 class="post-title reset-box-model reset-font"><?php the_title(); ?></h1>
                  <!-- .post-title -->

                </div>
                <!-- .post-head -->

                <div class="post-content">
                  <?php the_content();?>

                </div>
                <!-- .post-content -->

              <?php endwhile;?>

              <?php else : ?>
                <p><?php esc_html_e('Sorry, no posts matched your criteria.', 'info'); ?></p>
              <?php endif; ?>

            <?php }?>

          </article>
          <!-- #post -->

      </div>
      <!-- #primary -->

    </div>
    <!-- #content -->

<?php get_footer();?>
