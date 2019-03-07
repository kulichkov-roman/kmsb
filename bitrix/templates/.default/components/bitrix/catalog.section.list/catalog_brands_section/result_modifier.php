<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// получить бренд из url

$arVariables = array();
CComponentEngine::ParseComponentPath(
    '/catalog/',
    array('#SECTION_CODE#/#BRAND_CODE#/'),
    $arVariables
);

// получить имя бренда

$arSort = array();
$arSelect = array(
    "ID",
    "NAME",
    "CODE"
);
$arFilter = array(
    "IBLOCK_ID" => BRANDS_IBLOCK_ID,
    "CODE" => $arVariables["BRAND_CODE"]
);

$rsElements = CIBlockElement::GetList(
    $arSort,
    $arFilter,
    false,
    false,
    $arSelect
);

if($arItem = $rsElements->GetNext()) {
    $arBrand = $arItem;
}

// получить xml_id из

CModule::IncludeModule("highloadblock");

$rsData = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter'=>array('NAME' => CATALOG_TABLE_MANUFACTURER)));

if($arData = $rsData->fetch())
{
    $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arData);

    $mainQuery = new \Bitrix\Main\Entity\Query($entity);

    $mainQuery->setOrder(array());
    $mainQuery->setFilter(array('UF_NAME'=> $arBrand["NAME"]));
    $mainQuery->setSelect(array('*'));

    $rsResult = $mainQuery->exec();

    $rsResult = new CDBResult($rsResult);
    if($arRow = $rsResult->Fetch())
    {
        $arResult["XML_ID"] = $arRow["UF_XML_ID"];
    }
}

// получить список конечных разделов, где есть текущий элемент с текущим брендом

$arSort = array("SORT"=>"ASC");
$arSelect = array("ID", "NAME", "IBLOCK_SECTION_ID", 'PROPERTY_CML2_MANUFACTURER');
$arFilter = array(
    "ACTIVE" => "Y",
    "IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
    "PROPERTY_CML2_MANUFACTURER" => $arResult["XML_ID"],
    "PROPERTY_AKSESSUAR_V_GRUPPE" => "true",
);
$arGroupBy = array(
    "IBLOCK_SECTION_ID"
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
    $arElement[] = $arItem;
}

// дополнить текущий список родительскими разделами

foreach($arElement as &$arItem)
{
    $arIds[] = $arItem["IBLOCK_SECTION_ID"];
    $rsPath= GetIBlockSectionPath(CATALOG_IBLOCK_ID_KS, $arItem["IBLOCK_SECTION_ID"]);
    while($arPathItem = $rsPath->GetNext())
    {
        $arIds[] = $arPathItem["ID"];
    }
}
unset($arItem, $arPathItem, $arElement);

$arIds = array_unique($arIds);

if($USER->isAdmin())
{
	//echo "<pre>"; var_dump($arIds); echo "</pre>";
}

// удалить лишнии разделы
foreach($arResult['SECTIONS'] as $key=>$arSection)
{
	if(!in_array($arSection['ID'], $arIds))
	{
		unset($arResult['SECTIONS'][$key]);
	}
	//if(!recursiveArraySearch($arSection['ID'], $arIds))
	//{
	//	unset($arResult['SECTIONS'][$key]);
	//}
}
$arResult['SECTIONS'] = array_values($arResult['SECTIONS']);

// изменить SECTION_PAGE_URL
foreach($arResult['SECTIONS'] as &$arItem)
{
    $arParseUrl = array_unique(explode("/", $arItem["SECTION_PAGE_URL"]));
    $arParseUrl = array_diff($arParseUrl, array(''));
    $arItem["SECTION_PAGE_URL"] = "/catalog/manufacturers/section/".$arBrand["CODE"]."/".$arParseUrl[2]."/";
}
unset($arItem);
?>