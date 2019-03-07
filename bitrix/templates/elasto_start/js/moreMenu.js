(function (factory) {
	if(typeof define === "function" && define.amd) {		
		define(["jquery"], factory);
	} else {		
		factory(jQuery);
	}
}(function ($) {
	var moreObjects = [];
	
	function adjustMoreMenu() {
		$(moreObjects).each(function () {
			$(this).moreMenu({
				"undo": true
			}).moreMenu(this.options);
		});
	}	

	$(window).resize(function () {		
		adjustMoreMenu();
	});

	$.fn.moreMenu = function (options) {
		var checkMoreObject,
			s = $.extend({
				"threshold": 2,				
				"linkText": "...",				
				"undo": false
			}, options);
		this.options = s;
		checkMoreObject = $.inArray(this, moreObjects);
		if(checkMoreObject >= 0) {
			moreObjects.splice(checkMoreObject, 1);
		} else {
			moreObjects.push(this);
		}
		return this.each(function () {
			var $this = $(this),				
				$items = $this.find("> li"),
				$self = $this,
				$firstItem = $items.first(),
				$lastItem = $items.last(),
				numItems = $this.find("li").length,
				firstItemTop = Math.floor($firstItem.offset().top),
				firstItemHeight = Math.floor($firstItem.outerHeight(true)),
				$lastChild,
				keepLooking,
				$moreItem,				
				numToRemove,				
				$menu,
				i;
			
			function needsMenu($itemOfInterest) {
				var result = (Math.ceil($itemOfInterest.offset().top) >= (firstItemTop + firstItemHeight) && $(".navbar-toggle").css("display") == "none") ? true : false;
				return result;
			}

			if(needsMenu($lastItem) && numItems > s.threshold && !s.undo && $this.is(":visible")) {
				var $popup = $("<ul class='dropdown-menu more-menu'></ul>");
				
				for(i = numItems; i > 1; i--) {					
					$lastChild = $this.find("> li:last-child");
					keepLooking = (needsMenu($lastChild));
					if(keepLooking) {
						$lastChild.appendTo($popup);
					} else {
						break;
					}					
				}				
				$this.append("<li class='dropdown more'><a href='javascript:void(0)'>" + s.linkText + "</a></li>");				
				
				$moreItem = $this.find("> li.more");				
				if(needsMenu($moreItem)) {
					$this.find("> li:nth-last-child(2)").appendTo($popup);
				}				
				
				$popup.children().each(function(i, li) {
					$popup.prepend(li);
				});
				
				$moreItem.append($popup);

				$moreItem.hover(function() {
					var menu = $(this).closest(".navbar"),
						menuWidth = menu.outerWidth(),
						menuLeft = menu.offset().left,
						menuRight = menuLeft + menuWidth,											
						dropdownMenu = $(this).children(".dropdown-menu"),
						dropdownMenuWidth = dropdownMenu.outerWidth(),					
						dropdownMenuLeft = $(this).offset().left,
						dropdownMenuRight = dropdownMenuLeft + dropdownMenuWidth;
					if(dropdownMenuRight > menuRight) {
						dropdownMenu.css({"right": "0"});
					}
					$(this).addClass("open").children(".dropdown-menu").stop(true, true).delay(200).fadeIn(150);
				}, function() {
					$(this).removeClass("open").children(".dropdown-menu").stop(true, true).delay(200).fadeOut(150);
				});
			} else if(s.undo && $this.find("ul.more-menu")) {
				$menu = $this.find("ul.more-menu");
				numToRemove = $menu.find("li").length;
				for(i = 1; i <= numToRemove; i++) {
					$menu.find("> li:first-child").appendTo($this);
				}
				$menu.remove();
				$this.find("> li.more").remove();
			}
		});
	};
}));