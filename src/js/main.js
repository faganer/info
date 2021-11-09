/* eslint-disable no-undef */
$(function () {
  // 导航栏
  $('.main-navigation .menu-item-1672').append(
    '<span class="icon icon-hot"></span>'
  )
  $('.main-navigation .menu-item-1672 a').attr('target', '_blank')
  $('.searchinput').on('focus', function () {
    $('.site-searchform').addClass('current')
  })
  $('.searchinput').on('blur', function () {
    $('.site-searchform').removeClass('current')
  })
  $('.menu-min-icon').on('click', function () {
    $('html').addClass('noscroll')
    $('body').addClass('min-menu')
  })
  $('.menu-min-container li a,.menu-min-close').on('click', function () {
    $('html').removeClass('noscroll')
    $('body').removeClass('min-menu')
  })
  $('.site-login.logged a:first').tooltipster({
    theme: 'tooltipster-borderless',
    side: 'left',
    contentAsHTML: true
  })

  // 搜索
  $('.searchform-min-icon').on('click',function(){
    Swal.fire({
      input: 'text',
      inputLabel: '搜索',
      inputPlaceholder: '输入搜索内容...',
      showCancelButton: true,
      confirmButtonText:'确定',
      cancelButtonText:'取消',
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        if($('.swal2-input').val()){
          window.location.href="https://"+window.location.host+"/?s="+$('.swal2-input').val()
        } else {
          Swal.fire('输入内容不能为空！')
        }
      } else {
        Swal.fire('输入搜索内容！')
      }
    })
  })

  // .slider
  // eslint-disable-next-line no-undef
  // eslint-disable-next-line no-unused-vars
  const mySwiper = new Swiper('.home .swiper-container', {
    // Optional parameters
    loop: true,
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets'
    },
    autoplay: {
      delay: 5000
    }
  })

  // 首页：知识库
  // $(".qa-content").addClass("current");
  $('.section-right a:first').on('click', function () {
    $('.qa-content').addClass('renew')
    $('.qa-content').toggleClass('current')
    setTimeout(function () {
      $('.qa-content').removeClass('renew')
    }, 1000)
  })

  // 分页
  $('.page-numbers').each(function () {
    if ($(this).hasClass('current')) {
      $(this).addClass('btn btn-xs btn-secondary')
    } else if ($(this).hasClass('dots')) {
      $(this).addClass('btn btn-xs btn-default')
    } else {
      $(this).addClass('btn btn-xs btn-primary')
    }
  })
  // $(".next.page-numbers,.prev.page-numbers").addClass("iconfont");
  $('.navigation.pagination').css('opacity', '1')

  // 去掉single page figure尺寸
  $('.single figure,.page figure').removeAttr('style')
  $('.single figure img,.page figure img')
    .removeAttr('width')
    .removeAttr('height')
  $('.single figure,.page figure').css('opacity', '1')
  $('.post-content img').removeAttr('width').removeAttr('height')

  // 密码保护文章
  $('form.post-password-form input[type=submit]').addClass('btn btn-primary')
  $('form.post-password-form').css('opacity', '1')

  // 分享
  $('.single .modal-share-wechat .qrcode').qrcode({
    width: 128,
    height: 128,
    text: window.location.href
  })
  $('.post-share i').on('click', function () {
    const title = 'title=' + $('title').text() // 标题
    const url = '&url=' + window.location.href // 链接
    const appkey = '&appkey=' + '3411539221' // 微博appkey
    let WeibPic = ''
    let QQPics = ''
    if ($('.post-content img').length > 0) {
      WeibPic = '&pic=' + $('.post-content img')[0].src
      QQPics = '&pics=' + $('.post-content img')[0].src
    }

    const stringWeibo = 'https://service.weibo.com/share/share.php?' + title + url + appkey + WeibPic + '&content=utf-8&searchPic=true&language=zh_ch'
    const stringQQ = 'https://connect.qq.com/widget/shareqq/index.html?' + title + url + QQPics

    // 分享到微博
    if ($(this).hasClass('share-weibo')) {
      window.open(stringWeibo, 'newwindow')
    }

    // 分享到QQ
    if ($(this).hasClass('share-qq')) {
      window.open(stringQQ, 'newwindow')
    }

    // 分享到微信
    if ($(this).hasClass('share-wechat')) {
      Swal.fire({
        customClass: {
          container: 'swal2-wechat',
          cancelButton: 'btn btn-primary'
        },
        html: '<div class="swal2-wechat-qrcode"></div><p>使用微信“扫一扫”即可将本文分享到朋友圈</p>',
        // showCloseButton: true,
        title: '分享到微信',
        showCancelButton: true,
        showConfirmButton: false,
        cancelButtonText: '关闭',
        buttonsStyling: false
      })
      $('.swal2-wechat-qrcode').qrcode({
        width: 200,
        height: 200,
        text: window.location.href
      })
    }
  })

  // 视频自适应
  const pWidth = $(".single .post-content").width()
  $(".single video").each(function(){
    const vWidth = $(this).width()
    const vHeight = $(this).height()
    $(this).height(pWidth * vHeight / vWidth)
    $(this).width(pWidth)
  })

  // 表格
  $('.single table,.page table').each(function(){
    $(this).addClass('table').wrap('<div class="table-responsive"></div>')
  })

  // 推荐
  $('.single .post-share').before('<div class="alert alert-primary" role="alert"><h4 class="alert-heading">推荐</h4><p>阿里云-云小站 -> <a href="https://www.aliyun.com/minisite/goods?userCode=zj48tyhb" class="alert-link" target="_blank">限量代金券</a>，爆款产品5折起。</p><p>滴滴云ai大师码为：<b>2222</b>，可以享受专属折扣。</p><p>滴滴云使者为开发者而生，滴滴云提供专业、便捷、高效的云服务，最高 -> <a class="alert-link" href="https://i.didiyun.com/2dJFbGQJVmM" rel="external nofollow noopener" target="_blank">6折扣代金券</a>。</p>')

  // 评论
  $('.single .form-submit .submit')
    .addClass('btn btn-secondary')
    .css('opacity', '1')
  const commentPlaceholder = $('.single .comment-form-comment label').text()
  const authorPlaceholder = $('.single .comment-form-author label').text()
  const emailPlaceholder = $('.single .comment-form-email label').text()
  const urlPlaceholder = $('.single .comment-form-url label').text()
  $('.single .comment-form-comment textarea').attr(
    'placeholder',
    commentPlaceholder
  )
  $('.single .comment-form-author input').attr('placeholder', authorPlaceholder)
  $('.single .comment-form-email input').attr('placeholder', emailPlaceholder)
  $('.single .comment-form-url input').attr('placeholder', urlPlaceholder)
  $('.single .comment-author .says').html('：').css('opacity', '1')
  $('.comment-author .fn a').attr('target', '_blank')

  // sidebar
  $('.detail p').tooltipster({
    theme: 'tooltipster-borderless',
    side: 'top',
    contentAsHTML: true
  })

  // .tab
  $('.tab-head-item').on('click', function () {
    $(this).addClass('current').siblings().removeClass('current')
    $(this)
      .parent()
      .parent('.tab')
      .children()
      .children('.tab-content-item')
      .eq($(this).index())
      .addClass('current')
      .siblings()
      .removeClass('current')
  })

  // 右侧浮动
  $(window).on('scroll', function () {
    const top = $(window).scrollTop()
    if (top > 300) {
      $('.float').fadeIn('slow')
    } else {
      $('.float').fadeOut('slow')
    }
  })
  $('.float .scrollTop').on('click', function () {
    $('html,body').animate({
      scrollTop: 0
    })
  })
  $('.float a').tooltipster({
    theme: 'tooltipster-borderless',
    side: 'left',
    contentAsHTML: true
  })

})

// https://highlightjs.org/usage/
if ($('.single .post-content').length > 0) {
  hljs.initHighlightingOnLoad()
}
