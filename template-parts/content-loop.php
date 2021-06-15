<?php
$csf = get_option('_prefix_my_options');
?>
<div class="posts-content">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <div class="posts-item flex flex-column">
      <div class="posts-item-content flex flex-stretch">
          <?php
          /**
           * 特色图像.
           */
          if (has_post_thumbnail()) {
              $full_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
      <a class="posts-item-cover flex flex-center"
        href="<?php the_permalink(); ?>" target="_blank"
        rel="bookmark"><img
          src="<?php echo $full_image_url[0]; ?>?x-oss-process=image/auto-orient,1/resize,m_fill,w_208,h_116/quality,Q_100"
          alt="<?php echo the_title_attribute(array('echo' => 0)); ?>"></a>
      <?php
          }
            /*
             * 无特色图像，随机取出一组幻灯
             */
                      elseif (isset($csf['opt-thumbnail']) && !empty($csf['opt-thumbnail'])) {
                          $slides = $csf['opt-thumbnail'];
                          $random_keys = array_rand($slides, 1); ?>
              <?php

              $random_keys = array_rand($slides, 1); ?>
              <a class="posts-item-cover flex flex-center" href="<?php the_permalink(); ?>" target="_blank" rel="bookmark"><img src="<?php echo  $slides[$random_keys]['opt-thumbnail-upload']; ?>?x-oss-process=image/auto-orient,1/resize,m_fill,w_208,h_116/quality,Q_100" alt="<?php echo the_title_attribute(array('echo' => 0)); ?>"></a>
              <?php
                      }?>
      <!-- .posts-item-cover -->

          <div class="posts-item-info flex flex-column">
            <h3 class="posts-item-title reset-box-model reset-font">
            <?php if(get_field('original')) {?><span class="badge badge-danger">原创</span><?php }?><a class="secondary-link" href="<?php the_permalink(); ?>" target="_blank" rel="bookmark"><?php the_title(); ?></a>
            </h3>
            <!-- .posts-item-title -->

            <div class="posts-item-meta flex flex-between">
              <div class="meta-left flex">
                <span class="author">作者 : <?php the_author_posts_link(); ?></span>
                <!-- .author -->

                <span class="cat dp-none dp-lg-block">类别 : <?php the_category(', '); ?></span>
                <!-- .cat -->

              </div>
              <!-- .meta-left -->

              <div class="meta-right dp-none dp-lg-block">
                <span class="author" title="发布时间：<?php the_time('Y-m-d'); ?>"><?php the_time('Y-m-d'); ?></span>
                <!-- .time -->

              </div>
              <!-- .meta-right -->

            </div>
            <!-- .posts-item-meta -->

            <p class="posts-item-desc reset-box-model dp-none dp-lg-block">
              <?php
              // 子标题
              $subtitle = get_field('subtitle');
              if (!empty($subtitle)) {
                  echo $subtitle;
              }
              // // 文章简介
              // elseif (!empty(get_the_excerpt())) {
              //     echo mb_strimwidth(get_the_excerpt(), 0, 111, '...');
              // }
              // 截取文章内容
              else {
                  $content = get_the_content();
                  $content = wp_strip_all_tags(str_replace(array('[', ']'), array('<', '>'), $content));
                  echo mb_strimwidth(strip_tags($content), 0, 111, '...');
              }?>
            </p>
            <!-- .posts-item-desc -->

            <?php the_tags('<p class="posts-item-tags flex dp-none dp-lg-block"><i class="iconfont">&#xe660;</i> : ', ' , ', '</p>'); ?>

        </div>
        <!-- .posts-item-info -->

      </div>
      <!-- .posts-item-content -->

    </div>
    <!-- .posts-item  -->

  <?php endwhile; wp_reset_postdata(); ?>

  <?php else : ?>
          <p><?php esc_html_e('Sorry, no posts matched your criteria.', 'info'); ?></p>
  <?php endif; ?>
</div>
