<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");

$brandCode = $_REQUEST["BRAND_CODE"];
$sectionCode = $_REQUEST["SECTION_CODE"];

if(!$sectionCode || !$brandCode){
    LocalRedirect('/404.php');
}

$arFilter = array(
    "IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
    "CODE"      => $sectionCode
);
$rsSections = CIBlockSection::GetList(array(),$arFilter);
if( $arSection = $rsSections->GetNext() ) { 
    $sectionId = $arSection["ID"];
}

$arFilter = array(
    "IBLOCK_ID" => BRANDS_IBLOCK_ID,
    "CODE"      => $brandCode
);

$rsElements = CIBlockElement::GetList(array(),$arFilter);
if($arElement = $rsElements->GetNext()) {
    //$brandId = $arElement["ID"];
    $brandName = $arElement["NAME"];
}

CModule::IncludeModule("highloadblock");

$rsData = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter'=>array('NAME' => CATALOG_TABLE_MANUFACTURER)));

$arResult["XML_ID"] = "";
if($arData = $rsData->fetch())
{
    $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arData);

    $mainQuery = new \Bitrix\Main\Entity\Query($entity);

    $mainQuery->setOrder(array());
    $mainQuery->setFilter(array('UF_NAME'=> $brandName));
    $mainQuery->setSelect(array('*'));

    $rsResult = $mainQuery->exec();

    $rsResult = new CDBResult($rsResult);
    if($arRow = $rsResult->Fetch())
    {
        $arResult["XML_ID"] = $arRow["UF_XML_ID"];
    }
}

if($arResult["XML_ID"] == ""){
    LocalRedirect('/404.php');
}

global $arBrandFilter;
$arBrandFilter = array(
   "PROPERTY_CML2_MANUFACTURER" => $arResult["XML_ID"],
);

$arBrandFilter = array_merge((array)$arBrandFilter, (array)$_REQUEST["arPseudoFilter"]);
    
$APPLICATION->IncludeComponent(
	"your:catalog.section", 
	"catalog_section", 
	array(
		"IBLOCK_TYPE" => "dynamic",
		"IBLOCK_ID" => "48",
		"SECTION_ID" => $sectionId,
		"SECTION_CODE" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"ELEMENT_SORT_FIELD" => "property_NAIMENOVANIE_DLYA_SAYTA_KRATKOE",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "shows",
		"ELEMENT_SORT_ORDER2" => "asc",
		"FILTER_NAME" => "arBrandFilter",
		"INCLUDE_SUBSECTIONS" => "Y",
		"SHOW_ALL_WO_SECTION" => "Y",
		"HIDE_NOT_AVAILABLE" => "N",
		"PAGE_ELEMENT_COUNT" => "30",
		"LINE_ELEMENT_COUNT" => "3",
		"PROPERTY_CODE" => array(
			0 => "CML2_ARTICLE",
			1 => "SERVICE_ICO",
			2 => "OUT_ICO",
			3 => "AVAILABLE_ICO",
			4 => "NEW_ICO",
			5 => "ACTION_ICO",
			6 => "",
		),
		"OFFERS_LIMIT" => "5",
		"TEMPLATE_THEME" => "",
		"PRODUCT_SUBSCRIPTION" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "Y",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "Y",
		"META_DESCRIPTION" => "-",
		"ADD_SECTIONS_CHAIN" => "N",
		"DISPLAY_COMPARE" => "N",
		"SET_STATUS_404" => "N",
		"CACHE_FILTER" => "N",
		"PRICE_CODE" => array(
			0 => "Розничные",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"BASKET_URL" => "/personal/basket.php",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"USE_PRODUCT_QUANTITY" => "N",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
		),
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"ADD_PICT_PROP" => "-",
		"LABEL_PROP" => "-",
		"COMPONENT_TEMPLATE" => "catalog_section"
	),
	false
);
?>
<?$APPLICATION->ShowViewContent("showCatSectionNavString");?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>