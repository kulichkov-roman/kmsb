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

<!--META_PROPERTY-->
<?$APPLICATION->AddHeadString("<meta property='og:title' content='".(!empty($arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]) ? $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"] : $arResult["NAME"])."' />", true);
if(!empty($arResult["PREVIEW_TEXT"])):
	$APPLICATION->AddHeadString("<meta property='og:description' content='".strip_tags($arResult["PREVIEW_TEXT"])."' />", true);
endif;
$APPLICATION->AddHeadString("<meta property='og:url' content='http://".SITE_SERVER_NAME.$APPLICATION->GetCurPage()."' />", true);
if(!empty($arResult["DETAIL_PICTURE"])):
	$APPLICATION->AddHeadString("<meta property='og:image' content='http://".SITE_SERVER_NAME.$arResult["DETAIL_PICTURE"]["SRC"]."' />", true);
	$APPLICATION->AddHeadString("<meta property='og:image:width' content='".$arResult["DETAIL_PICTURE"]["WIDTH"]."' />", true);
	$APPLICATION->AddHeadString("<meta property='og:image:height' content='".$arResult["DETAIL_PICTURE"]["HEIGHT"]."' />", true);
	$APPLICATION->AddHeadString("<link rel='image_src' href='http://".SITE_SERVER_NAME.$arResult["DETAIL_PICTURE"]["SRC"]."' />", true);
elseif(!empty($arResult["PREVIEW_PICTURE"])):
	$APPLICATION->AddHeadString("<meta property='og:image' content='http://".SITE_SERVER_NAME.$arResult["PREVIEW_PICTURE"]["SRC"]."' />", true);
	$APPLICATION->AddHeadString("<meta property='og:image:width' content='".$arResult["PREVIEW_PICTURE"]["WIDTH"]."' />", true);
	$APPLICATION->AddHeadString("<meta property='og:image:height' content='".$arResult["PREVIEW_PICTURE"]["HEIGHT"]."' />", true);
	$APPLICATION->AddHeadString("<link rel='image_src' href='http://".SITE_SERVER_NAME.$arResult["PREVIEW_PICTURE"]["SRC"]."' />", true);
endif;?>

<!--LAST_NEWS-->
<?ob_start();

if($arParams["SHOW_LAST_NEWS"] == "Y"):?>	
	<?$APPLICATION->IncludeComponent("bitrix:main.include", "",
		array(
			"AREA_FILE_SHOW" => "file",
			"PATH" => SITE_DIR."include/block_news.php"
		),
		false,
		array("HIDE_ICONS" => "Y")
	);?>
<?endif;?>

</div>

<?$APPLICATION->AddViewContent("last_news", ob_get_contents());
ob_end_clean();?>