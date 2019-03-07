<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/js/owlCarousel/owl.carousel.css");
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/owlCarousel/owl.carousel.min.js");
$APPLICATION->AddHeadString("
	<script type='text/javascript'>		
		$(function() {
			$('.slider').owlCarousel({
				items: 1,
				loop: true,				
				nav: true,
				navText: ['<i class=\"fa fa-angle-left\"></i>', '<i class=\"fa fa-angle-right\"></i>'],
				navContainer: '.slider',
				autoplay: true,				
				autoplayHoverPause: true,
				smartSpeed: 500,
				responsiveRefreshRate: 0
			});
		});		
	</script>
", true);?>