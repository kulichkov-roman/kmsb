<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

// получить ID текущего элемента по CODE
$curDir = $APPLICATION->GetCurDir();

$arParseUrl = array_unique(explode("/", $curDir));
$arParseUrl = array_diff($arParseUrl, array(''));

$arSort = array();
$arSelect = array(
    "ID",
    "NAME"
);
$arFilter = array(
    "IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
    "CODE" => end($arParseUrl)
);

$rsCurElements = CIBlockElement::GetList(
    $arSort,
    $arFilter,
    false,
    false,
    $arSelect
);

$arCurElement = array();
if($arItem = $rsCurElements->GetNext()) {
    $arCurElement = $arItem;
}

// Вывод краткого и полного наименования
$arIds = array();
$arElement = array();
foreach($arResult['ITEMS'] as $arItem)
{
    $arIds[] = $arItem["ID"];
}
$arSort = array("SORT"=>"ASC");
$arSelect = array(
    "ID",
    "NAME",
    "PROPERTY_NAIMENOVANIE_DLYA_SAYTA_KRATKOE",
    "PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE",
);
$arFilter = array(
    "IBLOCK_ID" => CATALOG_IBLOCK_ID_KS, 
    "ID" => $arIds
);
$rsElements = CIBlockElement::GetList(
    $arSort, 
    $arFilter, 
    false, 
    false, 
    $arSelect
);
while ($arItem = $rsElements->GetNext())
{
    $arElement[$arItem["ID"]] = $arItem;
}

foreach ($arResult['ITEMS'] as &$arItem)
{
    // добавить полное и краткое наименование
    $arItem["PROPERTIES"]["NAIMENOVANIE_DLYA_SAYTA_KRATKOE"]["VALUE"] = $arElement[$arItem["ID"]]["PROPERTY_NAIMENOVANIE_DLYA_SAYTA_KRATKOE_VALUE"];
    $arItem["PROPERTIES"]["NAIMENOVANIE_DLYA_SAYTA_POLNOE"]["VALUE"] = $arElement[$arItem["ID"]]["PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE_VALUE"];

    // добавить перерезанные картинки
    if(is_array($arItem["DETAIL_PICTURE"]))
    {
        $arPhoto = CFile::ResizeImageGet(
            $arItem["DETAIL_PICTURE"]["ID"],
            array(
                'width' => 100,
                'height' => 100
            ),
            BX_RESIZE_IMAGE_EXACT,
            true
        );
        $arItem["DETAIL_PICTURE"]["SRC"] = $arPhoto['src'];
    }
    else
    {
        $arPhoto = CFile::ResizeImageGet(
            NO_PHOTO_PL_94_94_ID,
            array(
                'width' => 100,
                'height' => 100
            ),
            BX_RESIZE_IMAGE_EXACT,
            true
        );
        $arItem["DETAIL_PICTURE"]["SRC"] = $arPhoto['src'];
    }

    // проставить активность текущего элемента
    if($arItem["ID"] == $arCurElement["ID"])
    {
        $arItem["SELECTED"] = true;
    }
    else
    {
        $arItem["SELECTED"] = false;
    }
}
unset($arItem);
?>
