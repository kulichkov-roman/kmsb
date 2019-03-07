<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arVariables = array();
CComponentEngine::ParseComponentPath(
	'/catalog/',
	array('#SECTION_CODE#/#BRAND_CODE#/'),
	$arVariables
);
?>
<div class="b-manufacturer">
	<?
	$APPLICATION->IncludeComponent(
	    "bitrix:news.detail",
	    "brand_info",
	    array(
	    	"IBLOCK_TYPE" => "dynamic",
	    	"IBLOCK_ID" => "5",
	    	"ELEMENT_ID" => "",
	    	"ELEMENT_CODE" => $arVariables["BRAND_CODE"],
	    	"CHECK_DATES" => "Y",
	    	"FIELD_CODE" => array(
	    		0 => "",
	    		1 => "",
	    	),
	    	"PROPERTY_CODE" => array(
	    		0 => "LINK_SITE",
	    		1 => "",
	    	),
	    	"IBLOCK_URL" => "",
	    	"AJAX_MODE" => "N",
	    	"AJAX_OPTION_JUMP" => "N",
	    	"AJAX_OPTION_STYLE" => "Y",
	    	"AJAX_OPTION_HISTORY" => "N",
	    	"CACHE_TYPE" => "N",
	    	"CACHE_TIME" => "36000000",
	    	"CACHE_GROUPS" => "Y",
	    	"SET_TITLE" => "N",
	    	"SET_BROWSER_TITLE" => "N",
	    	"BROWSER_TITLE" => "-",
	    	"SET_META_KEYWORDS" => "N",
	    	"META_KEYWORDS" => "-",
	    	"SET_META_DESCRIPTION" => "N",
	    	"META_DESCRIPTION" => "-",
	    	"SET_STATUS_404" => "N",
	    	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	    	"ADD_SECTIONS_CHAIN" => "N",
	    	"ADD_ELEMENT_CHAIN" => "N",
	    	"ACTIVE_DATE_FORMAT" => "j F Y",
	    	"USE_PERMISSIONS" => "N",
	    	"DISPLAY_DATE" => "Y",
	    	"DISPLAY_NAME" => "Y",
	    	"DISPLAY_PICTURE" => "Y",
	    	"DISPLAY_PREVIEW_TEXT" => "Y",
	    	"USE_SHARE" => "N",
	    	"PAGER_TEMPLATE" => "",
	    	"DISPLAY_TOP_PAGER" => "N",
	    	"DISPLAY_BOTTOM_PAGER" => "Y",
	    	"PAGER_TITLE" => "Страница",
	    	"PAGER_SHOW_ALL" => "Y",
	    	"AJAX_OPTION_ADDITIONAL" => ""
	    ),
	    false
    );

    $APPLICATION->IncludeComponent(
	    "bitrix:catalog.section.list",
	    "catalog_brands_section",
	    array(
	    	"IBLOCK_TYPE" => "dynamic",
	    	"IBLOCK_ID" => "48",
	    	"SECTION_ID" => $_REQUEST["SECTION_ID"],
	    	"SECTION_CODE" => "",
	    	"SECTION_URL" => "",
	    	"COUNT_ELEMENTS" => "Y",
	    	"TOP_DEPTH" => "4",
	    	"SECTION_FIELDS" => array(
	    		0 => "",
	    		1 => "",
	    	),
	    	"SECTION_USER_FIELDS" => array(
	    		0 => "",
	    		1 => "",
	    	),
	    	"ADD_SECTIONS_CHAIN" => "Y",
	    	"CACHE_TYPE" => "N",
	    	"CACHE_TIME" => "0",
	    	"CACHE_GROUPS" => "Y"
	    ),
	    false
    );
    ?>
    <?/*$ElementID = $APPLICATION->IncludeComponent(
		"bitrix:news.detail",
		"",
		Array(
			"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
			"DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
			"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
			"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
			"PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
			"META_KEYWORDS" => $arParams["META_KEYWORDS"],
			"META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
			"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
			"SET_TITLE" => $arParams["SET_TITLE"],
			"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
			"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
			"ACTIVE_DATE_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
			"CACHE_TYPE" => "N",
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
			"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
			"DISPLAY_TOP_PAGER" => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
			"DISPLAY_BOTTOM_PAGER" => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
			"PAGER_TITLE" => $arParams["DETAIL_PAGER_TITLE"],
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => $arParams["DETAIL_PAGER_TEMPLATE"],
			"CHECK_DATES" => $arParams["CHECK_DATES"],
			"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
			"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
			"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
            "PSEUDO_FILTER" => $_REQUEST["arPseudoFilter"]
		),
		false
	);*/?>
</div>