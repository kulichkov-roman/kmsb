<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>
<?

//if($USER->isAdmin())
//{
//    echo "<pre>"; var_dump(sizeof($arResult["ITEMS"])); echo "</pre>";
//}

$arIds = array();
if(!empty($arResult["ITEMS"]))
{
	foreach($arResult["ITEMS"] as $arItem)
	{
		if (!empty($arItem['PROPERTIES']['LINK_ELEM']['VALUE']))
		{
			$arIds[] = $arItem['PROPERTIES']['LINK_ELEM']['VALUE'];
		}
	}
}

//if($USER->isAdmin())
//{
//    echo "<pre>"; var_dump(sizeof($arResult["ITEMS"])); echo "</pre>";
//}


$rsElement = CIBlockElement::GetList(
	array(),
	array(
		'ID' => $arIds
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
	$arCatalogItems[$arElement["ID"]] = $arElement;
}

//echo "<pre>"; var_dump($arCatalogItems); echo "</pre>"; die();
  
if (!empty($arResult["ITEMS"]))
{
	foreach ($arResult["ITEMS"] as &$arItem)
	{
		if (!empty($arItem['PROPERTIES']['LINK_ELEM']['VALUE']) && !empty($arCatalogItems[$arItem['PROPERTIES']['LINK_ELEM']['VALUE']]))
		{		
			$arItem['PROPERTIES']['LINK_ELEM']['ELEMENT'] = $arCatalogItems[$arItem['PROPERTIES']['LINK_ELEM']['VALUE']];
		}
	}
}

//echo "<pre>"; var_dump($arResult["ITEMS"]); echo "</pre>"; die();

unset($arItem);