/***DROPDOWN***/
function hideDropdown() {
	if($(".navbar-toggle").css("display") == "none") {
		$(".navbar-nav .dropdown-menu").each(function() {
			if($(this).css("display") == "block")
				$(this).hide();				
		});
		$(".navbar-nav .dropdown").each(function() {
			if($(this).hasClass("open"))
				$(this).removeClass("open");
		})
	}
}

/***FIXED_MENU***/
function fixedMenu() {	
	var menuWrap = $(".top-menu-wrapper"),
		menuWrapTop = menuWrap.offset().top,		
		menu = $(".top-menu"),
		menuHeight = menu.outerHeight(),
		top = $(document).scrollTop();			
	if(top > menuWrapTop && $(".navbar-toggle").css("display") == "none") {
		menu.addClass("fixed");
		menuWrap.css({height: menuHeight + "px"});			
	} else {
		menu.removeClass("fixed");
		menuWrap.css({height: ""});			
	}	
}

/***SLIDER***/
function adjustSlider() {		
	var slide = $(".slider .slider-item"),		
		ks = 3.2;	
	slide.height(Math.ceil($(window).width() / ks));
}

/***SERVICES_SECTIONS***/
function adjustServicesSections() {		
	var pic = $(".services-item .item-pic"),
		picSec = $(".section-item .item-pic"),
		kss = 4 / 3;	
	pic.height(Math.ceil(pic.width() / kss));
	picSec.height(Math.ceil(picSec.width() / kss));
}

/***GALLERY***/	
function adjustGalleryBg() {		
	$(".gallery").each(function() {		
		var elemsBgSearch = $(this).find(".gallery-item-bg");
		if(!!elemsBgSearch) {
			elemsBgSearch.parent().remove();
		}		
		var i, elemsCount = $(this).find(".fancyimage").length;
		if($(".navbar-toggle").css("display") == "none") {
			var elemsRowCount = 4;
		} else {
			var elemsRowCount = 2;
		}
		var rowsCount = Math.ceil(elemsCount / elemsRowCount),
			elemsBgCount = (elemsRowCount * rowsCount) - elemsCount,
			pagination = $(this).find(".pagination"),
			elemsBg = "<div class='col-xs-6 col-sm-6 col-md-3'><div class='gallery-item-bg'></div></div>";
		for(i = 0; i < elemsBgCount; i++) {	
			if(pagination.length) {
				pagination.parent().before(elemsBg);
			} else {
				$(this).append(elemsBg);
			}
		}
	})
}

/***GALLERY***/
function adjustGallery() {
	var img = $(".fancyimage .item-image"),
		cap = $(".fancyimage .item-caption-wrap"),
		bg = $(".gallery-item-bg"),
		kg = 4 / 3;	
	img.height(Math.ceil(img.width() / kg));
	cap.height(Math.ceil(cap.width() / kg));
	bg.height(Math.ceil(bg.width() / kg));
}

/***DETAIL_BANNER***/
function adjustBanner() {
	var ban = $(".services-detail-banner"),		
		kb = 3.33;
	ban.height(Math.ceil($(window).width() / kb));
}

$(function() {
	/***MENU***/
	if($(".navbar-nav").length) {
		/***MOREMENU***/
		$(".navbar-nav").moreMenu();	

		/***DROPDOWN***/	
		$(".navbar-nav .dropdown:not(.more)").on({		
			mouseenter: function() {			
				if($(".navbar-toggle").css("display") == "none") {
					var menu = $(this).closest(".navbar"),
						menuWidth = menu.outerWidth(),
						menuLeft = menu.offset().left,
						menuRight = menuLeft + menuWidth,
						isParentDropdownMenu = $(this).closest(".dropdown-menu"),					
						dropdownMenu = $(this).children(".dropdown-menu"),
						dropdownMenuWidth = dropdownMenu.outerWidth(),					
						dropdownMenuLeft = isParentDropdownMenu.length ? $(this).offset().left + $(this).outerWidth() : $(this).offset().left,
						dropdownMenuRight = dropdownMenuLeft + dropdownMenuWidth;
					if(dropdownMenuRight > menuRight) {
						if(isParentDropdownMenu.length) {
							dropdownMenu.css({"left": "auto", "right": "100%"});
						} else {
							dropdownMenu.css({"right": "0"});
						}
					}
					$(this).addClass("open").children(".dropdown-menu").stop(true, true).delay(200).fadeIn(150);				
				}
			},
			mouseleave: function() {			
				if($(".navbar-toggle").css("display") == "none") {			
					$(this).removeClass("open").children(".dropdown-menu").stop(true, true).delay(200).fadeOut(150);				
				}
			}
		});
		$(".navbar-nav .caret").on("click", function() {
			if($(".navbar-toggle").css("display") != "none") {		
				var li = $(this).closest(".dropdown"),
					isLiActive = li.hasClass("open");
				if(!!li) {
					if(!isLiActive) {
						li.addClass("open").children(".dropdown-menu").stop(true, true).show();
						return false;
					} else {
						li.removeClass("open").children(".dropdown-menu").stop(true, true).hide();					
						return false;
					}
				}
			}
		});
		$(window).resize(function() {	
			hideDropdown();
		});
		hideDropdown();
	}

	/***FIXED_MENU***/	
	if($(".top-menu-wrapper").length && $(".top-menu").length) {
		$(window).resize(function() {
			$(window).scroll(function() {
				fixedMenu();
			});
			fixedMenu();
		});
		$(window).scroll(function() {
			fixedMenu();
		});
		fixedMenu();
	}
	
	/***SLIDER***/
	if($(".slider").length) {	
		$(window).resize(function() {
			adjustSlider();		
		});
		adjustSlider();
	}

	/***SERVICES_SECTIONS***/
	if($(".services .item-pic").length || $(".sections .item-pic").length) {		
		$(window).resize(function() {		
			adjustServicesSections();		
		});	
		adjustServicesSections();
	}
	
	/***GALLERY***/	
	if($(".gallery").length) {		
		$(window).resize(function() {		
			adjustGalleryBg();
			adjustGallery();
		});	
		adjustGalleryBg();		
		adjustGallery();
	}

	/***DETAIL_BANNER***/
	if($(".services-detail-banner").length) {		
		$(window).resize(function() {		
			adjustBanner();
		});
		adjustBanner();
	}

	/***SCROLL_UP***/
	var top_show = 150,
		delay = 500;	
	$("body").append($("<a />").addClass("scroll-up").attr({"href": "javascript:void(0)", "id": "scrollUp"}).append($("<i />").addClass("fa fa-angle-up")));
	$("#scrollUp").click(function(e) {
		e.preventDefault();
		$("body, html").animate({scrollTop: 0}, delay);
		return false;
    });		
	$(window).scroll(function () {
		if($(this).scrollTop() > top_show) {
			$("#scrollUp").fadeIn();
		} else {
			$("#scrollUp").fadeOut();
		}
    });
});