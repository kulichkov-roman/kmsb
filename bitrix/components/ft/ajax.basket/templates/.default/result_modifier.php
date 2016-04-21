<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>

<?
// скрыть показ блока "показать все"
foreach($arResult["ITEMS"] as $arItem)
{
    if(sizeof($arItem["OPTIONS"])>0)
    {
        $arResult["OPTIONS_VIEW_ALL"] = true;
        break;
    }
}
?>