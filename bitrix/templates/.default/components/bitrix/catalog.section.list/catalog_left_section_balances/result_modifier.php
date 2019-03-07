<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// Показ общего числа элементов
$arSort = array();
$arSelect = array("ID", "NAME");
$arFilter = array(
    "ACTIVE"=>"Y",
    "IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
);

$rsElements = CIBlockElement::GetList(
    $arSort,
    $arFilter,
    false,
    false,
    $arSelect
);

$arResult["ELEMENTS_CNT"] = $rsElements->SelectedRowsCount();

unset($arSection);

foreach($arResult['SECTIONS'] as $key=>$arSection)
{
	if($arSection['UF_SHOW_LEFT_MENU'] !== '1')
	{		
		unset($arResult['SECTIONS'][$key]);		
	}
}
$arResult['SECTIONS'] = array_values($arResult['SECTIONS']);

$curDir = $APPLICATION->GetCurDir();

$arParseUrl = array_unique(explode("/", $curDir));
$arParseUrl = array_diff($arParseUrl, array(''));

// Установка активный секциц
if(sizeof($arParseUrl) < 4)
{
    // Для списка товаров
    $arVariables["SECTION_CODE"] = $arParseUrl[3];
}
elseif(sizeof($arParseUrl) >= 4)
{
    // Для деталки
    $arSort = array();
    $arSelect = array(
        "ID", 
        "IBLOCK_ID",
        "NAME",
        "IBLOCK_SECTION_ID"
    );
    $arFilter = array(
        "IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
        "CODE" => $arParseUrl[4]
    );
    
    $rsElement = CIBlockElement::GetList(
        $arSort, 
        $arFilter, 
        false, 
        false, 
        $arSelect
    );
    
    $arFields = array();
    while($obElement = $rsElement->GetNextElement())
    { 
        $arElement = $obElement->GetFields();
    }
    
    $arSort = array();
    $arFilter = array(
        "IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
        "ID" => $arElement["IBLOCK_SECTION_ID"]
    );
    $arSelect = array(
        "ID",
        "NAME",
        "CODE",
    );          
    $rsSection = CIBlockSection::GetList(
        $arSort,
        $arFilter,
        false,
        $arSelect,
        false
    );
    
    if($arItem = $rsSection->GetNext())
    {
        $arSection = $arItem;
    }    
    
    if($arSection["CODE"] <> "")
    {
        $arVariables["SECTION_CODE"] = $arSection["CODE"];
    }
}
if($arVariables["SECTION_CODE"] <> "")
{
    $arSort = array();
    $arFilter = array(
        "IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
        "CODE" => $arVariables["SECTION_CODE"]
    );
    $arSelect = array(
        "ID",
        "NAME",
        "SECTION_PAGE_URL"
    );          
    $rsSection = CIBlockSection::GetList(
        $arSort,
        $arFilter,
        false,
        $arSelect,
        false
    );
    
    while ($arItem = $rsSection->GetNext())
    {
        $arSections[] = $arItem;
    }
        
    $arSection = current($arSections);
    
    $rsPath = GetIBlockSectionPath(CATALOG_IBLOCK_ID, $arSection["ID"]);
    
    while($arItem = $rsPath->GetNext())
    {
        $arPath[] = $arItem["ID"];
    }
    
    $firstSectionId = current($arPath);
    
    foreach($arResult['SECTIONS'] as &$arItem)
    {
        if(recursiveArraySearch($arItem["ID"], $arPath) !== false)
        {
            $arItem["SELECTED"] = true;
        }
        else
        {
            $arItem["SELECTED"] = false;
        }
    }
}
unset($arItem);

// проставить/не проставлять /balances/ к url разделов.
if($USER->isAdmin())
{
    //echo "<pre>"; var_dump($arResult['SECTIONS']); echo "</pre>";
}

foreach($arResult['SECTIONS'] as &$arItem)
{
    $arParseUrl = array_unique(explode("/", $arItem["SECTION_PAGE_URL"]));
    $arParseUrl = array_diff($arParseUrl, array(''));
    if($arItem["UF_POSITIVE_BALANCES"] == 1)
    {
        $arItem["SECTION_PAGE_URL"] = "/".$arParseUrl[1]."/".CATALOG_BALANCES_DIR_KS."/".$arParseUrl[2]."/";
    }
}
unset($arItem);
?>