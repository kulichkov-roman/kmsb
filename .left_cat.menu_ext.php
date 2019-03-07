<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$curDir = $APPLICATION->GetCurDir();

if(strpos($curDir, '/catalog/balances/') === 0)
{
	$sefBaseUrl = "/catalog/balances/";
}
else
{
	$sefBaseUrl = "/catalog/";
}

/**
 * Важно уровень в каталоге сейчас 5 на текущий момент
 * Не верное выставление правильного уравня влече за собой не правильный показ количества
 */
$aMenuLinksExt = $APPLICATION->IncludeComponent("your:menu.sections","",Array(
		"IS_SEF" => "Y",
		"SEF_BASE_URL" => $sefBaseUrl,
	"SECTION_PAGE_URL" => "#SECTION_CODE#/",
	"DETAIL_PAGE_URL" => "#SECTION_CODE#/#CODE#/",
		"IBLOCK_TYPE" => DYNAMIC_CONTENT_TYPE_KS,
		"IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
		"DEPTH_LEVEL" => "5",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600"
	)
);

/*
 * получить список пользовательских свойств
 */
$arSort = array(
	"left_margin"=>"asc"
);
$arFilter = array(
	"IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
	"GLOBAL_ACTIVE"=>"Y",
	"IBLOCK_ACTIVE"=>"Y",
	"<="."DEPTH_LEVEL" => 5,
    "UF_SHOW_LEFT_MENU" => '1'
);
$arSelect = array(
	"ID",
	"NAME",
	"UF_COUNT_ELEM",
	"UF_COUNT_BALANCE",
	"UF_POSITIVE_BALANCES",
    "UF_SHOW_LEFT_MENU"
);

$rsSection = CIBlockSection::GetList(
	$arSort,
	$arFilter,
	false,
	$arSelect,
	false
);

foreach($aMenuLinksExt as &$arMenuItem)
{
	$arItem = $rsSection->Fetch();

    $arMenuItem['3']['UF_COUNT_ELEM'] = $arItem['UF_COUNT_ELEM'];
    $arMenuItem['3']['UF_COUNT_BALANCE'] = $arItem['UF_COUNT_BALANCE'];
    $arMenuItem['3']['UF_POSITIVE_BALANCES'] = $arItem['UF_POSITIVE_BALANCES'];
    $arMenuItem['3']['UF_SHOW_LEFT_MENU'] = $arItem['UF_SHOW_LEFT_MENU'];
}
unset($arMenuItem, $arItem);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>
