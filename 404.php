<?php get_header();?>

    <div id="content" class="site-main flex flex-middle flex-center">
      <?php
        /**
         * Breadcrumbs
         */
        if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p id="breadcrumbs" class="dp-none">', '</p>');
        }
        ?>
      <div class="container flex flex-middle flex-center">

        <div class="nothing flex flex-middle flex-center flex-column">
          <p><span class="icon icon-404"></span></p>
          <p><?php esc_html_e('Sorry, no posts matched your criteria.', 'info'); ?></p>
          <p><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"  class="btn btn-primary"><?php esc_html_e('Back home', 'info'); ?></a></p>
        </div>

      </div>
      <!-- .container -->

    </div>
    <!-- #content -->

<?php get_footer();?>