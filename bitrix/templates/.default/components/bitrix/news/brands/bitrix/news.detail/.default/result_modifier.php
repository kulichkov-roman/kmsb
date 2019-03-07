<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$arPseudoFilter = $arParams["PSEUDO_FILTER"];

CModule::IncludeModule("highloadblock");

$rsData = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter'=>array('NAME' => CATALOG_TABLE_MANUFACTURER)));

if($arData = $rsData->fetch())
{
    $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arData);

    $mainQuery = new \Bitrix\Main\Entity\Query($entity);

    $mainQuery->setOrder(array());
    $mainQuery->setFilter(array('UF_NAME'=> $arResult["NAME"]));
    $mainQuery->setSelect(array('*'));

    $rsResult = $mainQuery->exec();

    $rsResult = new CDBResult($rsResult);
    if($arRow = $rsResult->Fetch())
    {
        $arResult["XML_ID"] = $arRow["UF_XML_ID"];
    }
}

$arResult["XML_ID"];

$arFilter = array(
    "IBLOCK_ID"         => CATALOG_IBLOCK_ID_KS,
    "ACTIVE"            => "Y",
    "PROPERTY_CML2_MANUFACTURER" => $arResult["XML_ID"],
    //"PROPERTY_AKSESSUAR_V_GRUPPE" => "true",
);

$arFilter = array_merge((array)$arFilter, (array)$arPseudoFilter);

$arSectionIds = array();
$rsElements = CIBlockElement::GetList(
    array(),
    $arFilter,
    array("IBLOCK_SECTION_ID"),
    false,
    array("ID", "NAME", "PROPERTY_CML2_MANUFACTURER","IBLOCK_SECTION_ID")
);
while( $arElement = $rsElements->GetNext() ) {
    $arSectionIds[] = $arElement["IBLOCK_SECTION_ID"];
}

$sFilterQuery = '';
foreach($arPseudoFilter as $prop => $value){
    $sFilterQuery .= $sFilterQuery . 'arPseudoFilter[' . $prop . ']=' . $value;
}
if($sFilterQuery){
    $sFilterQuery = '?' . $sFilterQuery;
}

if($arSectionIds){
    $arSectionFilter = array(
        "IBLOCK_ID"         => CATALOG_IBLOCK_ID_KS,
        "ACTIVE"            => "Y",
        "ID"                => $arSectionIds,
    );

    if(!$arPseudoFilter){
        $arSectionFilter["UF_SHOW_LEFT_MENU"] = true;
    }

    $arSections = array();
    $rsSections = CIBlockSection::GetList(array("SORT" => "ASC", "NAME" => "ASC"),$arSectionFilter, array("ID","NAME", "IBLOCK_SECTION_ID", "UF_SHOW_LEFT_MENU"));
    while( $arSection = $rsSections->GetNext() ) {
        $arSections[$arSection["IBLOCK_SECTION_ID"]] = $arSection;
    }

    unset($arSectionIds);
    foreach($arSections as $key=>&$arItem)
    {
        $arSectionIds[] = $key;
    }
    unset($arItem);

    $arParentSectionFilter = array(
        "IBLOCK_ID"         => CATALOG_IBLOCK_ID_KS,
        "ACTIVE"            => "Y",
        "ID"                => $arSectionIds,
    );

    $arParentSections = array();
    $rsParentSections = CIBlockSection::GetList(
        array("SORT" => "ASC", "NAME" => "ASC"),
        $arParentSectionFilter,
        array("ID","NAME", "UF_SHOW_LEFT_MENU")
    );
    while($arItem = $rsParentSections->GetNext())
    {
        $arParentSections[$arItem["ID"]] = $arItem;
    }

    foreach($arSections as &$arItem)
    {
        $arParentSections[$arItem["IBLOCK_SECTION_ID"]]["CHILD"][] = $arItem;
    }

    $arResult["SECTIONS"] = $arParentSections;

    if($USER->isAdmin())
    {
        //echo "<pre>"; var_dump($arResult["SECTIONS"]); echo "</pre>";
    }

}
$arResult["SECTIONS"] = $arParentSections;
$arResult["S_FILTER_QUERY"] = $sFilterQuery;