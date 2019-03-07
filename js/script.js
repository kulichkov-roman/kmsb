$(function() {

  jQuery.extend(jQuery.validator.messages, {
    email: "Некорректный адрес электронной почты",
    required: "Необходимо заполнить"
  });

  if(typeof $.fancybox.defaults != 'undefined'){
    $.extend($.fancybox.defaults.tpl, {
      error    : '<p class="fancybox-error">Запрошенный контент не может быть загружен.<br/>Пожалуйста, попробуйте еще раз позже.</p>',
      closeBtn : '<a title="Закрыть" class="fancybox-item fancybox-close" href="javascript:;"></a>',
      next     : '<a title="Следующий" class="fancybox-nav fancybox-next" href="javascript:;"><span></span></a>',
      prev     : '<a title="Предыдущий" class="fancybox-nav fancybox-prev" href="javascript:;"><span></span></a>'
    });
    $.extend($.fancybox.defaults.helpers, {
      overlay: {
        css: {
          'backgroundImage': 'url(/files/kom-sib/Design/fancybox-overlay.png)'
        }
      },
      title: {
        type: 'inside'
      }
    });
  }

  $('.b-popup-form_auth form').validate();
  $('.validate').validate();
  $('.auth-form').validate();
  $('.remind-form').validate();
  $('.phone-field').mask('(999) 999-9999');


  $('.search-section__value').click(function(e) {
    e.preventDefault();
    $(this)
      .closest('.search-section__content').toggleClass('search-section__content_state_opened')
        .closest('.search-section')
          .siblings()
            .find('.search-section__content_state_opened').removeClass('search-section__content_state_opened');
  });
  // Перенес в developers.js
  /*$('.cart-bin__button').click(function(e) {
    if(!$(this).hasClass('cart-bin__button_state_order')) {
      e.preventDefault();
      $(this).addClass('cart-bin__button_state_order');
    }
  });*/
  $('.js__openPhotoInPopup').fancybox();

  $('.js__openBlockInPopup').fancybox({
    fitToView: false
  });
  $('.js__openFormInPopup').fancybox({
    fitToView: false,
    helpers: {
      title: null
    },
    padding: 0,
    wrapCSS: 'form-skin'
  });

  $(document). on('click', '.js__openFormInPopupFeedback', function(){
    var person_id = $(this).data('id');
    var person_name = $(this).data('name');
    $.fancybox({
      href:$(this).attr('href'),
      fitToView: false,
      helpers: {
        title: null
      },
      beforeShow: function(){
        $('.js__person-field').val(person_id);
        $('.js__name-field').val(person_name);
      },
      afterShow: function() {
        $(this.wrap).draggable({
          containment: "parent",
          scroll: false
        });
      },
      padding: 0,
      wrapCSS: 'form-skin'
    });
  });
  
  $('.feedback__form').live('submit', function(){
    var title = 'Заявка для '
      + $(this).find('.js__name-field').val()
      + ' от '  + $('.js__field-fio').val()
      + ' за ' + new Date().toLocaleString();
    $('.js__title-field').val(title);
  });

  //пометить разделы каталога, в которых есть вложенные
  $('.catalog-menu__item .catalog-menu__list')
    .siblings('.catalog-menu__link').addClass('catalog-menu__link_type_folder').click(function(e) {
      e.preventDefault();
      if($(this).closest('li').is(':visible')) {
        $(this)
          .closest('li').addClass('catalog-menu__item_state_opened').end()
          .siblings('.catalog-menu__list').slideToggle(function(e) {
            if($(this).is(':hidden')) {
              $(this).closest('li').removeClass('catalog-menu__item_state_opened');
            }
          });
      }
      else {
        $(this)
          .closest('li').addClass('sds').toggleClass('catalog-menu__item_state_opened').end()
            .siblings('.catalog-menu__list').toggle();
      }

  });

  $('.catalog-menu__item_state_active').addClass('catalog-menu__item_state_opened').children('.catalog-menu__list').show();

  $('.menu-toggle__link').click(function(e) {
    e.preventDefault();
    var $nextItem = $(this).closest('li').next().length ? $(this).closest('li').next() : $(this).closest('ul').children().first();
    $(this).closest('li').removeClass('menu-toggle__item_state_active');
    $nextItem.addClass('menu-toggle__item_state_active');

    if($(this).data('action') == 'open-all') {
      $('.catalog-menu__link_type_folder').each(function() {
        if(!$(this).closest('li').hasClass('catalog-menu__item_state_opened')) {
          $(this).addClass('check1').click();
        }
      });
    }
    if($(this).data('action') == 'close-all') {
      $('.catalog-menu__item_state_opened').each(function(e) {
        $(this).find('.catalog-menu__link_type_folder').first().click();
      });
    }
    if(($(this).data('action') == 'show-all') || ($(this).data('action') == 'show-available')) {
       $('.catalog-menu__list').first().toggleClass('catalog-menu__list_mode_balances');
    }
  });


  $('.lineup-gallery').each(function() {
    if($(this).find('.lineup__item').length > 5) {
      $(this).addClass('carousel')
        .find('.lineup-gallery-wrap').addClass('swiper-container').end()
        .find('.lineup__list').addClass('swiper-wrapper').end()
        .find('.lineup__item').addClass('swiper-slide');
      var $prev = $('<a href="javascript:;" class="b-lineup__control b-lineup__control_prev b-lineup__control_state_disabled" title="Назад"><span class="control-icon">&nbsp;</span></a>').appendTo($(this)),
          $next = $('<a href="javascript:;" class="b-lineup__control b-lineup__control_next" title="Вперед"><span class="control-icon">&nbsp;</span></a>').appendTo($(this));
      var initIndex = 0;
      if($(this).find('.lineup__item_state_active').length) {
        initIndex = $(this).find('.lineup__item_state_active').index();
      }
      var lineupCarousel = $(this).find('.swiper-container').swiper({
        calculateHeight: true,
        slidesPerView: 5,
        slidesPerViewFit: false,
        grabCursor: true,
        shortSwipes: false,
        slideElement: 'li',
        initialSlide: initIndex,
        onInit: function(swiper) {
          if(!$(swiper.visibleSlides).first().prev().length) {
            $prev.addClass('b-lineup__control_state_disabled');
          }
          else {
            $prev.removeClass('b-lineup__control_state_disabled');
          }

          if(!$(swiper.visibleSlides).last().next().length) {
            $next.addClass('b-lineup__control_state_disabled');
          }
          else {
            $next.removeClass('b-lineup__control_state_disabled');
          }
        },
        onSlideChangeEnd: function(swiper) {

          if(!$(swiper.visibleSlides).first().prev().length) {
            $prev.addClass('b-lineup__control_state_disabled');
          }
          else {
            $prev.removeClass('b-lineup__control_state_disabled');
          }

          if(!$(swiper.visibleSlides).last().next().length) {
            $next.addClass('b-lineup__control_state_disabled');
          }
          else {
            $next.removeClass('b-lineup__control_state_disabled');
          }
        },
        onTouchEnd: function(swiper) {
          if(!$(swiper.visibleSlides).first().prev().length) {
            $prev.addClass('b-lineup__control_state_disabled');
          }
          else {
            $prev.removeClass('b-lineup__control_state_disabled');
          }

          if(!$(swiper.visibleSlides).last().next().length) {
            $next.addClass('b-lineup__control_state_disabled');
          }
          else {
            $next.removeClass('b-lineup__control_state_disabled');
          }
        }
      });

      $prev.click(function(e){
        e.preventDefault();
        if(!$(this).hasClass('b-lineup__control_state_disabled')) {
          lineupCarousel.swipePrev();
        }
      });

      $next.click(function(e){
        e.preventDefault();
        if(!$(this).hasClass('b-lineup__control_state_disabled')) {
          lineupCarousel.swipeNext();
        }
      });
    }
  });


  $('.card-preview').each(function() {
    if($(this).find('.card-preview__item').length > 3) {
      $(this).addClass('carousel')
        .find('.card-preview-wrap').addClass('swiper-container').end()
        .find('.card-preview__list').addClass('swiper-wrapper').end()
        .find('.card-preview__item').addClass('swiper-slide');
      var $prev = $('<a href="javascript:;" class="card-preview__control card-preview__control_prev" title="Назад">&nbsp;</a>').appendTo($(this)),
          $next = $('<a href="javascript:;" class="card-preview__control card-preview__control_next" title="Вперед">&nbsp;</a>').appendTo($(this));

      var previewCarousel = $(this).find('.swiper-container').swiper({
        slidesPerView: 3,
        grabCursor: true,
        preventLinksPropagation: true,
        slideElement: 'li'
      });

      $prev.click(function(e){
        e.preventDefault();
        previewCarousel.swipePrev();
      });

      $next.click(function(e){
        e.preventDefault();
        previewCarousel.swipeNext();
      });
    }
    $(this).find('.swiper-container').on('touchstart mousedown',function(e){e.stopPropagation()});
  });

 $('.offer-gallery').each(function() {
    if($(this).find('.offer__item').length > 1) {
      $(this).addClass('carousel')
        .wrapInner('<div class="offer-gallery-container swiper-container"></div>')
        .find('.offer__list').addClass('swiper-wrapper').end()
        .find('.offer__item').addClass('swiper-slide');
      var $prev = $('<a href="javascript:;" class="gallery__control gallery__control_prev" title="Назад"><span class="control-icon">&nbsp;</span></a>').appendTo($(this)),
          $next = $('<a href="javascript:;" class="gallery__control gallery__control_next" title="Вперед"><span class="control-icon">&nbsp;</span></a>').appendTo($(this));

      var offerCarousel = $(this).find('.swiper-container').swiper({
        autoplay: 4000,
        calculateHeight: true,
        slidesPerView: 1,
        grabCursor: true,
        slideElement: 'li',
        speed: 500,
        loop: true
      });

      $prev.click(function(e){
        e.preventDefault();
        offerCarousel.swipePrev();
      });

      $next.click(function(e){
        e.preventDefault();
        offerCarousel.swipeNext();
      });
    }
  });

  $('.index-section_news').each(function() {
    if($(this).find('.news__item').length > 1) {
      var height = $(this).find('.news__list').height();
      $(this).find('.news__item').height(height);
      $(this)
        .find('.news__list').wrap('<div class="news-gallery-container swiper-container"></div>')
        .addClass('swiper-wrapper')
        .find('.news__item').addClass('swiper-slide');

      var newsCarousel = $(this).find('.swiper-container').swiper({
        autoplay: 5000,
        calculateHeight: true,
        loop: true,
        mode: 'vertical',
        grabCursor: true,
        slideElement: 'li',
        slidesPerView: 1,
        speed: 500
      });
    }
  });

  $(document).on('click', '.js__changePhotoInGallery', function(e) {
    e.preventDefault();
    if(!$(this).closest('li').hasClass('card-preview__item_state_active')) {
      $(this).closest('li').addClass('card-preview__item_state_active').siblings().removeClass('card-preview__item_state_active');
      var index = parseInt($(this).attr('href').split('photo')[1]) - 1;
      $('.card-gallery__item').eq(index).addClass('card-gallery__item_state_active').siblings().removeClass('card-gallery__item_state_active');
    }
  });

  $('.js__toggle-all-options').click(function(e) {
    e.preventDefault();
    $(this).toggleClass('state_opened');
    if($(this).hasClass('state_opened')) {
      $('.cart-grid__row_item, .cart-grid__row_option').addClass('cart-grid__row_state_opened');
    }
    else {
      $('.cart-grid__row_item, .cart-grid__row_option').removeClass('cart-grid__row_state_opened');
    }
  });

  window.setTimeout(function() {
    $('.js__toggle-all-options').addClass('toggle-all-options-button_highlight');
    window.setTimeout(function() {
      $('.js__toggle-all-options').addClass('toggle-all-options-button_highlight2');
    }, 1000);
  }, 5000);


  /*$(document).on('click', '.b-popup-form_auth .submit', function(e) {
    e.preventDefault();
    window.location = '/basket1/';
  });*/

  $('.js__changeAuthForm').click(function(e) {
    e.preventDefault();
    $(this).closest('.popup-form').removeClass('popup-form_state_active').siblings('.popup-form').addClass('popup-form_state_active');
  });

  $('.js__addItemToCompare').change(function() {
    if($('.js__addItemToCompare:checked').length > 2) {
      $('.js__addItemToCompare:not(:checked)').attr('disabled', 'disabled');
    }
    else {
      $('.js__addItemToCompare:not(:checked)').removeAttr('disabled');
    }
    if($('.js__addItemToCompare:checked').length > 1) {
      $('.js__goToCompareIcon').removeClass('state_disabled');
      if($('.js__goToCompareButton').length) {
        $('.js__goToCompareButton').removeClass('state_disabled');
      }
      else {
        //$('.catalog-grid').after('<a class="compare-button js__goToCompareButton" href="/compare/">Сравнить</a>');
        $('.catalog-grid').after('<a class="compare-button js__goToCompareButton" href="/catalog/compare/">Сравнить</a>');
      }
    }
    else {
      $('.js__goToCompareIcon').addClass('state_disabled');
      $('.js__goToCompareButton').addClass('state_disabled');
    }
  });

  $('.js__goToCompareIcon').click(function(e) {
    if($(this).hasClass('state_disabled')) {
      e.preventDefault();
    }
  });

   $( ".compare-details__content" ).each(function() {
     var popupTitle = $(this).prev('.compare-details__button').attr('title');
     $(this).dialog({
       autoOpen: false,
       closeText: 'Закрыть',
       dialogClass: 'compare-details',
       title: 'Переместить',
       width: 600
     });
   });

  $('.js__openCompareDetails').click(function(e) {
    e.preventDefault();
    $('#details-' + $(this).data('href')).dialog('open');
  })

  $('.compare-grid').stickytable();

  $('.site-search .submit').click(function(e) {
    e.preventDefault();
    window.location = '/search/';
  });

  $('.js__toggleOrderContent').click(function(e) {
    e.preventDefault();
    $(this).next('.order-content__content').not(':animated').slideToggle();
  });

  if($('.promo__item').length > 1) {
    $('.promo__list').addClass('kwicks').kwicks({
      minSize: '60px',
      spacing: 0,
      behavior: 'slideshow',
      interval: 10000
    }).kwicks('select', 0);;
  }

  $('.staff__header').click(function(e) {
    e.preventDefault();
    if(!$(this).closest('.staff-section').hasClass('staff-section_state_opened')) {
      $(this)
        .next('.staff__content').not(':animated').slideToggle(function(e) {
          if($(this).is(':visible')) {
            $(this).closest('.staff-section').addClass('staff-section_state_opened');
          }
          else {
            $(this).closest('.staff-section').removeClass('staff-section_state_opened');
          }
        })
          .closest('.staff-section')
            .siblings().removeClass('staff-section_state_opened')
              .find('.staff__content').not(':animated').slideUp();
    }
    else {
      $(this)
        .next('.staff__content').not(':animated').slideUp(function(e) {
          $(this).closest('.staff-section').removeClass('staff-section_state_opened');
        });
    }
    window.location.hash = $(this).attr('id');
  });


  $('.project-preview').each(function() {
    var ItemLength = $(this).find('.project-preview__item').length,
        ItemPerView = 4;
    if(ItemLength > ItemPerView) {
      $(this).addClass('carousel')
        .wrapInner('<div class="project-preview-wrap swiper-container"></div>')
        .find('.project-preview__list').addClass('swiper-wrapper').end()
        .find('.project-preview__item').addClass('swiper-slide');
      var $prev = $('<a href="javascript:;" class="project-preview__control project-preview__control_prev project__control_state_disabled" title="Назад">&nbsp;</a>').appendTo($(this)),
          $next = $('<a href="javascript:;" class="project-preview__control project-preview__control_next" title="Вперед">&nbsp;</a>').appendTo($(this));

      var previewCarousel = $(this).find('.swiper-container').swiper({
        slidesPerView: ItemPerView,
        grabCursor: true,
        preventLinksPropagation: true,
        slideElement: 'li',
        onSlideChangeEnd: function(swiper) {

          if(!$(swiper.visibleSlides).first().prev().length) {
            $prev.addClass('project__control_state_disabled');
          }
          else {
            $prev.removeClass('project__control_state_disabled');
          }

          if(!$(swiper.visibleSlides).last().next().length) {
            $next.addClass('project__control_state_disabled');
          }
          else {
            $next.removeClass('project__control_state_disabled');
          }
        },
        onTouchEnd: function(swiper) {
          if(!$(swiper.visibleSlides).first().prev().length) {
            $prev.addClass('project__control_state_disabled');
          }
          else {
            $prev.removeClass('project__control_state_disabled');
          }

          if(!$(swiper.visibleSlides).last().next().length) {
            $next.addClass('project__control_state_disabled');
          }
          else {
            $next.removeClass('project__control_state_disabled');
          }
        }
      });

      $prev.click(function(e){
        e.preventDefault();
        if(!$(this).hasClass('project__control_state_disabled')) {
          previewCarousel.swipePrev();
        }
      });

      $next.click(function(e){
        e.preventDefault();
        if(!$(this).hasClass('project__control_state_disabled')) {
          previewCarousel.swipeNext();
        }
      });
    }
    $(this).find('.swiper-container').on('touchstart mousedown',function(e){e.stopPropagation()});
  });

  $('.project-preview__link').click(function(e) {
    e.preventDefault();
    if(!$(this).closest('li').hasClass('project-preview__item_state_active')) {
      $(this).closest('li').addClass('project-preview__item_state_active').siblings().removeClass('project-preview__item_state_active');
      var index = $(this).closest('li').index();
      $(this).closest('.project-photo').find('.project-photo__item').eq(index).addClass('project-photo__item_state_active').siblings().removeClass('project-photo__item_state_active');
    }
  });
  $('.project-photo__link').fancybox();

  $('.offer__link-more').click(function(e) {
    e.preventDefault();
    $(this).closest('.offer__item').find('.offer__announce').not(':animated').slideToggle(function() {
      if($(this).is(':visible')) {
        $(this).closest('.offer__item').addClass('offer__item_state_opened');
      }
      else {
        $(this).closest('.offer__item').removeClass('offer__item_state_opened');
      }

    });
  });


  //фильтр в списке товаров
  $('.search-section__title').click(function(e) {
    e.preventDefault();
    $(this)
      .closest('.search-section').addClass('search-section_state_opened')
        .find('.search-section__dropdown')
          .not(':animated').slideToggle(function() {
            if($(this).is(':hidden')) {
              $(this).closest('.search-section').removeClass('search-section_state_opened');
              $(document).unbind('keyup', closeFilterDropdownByEsc);
              $('body').unbind('click', closeFilterDropdownByClick);
            }
            else {
              $(document).bind('keyup', closeFilterDropdownByEsc);
              $('body').bind('click', closeFilterDropdownByClick);
            }
          })
          .end()
        .end()
        .siblings('.search-section_state_opened').removeClass('search-section_state_opened')
          .find('.search-section__dropdown').not(':animated').slideUp();
  });

  $('.js__filterCatalogList').click(function(e) {
    e.preventDefault();
    if($(this).hasClass('search-section__button_selected')) {
      var checked = $(this).closest('.search-section__dropdown').find('input:checked').length;
      if(checked > 0) {
        $(this)
          .closest('.search-section').addClass('search-section_state_filled')
            .find('.search-section__value').text(' (выбрано параметров: ' + checked + ')').end()
            .find('.search-section__dropdown')
              .not(':animated').slideUp(function() {
                $(this).closest('.search-section').removeClass('search-section_state_opened');
              });
        $(this).closest('.search-section__dropdown').find('.select__control').removeClass('state_attached').filter(':checked').addClass('state_attached');

        $('#del_filter').show();
        $('#modef').removeClass('state_deleted');
      }
      else {
        $(this)
          .closest('.search-section')
            .find('.search-section__button_all').click();
      }

    }
    if($(this).hasClass('search-section__button_all')) {
      $(this)
        .closest('.search-section').removeClass('search-section_state_filled')
          .find('input:checked').removeClass('state_attached').click().end()
          .find('.search-section__value').text('').end()
          .find('.search-section__dropdown')
            .not(':animated').slideUp(function() {
              $(this).closest('.search-section').removeClass('search-section_state_opened');
            });
    }

  });

  $(document).on('click', '#del_filter', function(e) {
    e.preventDefault();
    console.log('check');
    $('.b-catalog-search .state_attached').addClass('check').click();
    $('.js__filterCatalogList.search-section__button_selected').click();
    $(this).hide();
    $('#modef').addClass('state_deleted').hide();
  });

  $('.js__openDealerAccessError').fancybox({
    content: '<div class="b-download-error">У вас недостаточно прав для&nbsp;скачивания прайс-листов</div>',
    wrapCSS: 'form-skin'
  });

});


