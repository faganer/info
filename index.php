<?php
$csf = get_option('_prefix_my_options');
get_header(); ?>

    <div id="content" class="site-main flex flex-between container">
      <div id="primary" class="content-area">

        <?php
        /**
         * 幻灯.
         */
        if (is_home() && !is_paged()) {
            ?>
          <div class="slider dp-lg-none">
            <!-- Slider main container -->
            <div class="swiper-container">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">

                  <?php
                  /**
                   * 精选内容.
                   */
                  // OptionTree
                  $otdf = explode(',', $csf['opt-select']);

            foreach ($otdf as $post_id) {
                $post = get_post($post_id); ?>
                    <div class="swiper-slide">
                      <?php
                      /**
                       * 有特色图像.
                       */
                      if (has_post_thumbnail()) {
                          $full_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
                        <div class="cover">
                          <a href="<?php echo get_permalink($post->ID); ?>" target="
                            _blank" rel="bookmark" style="background-image:url(<?php echo $full_image_url[0]; ?>?x-oss-process=image/auto-orient,1/resize,m_fill,w_350,h_198/quality,q_98/format,webp)"><?php echo $post->post_title; ?></a>
                        </div>
                        <!-- .cover -->
                      <?php
                      }
                /*
                 * 无特色图像，随机取出一组幻灯
                 */
                elseif (isset(get_option('_prefix_my_options')['opt-thumbnail']) && !empty(get_option('_prefix_my_options')['opt-thumbnail'])) {
                    $slides = get_option('_prefix_my_options')['opt-thumbnail'];
                    $random_keys = array_rand($slides, 1); ?>
                          <div class="cover">
                            <a href="<?php echo get_permalink($post->ID); ?>" target="
                              _blank" rel="bookmark" style="background-image:url(<?php echo $slides[$random_keys]["opt-thumbnail-upload"]; ?>?x-oss-process=image/auto-orient,1/resize,m_fill,w_350,h_198/quality,q_98/format,webp"><?php echo $post->post_title; ?>/a>
                          </div>
                          <!-- .cover -->
                        <?php
                } ?>


                      <div class="info">

                        <h3 class="title reset-box-model reset-font">
                          <a class="secondary-link" href="<?php echo get_permalink($post->ID); ?>"" target="_blank" rel="bookmark"><?php echo $post->post_title; ?></a>
                        </h3>
                        <!-- .title -->

                        <p class="meta">
                          <?php $user_info = get_userdata($post->post_author); ?>
                          <span class="author">作者 : <?php
                        ?><a class="secondary-link" href="<?php echo esc_url(home_url('/')); ?>?author=<?php echo $post->post_author; ?>" rel="nofollow"><?php echo $user_info->display_name; ?></a></span>
                        </p>
                        <!-- .meta -->

                        <p class="desc reset-box-model">
                          <?php
                          // 子标题
                          $subtitle = get_field('subtitle');
                if (!empty($subtitle)) {
                    echo $subtitle;
                }
                // 截取简介
                else {
                    // $content = get_the_content();
                    $content = $post->post_content;
                    $content = wp_strip_all_tags(str_replace(array('[', ']'), array('<', '>'), $content));
                    echo mb_strimwidth(strip_tags($content), 0, 111, '...');
                } ?>
                        </p>
                        <!-- .desc -->

                      </div>
                      <!-- .info -->

                    </div>
                    <!-- .swiper-slide -->

                  <?php
            } ?>
                </div>

                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>

            </div>
          </div>
          <!-- .slider -->
        <?php
        }?>

        <div class="top section dp-none dp-lg-block">
          <div class="section-title">
            <h2><svg viewBox="0 0 1024 1024"><path d="M946.612679 910.248381a33.235846 33.235846 0 0 1-66.471692 0v-432.084111h66.47622v432.084111z m-132.952439 33.235846H82.43993V79.316005h731.22031v830.932376a98.471551 98.471551 0 0 0 6.116554 33.235846h-6.116554z m66.476219-531.796177V12.839785H15.968237v997.120662h897.408596c55.07163 0 99.712066-44.640436 99.712066-99.712066V411.68805h-132.95244z" fill="#1B5A97"></path><path d="M182.151996 478.159742h531.796177V411.68805H182.151996v66.471692zM182.151996 644.348028h531.796177v-66.47622H182.151996v66.47622zM182.151996 810.536314h531.796177v-66.476219H182.151996v66.476219z" fill="#106A37"></path></svg>精选内容</h2>
          </div>
          <!-- .section-title -->

          <div class="top-content flex flex-between flex-wrap">
            <?php
            /**
             * 精选内容.
             */
            $otdf = explode(',', $csf['opt-select']);

            foreach ($otdf as $post_id) {
                $post = get_post($post_id); ?>

              <div class="top-item flex flex-column">
          <div class="top-item-content flex">
            <?php
            /**
             * 特色图像.
             */
            if (has_post_thumbnail()) {
                $full_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
            <a class="top-item-cover flex flex-center"
              href="<?php echo get_permalink($post->ID); ?>"" target="
              _blank" rel="bookmark"><img
                src="<?php echo $full_image_url[0]; ?>?x-oss-process=image/auto-orient,1/resize,m_fill,w_350,h_198/quality,q_98/format,webp"
                alt="<?php echo $post->post_title; ?>"></a>
            <?php
            }
                /*
                 * 无特色图像，随机取出一组幻灯
                 */
                elseif (isset($opt['opt_thumbnail']) && !empty($opt['opt_thumbnail'])) {
                    $slides = $opt['opt_thumbnail'];
                    $random_keys = array_rand($slides, 1); ?>
            <a class="top-item-cover flex flex-center"
              href="<?php echo get_permalink($post->ID); ?>"" target="
              _blank" rel="bookmark"><img
                src="<?php echo $slides[$random_keys]['url']; ?>?x-oss-process=image/auto-orient,1/resize,m_fill,w_350,h_198/quality,q_98/format,webp"
                alt="<?php echo $post->post_title; ?>"></a>
            <?php
                } ?>
            <!-- .top-item-cover -->

            <div class="top-item-info">
              <h3 class="top-item-title reset-box-model reset-font">
                <a class="secondary-link"
                  href="<?php echo get_permalink($post->ID); ?>"
                  target="_blank" rel="bookmark"><?php echo $post->post_title; ?></a>
              </h3>
              <!-- .top-item-title -->

              <p class="top-item-meta flex">
                <?php
                        $user_info = get_userdata($post->post_author); ?>
                <span class="author">作者 : <?php
                        ?><a class="secondary-link"
                    href="<?php echo esc_url(home_url('/')); ?>?author=<?php echo $post->post_author; ?>"
                    rel="nofollow"><?php echo $user_info->display_name; ?></a></span>
                <!-- .author -->

              </p>
              <!-- .top-item-meta -->

              <p class="top-item-desc reset-box-model">
                <?php
                        // 子标题
                        $subtitle = get_field('subtitle');
                if (!empty($subtitle)) {
                    echo $subtitle;
                }
                // 截取简介
                else {
                    // $content = get_the_content();
                    $content = $post->post_content;
                    $content = wp_strip_all_tags(str_replace(array('[', ']'), array('<', '>'), $content));
                    echo mb_strimwidth(strip_tags($content), 0, 111, '...');
                } ?>
              </p>

              <?php the_tags('<p class="top-item-tags"><i class="iconfont">&#xe660;</i> ', ' , ', '</p>'); ?>

            </div>
            <!-- .top-item-info -->

          </div>
          <!-- .top-item-content -->

        </div>
        <!-- .top-item  -->

        <?php
            } ?>

          </div>
          <!-- .top-content -->

        </div>
        <!-- .top -->

        <?php
        /**
         * 话题.
         */
        if (is_home() && !is_paged()) {
            // OptionTree
            if (!empty($csf['opt-talk'])) {
                // 分类ID
                $ot_talk = $csf['opt-talk'];
                // 分类名称
                $category_name = get_category($ot_talk)->name;
                // 分类链接
                $category_link = get_category_link($ot_talk);
                // echo $ot_talk.',';
            // print_r($category_name);
            // echo $category_name.',';
            // echo $category_link.',';
            } ?>
          <div class="qa section dp-none dp-lg-block">
            <div class="section-title">
              <h2><svg viewBox="0 0 1024 1024"><path d="M433.424027 782.121151H130.165821V41.193909h763.668358v740.927242h-316.816243l-73.161422 159.057868-70.432487-159.057868z" fill="#FFFFFF"></path><path d="M863.51269 71.515398v680.284264h-305.943824l-53.192555 115.654822-51.2-115.654822H160.48731v-680.067682h703.02538m60.642978-60.642978H99.844332v801.353638h313.870727l35.216244 79.57225 54.405414 122.888663 56.311337-122.065651 36.992217-80.395262h327.688663V10.87242z" fill="#1B5A97"></path><path d="M311.878173 283.375973h431.907952v60.642978H311.878173zM269.081557 470.113029h431.907952v60.642978H269.081557z" fill="#106A37"></path><path d="M582.215905 627.914721L687.864636 160.054146h-62.159052l-105.648731 467.860575h62.159052zM393.572927 627.914721l105.605415-467.860575h-62.159053L331.413875 627.914721h62.159052z" fill="#106A37"></path></svg><?php echo $category_name; ?></h2>
              <div class="section-right"><a href="javascript:;">换一批</a><a href="<?php echo $category_link; ?>" rel="nofollow">全部</a></div>
            </div>
            <!-- .section-title -->

            <div class="qa-content current">

              <div class="qa-renew"><i class="iconfont">&#xea80;</i></div>
              <!-- .qa-renew -->

              <?php
              /**
               * 知识库：最新3条
               */
              $args = array(
                  'cat' => $ot_talk,
                  'posts_per_page' => 3,
                  'order' => 'DESC',
              );
            $qa_latest_query = new WP_Query($args); ?>
              <?php if ($qa_latest_query->have_posts()) :?>
                <ul class="reset-box-model no-bullets latest">
                  <?php while ($qa_latest_query->have_posts()) : $qa_latest_query->the_post(); ?>
                    <li class="flex flex-between">
                      <a class="secondary-link" href="<?php the_permalink(); ?>" target="_blank" rel="bookmark" title="<?php the_title_attribute(); ?>"><i class="iconfont">&#xe702;</i><?php the_title(); ?></a>
                      <span class="dp-none dp-lg-block"><?php if (function_exists('the_views')) {
                the_views();
            } ?> 次查阅</span>
                    </li>
                  <?php endwhile;
            wp_reset_postdata(); ?>
                </ul>
              <?php else : ?>
                      <p><?php esc_html_e('Sorry, no posts matched your criteria.', 'info'); ?></p>
              <?php endif; ?>

              <?php
              /**
               * 知识库：最新排除3条后，最新3条
               */
              $args = array(
                  'cat' => $ot_talk,
                  'posts_per_page' => 3,
                  'order' => 'DESC',
                  'offset' => 3,
              );
            $qa_offset_query = new WP_Query($args); ?>
              <?php if ($qa_offset_query->have_posts()) :?>
                <ul class="reset-box-model no-bullets offset">
                  <?php while ($qa_offset_query->have_posts()) : $qa_offset_query->the_post(); ?>
                    <li class="flex flex-between">
                      <a class="secondary-link" href="<?php the_permalink(); ?>" target="_blank" rel="bookmark" title="<?php the_title_attribute(); ?>"><i class="iconfont">&#xe702;</i><?php the_title(); ?></a>
                      <span class="dp-none dp-lg-block"><?php if (function_exists('the_views')) {
                the_views();
            } ?> 次查阅</span>
                    </li>
                  <?php endwhile;
            wp_reset_postdata(); ?>
                </ul>
              <?php else : ?>
                      <p><?php esc_html_e('Sorry, no posts matched your criteria.', 'info'); ?></p>
              <?php endif; ?>
            </div>
            <!-- .qa-content -->

          </div>
        <!-- .qa -->
        <?php
        }?>

        <?php
        /**
         * 文章循环.
         */
        if (isset($csf['opt_adm_article_loop']) && !empty($csf['opt_adm_article_loop'])) {
            $_m_apl = $csf['opt_adm_article_loop'];
            if (is_home() && !is_paged() && !empty($_m_apl)) {
                echo $_m_apl;
            }
        }?>

        <div class="latest section ">
          <div class="section-title">
            <h2><svg viewBox="0 0 1024 1024"><path d="M588.406751 21.6726a144.664604 144.664604 0 0 0-108.501704 49.547898A144.668938 144.668938 0 0 0 371.403343 21.6726H9.726663v868.017964h361.67668a72.347473 72.347473 0 0 1 53.526987 24.953832l54.974717 62.568796v-108.501704a144.673273 144.673273 0 0 0-108.501704-51.359727H82.061132V94.007069h289.337877a72.347473 72.347473 0 0 1 53.526987 24.953831l18.083617 20.614977v496.822679h72.334469V141.023607l18.083617-20.614977a72.343138 72.343138 0 0 1 54.974717-26.401561H877.740293v493.129667h72.334469V21.6726h-361.668011z" fill="#1B5A97"></path><path d="M118.228367 238.676007h253.170642v72.33447H118.228367zM118.228367 455.683749h180.836172v72.33447h-180.836172zM571.471781 238.676007h253.170642v72.33447h-253.170642zM571.471781 455.683749h253.170642v72.33447h-253.170642z" fill="#1B5A97"></path><path d="M686.375571 999.197877l-233.869025-233.869025 55.737592-55.741927 179.9606 179.964935 277.608666-259.698429 53.852076 57.562425z" fill="#106A37"></path></svg>最新内容</h2>
            <div class="section-right"><a href="<?php echo esc_url(home_url('/')); ?>feed" target="_blank">RSS订阅</a></div>
          </div>
          <!-- .section-title -->

          <?php
          /**
           * 文章列表 loop.
           */
          get_template_part('template-parts/content', 'latest'); ?>
          <!-- .latest-content -->

          <div class="wp-pagenavi-container flex flex-center dp-none dp-md-block">
            <?php wp_pagenavi(); ?>
          </div>
          <!-- .wp-pagenavi-container -->

          <div class="pagination-container flex flex-center dp-md-none">
            <?php
            /**
             * Previous/next page navigation.
             */
            the_posts_pagination(array(
              'mid_size' => 2,
              'prev_text' => __('&lsaquo;', 'info'),
              'next_text' => __('&rsaquo;', 'info'),
              'before_page_number' => null,
            )); ?>
          </div>
          <!-- .pagination-container -->

        </div>
        <!-- .latest -->

      </div>
      <!-- #primary -->

      <?php get_sidebar(); ?>

    </div>
    <!-- #content -->

<?php get_footer(); ?>
