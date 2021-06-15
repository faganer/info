<?php
$csf = get_option('_prefix_my_options');
get_header(); ?>

    <div id="content" class="site-main">
      <div class="container flex flex-between">
        <div id="primary" class="content-area">
          <?php
        /**
         * Breadcrumbs.
         */
        // https://wordpress.org/plugins/yoast-seo
        if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p id="breadcrumbs" class="dp-none">', '</p>');
        }
        // https://mtekk.us/code/breadcrumb-navxt/
        if (function_exists('bcn_display')) {
            echo '<div class="breadcrumbs dp-none" typeof="BreadcrumbList" vocab="https://schema.org/">';
            bcn_display();
            echo '</div>';
        }
        ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
              <?php
              /**
               * post_meta_key.
               */
              // 原创
              $original = get_field('original');
              // 来源
              $source = get_field('source');
              // 网址
              $source_uri = get_field('url');
              // 子标题
              $subtitle = get_field('subtitle');

              /**
               * author_meta.
               */
              // 个人说明
              $description = get_the_author_meta('description');
              // 站点
              $url = get_the_author_meta('user_url');
              // 角色
              $roles = get_the_author_meta('roles');
              $roles = $roles[0];
              ?>
              <div class="post-head">
                <h1 class="post-title reset-box-model reset-font"><?php the_title(); ?></h1>
                <!-- .post-title -->

                <?php
                // 子标题
                if (!empty($subtitle)) {
                    ?>
                  <p class="post-subtitle"><?php echo $subtitle; ?></p>
                <?php
                }?>

                <div class="post-meta">
                  <p>
                    <span class="author">作者 : <?php the_author_posts_link(); ?></span>
                    <span class="cat">类别 : <?php the_category(', '); ?></span>
                  </p>
                  <p>
                   <span class="views">阅读数 : <?php if (function_exists('the_views')) {
                    the_views();
                } ?></span>
                   <span class="time" title="发布时间：<?php the_time('Y 年 m 月 d 日 H:s'); ?>"><?php the_time('Y 年 m 月 d 日 H:s'); ?></span>
                   <?php
                    // 来源、网址都存在
                   if (!empty($source) && !empty($source_uri)) {
                       ?><span class="source">来源 : <a href="<?php echo $source_uri; ?>" rel="nofollow external noopener" tatget="_blank"><?php echo $source; ?></a></span><?php
                   }
                   // 来源存在
                   elseif (!empty($source) && empty($source_uri)) {
                       ?><span class="source">来源 :<?php echo $source; ?></span><?php
                   }
                   // 网址存在
                   elseif (empty($source) && !empty($source_uri)) {
                       ?><span class="source"><a href="<?php echo $source_uri; ?>" rel="nofollow noopener external" tatget="_blank">查看原文</a></span><?php
                   } ?>
                  </p>
                </div>
                <!-- .post-meta -->

              </div>
              <!-- .post-head -->

              <div class="post-content">
                <?php
                // 文章简介
                //if (!empty(get_the_excerpt())) {
                    ?>
                  <!-- <p class="post-excerpt"> -->
                    <?php // echo get_the_excerpt(); ?>
                  <!-- </p> -->
                <?php
                //}?>

                <?php
                // 文章开始
                if (isset($csf['opt_adm_article_start']) && !empty($csf['opt_adm_article_start'])) {
                    $_m_aps = $csf['opt_adm_article_start'];
                    if (!empty($_m_aps) && !is_single('1552')) {
                        echo $_m_aps;
                    }
                }?>

                <?php the_content(); ?>

                <?php
                // 软件信息
                $dUri = get_field('download_link'); // 下载地址
                $dCode = get_field('download_pan_code'); // 提取码
                $dUnZip= get_field('download_upzip_code'); // 解压密码
                if( $dUri || $dCode || $dUnZip){?>
                  <div class="post-dlownload alert alert-secondary" role="alert">
                    <h4 class="alert-heading mb-2">软件信息</h4>
                    <p class="mb-2 mt-0">
                      <?php if( $dUri ){?>
                        下载地址：<a href="<?php echo $dUri;?>" class="alert-link" rel="nofollow noopener" target="_blank" ><?php echo $dUri;?></a>
                      <?php }?>
                      <?php if( $dCode ){?>
                        ，提取码：<?php echo $dCode;?></a>
                      <?php }?>
                      <?php if( $dUnZip ){?>
                        ，解压密码：<?php echo $dUnZip;?></a>
                      <?php }?>。
                    </p>
                  </div>
                  <!-- .post-dlownload -->
                <?php }?>

                <?php
                // 内容结束
                if (isset($csf['opt_adm_content_end']) && !empty($csf['opt_adm_content_end'])) {
                    $_m_apce = $csf['opt_adm_content_end'];
                    if (!empty($_m_apce) && !is_single('1552')) {
                        echo $_m_apce;
                    }
                }?>

                <?php
                /**
                 * 原创.
                 */
                if ($original && !is_single('1552')) {
                    ?>
                  <p class="post-original">文章版权归 <?php bloginfo('name'); ?> 所有，未经许可不得转载，责任编辑：<?php echo the_author_meta('display_name'); ?>。</p>
                <?php
                }?>

                <?php
                /**
                 * 标签.
                 */
                if (!is_single('1552')) {
                    the_tags('<p class="post-tags"><i class="iconfont">&#xe660;</i> ', ' , ', '</p>');
                }?>

                <?php
                /**
                 * 分享.
                 */
                if (!is_single('1552')) {
                    ?>
                <p class="post-share flex flex-middle"><span>分享到：</span><i class="share-weibo iconfont">&#xe641;</i><i class="share-wechat iconfont">&#xe6cb;</i><i class="share-qq iconfont">&#xe66e;</i></p>
                <!-- .post-share -->
                <?php
                }?>

              </div>
              <!-- .post-content -->

              <?php
              // 文章结束
              if (isset($csf['opt_adm_article_end']) && !empty($csf['opt_adm_article_end'])) {
                  $_m_ape = $csf['opt_adm_article_end'];
                  if (!empty($_m_ape) && !is_single('1552')) {
                      echo $_m_ape;
                  }
              }?>

            <?php endwhile; ?>

            <?php else : ?>
              <p><?php esc_html_e('Sorry, no posts matched your criteria.', 'info'); ?></p>
            <?php endif; ?>

          </article>
          <!-- #posts -->

          <?php
          if (!is_single('1552')) {
              ?>
          <div class="post-author">
              <h3 class="post-author-title reset-box-model reset-font">作者信息</h3>
              <div class="post-author-content flex">
                <div class="post-author-face">
                  <?php echo get_avatar(get_the_author_meta('user_email'), 64, null, get_the_author_meta('user_nicename')); ?>
                </div>
                <!-- .post-author-face -->

                <div class="post-author-info">
                  <p class="name">
                  <?php
                  the_author_posts_link();
              echo '，';
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
                  <p class="regCount"><?php echo get_date_from_gmt(get_the_author_meta('user_registered'), 'Y年m月d日'); ?>注册，发布了<span><?php echo count_user_posts(get_the_author_meta('ID')); ?></span>篇文章。</p>

                  <?php
                  if ($description != '') {
                      ?>
                    <p class="introduce"><?php echo $description; ?></p>
                  <?php
                  }
              if ($url != '') {
                  ?>
                    <p class="url">站点：<a href="<?php echo $url; ?>" rel="nofollow" target="_blank"><?php echo $url; ?></a></p>
                  <?php
              } ?>

                </div>
                <!-- .post-author-info -->

              </div>
              <!-- .post-author-content -->

          </div>
          <!-- .post-author -->
          <?php
          }?>

          <?php
          if (!is_single('1552')) {
              ?>
          <?php
          /**
           * 上一篇、下一篇.
           */
          if (get_previous_post() || get_previous_post()) {
              echo '<div class="post-prevNext flex flex-column">';
              if (get_previous_post()) {
                  echo '<p class="post-prev">';
                  previous_post_link('<span>上一篇:</span>%link', '%title', true);
                  echo '</p>';
              }
              if (get_next_post()) {
                  echo '<p class="post-next">';
                  next_post_link('<span>下一篇:</span>%link', '%title', true);
                  echo '</p>';
              }
              echo '</div>';
          } ?>
          <?php
          }?>

          <?php
          if (!is_single('1552')) {
              ?>
          <?php
          /**
           * 相关文章.
           */

          // 判断是否存在标签
          if (has_tag()) {
              // 当前文章页的标签
              $tag_ids = wp_get_post_tags($post->ID, array('fields' => 'ids'));

              // 查询规则
              $args = array(
              // 查询标签，用tag__in，即“或”关系
              'tag__in' => $tag_ids,
              // 查询数量
              'posts_per_page' => 5,
              // 排除当前文章
              'post__not_in' => array($post->ID),
            );

              // 主循环查询
              $the_query = new WP_Query($args);

              // 查询结果文章数量
              $found_posts = $the_query->found_posts;

              // 如果大于或等于1篇文章
              if ($found_posts >= 1) {
                  // 构建相关文章html结构
                  echo '<div class="wp_rp_wrap"><h3 class="related_post_title">相关文章</h3><ul class="related_post wp_rp">';

                  // the loop
                  while ($the_query->have_posts()) : $the_query->the_post(); ?>
                <li><a href="<?php the_permalink(); ?>" target="_blank" rel="bookmark"><?php the_title(); ?></a></li>
              <?php endwhile;
                  echo '</ul></div>';
              }

              // 重设主循环
              wp_reset_postdata();
          }
              // wp_related_posts()?>
          <?php
          }?>

          <?php
          // If comments are open or we have at least one comment, load up the comment template.
          if (comments_open() || get_comments_number()) :
            comments_template();
          endif; ?>

        </div>
        <!-- #primary -->

        <?php get_sidebar(); ?>

      </div>
      <!-- .container -->

    </div>
    <!-- #content -->

<?php get_footer(); ?>
