<?php
$csf = get_option('_prefix_my_options');
?>
    <footer id="colophon" class="site-footer flex flex-column">
        <div class="footer-guide container flex flex-column">
          <div class="item dp-none dp-lg-block">
            <p class="footer-logo"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><img src="<?php echo $csf['opt_footer_logo']["url"];?>" alt="<?php bloginfo('name'); ?>"></a></p>

            <?php if (!empty($csf['opt_footer_desc'])) {?>
              <p class="footer-desc"><?php echo $csf['opt_footer_desc'];?></p>
            <?php }?>
          </div>
          <!-- .item -->

          <div class="item">
            <nav class="footer-navigation">
              <?php
              wp_nav_menu(array(
                'theme_location' => 'menu-2',
                'menu_id' => 'footer-menu',
                'menu_class' => 'footer-menu reset-box-model no-bullets inline-list flex flex-row flex-wrap',
              ));
              ?>
            </nav>
            <!-- .footer-navigation -->
          </div>
          <!-- .item -->

        </div>
        <!-- .footer-guide -->

        <p class="copyright">&copy <?php echo date('Y'); ?> <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>(<?php echo $_SERVER['HTTP_HOST']; ?>)，主题由<a href="https://wpmore.cn/" target="_blank" rel="nofollow">WPMORE</a>开发，服务器由<a href="/ifkc" target="_blank" rel="nofollow">阿里云</a>提供<?php if (!empty(get_option('_prefix_my_options')['opt-icp'])) {
                  ?><a href="https://beian.miit.gov.cn/" rel="nofollow" target="_blank">，<?php echo get_option('_prefix_my_options')['opt-icp']; ?></a><?php
              }?>。</p>
        <!-- .copyright -->

    </footer>
    <!-- #colophon -->


    <div class="float">
      <div class="float-cotnent flex flex-middle flex-center flex-column">
        <a class="qq" href="javascript:;" title="QQ：309946202"><span class="iconfont">&#xe66e;</span></a>
        <a class="wechat" href="javascript:;" title="微信号：faganer"><span class="iconfont">&#xe6cb;</span></a>
        <a class="weibo" href="https://weibo.com/xiedexu/" title="关注微博：鸽听网" target="_blank" rel="nofollow"><span class="iconfont">&#xe641;</span></a>
        <a class="scrollTop" href="javascript:;" title="返回顶部"><span class="iconfont">&#xeb3e;</span></a>
      </div>
      <!-- .float-cotnent -->

    </div>
    <!-- .float -->

  </div>
  <!-- #page -->

  <?php wp_footer(); ?>
  <?php
  /**
   * 更多标签
   * SweetAlert2：https://sweetalert2.github.io/.
   */
  if (!empty($csf['opt_cloud_tag'])) {
      $tags = get_tags(array('orderby' => 'count', 'order' => 'DESC'));
      $html = "<div class='post_tags'>";
      foreach ($tags as $tag) {
          $tag_link = get_tag_link($tag->term_id);

          $html .= "<a href='{$tag_link}' title='{$tag->name}' class='{$tag->slug}'>";
          $html .= "{$tag->name}</a>";
      }
      $html .= '</div>';
      // echo $html;
      $html = str_replace("<div class='post_tags'>", '<div class="post_tags">', $html);
      $html = str_replace("<a href='", '<a target="_blank" href="', $html);
      $html = str_replace("' title='", '" title="', $html);
      $html = str_replace("' class='", '" class="', $html);
      $html = str_replace("'>", '">', $html);

      echo "<script>
        $(function(){
          $('.site-tags-more').click(function(){
            Swal.fire({
              customClass: {
                container: 'tags-all',
                cancelButton: 'btn btn-primary',
              },
              html:'".$html."',
              // showCloseButton: true,
              showCancelButton: true,
              showConfirmButton:false,
              cancelButtonText:'关闭',
              buttonsStyling: false
            });
          });
        });
      </script>";
  }?>
</body>

</html>
