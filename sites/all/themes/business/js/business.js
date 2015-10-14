(function($) {

  Drupal.Business = Drupal.Business || {};
  Drupal.Responsive = Drupal.Responsive || {};

  Drupal.behaviors.actionBusiness = {
    attach: function(context) {

      // $('[data-toggle="offcanvas"]').click(function () {
      //   $('.row-offcanvas').toggleClass('active');
      // });

      $('.btn-btt').click(function() {
        $('html, body').animate({
          scrollTop: 0
        }, 600);
        return false;
      });

      if ($("#search-block-form input[name='search_block_form']").val() === "") {
        $("#search-block-form input[name='search_block_form']").val(Drupal.t("Keywords"));
      }
      $("#search-block-form input[name='search_block_form']").focus(function() {
        if ($(this).val() === Drupal.t("Keywords")) {
          $(this).val("");
        }
      }).blur(function() {
        if ($(this).val() === "") {
          $(this).val(Drupal.t("Keywords"));
        }
      });
      $(window).load(function() {
        $(window).resize(function() {
          Drupal.Responsive.setSlideshowHeight();
        });
      });
      $(window).scroll(function() {
        if ($(window).scrollTop() > 200) {
          $('.btn-btt').show();
        } else
          $('.btn-btt').hide();
      });


      Drupal.Business.setInputPlaceHolder('mail', 'Your Email Address', '.simplenews-subscribe .form-item-mail');
      Drupal.Business.setInputPlaceHolder('keys', 'Keywords', '.search-form');

      // Mobile menu
      $('#menu-toggle').mobileMenu({
        targetWrapper: '#main-menu-wrapper',
        targetMenu: '#block-tb-megamenu-main-menu, #block-superfish-1'
      });

      if ($(window).width() <= 991) {
        $('.mobile-main-menu .region-main-menu').accordionMenu();
      }
      $(window).resize(function() {
        if ($(window).width() <= 991) {
          $('.mobile-main-menu .region-main-menu').accordionMenu();
        }
      });

    }
  };

  Drupal.Responsive.setSlideshowHeight = function() {
    var imgs = $("#views_slideshow_cycle_main_slideshow-block .views-field-field-slideshow img");
    if (imgs.length) {
      var minHeight = imgs.get(0).height;
      imgs.each(function(index, value) {
        if (value.height < minHeight) {
          minHeight = value.height;
          width_img = value.width;
        }
      })
      $('#views_slideshow_cycle_main_slideshow-block .views-slideshow-cycle-main-frame').css('height', minHeight);
      $('#views_slideshow_cycle_main_slideshow-block .views-slideshow-cycle-main-frame-row').css('height', minHeight);
    }

    imgs = $("#views_slideshow_cycle_main_ads-block .views-field-field-slideshow img");
    if (imgs.length) {
      var Height = imgs.get(0).height;
      var width_img = imgs.get(0).width;
      imgs.each(function(index, value) {
        if (value.height < Height) {
          Height = value.height;
        }
      })
      $('#views_slideshow_cycle_main_ads-block .views-slideshow-cycle-main-frame').css({
        'height': Height,
        'width': width_img
      });
      $('#views_slideshow_cycle_main_ads-block .views-slideshow-cycle-main-frame-row').css('height', Height);
    }
  };

  Drupal.Responsive.hide = function() {
    $('#block-search-form')
  }


  Drupal.Business.setInputPlaceHolder = function(name, text, selector) {
    selector = selector == undefined ? '' : selector + ' ';

    if ($.support.placeholder) {
      $(selector + 'input[name="' + name + '"]').attr('placeholder', Drupal.t(text));
    } else {
      $(selector + 'input[name="' + name + '"]').val(Drupal.t(text));
      $(selector + 'input[name="' + name + '"]').focus(function() {
        if (this.value == Drupal.t(text)) {
          this.value = '';
        }
      }).blur(function() {
        if (this.value == '') {
          this.value = Drupal.t(text);
        }
      });
    }
  }

})(jQuery);
