<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$arParams['NUM_TO_SHOW'] = intval($arParams['NUM_TO_SHOW']);
if ($arParams['NUM_TO_SHOW'] <= 0) $arParams['NUM_TO_SHOW'] = $arParams['ELEMENT_COUNT'];
else $arParams['NUM_TO_SHOW'] = min($arParams['NUM_TO_SHOW'], $arParams['ELEMENT_COUNT']);

shuffle($arResult['ITEMS']);
if ($arResult['NUM_TO_SHOW'] != $arParams['ELEMENT_COUNT'])
{
	$arResult['ITEMS'] = array_slice($arResult['ITEMS'], 0, $arParams['NUM_TO_SHOW']);
}

$arResult["TD_WIDTH"] = round(100/$arParams["LINE_ELEMENT_COUNT"])."%";
$arResult["bDisplayButtons"] = $arParams["DISPLAY_COMPARE"] || count($arResult["PRICES"])>0;

//array_chunk
$arResult["ROWS"] = array();
while(count($arResult["ITEMS"])>0)
{
	$arRow = array_splice($arResult["ITEMS"], 0, $arParams["LINE_ELEMENT_COUNT"]);
	while(count($arRow) < $arParams["LINE_ELEMENT_COUNT"])
		$arRow[]=false;
	$arResult["ROWS"][]=$arRow;
}
?>
