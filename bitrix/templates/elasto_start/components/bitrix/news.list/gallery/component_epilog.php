<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/js/fancybox/jquery.fancybox.css");
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/fancybox/jquery.fancybox.pack.js");
$APPLICATION->AddHeadString("
	<script type='text/javascript'>		
		$(function() {
			$('.fancyimage').fancybox({
				helpers: {
					title: {
						type: 'inside',
						position: 'bottom'
					}
				}
			});
		});		
	</script>
", true);?>