<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?
global $arRecBsFilter;
$arRecBsFilter = array();
if(!empty($arResult["PRODUCT"]))
{
foreach($arResult["PRODUCT"] as $arItem)
{
	$arRecBsFilter["ID"][] = $arItem["PRODUCT_ID"];
}
	$APPLICATION->IncludeComponent("bitrix:store.catalog.top", "", array(
	"IBLOCK_TYPE" => "catalog",
	"IBLOCK_ID" => "",
	"ELEMENT_SORT_FIELD" => "sort",
	"ELEMENT_SORT_ORDER" => "asc",
	"ELEMENT_COUNT" => 4,
	"LINE_ELEMENT_COUNT" => 2,
	"BASKET_URL" => "/personal/basket.php",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"CACHE_TYPE" => $arParams["CACHE_TYPE"],
	"CACHE_TIME" => $arParams["CACHE_TIME"],
	"DISPLAY_COMPARE" => "N",
	"PRICE_CODE" => Array("BASE"),
	"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
	"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
	"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
	"FILTER_NAME" => "arRecBsFilter",
	),
	$component
);
}
?>