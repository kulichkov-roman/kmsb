var basketUrl = '/personal/cart/';

// показать еще
function newsLoader(p){
    var o = this;

    this.newsBlock = $(p.newsBlock, this.root);
    this.newsLoader = $(p.newsLoader);
    this.ajaxLoader = $(p.ajaxLoader);

    this.curPage = 1;
    this.loadSett = (p.loadSett);
    // загружаем дополнительные новости
    this.loadMoreNews = function(){
        var loadUrl = location.href;
        if(location.search != ''){
            loadUrl += '&';
        }
        else{
            loadUrl += '?';
        }
        loadUrl  += 'PAGEN_'+ o.loadSett.navNum +'=' + (++o.curPage);
        o.ajaxLoader.show();
        $.ajax({
            url: loadUrl,
            type: "POST",
            data:{
                AJAX: 'Y'
            }
        }).done(function(html){
            console.log(html);

            o.newsBlock.append(html);
            o.ajaxLoader.hide();

            if(o.curPage == o.loadSett.endPage){
                o.newsLoader.parent().hide();
            }

            var count = $(".js_b-projects").data("count");
            var countNews = $(".js_b-projects").data("news-count");
            if(o.curPage * countNews >= count){
                $(".all-button").hide();
            }
        });
    };
    this.init = function(){
        o.newsLoader.click(function(event){
            o.loadMoreNews();
            event.preventDefault();
        })
    }
}