(function($){
	$.fn.stickytable = function(options){

		var settings = $.extend({},$.fn.stickytable.defaults, options);

		return this.each(function(index){
			var table = $(this);
			var fixedheader = $('<div class="compare-header_fixed"></div>');
			var tableOffset = table.offset().top;
			var tableleft = table.offset().left;
			var tablewidth = table.width();
			var tableheight = table.height();

			if($('thead',table).length < 1) {
				if($('th',table).length > 0){
					$('th',table).eq(0).parent().wrap('<thead class="theader"></thead>');
					$('.theader',table).prependTo(table);
				}

				else $('tr',table).eq(0).wrap('<thead></thead>');
			}

			var $header = $("thead", table).clone();
			var newTable = $('<table class="'+table.attr('class')+'" cellpadding="0" cellspacing="0" border="0"></table>');
			$header.appendTo(newTable);
			newTable.css('margin','0');

			fixedheader.css({
				'position':'fixed',
				'top':'0px',
				'display':'none',
				'left':tableleft+'px',
				'width':tablewidth+2+'px',
				'z-index': '103'
			});
			var $fixedHeader = fixedheader.append(newTable);

			table.find('th').each(function(index, valuee){
				$header.find('th').eq(index).css('width',$(this).width()+'px');
			});

			$(window).on("scroll", function() {
				var offset = $(this).scrollTop();
				tableOffset = table.offset().top;
				tablewidth = table.width();
				tableheight = table.height();
				if (offset >= tableOffset && $fixedHeader.is(":hidden") && offset < tableOffset+tableheight) {
					fixedheader.appendTo('body');
					$fixedHeader.fadeIn(100);
					table.addClass('stuck');
				}
				else if (offset < tableOffset || offset > tableOffset+tableheight-30) {
					$fixedHeader.fadeOut(150);
					table.removeClass('stuck');
				}
			});

		});
	}


	$.fn.stickytable.defaults = {

	}

})(jQuery);

function closeFilterDropdownByClick(e) {
  if(!$(e.target).closest('.search-section_state_opened').length) {
    closeFilterDropdown();
  }
}
function closeFilterDropdownByEsc(event) {
  if(event.keyCode == 27){
    closeFilterDropdown();
  }
}
function closeFilterDropdown() {
  $('.search-section_state_opened')
    .find('.search-section__dropdown').each(function() {
      $(this).not(':animated').slideUp(function() {

          $(this).find('.select__control:checked').not('.state_attached').click();
          $(this).find('.state_attached').not(':checked').click();

        $(this).closest('.search-section').removeClass('search-section_state_opened');
      });
    });

  $(document).unbind('keyup', closeFilterDropdownByEsc);
  $('body').unbind('click', closeFilterDropdownByClick);
}