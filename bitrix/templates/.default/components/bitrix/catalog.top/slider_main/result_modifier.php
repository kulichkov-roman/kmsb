<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

//for slider

$arIds = array();
if(!empty($arResult["ITEMS"]))
{
    foreach($arResult["ITEMS"] as $arItem)
    {
        if (!empty($arItem['PROPERTIES']['ITEM']['VALUE']))
        {
            $arIds[] = $arItem['PROPERTIES']['ITEM']['VALUE'];
        }
    }
}

$rsElement = CIBlockElement::GetList(
    array(),
    array(
        'IBLOCK_ID' => CATALOG_IBLOCK_ID_KS,
        'ID' => $arIds,
    ),
    false,
    false,
    array(
        'ID',
        'NAME',
        'PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE',
        'DETAIL_PAGE_URL',
        'CATALOG_GROUP_2',
    )
);

$arCatalogItems = array();
while($arElement = $rsElement->GetNext())
{
	$arCatalogItems[$arElement['ID']] = $arElement;
}

// Не выводятся элементы - проверить

if (!empty($arResult["ITEMS"]))
{
    foreach ($arResult["ITEMS"] as &$arItem)
    {
        if (!empty($arItem['PROPERTIES']['ITEM']['VALUE']) && !empty($arCatalogItems[$arItem['PROPERTIES']['ITEM']['VALUE']]))
        {
            $arItem['PROPERTIES']['ITEM']['ELEMENT'] = $arCatalogItems[$arItem['PROPERTIES']['ITEM']['VALUE']];
			if($arItem["PROPERTIES"]["LINK"]["VALUE"] <> "")
			{
				$arItem['PROPERTIES']['ITEM']['ELEMENT']["DETAIL_PAGE_URL"] = $arItem["PROPERTIES"]["LINK"]["VALUE"];
			}
        }
        if ($arItem['PROPERTIES']['IMAGE']['VALUE'])
        {
            $arItem['PROPERTIES']['IMAGE']['FILEPATH'] = CFile::GetPath($arItem['PROPERTIES']['IMAGE']['VALUE']);
        }
    }
}

if($USER->isAdmin())
{
	//echo "<pre>"; var_dump($arResult["ITEMS"]); echo "</pre>";
}

unset($arItem);