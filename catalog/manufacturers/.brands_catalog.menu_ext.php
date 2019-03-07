<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$aMenuLinksExt=array();

CModule::IncludeModule('iblock');
$arFilter = array(
    "IBLOCK_ID" => BRANDS_IBLOCK_ID,
    "ACTIVE" => "Y"
);

$rsElements = CIBlockElement::GetList(array("SORT" => "ASC"),$arFilter);
while($arElement = $rsElements->GetNext()) {
    $aMenuLinksExt[] = array(
        $arElement["NAME"],
        $arElement["DETAIL_PAGE_URL"],
        array(),
        array("DEPTH_LEVEL" => 2)
    );
}
$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>