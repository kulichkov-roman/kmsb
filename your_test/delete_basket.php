<?require($_SERVER["DOCUMENT_ROOT"]. "/bitrix/modules/main/include/prolog_before.php");?>
<?
function getBasketOptionIds($productId){
	CModule::IncludeModule('sale');
	
	$fUser = CSaleBasket::GetBasketUserID();

	$strSql = "select bbasket.ID 
		from b_sale_basket bbasket join b_sale_basket_props as bprops on 
		bbasket.ID = bprops.BASKET_ID 
			where FUSER_ID = ". intval($fUser) ." AND bprops.CODE = 'MAIN_PRODUCT' AND bprops.VALUE = " . intval($productId) . "
		AND ORDER_ID IS NULL AND CAN_BUY = 'Y' AND DELAY = 'N' AND LID = '" . SITE_ID . "';";

	global $DB;
	$rsQuery = $DB -> Query($strSql);

	$arOptionIds = array();
	while($arDBFields = $rsQuery -> Fetch()){
		$basketItemId = $arDBFields["ID"];
		$arOptionIds[] = $basketItemId;
	}

	return $arOptionIds;
}