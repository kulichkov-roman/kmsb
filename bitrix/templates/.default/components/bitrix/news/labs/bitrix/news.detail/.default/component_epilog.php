<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$APPLICATION->SetPageProperty("description", $arResult["NAME"]);
$APPLICATION->SetPageProperty("title", $arResult["NAME"]);
$APPLICATION->AddChainItem($arResult['NAME'], "");
?>