$(function () {
    // показать еще (скрытие/раскрытие)
    $('.js-hide-block-b-project').css('display', 'none');

    $('.js-show-all').on('click', function(event){

        event.preventDefault();

        $('.js-hide-block-b-project').slideToggle(function() {
            if($('.js-hide-block-b-project').css('display') == 'none') {
                $('.js-show-all .button-text').text('Показать всё');
            } else {
                $('.js-show-all .button-text').text('Свернуть всё');
            }
        });

    });

    // показать по для списка лабораторий
    var newsSetLoader = new newsLoader({
        newsBlock: '.js_b-projects',
        newsLoader: '.js_all-button',
        ajaxLoader: '.ajax-loader img',
        loadSett:{
            endPage: $(".js_b-projects").data("total-page"),
            navNum: $(".js_b-projects").data("nav-num")
        }
    });
    newsSetLoader.init();

	//"добавить в корзину" - список
	$('.add_to_basket_input').click(function(){
		var productId = $(this).data('product_id');
		var attr = $(this).attr("checked");

        if(typeof attr !== typeof undefined && attr !== false){
			addToBasket(productId, 1, 'oops', 'a_place_to_bury_strangers');
		} else {
			addToBasket(productId, 0, 'oops', 'a_place_to_bury_strangers');
		}
	});

    $('.add_to_basket_input_compare').click(function(){
        var productId = $(this).data('product-id');

        if(productId) {
            addToBasket(productId, 1);
        }
    });

	$('.cart-bin__button').click(function (e) {
		if (!$(this).hasClass('cart-bin__button_state_order')) {
			var product_prop;
			var place;
            // Уточнить(!!!)
            if($('.b-compare') !== undefined){
                var articul_prop = $(".b-card__aside").data("arcticle");
                var product_id = $(".b-card__aside").data("product-id");
    
                product_props = {
                    articul : articul_prop
                };
                
                place = 'detail';
            } else {
                var product_id = $(this).data("product-id");
                
                product_props = {};
                
                place = 'detail';
            }
            
			addToBasket(product_id, 1, product_props, place);

			e.preventDefault();
			$(this).addClass('cart-bin__button_state_order');

			return false;
		}
	});

	/* контролы в корзине */
	$('.cart-grid')

	// удаление
	.find('.cart-delete').each(function () {
		$('<div class="cart-loading"><img src="/files/kom-sib/Design/cart-loader.gif" /></div>').insertAfter($(this));
	}).click(function (e) {
		e.preventDefault();
		if (!$(this).closest('tr').hasClass('cart-grid__row_title')) {
			if (confirm("Вы уверены, что хотите удалить товар из корзины?")) {
				var $row = $(this).closest('tr');
				if (!$row.hasClass('cart-grid__row_item_state_process')) {
					$row.addClass('cart-grid__row_item_state_process cart-grid__row_item_state_deleting');
					//потом тут выполняется аякс-запрос и после его успешного завершения выполняется удаление строки
					//я пока воткну таймаут
					$row
					.find('.cart-count__input').val(0).keyup().end()
					.nextUntil('.cart-grid__row_item').andSelf().remove();
					/*
					window.setTimeout(function() {
					$row
					.find('.cart-count__input').val(0).keyup().end()
					.nextUntil('.cart-grid__row_item').andSelf().remove();
					}, 2000);
					 */
				} else {
					alert('Пожалуйста, подождите, выполняется обработка данных.');
				}
			}
		} else {
			if (confirm("Вы уверены, что хотите очистить корзину?")) {
				$.ajax({
					url : basketUrl,
					type : 'POST',
					data : {
						ajaxBasket : 'Y',
						action : 'clear'
					},
					dataType : 'json',
					success : function (data) {
						if (data == 'success') {
							$('.b-cart').html('<p>Корзина пуста.</p>');
						}
					}
				});

			}
		}
	}).end()

	// + и -
	.find('.cart-count').each(function () {
		$('<div class="cart-loading"><img src="/files/kom-sib/Design/cart-loader.gif" /></div>').appendTo($(this));
	}).end()

	.find('.cart-count__control').click(function (e) {
		e.preventDefault();
		if (!$(this).closest('tr').hasClass('cart-grid__row_item_state_process')) {

			var count = parseInt($(this).siblings('.cart-count__input').val());

			//+
			if ($(this).hasClass('cart-count__control_type_add')) {
				count++;
			}
			// -
			else {
				if (count > 1) {
					count--;
				} else if (count > 0) {
					//при нуле товар удаляем
					if ($(this).closest('tr').hasClass('cart-grid__row_item')) {
						$(this).closest('tr').find('.cart-delete').click();
						count--;
					}
					//а акусессуар оставляем с нулем
					else {
						count--;
					}
				}
			}

			$(this).siblings('.cart-count__input').val(count).keyup();

		} else {
			alert('Пожалуйста, подождите, выполняется обработка данных.');
		}

	}).end()

	//поле ввода количества
	.find('.cart-count__input').keyup(function (e) {
		var $row = $(this).closest('tr').addClass('cart-grid__row_item_state_process cart-grid__row_item_state_counting'),
		$input = $(this);

		//где-то тут отправляется аякс-запрос, после успешного выполнения которого:
		//console.log($input.val());
		//console.log($input.closest('tr.cart-grid__row_odd').data());
		$.ajax({
			url : basketUrl,
			type : 'POST',
			data : {
				ajaxBasket : 'Y',
				action : $input.val() == 0 ? 'delete' : 'update',
				productId : $input.closest('tr.cart-grid__row_odd').data('product-id'),
				quantity : $input.val(),
				mainProductId : $input.closest('tr.cart-grid__row_odd').data('main-product-id')
			},
			dataType : 'json',
			success : function (data) {
				if (data == 'success') {
					//если есть цена
					if ($row.find('.cart-price__value').length) {
						var price = parseInt($row.find('.cart-price__value').text().replace(' ', ''));
						//пересчет суммы товара в исходной валюте
						$row
						.find('.cart-sum__value').text(number_format($input.val() * price, 0, '', ' '));

						//пересчет суммы корзины в рублях
						var result = 0;
						$('.cart-sum').each(function () {
							var sumRur = $(this).find('.cart-sum__value').text().replace(' ', '') * $(this).data('currency');
							result += sumRur;
						});
						$('.bin-summary__value').text(number_format(result, 0, '', ' ') + ' руб.');

					}
					$row.removeClass('cart-grid__row_item_state_process cart-grid__row_item_state_counting');
				}
			}
		});
		/*
		window.setTimeout(function() {
		//если есть цена
		if($row.find('.cart-price__value').length) {
		var price = parseInt($row.find('.cart-price__value').text().replace(' ', ''));
		//пересчет суммы товара в исходной валюте
		$row
		.find('.cart-sum__value').text(number_format($input.val()*price, 0, '', ' '));

		//пересчет суммы корзины в рублях
		var result = 0;
		$('.cart-sum').each(function() {
		var sumRur = $(this).find('.cart-sum__value').text().replace(' ', '')*$(this).data('currency');
		result += sumRur;
		});
		$('.bin-summary__value').text(number_format(result, 0, '', ' ') + ' руб.');

		}
		$row.removeClass('cart-grid__row_item_state_process cart-grid__row_item_state_counting');
		}, 2000);
		 */
	}).end()

	//открыть/закрыть опции
	.find('.js__toggle-options').click(function (e) {
		var $tr = $(this).closest('tr');
		$tr.toggleClass('cart-grid__row_state_opened')
		.nextUntil('.cart-grid__row_item').toggleClass('cart-grid__row_state_opened');
	});

	//удаление в списке сравнения
    $(".compare__item__delete").on('click', function (e) {
		e.preventDefault();
		var colIndex = $(this).closest('td').index();
		var compareUrl = $(this).data("compare-url");
		var productId = $(this).data("element-id");
        $('.compare-grid td:nth-child(' + (colIndex + 1) + ')').remove();

        //console.log($(this));
        //console.log(productId);
        console.log(colIndex);

        $.ajax({
			type : 'get',
			url : compareUrl,
            data : {
				action : "DELETE_FROM_COMPARE_LIST",
                id : productId
			},
            dataType : 'json',
			success : function () {}
		});

		//если удалили все
		if ($('.compare-grid thead').first().find('td').length < 2) {
			$('.b-compare').html('Список сравнения пуст.');
		}
	});
});

