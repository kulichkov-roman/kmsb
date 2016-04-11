<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$arIds = array();
foreach($arResult["ITEMS"] as $key => $arItem)
{
    $arIds[] = $arItem["ID"];
}

$arSort = array("SORT"=>"ASC");
$arSelect = array(
    "ID",
    "NAME",
    "DETAIL_PICTURE",
    "DETAIL_TEXT"
);

$arFilter = array(
    "IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
    "ID" => $arIds
);

$rsElement = CIBlockElement::GetList(
	$arSort, 
	$arFilter, 
	false, 
	false, 
	$arSelect
);

$arElements = array();
while($arItem = $rsElement->GetNext())
{
    $arElements[$arItem["ID"]] = $arItem;
}
unset($arItem);

foreach($arResult["ITEMS"] as &$arItem)
{
    if(!$arItem["DETAIL_PICTURE"])
    {
        $arItem["DETAIL_PICTURE"] = $arElements[$arItem["ID"]]["DETAIL_PICTURE"];
    }
    if(!$arItem["DETAIL_TEXT"])
    {
        $arItem["DETAIL_TEXT"] = $arElements[$arItem["ID"]]["DETAIL_TEXT"];
    }
}
unset($arItem);

$arDetailPhotoIds = array();
foreach($arElements as &$arItem)
{
    if(!empty($arItem["DETAIL_PICTURE"]))
    {
        $arDetailPhotoIds[] = $arItem["DETAIL_PICTURE"];
    }
}
unset($arItem);

if(sizeof($arDetailPhotoIds) == 1)
{
    $arDetailPhotoIdsTmp = current($arDetailPhotoIds);
    unset($arDetailPhotoIds);
    $arDetailPhotoIds = $arDetailPhotoIdsTmp;
    unset($arDetailPhotoIdsTmp);
}

$arSort = array("id"=>"desc");
$arFilter = array(
	"ID" => $arDetailPhotoIds
);

$rsDetailPhoto = CFile::GetList(
	$arSort, 
	$arFilter
);

while($arItem = $rsDetailPhoto->Fetch())
{    
    $arItem["SRC"] = getFileSrc($arItem);
    $arDetailPhoto[$arItem["ID"]] = $arItem;
}
unset($arItem);

foreach($arResult["ITEMS"] as &$arItem)
{
    if($arItem["DETAIL_PICTURE"] !== false)
    {
        $arItem["DETAIL_PICTURE"] = $arDetailPhoto[$arItem["DETAIL_PICTURE"]];
    }
}
unset($arItem);

$count = sizeof($arResult["ITEMS"]);

$index = 1;
$arElement = $arResult["ITEMS"][0];
$flagDelProperty = true;

foreach($arElement["DISPLAY_PROPERTIES"] as $propKey=>&$arItem)
{
    if(empty($arItem["VALUE"]))
    {
        $flagDelProperty = true;
        
        $index = 1;
        while($index <= $count - 1)
        {
            if(!empty($arResult["ITEMS"][$index]["DISPLAY_PROPERTIES"][$propKey]["VALUE"]))
            {
                $flagDelProperty = false;
                break;
            }
            else
            {
                $flagDelProperty = true;
            }
            $index++;
        }
    }
    else
    {       
        $flagDelProperty = false;
    }
    
    if($flagDelProperty === true)
    {
        unset($arResult["SHOW_PROPERTIES"][$propKey]);
    }
}
unset($arItem);
?>