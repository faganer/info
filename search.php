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
        <div class="posts">
          <?php
          /**
           * 文章列表 loop
           */
          get_template_part('template-parts/content', 'loop');?>
          <!-- .posts-content -->

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
              'prev_text'          => __('&lsaquo;', 'info'),
              'next_text'          => __('&rsaquo;', 'info'),
              'before_page_number' => null,
            ));?>
          </div>
          <!-- .pagination-container -->

        </div>
        <!-- .posts -->

      </div>
      <!-- #primary -->

    </div>
    <!-- #content -->

<?php get_footer();?>