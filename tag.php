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

          <div class="wp-pagenavi-container flex flex-center">
            <?php wp_pagenavi(); ?>
          </div>
          <!-- .wp-pagenavi-container -->

        </div>
        <!-- .posts -->

      </div>
      <!-- #primary -->

    </div>
    <!-- #content -->

<?php get_footer();?>