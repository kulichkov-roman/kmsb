<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
global $APPLICATION;

$APPLICATION->SetPageProperty("description", $arResult["NAME"]);
$APPLICATION->SetPageProperty("title", $arResult["NAME"]);
$APPLICATION->AddChainItem($arResult['NAME'], "");
?>