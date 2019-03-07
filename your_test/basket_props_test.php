<?require($_SERVER["DOCUMENT_ROOT"]. "/bitrix/modules/main/include/prolog_before.php");?>
<?
CModule::IncludeModule('sale');

$arBasketItemIds = array();
$arFindFilter = array(
	'FUSER_ID' 	=> CSaleBasket::GetBasketUserID(), 
	'LID' 		=> SITE_ID, 
	'ORDER_ID' 	=> 'NULL', 
	'DELAY' 	=> 'N', 
	'CAN_BUY' 	=> 'Y',
);

$rsBasket = CSaleBasket::GetList($arFindSort, $arFindFilter, false, false, array('ID'));
while($arBasket = $rsBasket ->Fetch()){
	$arBasketItemIds[] = $arBasket["ID"];
}

$arMainProducts = array();
$rsBasket = CSaleBasket::GetPropsList(
	array(),
	array(
		"@BASKET_ID" => $arBasketItemIds,
		"CODE" => "MAIN_PRODUCT"
	)
);
while ($arBasketProp = $rsBasket->Fetch())
{
	$basketItemId = $arBasketProp["BASKET_ID"];
   	$arMainProducts[$basketItemId] = $arBasketProp["VALUE"];
}

pre($arMainProducts);