// Положить в корзину
function addToBasket(productId, quantity, product_props, place) {

	productData = {
		productId : productId,
		action : 'add',
		quantity : quantity,
		product_props : product_props,
		place : place
	};

	$.ajax({
		type : 'post',
		url : '/include/ajax/add2basket.php',
		dataType : 'json',
		data : productData,
		success : function (data) {
			if (data['status'] == 1) {
                $('#cart_products_count').html(data['productsCount'] + ' ' + data['productsTitle']);
				$('#cart_total_sum').html(data['productsPrice'] + ' руб.');
			}
		}
	})
}

//
function changeCompare(compareUrl, productId) {
    if (!$(".js__compare-id-" + productId).hasClass("checked")) {
		$.ajax({
			type : 'get',
			url : compareUrl,
			data : {
				action : "ADD_TO_COMPARE_LIST",
                id : productId
			},
            dataType : 'json',
			success : function () {}
		});
        // Уточнить(!!!)
        $(".js__compare-id-" + productId).addClass('checked');
        //$(".js__compare-id-" + productId).prop({checked: true});
	} else {
		$.ajax({
			type : 'get',
			url : compareUrl,
            data : {
				action : "DELETE_FROM_COMPARE_LIST",
                id : productId
			},
            dataType : 'json',
			success : function () {}
		});
        // Уточнить(!!!)
        $(".js__compare-id-" + productId).removeClass('checked');
        //$(".js__compare-id-" + productId).prop({checked: false});
	}
}

// Удаление товара из корзины
function shelveProduct(action, productId) {
	productData = {
		productId : productId,
		action : action,
		quantity : 1
	}

	$.ajax({
		type : 'post',
		url : '/include/ajax/add2basket.php',
		dataType : 'json',
		data : productData,
		success : function (data) {
			if (data['status'] == 1) {
				switch (action) {
				case 'shelve':
					if ($('#basket_item_' + productId) !== undefined) {
						$that = $('#basket_item_' + productId).clone();
						$('#basket_item_' + productId).remove();
						$that.attr('id', 'del_basket_item_' + productId);
						$('#delayed_basket_items').append($that.html());
					}
					break;
				case 'unshelve':
					if ($('#del_basket_item_' + productId) !== undefined)
						$that = $('#del_basket_item_' + productId).clone();
					$('#del_basket_item_' + productId).remove();
					$that.attr('id', 'basket_item_' + productId);
					$('#available_basket_items').append($that);
					break;
				}
			}
		}
	});

	return false;
}